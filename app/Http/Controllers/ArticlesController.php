<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resources\ArticlesResource;
use App\Http\Traits\ApiArticleResponse;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{

    use ApiArticleResponse;



    public function index(){
        $data= ArticlesResource::collection(Articles::all());
        $msg= 'RETURN ALL RECORDS';
        $status=200;

        return $this->ApiResponse($data,$msg,$status);
    }

    public function show($id){
        $data= Articles::find($id);
        if($data){
            $msg= 'Return one record';
            $status=200;
            return $this->ApiResponse(new ArticlesResource($data),$msg,$status);
        }else{
            $data=null;
            $msg= 'no such ID exist!';
            $status=201;
            return $this->ApiResponse($data,$msg,$status);
        }
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|unique:articles|max:11',
            'author' => 'required',
            'title'=> 'required',
            'category'=> 'required',
            'content'=> 'required',
            'status'=> 'required'
        ]);

        if ($validator->fails()) {
                $msg = 'please add data correctly';
                $status = 203;
                $data = $validator->errors();

            return $this->ApiResponse($data,$msg,$status);
        }

            $newCreate=Articles::create([
            'id' => $request->id,
            'author' => $request->author,
            'title'=> $request->title,
            'category'=> $request->category,
            'content'=> $request->content,
            'status'=> $request->status
            ]);

            $msg = 'CREATED NEW RECORD SUCCESSFULLY!!';
                $status = 201;
                $data = new ArticlesResource($newCreate);
                
            return $this->ApiResponse($data,$msg,$status);

    }

    public function delete(Request $request){
        $id= $request->id;
        $delete=Articles::find($id);
        $delete->delete();

        return $this->ApiResponse(null,'deleted successfully !',205);
    }

    public function update(Request $request){
        $old_id= $request->old_id;
        $article= Articles::find($old_id);

        $validator= Validator::make($request->all(),[
            'id' => 'required|unique:articles|max:11',
            'author' => 'required',
            'title'=> 'required',
            'category'=> 'required',
            'content'=> 'required',
            'status'=> 'required'
        ]);

        if($validator->fails()){
            return $this->ApiResponse($validator->errors(),'please enter data correctly',203);
        }

        $article->update([
            'id' => $request->id,
            'author' => $request->author,
            'title'=> $request->title,
            'category'=> $request->category,
            'content'=> $request->content,
            'status'=> $request->status
        ]);

        return $this->ApiResponse(new ArticlesResource($article),'UPDATED successfully !!',207);
    
    }
}
