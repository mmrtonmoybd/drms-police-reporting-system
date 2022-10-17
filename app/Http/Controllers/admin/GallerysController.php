<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Session;


class GallerysController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $session_user = Session::get('user');
             if($session_user['type']=='Admin'){
                //allowed
             }
            else{
                return redirect('admin/dashboard');
            }
                
            return $next($request);
        });
    }

    //This method list all users
    public function Index(Request $request){
        $session_user = Session::get('user');
        $query = Gallery::query();
        $query->orderBy('order_by', 'ASC');
            
        $data['gallerys'] = $query->paginate(20);
        $data['request'] =  $request;
        return view('admin/gallery/gallerys', $data);
    }


    //This method add new users
    public function AddGallery(Request $request){
        return view('admin/gallery/gallerys-add');
    }

    //this method for add new user
    public function Create(Request $request){
        

        $validated = $request->validate([
            'title' => 'required',
        ]);

        $insertAttr = [
            'title'=>$request->input('title'),
            'sub_title'=>$request->input('sub_title'),
            'description'=>$request->input('description'),
            
        ];

        if($request->file('image')){
            $path = $request->file('image')->store('public/gallerys');
            $path =str_replace("public/gallerys","",$path);

            $insertAttr['image'] = $path;
        }

        
        
        if(Gallery::insert($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/gallerys');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return view('admin/gallery/gallerys-add');
    }


    //this method for view edit()
    public function Edit(Request $request, $id){
        if(!$id or !is_numeric($id))
            return redirect('admin/gallerys');
        
        $data['gallery'] = Gallery::where('id', $id)->first();
    
        if(!$data)
            return redirect('admin/gallerys');
        return view('admin/gallery/gallerys-edit', $data);
    }


    //this method for update user
    public function Update(Request $request, $id){
        

        $validated = $request->validate([
            'title' => 'required',
        ]);

        $insertAttr = [
            'title'=>$request->input('title'),
            'sub_title'=>$request->input('sub_title'),
            'description'=>$request->input('description'),
            
        ];



        if($request->file('image')){
            $path = $request->file('image')->store('public/gallerys');
            $path =str_replace("public/gallerys","",$path);

            $insertAttr['image'] = $path;
        }

        
        if(Gallery::where('id', $id)->update($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/gallerys');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return view('admin/gallery/gallerys-edit', ['gallery'=>$data]);
    }




    //this method for  user delete
    public function Delete(Request $request, $id=null){


        $session_user = Session::get('user');
        if($session_user['type']!='Admin'){
            $request->session()->flash('success_msg', 'You don\'t have permission to delete any data');
            return redirect('admin/dashboard');
        }
        
        if(!$id or !is_numeric($id))
            return redirect('admin/gallerys');

        if(Gallery::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/gallerys');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/gallerys');
        }
        return redirect('admin/gallerys');
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
                   Gallery::where('id', $id)->update($attr);
               }
            }
        }
    }
}
