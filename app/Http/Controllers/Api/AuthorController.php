<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorsResource;
use App\Http\Traits\ApiAuthors;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    use ApiAuthors;

    public function index(){
        return $this->ApiResponse(AuthorsResource::collection(Author::all()),'RETURN ALL AUTHORS RECORD',200);
    }

    public function show($id){
        $data=Author::find($id);
        if($data){
            return $this->ApiResponse(new AuthorsResource($data),'RETURN ONE RECORD',200);
        }else{
            return $this->ApiResponse(null,'NO SUCH ID EXIST!',202);
        }
    }

    
    public function delete(Request $request){
        $id=$request->id;
        $delete=Author::find($id);
        $delete->delete();
        return $this->ApiResponse(null,'deleted successfully !',205);
    }

}
