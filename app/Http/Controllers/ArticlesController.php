<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

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
}
