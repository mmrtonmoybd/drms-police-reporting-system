<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Models\District;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        /*
        $this->middleware(function ($request, $next) {
            $session_user = Session::get('user');
            if (auth()->user()->type =='Admin' or auth()->user()->type =='DivisionAdmin') {
                //allowed
            } else {
                return redirect('admin/dashboard');
            }

            return $next($request);
        });

        */
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
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        return view('admin/user/users-add', $data);
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

    public function addsaShow()
    {
        $role = Role::all();
        return view('admin/user/users-addsa', ['roles' => $role]);
    }

    public function addsacreate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=> 'Super admin',
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('Super admin');
            $request->session()->flash('success_msg', 'Super admin created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addsa', ['roles' => $role]);
    }

    public function addspShow()
    {
        $data['districts'] = District::where('division_id', 1)->get();
        return view('admin/user/users-addsp', $data);
    }

    public function addspcreate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6',
            'districtID' => 'required',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=> 'SP',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('SP');
            $request->session()->flash('success_msg', 'SP created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addsp', ['roles' => $role]);
    }

    public function addocShow(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        return view('admin/user/users-addoc', $data);
    }

    public function addoccreate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6',
            'districtID' => 'required',
            'thanaID' => 'required',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=> 'OC',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
            'thanaID' => $request->input('thanaID')
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('OC');
            $request->session()->flash('success_msg', 'OC created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addoc', ['roles' => $role]);
    }

    public function addop1Show()
    {
        $data['districts'] = District::where('division_id', 1)->get();
        return view('admin/user/users-addop1', $data);
    }

    public function addop1create(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6',
            'districtID' => 'required',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=> 'operator 1',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('operator 1');
            $request->session()->flash('success_msg', 'operator 1 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addop1', ['roles' => $role]);
    }

    public function addop2Show()
    {
        $data['districts'] = District::where('division_id', 1)->get();
        return view('admin/user/users-addop2', $data);
    }

    public function addop2create(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6',
            'districtID' => 'required',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=> 'operator 2',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('operator 2');
            $request->session()->flash('success_msg', 'operator 2 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addop2', ['roles' => $role]);
    }

    public function addop3Show()
    {
        $data['districts'] = District::where('division_id', 1)->get();
        return view('admin/user/users-addop3', $data);
    }

    public function addop3create(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6',
            'districtID' => 'required',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=> 'operator 3',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('operator 3');
            $request->session()->flash('success_msg', 'operator 3 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addop3', ['roles' => $role]);
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
            'name' => 'required',
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
        ];

        if ($request->input('password')) {
            $insertAttr['password'] = Hash::make($request->input('password'));
        }


        if ($request->file('picture')) {
            $path = $request->file('picture')->store('public/users');
            $path =str_replace("public/users", "", $path);

            $insertAttr['picture'] = $path;
        }

        $data = User::find($id);

        if (User::where('id', $id)->update($insertAttr)) {
            $request->session()->flash('success_msg', 'Profile updated successfully');
            return view('admin/user/users-edit', ['user'=>$data]);
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

    public function ueditshow(Request $request, User $user)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $data['user'] = $user;
        $data['roles'] = Role::all();

        return view('admin/user/user-uedit', $data);
    }

    public function ueditupdate(Request $request, User $user)
    {
        $validated = $request->validate([
           'email' => 'required|email',
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
            'type'=>$request->input('type'),
        ];

        if ($request->input('password')) {
            $insertAttr['password'] = Hash::make($request->input('password'));
        }

        $usert = User::where('id', $user->id)->update($insertAttr);

        if ($usert) {
            $user->syncRoles($request->input('type'));
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $data['user'] = $user;
        $data['roles'] = Role::all();

        return view('admin/user/user-uedit', $data);
    }
}
