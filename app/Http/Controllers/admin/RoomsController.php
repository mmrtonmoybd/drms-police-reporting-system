<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Banglo;
use Session;

class RoomsController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $session_user = Session::get('user');
             if($session_user['type']=='Admin' or $session_user['type']=='Manager'){
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
        $query = Room::query();
        $query->orderBy('order_by', 'ASC');
        $query->with(['room_category', 'banglo']);
        $data['rooms'] = $query->paginate(20);
        $data['categories'] = RoomCategory::get();
        $data['banglos'] = Banglo::get();
        $data['request'] =  $request;
        return view('admin/room/rooms', $data);
    }


    //This method add new users
    public function AddRoom(Request $request){
        $data['categories'] = RoomCategory::get();
        $data['banglos'] = Banglo::get();
        return view('admin/room/rooms-add', $data);
    }

    //this method for add new user
    public function Create(Request $request){
        

        $validated = $request->validate([
            'title' => 'required',
            'rent' => 'required',
        ]);

        $insertAttr = [
            'title'=>$request->input('title'),
            'rent'=>$request->input('rent'),
            'max_adult'=>$request->input('max_adult'),
            'max_children'=>$request->input('max_children'),
            'bed_count'=>$request->input('bed_count'),
            'category'=>$request->input('category'),
            'banglo_id'=>$request->input('banglo_id'),
            'description'=>$request->input('description'),
            
        ];

        if($request->file('big_picture')){
            $path = $request->file('big_picture')->store('public/rooms');
            $path =str_replace("public/rooms","",$path);

            $insertAttr['big_picture'] = $path;
        }

        
        
        if(Room::insert($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/rooms');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return view('admin/room/roomos-add');
    }


    //this method for view edit()
    public function Edit(Request $request, $id){
        if(!$id or !is_numeric($id))
            return redirect('admin/rooms');
        
        $data['room'] = Room::where('id', $id)->first();
        $data['categories'] = RoomCategory::get();
        $data['banglos'] = Banglo::get();
    
        if(!$data)
            return redirect('admin/room');
        return view('admin/room/rooms-edit', $data);
    }


    //this method for update user
    public function Update(Request $request, $id){
        

        $validated = $request->validate([
            'title' => 'required',
            'rent' => 'required',
        ]);

        $insertAttr = [
            'title'=>$request->input('title'),
            'rent'=>$request->input('rent'),
            'max_adult'=>$request->input('max_adult'),
            'max_children'=>$request->input('max_children'),
            'bed_count'=>$request->input('bed_count'),
            'category'=>$request->input('category'),
            'banglo_id'=>$request->input('banglo_id'),
            'description'=>$request->input('description'),
            
        ];



        if($request->file('big_picture')){
            $path = $request->file('big_picture')->store('public/rooms');
            $path =str_replace("public/rooms","",$path);

            $insertAttr['big_picture'] = $path;
        }

        
        if(Room::where('id', $id)->update($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/rooms');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        $data['categories'] = RoomCategory::get();
        $data['banglos'] = Banglo::get();
        return view('admin/room/rooms-edit', ['room'=>$data]);
    }




    //this method for  user delete
    public function Delete(Request $request, $id=null){


        $session_user = Session::get('user');
        if($session_user['type']!='Admin'){
            $request->session()->flash('success_msg', 'You don\'t have permission to delete any data');
            return redirect('admin/dashboard');
        }
        
        if(!$id or !is_numeric($id))
            return redirect('admin/rooms');

        if(Room::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/rooms');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/rooms');
        }
        return redirect('admin/rooms');
    }

    //this method for short Rooms
    public function Short(Request $request){
        if($request->input('orders')){
            $orders = $request->input('orders');
            if($orders){
                $counter=0;
               foreach($orders as $id){
                   $counter++;
                   $attr=array('order_by'=>$counter);
                   Room::where('id', $id)->update($attr);
               }
            }
        }
    }
}
