<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Session;

class ContactsController extends Controller
{
    //This method list all users
    public function Index(Request $request){
        $session_user = Session::get('user');
        $query = Contact::query();
        $query->orderBy('id', 'DESC');
            
        $data['contacts'] = $query->paginate(20);
        $data['request'] =  $request;
        return view('admin/contact/contacts', $data);
    }


    




    //this method for  user delete
    public function Delete(Request $request, $id=null){
        if(!$id or !is_numeric($id))
            return redirect('admin/contacts');

        if(Contact::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/contacts');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/contacts');
        }
        return redirect('admin/contacts');
    }
}
