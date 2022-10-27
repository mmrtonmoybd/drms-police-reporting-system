<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\AreaController;

use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\QrrsController;
use App\Http\Controllers\admin\WarrantController;
use App\Http\Controllers\admin\GallerysController;
use App\Http\Controllers\admin\NarcotiscController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\Test;

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

Route::get('/clear', function () {
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
Route::get('/admin', function () {
    return redirect('admin/dashboard');
});
Route::prefix('admin')->group(function () {
    Auth::routes(['login' => false, 'register' => false, 'logout' => false]);
    Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    Route::group(['middleware'=>'auth'], function () {
        Route::get('/dashboard', [Dashboard::class, 'Index'])->name('home');

        Route::get('/districts/{division_id}', [AreaController::class, 'getDistricts']);
        Route::get('/upazilas/{district_id}', [AreaController::class, 'getUpazilas']);
        Route::get('/thanas/{district_id}', [AreaController::class, 'getThanas']);


        //admin qrrs route
        Route::get('/qrrs', [QrrsController::class, 'Index']);
        Route::post('/qrrs/short', [QrrsController::class, 'Short']);
        Route::post('/qrrs/search', [QrrsController::class, 'SearchSort']);
        Route::get('/qrrs/add', [QrrsController::class, 'AddQrr']);
        Route::post('/qrrs/add', [QrrsController::class, 'Create']);
        Route::get('/qrrs/delete/{id}', [QrrsController::class, 'Delete']);
        Route::get('/qrrs/edit/{id}', [QrrsController::class, 'Edit']);
        Route::post('/qrrs/edit/{id}', [QrrsController::class, 'Update']);
        Route::get('/qrrs/details/{id}', [QrrsController::class, 'View']);
        Route::get('/qrrs/print-details/{id}', [QrrsController::class, 'PrintView']);
        Route::post('/qrrs/charts', [QrrsController::class, 'chart']);
        Route::get('/qrrs/report/{report}', [QrrsController::class, 'report']);
        Route::get('/qrrs/srcs', [QrrsController::class, 'srcs']);

        // Warrant router
        Route::get('/warrant/add', [WarrantController::class, 'addShow']);
        Route::post('/warrant/add', [WarrantController::class, 'addData']);
        Route::get('/warrant', [WarrantController::class, 'index']);
        Route::get('/warrant/dashboard', [WarrantController::class, 'dashs']);
        Route::post('/warrant/search', [WarrantController::class, 'dashsp']);
        Route::get('/warrant/edit/{id}', [WarrantController::class, 'editShow']);
        Route::post('/warrant/edit/{id}', [WarrantController::class, 'editUpdate']);
        Route::get('/warrant/delete/{id}', [WarrantController::class, 'delete']);
        Route::get('/warrant/view/{id}', [WarrantController::class, 'pView']);
        Route::get('/warrant/print-details/{id}', [WarrantController::class, 'PrintView']);

        // Narcotic router
        Route::get('/narcotic', [NarcotiscController::class, 'index']);
        Route::get('/narcotic/add', [NarcotiscController::class, 'addShow']);
        Route::post('/narcotic/add', [NarcotiscController::class, 'addData']);
        Route::get('/narcotic/edit/{id}', [NarcotiscController::class, 'editShow']);
        Route::post('/narcotic/edit/{id}', [NarcotiscController::class, 'editUpdate']);
        Route::get('/narcotic/delete/{id}', [NarcotiscController::class, 'delete']);
        Route::get('/narcotic/view/{id}', [NarcotiscController::class, 'pView']);
        Route::get('/narcotic/print-details/{id}', [NarcotiscController::class, 'PrintView']);

        Route::group(['prefix' => 'users'], function () {
            Route::get('/role', [RoleController::class, 'index']);
            Route::get('/role/add', [RoleController::class, 'addShow']);
            Route::post('/role/add', [RoleController::class, 'addData']);
            Route::get('/role/edit/{role}', [RoleController::class, 'editShow']);
            Route::post('/role/edit/{role}', [RoleController::class, 'editUpdate']);
            Route::get('/role/delete/{role}', [RoleController::class, 'delete']);
            Route::get('/role/show/{role}', [RoleController::class, 'show']);
            Route::get('/uedit/{user}', [UsersController::class, 'ueditshow']);
            Route::post('/uedit/{user}', [UsersController::class, 'ueditupdate']);

            Route::get('/add/superadmin', [UsersController::class, 'addsaShow']);
            Route::post('/add/superadmin', [UsersController::class, 'addsacreate']);

            Route::get('/add/sp', [UsersController::class, 'addspShow']);
            Route::post('/add/sp', [UsersController::class, 'addspcreate']);

            Route::get('/add/op1', [UsersController::class, 'addop1Show']);
            Route::post('/add/sp', [UsersController::class, 'addop1create']);

            Route::get('/add/op2', [UsersController::class, 'addop2Show']);
            Route::post('/add/op2', [UsersController::class, 'addop2create']);

            Route::get('/add/op3', [UsersController::class, 'addop3Show']);
            Route::post('/add/op3', [UsersController::class, 'addop3create']);

            Route::get('/add/oc', [UsersController::class, 'addocShow']);
            Route::post('/add/oc', [UsersController::class, 'addoccreate']);
        });



        //admin gallerys route
        Route::get('/gallerys', [GallerysController::class, 'Index']);
        Route::post('/gallerys/short', [GallerysController::class, 'Short']);
        Route::get('/gallerys/add', [GallerysController::class, 'AddGallery']);
        Route::post('/gallerys/add', [GallerysController::class, 'Create']);
        Route::get('/gallerys/delete/{id}', [GallerysController::class, 'Delete']);
        Route::get('/gallerys/edit/{id}', [GallerysController::class, 'Edit']);
        Route::post('/gallerys/edit/{id}', [GallerysController::class, 'Update']);

        //settings route
        Route::get('/settings', [SettingsController::class, 'Index']);
        Route::post('/settings', [SettingsController::class, 'SaveData']);

        //admin users route
        Route::get('/users', [UsersController::class, 'Index']);
        Route::get('/users/add', [UsersController::class, 'AddUser']);
        Route::post('/users/add', [UsersController::class, 'Create']);
        Route::get('/users/delete/{id}', [UsersController::class, 'Delete']);
        Route::get('/users/edit/{id}', [UsersController::class, 'Edit']);
        Route::post('/users/edit/{id}', [UsersController::class, 'Update']);
    });
});

Route::get('/test', [Test::class, 'index'])->name('home');
//Auth::routes();
//Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
//Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
