<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Actionlog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
    //ActionLog
    public function ActionLog(Request $request){
        $data = [
            'user_id'=>$request->userId,
            'post_id'=>$request->postId
        ];
        Actionlog::create($data);
        $data = Actionlog::where('post_id',$request->postId)->get();
        return response()->json([
            'post'=>$data
        ]);
    }
}
