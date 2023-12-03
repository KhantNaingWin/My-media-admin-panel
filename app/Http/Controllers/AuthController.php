<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     //login
     public function login(Request $request){
        $data=User::where('email',$request->email)->first();
        if (isset($data)) {

        if (Hash::check($request->password,$data->password)) {
            return response()->json([
                'user'=>$data,
                'token'=>$data->createToken(time())->plainTextToken
            ]);
        }else{
            return response()->json([
                'user'=>null,
                'token'=>null
            ]);
        }
        }else{
            return response()->json([
                'user'=>null,
                'token'=>null
            ]);
        }
    }
    //register
    public function register(Request $request){
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ];
        User::create($data);
        $user=User::where('email',$request->email)->first();
        return response()->json([
            'user'=>$user,
            'token'=>$user->createToken(time())->plainTextToken
        ]);
    }


    //CategoryList
    public function CategoryList(){
        $category=Category::get();

        return response()->json([
            'category'=>$category,
        ]);
    }
}
