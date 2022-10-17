<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\AdminLogin;
use App\Http\Controllers\admin\AreaController;

use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\QrrsController;
use App\Http\Controllers\admin\GallerysController;
use App\Http\Controllers\admin\BanglosController;
use App\Http\Controllers\admin\ContactsController;
use App\Http\Controllers\admin\AccountsController;
use App\Http\Controllers\admin\SmsController;
use App\Http\Controllers\admin\RoomsController;
use App\Http\Controllers\admin\BookingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('storage:link');
    // return what you want
});

Route::get('/', function () {
    return redirect('admin/dashboard');
});





//apply middle ware for admin
Route::fallback([Dashboard::class, 'NotFound']);
Route::get('/admin',  function(){
    return redirect('admin/dashboard');
});
Route::prefix('admin')->group(function(){

    Route::get('/login',  [AdminLogin::class, 'Index']);
    Route::post('/login',  [AdminLogin::class, 'TryLogin']);
    Route::get('/logout',  [AdminLogin::class, 'LogOut']);
    


    Route::group(['middleware'=>'adminProtection'], function(){

        Route::get('/dashboard',  [Dashboard::class, 'Index']);
        Route::get('/dashboard/testsms',  [Dashboard::class, 'smsTest']);
        Route::get('/sms',  [SmsController::class, 'Index']);
        Route::post('sms/send',  [SmsController::class, 'Send']);

        Route::get('/districts/{division_id}', [AreaController::class, 'getDistricts']);
        Route::get('/upazilas/{district_id}', [AreaController::class, 'getUpazilas']);
        Route::get('/thanas/{district_id}', [AreaController::class, 'getThanas']);
    
      





        //new working

        //this routes for acccounts controller
        Route::get('/accounts', [AccountsController::class, 'Index']);
        Route::get('/accounts/edit/{id}', [AccountsController::class, 'Edit']);
        Route::post('/accounts', [AccountsController::class, 'Create']);
        Route::post('/accounts/update/{id}', [AccountsController::class, 'Update']);
        Route::get('/accounts/delete/{id}', [AccountsController::class, 'Delete']);
        
        Route::get('/accounts/category', [AccountsController::class, 'CategoryIndex']);
        Route::get('/accounts/category/edit/{id}', [AccountsController::class, 'CategoryEdit']);
        Route::post('/accounts/category', [AccountsController::class, 'CategoryCreate']);
        Route::post('/accounts/category/update/{id}', [AccountsController::class, 'CategoryUpdate']);
        Route::get('/accounts/category/delete/{id}', [AccountsController::class, 'CategoryDelete']);

        //admin contacts
        Route::get('/contacts',  [ContactsController::class, 'Index']);
        Route::get('/contacts/delete/{id}',  [ContactsController::class, 'Delete']);
        
       

        //admin dak banglos routes
        Route::get('/banglos',  [BanglosController::class, 'Index']);
        Route::post('/banglos/short',  [BanglosController::class, 'Short']);
        Route::get('/banglos/add',  [BanglosController::class, 'AddBanglo']);
        Route::post('/banglos/add',  [BanglosController::class, 'Create']);
        Route::get('/banglos/delete/{id}',  [BanglosController::class, 'Delete']);
        Route::get('/banglos/edit/{id}',  [BanglosController::class, 'Edit']);
        Route::post('/banglos/edit/{id}',  [BanglosController::class, 'Update']);

        
       

        //admin dak banglos routes
        Route::get('/rooms',  [RoomsController::class, 'Index']);
        Route::post('/rooms/short',  [RoomsController::class, 'Short']);
        Route::get('/rooms/add',  [RoomsController::class, 'AddRoom']);
        Route::post('/rooms/add',  [RoomsController::class, 'Create']);
        Route::get('/rooms/delete/{id}',  [RoomsController::class, 'Delete']);
        Route::get('/rooms/edit/{id}',  [RoomsController::class, 'Edit']);
        Route::post('/rooms/edit/{id}',  [RoomsController::class, 'Update']);


        //this routes for booking controller
        
        Route::get('/bookings',  [BookingsController::class, 'Index']);
        Route::get('/bookings/delete/{id}',  [BookingsController::class, 'Delete']);
        Route::get('/bookings/edit/{id}',  [BookingsController::class, 'Edit']);
        Route::post('/bookings/edit/{id}',  [BookingsController::class, 'Update']);
        Route::get('/bookings/print/{id}',  [BookingsController::class, 'Print']);
        

        //admin qrrs route
        Route::get('/qrrs',  [QrrsController::class, 'Index']);
        Route::post('/qrrs/short',  [QrrsController::class, 'Short']);
        Route::post('/qrrs/search',  [QrrsController::class, 'SearchSort']);
        Route::get('/qrrs/add',  [QrrsController::class, 'AddQrr']);
        Route::post('/qrrs/add',  [QrrsController::class, 'Create']);
        Route::get('/qrrs/delete/{id}',  [QrrsController::class, 'Delete']);
        Route::get('/qrrs/edit/{id}',  [QrrsController::class, 'Edit']);
        Route::post('/qrrs/edit/{id}',  [QrrsController::class, 'Update']);
        Route::get('/qrrs/details/{id}',  [QrrsController::class, 'View']);
        Route::get('/qrrs/print-details/{id}',  [QrrsController::class, 'PrintView']);
        Route::get('/qrrs/charts', [QrrsController::class, 'chart']);
        Route::get('/qrrs/report/{report}', [QrrsController::class, 'report']);

        

        //admin gallerys route
        Route::get('/gallerys',  [GallerysController::class, 'Index']);
        Route::post('/gallerys/short',  [GallerysController::class, 'Short']);
        Route::get('/gallerys/add',  [GallerysController::class, 'AddGallery']);
        Route::post('/gallerys/add',  [GallerysController::class, 'Create']);
        Route::get('/gallerys/delete/{id}',  [GallerysController::class, 'Delete']);
        Route::get('/gallerys/edit/{id}',  [GallerysController::class, 'Edit']);
        Route::post('/gallerys/edit/{id}',  [GallerysController::class, 'Update']);

        //settings route
        Route::get('/settings',  [SettingsController::class, 'Index']);
        Route::post('/settings',  [SettingsController::class, 'SaveData']);

        //admin users route
        Route::get('/users',  [UsersController::class, 'Index']);
        Route::get('/users/add',  [UsersController::class, 'AddUser']);
        Route::post('/users/add',  [UsersController::class, 'Create']);
        Route::get('/users/delete/{id}',  [UsersController::class, 'Delete']);
        Route::get('/users/edit/{id}',  [UsersController::class, 'Edit']);
        Route::post('/users/edit/{id}',  [UsersController::class, 'Update']);
    
    });

});