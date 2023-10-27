<?php

namespace App\Http\Traits;

trait ApiArticleResponse{

    public function ApiResponse($data=null,$msg=null,$status=null){
        $array=[
            'msg' => $msg,
            'status' => $status,
            'data' => $data
        ];
        return response()->json($array);
    }

}