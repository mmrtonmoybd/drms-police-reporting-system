<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banglo;
use Session;

class BanglosController extends Controller
{
     //This method list all users
     public function Index(Request $request){
        $session_user = Session::get('user');
        $query = Banglo::query();
        $query->orderBy('order_by', 'ASC');
            
        $data['banglos'] = $query->paginate(20);
        $data['request'] =  $request;
        return view('admin/banglo/banglos', $data);
    }


    //This method add new users
    public function AddBanglo(Request $request){
        return view('admin/banglo/banglos-add');
    }

    //this method for add new user
    public function Create(Request $request){
        

        $validated = $request->validate([
            'title' => 'required',
            'total_room' => 'required',
        ]);

        $insertAttr = [
            'title'=>$request->input('title'),
            'sub_title'=>$request->input('sub_title'),
            'total_room'=>$request->input('total_room'),
            'description'=>$request->input('description'),
            'address'=>$request->input('address'),
            'phone'=>$request->input('phone'),
            'email'=>$request->input('email'),
            
        ];

        if($request->file('image')){
            $path = $request->file('image')->store('public/banglos');
            $path =str_replace("public/banglos","",$path);

            $insertAttr['image'] = $path;
        }

        
        
        if(Banglo::insert($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/banglos');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return view('admin/banglo/banglos-add');
    }


    //this method for view edit()
    public function Edit(Request $request, $id){
        if(!$id or !is_numeric($id))
            return redirect('admin/banglos');
        
        $data['banglo'] = Banglo::where('id', $id)->first();
    
        if(!$data)
            return redirect('admin/banglos');
        return view('admin/banglo/banglos-edit', $data);
    }


    //this method for update user
    public function Update(Request $request, $id){
        

        $validated = $request->validate([
            'title' => 'required',
            'total_room' => 'required',
        ]);

        $insertAttr = [
            'title'=>$request->input('title'),
            'sub_title'=>$request->input('sub_title'),
            'total_room'=>$request->input('total_room'),
            'description'=>$request->input('description'),
            'address'=>$request->input('address'),
            'phone'=>$request->input('phone'),
            'email'=>$request->input('email'),
            
        ];



        if($request->file('image')){
            $path = $request->file('image')->store('public/banglos');
            $path =str_replace("public/banglos","",$path);

            $insertAttr['image'] = $path;
        }

        
        if(Banglo::where('id', $id)->update($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/banglos');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return view('admin/banglo/banglos-edit', ['course'=>$data]);
    }




    //this method for  user delete
    public function Delete(Request $request, $id=null){
        if(!$id or !is_numeric($id))
            return redirect('admin/banglos');

        $session_user = Session::get('user');
        if($session_user['type']!='Admin'){
            $request->session()->flash('error_msg', 'You don\'t have permission to delete any data');
            return redirect('admin/dashboard');
        }

        if(Banglo::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/banglos');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/banglos');
        }
        return redirect('admin/banglos');
    }

    //this method for short Gallerys
    public function Short(Request $request){
        if($request->input('orders')){
            $orders = $request->input('orders');
            if($orders){
                $counter=0;
               foreach($orders as $id){
                   $counter++;
                   $attr=array('order_by'=>$counter);
                   Banglo::where('id', $id)->update($attr);
               }
            }
        }
    }

}
