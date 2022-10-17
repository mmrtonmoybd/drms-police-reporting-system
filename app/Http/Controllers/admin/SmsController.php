<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batche;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrolled;
use Session;

class SmsController extends Controller
{
    //Index function 

    public function Index(Request $request){

        $data=[];
        $data['request'] = $request;
        $data['courses'] = Course::get();

        $course_id = $request->get('course_id');
        $batch_id = $request->get('batch_id');

        if($course_id or $batch_id){

            $query = Enrolled::query();
            $query->orderBy('id', 'DESC');
            if( $course_id = $request->get('course_id'))
                $query->where('course_id', $course_id);
            if( $batch_id = $request->get('batch_id'))
                $query->where('batch_id', $batch_id);
            $data['total'] = $query->count();

        }else{
            $data['total'] = Student::count();
        }

        
        return view('admin/sms/sms-sender', $data);
    }
    

    //this method for sms send
    public function Send(Request $request){
        $course_id = $request->get('course_id');
        $batch_id = $request->get('batch_id');
        $your_phone = $request->input('your_phone');
        $message = $request->input('message');

        $numbers = '';

        if($course_id or $batch_id){
            $query = Enrolled::query();
            $query->orderBy('id', 'DESC');
            if( $course_id = $request->get('course_id'))
                $query->where('course_id', $course_id);
            if( $batch_id = $request->get('batch_id'))
                $query->where('batch_id', $batch_id);

            $total = $query->count();
            $students = $query->with('student')->get();

            $counter = 0;
            if($students){
                foreach($students as $student){
                    $counter++;
                    if(isset($student->student->phone)){
                        $numbers.='88'.$student->student->phone;
                        if($total!=$counter){
                            $numbers.=',';
                        }
                    }else{
                        $total--;
                    }
                    
                }
            }

        }else{
            $students = Student::get(['phone']);
            $total = Student::count();
            $counter = 0;
            if($students){
                foreach($students as $student){
                    $counter++;
                    $numbers.='88'.$student->phone;
                    if($total!=$counter){
                        $numbers.=',';
                    }
                }
            }

        }
        if($your_phone){
            $numbers.=',';
            $numbers.='88'.$your_phone;
        }

        if($numbers and $message){
            $status =  SmsSender::send($numbers, $message);
            $request->session()->flash('success_msg', 'Status is '.$status. '\n'
                .'1000 = Invalid user or Password \n
                1002 = Empty Number \n
                1003 = Invalid message or empty message \n
                1004 = Invalid number \n
                1005 = All Number is Invalid \n
                1006 = insufficient Balance \n
                1009 = Inactive Account \n
                1010 = Max number limit exceeded \n
                1101 = Success'
            );
        }else{
            $request->session()->flash('error_msg', 'Something  Wrong please try again');
        }
        return redirect('admin/sms');
    }
}
