<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $session_user = Session::get('user');
            if (auth()->user()->type =='Admin' or auth()->user()->type =='DivisionAdmin') {
                //allowed
            } else {
                return redirect('admin/dashboard');
            }

            return $next($request);
        });
    }
    //This method list all users
    public function Index(Request $request)
    {
        $session_user = Session::get('user');
        $query = User::query();
        $query->orderBy('id', 'DESC');

        if ($name = $request->get('name')) {
            $query->where('name', 'LIKE', '%'.$name.'%');
        }
        if ($phone = $request->get('phone')) {
            $query->where('phone', 'LIKE', '%'.$phone.'%');
        }
        if ($email = $request->get('email')) {
            $query->where('email', 'LIKE', '%'.$email.'%');
        }



        $data['users'] = $query->paginate(10);
        $data['request'] =  $request;
        return view('admin/user/users', $data);
    }


    //This method add new users
    public function AddUser(Request $request)
    {
        return view('admin/user/users-add');
    }

    //this method for add new user
    public function Create(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'phone' => 'required',
            'name' => 'required',
            'type' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6'
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'type'=>$request->input('type'),
            'address'=>$request->input('address'),
            'designation'=>$request->input('designation'),
            'picture'=>'avatar-1.jpg',
            'password'=>md5($request->input('password')),
        ];

        if ($request->file('picture')) {
            $path = $request->file('picture')->store('public/users');
            $path =str_replace("public/users", "", $path);
            $insertAttr['picture'] = $path;
        }

        if (User::insert($insertAttr)) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }


        return view('admin/user/users-add');
    }


    //this method for view edit()
    public function Edit(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/users');
        }

        $data['user'] = User::where('id', $id)->first();

        if (!$data) {
            return redirect('admin/users');
        }
        return view('admin/user/users-edit', $data);
    }


    //this method for update user
    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required',
            'name' => 'required',
            'type' => 'required'
        ]);

        if ($request->input('password')) {
            $validated = $request->validate(
                [
                    'password' => 'min:6|required_with:confirm-password|same:confirm-password',
                    'confirm-password' => 'min:6'
                ]
            );
        }

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'type'=>$request->input('type'),
            'address'=>$request->input('address'),
            'designation'=>$request->input('designation'),
        ];

        if ($request->input('password')) {
            $insertAttr['password'] = md5($request->input('password'));
        }


        if ($request->file('picture')) {
            $path = $request->file('picture')->store('public/users');
            $path =str_replace("public/users", "", $path);

            $insertAttr['picture'] = $path;
        }

        if (User::where('id', $id)->update($insertAttr)) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }


        return view('admin/user/users-edit', ['user'=>$data]);
    }




    //this method for  user delete
    public function Delete(Request $request, $id=null)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/users');
        }

        if (User::where('id', $id)->delete()) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/users');
        }
        return redirect('admin/users');
    }
}
