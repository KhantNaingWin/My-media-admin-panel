<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    //Direct Dashboard
    public function dashboard(){
        $user=User::select('name','email','phone','address','gender')->where('id',Auth::user()->id)->first();
        // dd($user->toArray());
        return view('admin.profile.index',compact('user'));
    }
    //Admin Update
    public function adminUpdate(Request $request){
        $this->userAccountValidationCheck($request);
        $userData=$this->adminAccountUpdate($request);


        User::where('id',Auth::user()->id)->update($userData);
        return back()->with('updateSuccess','Account update successfully!');

    }
    //Direct Change Password
    public function directChangePassword(){
        return view('admin.profile.changePassword');
    }
    //Change Password
    public function adminChangePassword(Request $request){
        $this->changePasswordValidationCheck($request);
        $dbpassword=User::where('id',Auth::user()->id)->first();
        $newPassword=Hash::make($request->newPassword);
        if (Hash::check($request->oldPassword,$dbpassword->password)) {
            User::where('id',Auth::user()->id)->update([
                'password'=>$newPassword
            ]);
         return redirect()->route('dashboard');
        }else{
            return back()->with('fail','Your Old Password is wrong!Try Again');
        }
    }

    //adminAccountUpdate
    private function adminAccountUpdate($request){
        return [
            'name'=>$request->inputName,
            'email'=>$request->inputEmail,
            'phone'=>$request->inputPhone,
            'address'=>$request->inputAddress,
            'gender'=>$request->inputGender,
            'updated_at'=>Carbon::now()
        ];
    }
    //userAccountValidationCheck
    private function userAccountValidationCheck($request){
        $validator=$request->validate([
            'inputName'=>'required',
            'inputEmail'=>'required',
        ]);
        return $validator;
    }
    //changePasswordValidationCheck
    private function changePasswordValidationCheck($request){
        return Validator::make($request->all(),[
            'oldPassword'=>'required',
            // 'newPassword'=>'unique:users,password|required|min:6|max:15',
            'confirmPassword'=>'required|same:newPassword|min:6'
        ])->validate();
    }
}
