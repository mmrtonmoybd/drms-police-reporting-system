<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Room;
use App\Models\Gallery;
use App\Models\Banglo;
use App\Models\Contact;
use App\Models\RoomCategory;
use Carbon\Carbon;
use Validator;



class API extends Controller
{
    //this method for return all data of website
    public function StoreContext(){
        $data=[
            'settings' => $this->settings(),
            'sliders' => $this->sliders(),
            'gallerys' => $this->gallerys(),
            'banglos' => $this->banglos(),
            'categories' => $this->categories(),
        ];

        return response()->json($data);
    }


    //this method for return all settings data
    public function settings(){
        $settingsGet = Setting::get();
        $settings = [];
        if($settingsGet){
            foreach($settingsGet as $setting){
                $settings[$setting->data_id] = $setting->data; 
            }
        }

        $settings['header_logo'] = asset('storage/settings'.$settings['header_logo']);
        $settings['footer_logo'] = asset('storage/settings'.$settings['footer_logo']);
        $settings['about_image'] = asset('storage/settings'.$settings['about_image']);

        return $settings;
    }




    //this method for return services
    public function sliders(){
        $slidersData = Slider::orderBy('order_by', 'ASC')->get(['title','sub_title','description', 'image']);
        $sliders =[];
        if($slidersData){
            foreach($slidersData as $slider){
                $slider->image = asset('storage/sliders'.$slider->image);
                $sliders[] = $slider;
            }
        }
        return $sliders;
    }


    //this method for return services
    public function banglos(){
        $banglosData = Banglo::orderBy('order_by', 'ASC')->get(['id','title','sub_title','total_room','address','description', 'image']);
        $banglos =[];
        if($banglosData){
            foreach($banglosData as $banglo){
                $banglo->image = asset('storage/banglos'.$banglo->image);
                $banglos[] = $banglo;
            }
        }
        return $banglos;
    }


    //this method for return services
    public function categories(){
        return $categoryData = RoomCategory::orderBy('id', 'ASC')->get();
        
    }


    //this method for return services
    public function gallerys(){
        $gallerysData = Gallery::orderBy('order_by', 'ASC')->get(['title','sub_title','description', 'image']);
        $gallerys =[];
        if($gallerysData){
            foreach($gallerysData as $gallery){
                $gallery->src = asset('storage/gallerys'.$gallery->image);
                $gallery->thumbnail = asset('storage/gallerys'.$gallery->image);
                $gallery->caption = $gallery->title;
                
                $gallerys[] = $gallery;
            }
        }
        return $gallerys;
    }

    

    //This method for get single dakbanglo details
    public function  DakbangloByID(Request $request, $id=null){
        $data = array();
        $data = Banglo::where('id', $id)->first();
        $data->image = asset('storage/banglos'.$data->image);
        return response()->json($data);
    }

    public function Rooms(Request $request, $id=null){
        
        $query = Room::query();
        $query->orderBy('order_by', 'ASC');
        if( $banglo_id = $request->get('banglo'))
            $query->where('banglo_id', $banglo_id);
        
        if( $category = $request->get('category'))
            $query->where('category', $category);

        if( $adult = $request->get('adult'))
            $query->where('max_adult', '>=', $adult);

        if( $max_children = $request->get('chield'))
            $query->where('max_children', '>=', $max_children);
            
        if( $id)
            $query->where('banglo_id', $id);

        $roomsData = $query->get();
        $rooms =[];
        if($roomsData){
            foreach($roomsData as $room){
                $room->big_picture = asset('storage/rooms'.$room->big_picture);
                $room->small_picture = asset('storage/rooms'.$room->small_picture);

                //if file not exists then set a defailt image
                // if(!file_exists($room->big_picture) ){
                //     $room->big_picture = asset('storage/rooms/no-photo.jpg');
                // }
                $rooms[] = $room;
            }
        }
        return response()->json($rooms);
    }

    //this methdo for get single room details
    public function RoomDetails(Request $request, $room_id=null){
        $response = [];
        if($room_id){
            $query = Room::query();
            $query->where('id', $room_id);
            $query->with(['room_category', 'banglo']);
            $room = $query->first();
            if($room){
                $room->big_picture = asset('storage/rooms'.$room->big_picture);
                $room->small_picture = asset('storage/rooms'.$room->small_picture);
                $response = $room;
            }
        }
        return response()->json($response);
    }


    //this method for add new user
    public function AddContact(Request $request){
        

        $response = array();

        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        
      

        $insertAttr = [
            'full_name'=>$request->input('full_name'),
            'phone'=>$request->input('phone'),
            'email'=>$request->input('email'),
            'message'=>$request->input('message'),
            
        ];

        if($validator->fails()){
            $response=array(
                'status'  => 'ERROR',
                'message' => 'Something wrong in form fillup',
                'errors' => $validator->errors()
            );
            
        }else{
            if(Contact::insert($insertAttr)){
                $response=array(
                    'status'  => 'SUCCESS',
                    'message' => 'Your message successfully send to website admin.',
                    'errors' => array()
                );

            }else{
                $response=array(
                    'status'  => 'ERROR',
                    'message' => 'Something wrong please try again',
                    'errors' => array()
                );
            }
        }
        
        

        
        return response()->json($response);
    }




}
