<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    //adminList
    public function adminList(){
        $userData=User::get();
        return view('admin.list.index',compact('userData'));
    }
    //adminDelete
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with('delete','Admin Account Delete Successful!');
    }
    //adminSearchList
    public function adminSearchList(Request $request){
        $userData=User::orwhere('name','like','%'.$request->adminSearchKey.'%')
                        ->orwhere('email','like','%'.$request->adminSearchKey.'%')
                        ->orwhere('phone','like','%'.$request->adminSearchKey.'%')
                        ->orwhere('address','like','%'.$request->adminSearchKey.'%')
                        ->orwhere('gender','like','%'.$request->adminSearchKey.'%')              
                        ->get();
       return view('admin.list.index',compact('userData')); 
    }
}
