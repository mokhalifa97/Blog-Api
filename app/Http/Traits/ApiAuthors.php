<?php

namespace App\Http\Traits;

trait ApiAuthors{

    public function ApiResponse($data=null,$msg=null,$status=null){
        $array=[
            'message' => $msg,
            'status' => $status,
            'data' => $data
        ];
        return response()->json($array);
    }

}