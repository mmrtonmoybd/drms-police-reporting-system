<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class AdminLogin extends Controller
{
    //index function for load defailt login form
    public function index(Request $request)
    {
        //if youser already loged in -> redirect to home page
        $user = $request->session()->get('user');

        if ($user and isset($user['login']) and $user['login']==true) {
            return redirect('admin/dashboard');
        }

        return view('admin/login');
    }


    //Try Lgoin
    public function tryLogin(Request $request)
    {
        //if youser already loged in -> redirect to home page
        $user = $request->session()->get('user');
        if ($user and isset($user['login']) and $user['login']==true) {
            return redirect('admin/dashboard');
        }

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $password = md5($request->input('password'));


        $email = $request->input('email');
        $user = User::where(['email'=>$email, 'password'=>$password])->first();



        if ($user) {
            $user = array('id'=>$user->id,'login'=>true, 'username'=>$user->email, 'password'=>$user->password, 'type'=>$user->type, 'name'=>$user->name, 'picture'=>$user->picture, 'designation'=>$user->designation, 'officeID'=>$user->officeID);
            $request->session()->put('user', $user);
            $request->session()->flash('success_msg', 'Login successs');
            //update user login time
            User::where('id', $user['id'])->update(['last_login'=>time()+30]);
            //redirect to dashboard
            redirect('admin/dashboard');
        } else {
            $request->session()->flash('error_msg', 'Email and  password dose not match.');
        }

        //truy to login


        return redirect('admin/dashboard');
    }


    //this method for ogout
    public function LogOut(Request $request)
    {
        $request->session()->pull('user');
        return redirect('admin/login');
    }
}
