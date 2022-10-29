<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Models\District;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    //This method list all users
    public function Index(Request $request)
    {
        $query = User::query();
        $query->orderBy('id', 'ASC');

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

    public function addsaShow()
    {
        $role = Role::all();
        return view('admin/user/users-addsa', ['roles' => $role]);
    }

    public function addsacreate(Request $request)
    {
         $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'min:6|required_with:confirm-password|same:confirm-password',
            'confirm-password' => 'min:6',
        ]);

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=> 'Super Admin',
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('Super Admin');
            $request->session()->flash('success_msg', 'Super Admin created successful');
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
        $request->validate([
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
         $request->validate([
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

    public function addspop1Show()
    {
        $data['districts'] = District::where('division_id', 1)->get();
        return view('admin/user/users-addop1', $data);
    }

    public function addspop1create(Request $request)
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
            'type'=> 'SP-Operator 1',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('SP-Operator 1');
            $request->session()->flash('success_msg', 'SP-Operator 1 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addop1', ['roles' => $role]);
    }

    public function addspop2Show()
    {
        $data['districts'] = District::where('division_id', 1)->get();
        return view('admin/user/users-addop2', $data);
    }

    public function addspop2create(Request $request)
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
            'type'=> 'SP-Operator 2',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('SP-Operator 2');
            $request->session()->flash('success_msg', 'SP-Operator 2 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addop2', ['roles' => $role]);
    }


    public function addocop1Show(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        return view('admin/user/users-addocop1', $data);
    }

    public function addocop1create(Request $request)
    {
         $request->validate([
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
            'type'=> 'OC-Operator 1',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
            'thanaID' => $request->input('thanaID')
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('OC-Operator 1');
            $request->session()->flash('success_msg', 'OC-Operator 1 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addocop1', ['roles' => $role]);
    }

    public function addocop2Show(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        return view('admin/user/users-addocop2', $data);
    }

    public function addocop2create(Request $request)
    {
         $request->validate([
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
            'type'=> 'OC-Operator 2',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
            'thanaID' => $request->input('thanaID')
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('OC-Operator 2');
            $request->session()->flash('success_msg', 'OC-Operator 2 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addocop2', ['roles' => $role]);
    }

    public function addocop3Show(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        return view('admin/user/users-addocop3', $data);
    }

    public function addocop3create(Request $request)
    {
         $request->validate([
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
            'type'=> 'OC-Operator 3',
            'districtID' => $request->input('districtID'),
            'password'=> Hash::make($request->input('password')),
            'thanaID' => $request->input('thanaID')
        ];

        //dd($insertAttr);

        $user = User::create($insertAttr);


        if ($user) {
            $user->assignRole('OC-Operator 3');
            $request->session()->flash('success_msg', 'OC-Operator 3 created successful');
            return redirect('admin/users');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $role = Role::all();

        return view('admin/user/users-addocop3', ['roles' => $role]);
    }




    //this method for view edit()
    public function Edit(Request $request, $id)
    {
        Gate::authorize('profile', $id);

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
        Gate::authorize('profile', $id);
         $request->validate([
            'name' => 'required',
        ]);

        if ($request->input('password')) {
             $request->validate(
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
            $request->validate(
                [
                    'picture' => 'image'
                ]
            );
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
         $request->validate([
           'email' => 'required|email',
           'name' => 'required',
           'type' => 'required'
        ]);

        if ($request->input('password')) {
             $request->validate(
                [
                    'password' => 'min:6|required_with:confirm-password|same:confirm-password',
                    'confirm-password' => 'min:6'
                ]
            );
        }

        if ($request->input('type') == 'SP' || $request->input('type') == 'SP-Operator 1' || $request->input('type') == 'SP-Operator 2') {
            $request->validate(
                [
                    'districtID' => 'required'
                ]
            );
        }

        if ($request->input('type') == 'OC' || $request->input('type') == 'OC-Operator 1' || $request->input('type') == 'OC-Operator 2' || $request->input('type') == 'OC-Operator 3') {
            $request->validate(
                [
                    'districtID' => 'required',
                    'thanaID' => 'required'
                ]
            );
        }

        $insertAttr = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'type'=>$request->input('type'),
            'districtID' => $request->input('districtID'),
            'thanaID' => $request->input('thanaID')
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
