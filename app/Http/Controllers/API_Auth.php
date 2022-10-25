<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTFactory;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;


use Validator;

class API_Auth extends Controller
{
    //user login method
    public function Login(Request $request)
    {
        $response = array();
        $token_key = env('JWT_SECRET');
        $email = $request->input('email');
        $password = md5($request->input('password'));

        $user = User::where('email', $email)->where('password', $password)->first();

        if ($user) {
            $decrypted=null;
            //try password dycription
            try {
                $decrypted = $user->password;
            } catch(\DecryptException $e) {
            }

            if ($decrypted) {
                if ($decrypted == $password) {
                    //successfully login need to generate access_token
                    $payload = array(
                        "iss" => "http://demo.org",
                        "aud" => $user->id,
                        "user_id" => $user->id,
                        "email" => $user->email,
                        "user_type" => 'member',
                        "sub" =>'token',
                        "iat" => time(),
                        "exp" => time()+31556952
                    );

                    $customClaims = $payload;
                    $factory = JWTFactory::customClaims($customClaims);
                    $payload = $factory->make();
                    $jwt = JWTAuth::encode($payload)->get();

                    $response=array(
                        'access_token' => $jwt,
                        'status'  => 'SUCCESS',
                        'message' => 'Login successfully completed',
                        'user' => $user
                    );
                } else {
                    $response=array(
                        'status'  => 'ERROR',
                        'message' => 'Password Cannot match'
                    );
                }
            } else {
                $response=array(
                    'status'  => 'ERROR',
                    'message' => 'Password Cannot Decrypted'
                );
            }
        } else {
            $response=array(
                'status'  => 'ERROR',
                'message' => 'User name not found'
            );
        }

        return response()->json($response);
    }


    //this method for signup
    public function SignUp(Request $request)
    {
        $response = array();
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:20',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:11|unique:users',
            'address' => 'required',
            'identity' => 'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'email' => 'required_with:confirm_email|same:confirm_email',
        ]);


        //check referal user details
        $insert_data = array(
            'name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'identity' => $request->input('identity'),
            'type' => 'Customer',
            'password' => md5($request->input('password'))
        );


        if ($validator->fails()) {
            $response=array(
                'status'  => 'ERROR',
                'message' => 'Something wrong in signup',
                'errors' => $validator->errors()
            );
        } else {
            if ($userID = User::insertGetId($insert_data)) {
                $response=array(
                    'status'  => 'SUCCESS',
                    'message' => 'You have signup Successfully',
                );

                $new_user = User::where('id', $userID)->first();

                $token_key = env('JWT_SECRET');
                $payload = array(
                    "iss" => "http://demo.org",
                    "aud" => $new_user->id,
                    "user_id" => $new_user->id,
                    "email" => $new_user->email,
                    "user_type" => 'member',
                    "sub" =>'access_token',
                    "iat" => time(),
                    "exp" => time()+31556952
                );

                $customClaims = $payload;
                $factory = JWTFactory::customClaims($customClaims);
                $payload = $factory->make();
                $jwt = JWTAuth::encode($payload)->get();

                $response['user'] = $new_user;
                $response['access_token'] = $jwt;

            //after completing signup send email
            // $this->sendEmail([
                //     'user_name' => $new_user->user_name,
                //     'name' => $new_user->name,
                //     'email' => $new_user->email,
                //     'subject' => 'Welcome to the best online earning and learning ocean!',
                //     'template' => 'signup-mail',
            // ]);

            //$this->sendGitf($new_user);
            } else {
                $response=array(
                    'status'  => 'ERROR',
                    'message' => 'Something wrong please try again',
                    'errors'  => array()
                );
            }
        }

        return response($response);
    }

    //this method for get bookings for customer
    public function Bookings(Request $request)
    {
        $response = array();
        $token = $request->header('Authorization');
        $user_id = JWTAuth::parseToken()->getPayload()->get('user_id');

        if ($user_id) {
            $query = Booking::query();
            $query->orderBy('id', 'DESC');
            $query->where('user_id', $user_id);
            $response = $query->get();
        }

        return response($response);
    }


    public function BookNow(Request $request)
    {
        $insertAttr = [];
        $response = array(
            'status'=> 'ERROR',
            'message'=> 'Something wrong please try again 1',
            'errors'=> [],
        );
        $token = $request->header('Authorization');
        $user_id = JWTAuth::parseToken()->getPayload()->get('user_id');

        if ($user_id) {
            $validator = Validator::make($request->all(), [
                'check_in' => 'required',
                'check_out' => 'required',
                'room_id' => 'required',
            ]);

            if ($validator->fails()) {
                $response=array(
                    'status'  => 'ERROR',
                    'message' => 'Something wrong in please try again 2'.$request->input('check_in'),
                    'errors' => $validator->errors()
                );
            } else {
                $room = Room::with('banglo')->where('id', $request->input('room_id'))->first();
                if ($room) {
                    $insertAttr = [
                        'user_id'=>$user_id,
                        'status'=>'requested',
                        'payment_status'=>'due',
                        'banglo_id'=>$room->banglo_id,
                        'price'=>$room->rent,
                        'adult'=>$request->input('adult'),
                        'child'=>$request->input('chield'),
                        'room_id'=>$request->input('room_id'),
                    ];
                    $insertAttr['check_in'] = Carbon::createFromFormat('d/m/Y', $request->input('check_in'))->format('Y-m-d H:m:s');
                    $insertAttr['check_out'] = Carbon::createFromFormat('d/m/Y', $request->input('check_out'))->format('Y-m-d H:m:s');

                    if ($userID = Booking::insertGetId($insertAttr)) {
                        $response=array(
                            'status'  => 'SUCCESS',
                            'message' => 'You have successfully booked the room',
                            'errors'=>[]
                        );
                    } else {
                        $response = array(
                        'status'=> 'ERROR',
                        'message'=> 'Something wrong 3',
                        'errors'=>[]
                        );
                    }
                } else {
                    $response = array(
                        'status'=> 'ERROR',
                        'message'=> 'We cannot found this room',
                        'errors'=>[]
                    );
                }
            }
        } else {
            $response = array(
                'status'=> 'ERROR',
                'message'=> 'This user is not authorized for booking',
                'errors'=>[]
            );
        }


        return response($response);
    }
}
