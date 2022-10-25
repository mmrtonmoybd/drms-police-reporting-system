<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Session;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $session_user = Session::get('user');
             if(auth()->user()->type=='Admin'){
                //allowed
             }
            else{
                return redirect('admin/dashboard');
            }
                
            return $next($request);
        });
    }
    
    //index function
    public function Index(){
        $settingsGet = Setting::get();
        $settings = [];
        if($settingsGet){
            foreach($settingsGet as $setting){
                $settings[$setting->data_id] = $setting->data; 
            }
        }
        
        $data['settings'] = $settings;
        return view('admin/settings/settings', $data);
    }


    //this method for settings data should save
    public function SaveData(Request $request){
        $settingsGet = Setting::get();
        $settings = [];
        $addOptions = [];

        //clear settings  fields
        if($settingsGet){
            foreach($settingsGet as $setting){
                $settings[$setting->data_id] = $setting->data; 
            }
        }
        


        //update header phone
        if(isset($settings['header_phone'])){
            $settings['header_phone'] = $request->input('header_phone');
        }else{
            $addOptions['header_phone'] = $request->input('header_phone');
            $settings['header_phone'] = $request->input('header_phone');
        }
            

        //update header email
        if(isset($settings['header_email'])){
            $settings['header_email'] = $request->input('header_email');
        }else{
            $addOptions['header_email'] = $request->input('header_email');
            $settings['header_email'] = $request->input('header_email');
        }
            

        //update header logo
        if(isset($settings['header_logo'])){
            $header_logo = $this->UploadFile('header_logo', $request);
            if($header_logo){
                $settings['header_logo'] = $header_logo;
            }
        }else{
            $header_logo = $this->UploadFile('header_logo', $request);
            $addOptions['header_logo'] = $header_logo ? $header_logo : null;
            $settings['header_logo'] = $header_logo ? $header_logo : null;
        }
            
        
        //update footer phone
        if(isset($settings['footer_phone'])){
            $settings['footer_phone'] = $request->input('footer_phone');
        }else{
            $addOptions['footer_phone'] = $request->input('footer_phone');
            $settings['footer_phone'] = $request->input('footer_phone');
        }
            

        //update footer email
        if(isset($settings['footer_email'])){
            $settings['footer_email'] = $request->input('footer_email');
        }else{
            $addOptions['footer_email'] = $request->input('footer_email');
            $settings['footer_email'] = $request->input('footer_email');
        }
            
            

        //update footer email
        if(isset($settings['footer_address'])){
            $settings['footer_address'] = $request->input('footer_address');
        }else{
            $addOptions['footer_address'] = $request->input('footer_address');
            $settings['footer_address'] = $request->input('footer_address');
        }
            
            

        //update footer copy
        if(isset($settings['footer_copyright'])){
            $settings['footer_copyright'] = $request->input('footer_copyright');
        }else{
            $addOptions['footer_copyright'] = $request->input('footer_copyright');
            $settings['footer_copyright'] = $request->input('footer_copyright');
        }
            

        //update footer logo
        if(isset($settings['footer_logo'])){
            $footer_logo = $this->UploadFile('footer_logo', $request);
            if($footer_logo){
                $settings['footer_logo'] = $footer_logo;
            }
        }else{
            $footer_logo = $this->UploadFile('footer_logo', $request);
            $addOptions['footer_logo'] = $footer_logo ? $footer_logo : null;
            $settings['footer_logo'] = $footer_logo ? $footer_logo : null;
        }



        
        
        //update footer phone
        if(isset($settings['contact_phone'])){
            $settings['contact_phone'] = $request->input('contact_phone');
        }else{
            $addOptions['contact_phone'] = $request->input('contact_phone');
            $settings['contact_phone'] = $request->input('contact_phone');
        }
            

        //update footer email
        if(isset($settings['contact_email'])){
            $settings['contact_email'] = $request->input('contact_email');
        }else{
            $addOptions['contact_email'] = $request->input('contact_email');
            $settings['contact_email'] = $request->input('contact_email');
        }
            
            

        //update footer email
        if(isset($settings['contact_short_text'])){
            $settings['contact_short_text'] = $request->input('contact_short_text');
        }else{
            $addOptions['contact_short_text'] = $request->input('contact_short_text');
            $settings['contact_short_text'] = $request->input('contact_short_text');
        }

        //update footer email
        if(isset($settings['contact_map'])){
            $settings['contact_map'] = $request->input('contact_map');
        }else{
            $addOptions['contact_map'] = $request->input('contact_map');
            $settings['contact_map'] = $request->input('contact_map');
        }
            

        //update about title
        if(isset($settings['about_title'])){
            $settings['about_title'] = $request->input('about_title');
        }else{
            $addOptions['about_title'] = $request->input('about_title');
            $settings['about_title'] = $request->input('about_title');
        }

        //update about description
        if(isset($settings['about_description'])){
            $settings['about_description'] = $request->input('about_description');
        }else{
            $addOptions['about_description'] = $request->input('about_description');
            $settings['about_description'] = $request->input('about_description');
        }


        
        //update footer logo
        if(isset($settings['about_image'])){
            $about_image = $this->UploadFile('about_image', $request);
            if($about_image){
                $settings['about_image'] = $about_image;
            }
        }else{
            $about_image = $this->UploadFile('about_image', $request);
            $addOptions['about_image'] = $about_image ? $about_image : null;
            $settings['about_image'] = $about_image ? $about_image : null;
        }



        
        //update opening hourse
        if(isset($settings['saturday_open'])){
            $settings['saturday_open'] = $request->input('saturday_open');
        }else{
            $addOptions['saturday_open'] = $request->input('saturday_open');
            $settings['saturday_open'] = $request->input('saturday_open');
        }

        
        //update opening hourse
        if(isset($settings['sunday_open'])){
            $settings['sunday_open'] = $request->input('sunday_open');
        }else{
            $addOptions['sunday_open'] = $request->input('sunday_open');
            $settings['sunday_open'] = $request->input('sunday_open');
        }
        
        //update opening hourse
        if(isset($settings['monday_open'])){
            $settings['monday_open'] = $request->input('monday_open');
        }else{
            $addOptions['monday_open'] = $request->input('monday_open');
            $settings['monday_open'] = $request->input('monday_open');
        }
        
        //update opening hourse
        if(isset($settings['tudesday_open'])){
            $settings['tudesday_open'] = $request->input('tudesday_open');
        }else{
            $addOptions['tudesday_open'] = $request->input('tudesday_open');
            $settings['tudesday_open'] = $request->input('tudesday_open');
        }
        
        //update opening hourse
        if(isset($settings['wednesday_open'])){
            $settings['wednesday_open'] = $request->input('wednesday_open');
        }else{
            $addOptions['wednesday_open'] = $request->input('wednesday_open');
            $settings['wednesday_open'] = $request->input('wednesday_open');
        }
        
        //update opening hourse
        if(isset($settings['thursday_open'])){
            $settings['thursday_open'] = $request->input('thursday_open');
        }else{
            $addOptions['thursday_open'] = $request->input('thursday_open');
            $settings['thursday_open'] = $request->input('thursday_open');
        }
        
        //update opening hourse
        if(isset($settings['friday_open'])){
            $settings['friday_open'] = $request->input('friday_open');
        }else{
            $addOptions['friday_open'] = $request->input('friday_open');
            $settings['friday_open'] = $request->input('friday_open');
        }

            
        $this->UpdateSettings($addOptions, $settings);

        $request->session()->flash('success_msg', 'Data updated successfully');
        return redirect('admin/settings');

    }



    //update settings
    public function UpdateSettings($addOptions, $settings){
        $addOptionsAttr = [];
        $updateOptionsAttr = [];

        //add options
        if($addOptions){
            foreach($addOptions as $key=>$addItem){
                $addOptionsAttr[] = ['data_id'=>$key, 'data'=>$addItem];
            }

            Setting::insert($addOptionsAttr);
        }

        //update options
        if($settings){
            foreach($settings as $key=>$addItem){
                Setting::where('data_id', $key)->update(['data_id'=>$key, 'data'=>$addItem]);
            }


        }
    }




    //this method for file upload
    public function UploadFile($field_name, $request){
        $filepath = null;
        if($request->file($field_name)){
            $path = $request->file($field_name)->store('public/settings');
            $path =str_replace("public/settings","",$path);
            $filepath = $path;
        }
        
        return $filepath;
    }
}
