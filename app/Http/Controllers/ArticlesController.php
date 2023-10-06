<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resources\ArticlesResource;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    public function index(){
        $articles=Articles::all();
        $data=[
            'msg' => 'All Data Return',
            'status' => 200,
            'data' => $articles
        ];
        return response()->json($data);
    }

    public function show($id){
        $article=Articles::find($id);
        if($article){
            $data=[
                'msg' => 'Return one record',
                'status' => 200,
                'data' => $article
            ];
            return response()->json($data);
        }else{
            $data=[
                'msg' => 'no such ID exist!',
                'status' => 201,
                'data' => null
            ];
            return response()->json($data);
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
            $data=[
                'msg' => 'please add data correctly',
                'status' => 203,
                'data' => $validator->errors()
            ];
            return response()->json($data);
        }

            $newCreate=Articles::create([
            'id' => $request->id,
            'author' => $request->author,
            'title'=> $request->title,
            'category'=> $request->category,
            'content'=> $request->content,
            'status'=> $request->status
            ]);

            $data=[
                "msg"=> "CREATED NEW RECORD SUCCESSFULLY!!",
                "status"=> 201,
                "data" => new ArticlesResource($newCreate)
            ];
            return response()->json($data);
        
    }

    public function delete(Request $request){
        $id= $request->id;
        $delete=Articles::find($id);
        $delete->delete();
        $data=[
            "msg"=> "deleted successfully !",
            "status"=> 205,
            "data" => null
        ];
        return response()->json($data);
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
            $data=[
                'msg' => 'please add data correctly',
                'status' => 203,
                'data' => $validator->errors()
            ];
            return response()->json($data);
        }

        $article->update([
            'id' => $request->id,
            'author' => $request->author,
            'title'=> $request->title,
            'category'=> $request->category,
            'content'=> $request->content,
            'status'=> $request->status
        ]);

        $data=[
            "msg"=> "UPDATED successfully !!",
            "status"=> 207,
            "data" => new ArticlesResource($article)
        ];
        return response()->json($data);
    
    }
}
