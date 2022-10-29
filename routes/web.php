<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\AreaController;

use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\QrrsController;
use App\Http\Controllers\admin\WarrantController;
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



    Route::group(['middleware'=> 'auth'], function () {
        Route::get('/dashboard', [Dashboard::class, 'Index'])->name('home');

        Route::get('/districts/{division_id}', [AreaController::class, 'getDistricts']);
        Route::get('/upazilas/{district_id}', [AreaController::class, 'getUpazilas']);
        Route::get('/thanas/{district_id}', [AreaController::class, 'getThanas']);


        //admin qrrs route
        Route::get('/qrrs', [QrrsController::class, 'Index'])->middleware('permission:qrr.view');
        Route::get('/qrrs/add', [QrrsController::class, 'AddQrr'])->middleware('permission:qrr.add');
        Route::post('/qrrs/add', [QrrsController::class, 'Create'])->middleware('permission:qrr.add');
        Route::get('/qrrs/delete/{id}', [QrrsController::class, 'Delete'])->middleware('permission:qrr.delete');
        Route::get('/qrrs/edit/{id}', [QrrsController::class, 'Edit'])->middleware('permission:qrr.edit');
        Route::post('/qrrs/edit/{id}', [QrrsController::class, 'Update'])->middleware('permission:qrr.edit');
        Route::get('/qrrs/details/{id}', [QrrsController::class, 'View'])->middleware('permission:qrr.view');
        Route::get('/qrrs/print-details/{id}', [QrrsController::class, 'PrintView'])->middleware('permission:qrr.view');
        Route::post('/qrrs/charts', [QrrsController::class, 'chart'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/report/{report}', [QrrsController::class, 'report'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/srcs', [QrrsController::class, 'srcs'])->middleware('permission:qrr.dashboard');

        // Warrant router
        Route::get('/warrant/add', [WarrantController::class, 'addShow'])->middleware('permission:warrant.add');
        Route::post('/warrant/add', [WarrantController::class, 'addData'])->middleware('permission:warrant.add');
        Route::get('/warrant', [WarrantController::class, 'index'])->middleware('permission:warrant.view');
        Route::get('/warrant/dashboard', [WarrantController::class, 'dashs'])->middleware('permission:warrant.dashboard');
        Route::post('/warrant/search', [WarrantController::class, 'dashsp'])->middleware('permission:warrant.dashboard');
        Route::get('/warrant/edit/{id}', [WarrantController::class, 'editShow'])->middleware('permission:warrant.edit');
        Route::post('/warrant/edit/{id}', [WarrantController::class, 'editUpdate'])->middleware('permission:warrant.edit');
        Route::get('/warrant/delete/{id}', [WarrantController::class, 'delete'])->middleware('permission:warrant.delete');
        Route::get('/warrant/view/{id}', [WarrantController::class, 'pView'])->middleware('permission:warrant.view');
        Route::get('/warrant/print-details/{id}', [WarrantController::class, 'PrintView'])->middleware('permission:warrant.view');

        // Narcotic router
        Route::get('/narcotic', [NarcotiscController::class, 'index'])->middleware('permission:narcotic.view');
        Route::get('/narcotic/add', [NarcotiscController::class, 'addShow'])->middleware('permission:narcotic.add');
        Route::post('/narcotic/add', [NarcotiscController::class, 'addData'])->middleware('permission:narcotic.add');
        Route::get('/narcotic/edit/{id}', [NarcotiscController::class, 'editShow'])->middleware('permission:narcotic.edit');
        Route::post('/narcotic/edit/{id}', [NarcotiscController::class, 'editUpdate'])->middleware('permission:narcotic.edit');
        Route::get('/narcotic/delete/{id}', [NarcotiscController::class, 'delete'])->middleware('permission:narcotic.delete');
        Route::get('/narcotic/view/{id}', [NarcotiscController::class, 'pView'])->middleware('permission:narcotic.view');
        Route::get('/narcotic/print-details/{id}', [NarcotiscController::class, 'PrintView'])->middleware('permission:narcotic.view');

        Route::group(['prefix' => 'users'], function () {

        Route::get('/edit/{id}', [UsersController::class, 'Edit']);
        Route::post('/edit/{id}', [UsersController::class, 'Update']);

            Route::get('/role', [RoleController::class, 'index']);
            Route::get('/role/add', [RoleController::class, 'addShow']);
            Route::post('/role/add', [RoleController::class, 'addData']);
            Route::get('/role/edit/{role}', [RoleController::class, 'editShow']);
            Route::post('/role/edit/{role}', [RoleController::class, 'editUpdate']);
            Route::get('/role/delete/{role}', [RoleController::class, 'delete']);
            Route::get('/role/show/{role}', [RoleController::class, 'show']);

            //

            Route::get('/', [UsersController::class, 'Index'])->middleware('permission:user.view');
            Route::get('/delete/{id}', [UsersController::class, 'Delete'])->middleware('permission:user.delete');

            Route::get('/uedit/{user}', [UsersController::class, 'ueditshow'])->middleware('permission:user.edit');
            Route::post('/uedit/{user}', [UsersController::class, 'ueditupdate'])->middleware('permission:user.edit');

            Route::group(['middleware' => 'permission:user.add'], function() {

            Route::get('/add/superadmin', [UsersController::class, 'addsaShow']);
            Route::post('/add/superadmin', [UsersController::class, 'addsacreate']);

            Route::get('/add/sp', [UsersController::class, 'addspShow']);
            Route::post('/add/sp', [UsersController::class, 'addspcreate']);

            Route::get('/add/sp/op1', [UsersController::class, 'addspop1Show']);
            Route::post('/add/sp/op1', [UsersController::class, 'addspop1create']);

            Route::get('/add/sp/op2', [UsersController::class, 'addspop2Show']);
            Route::post('/add/sp/op2', [UsersController::class, 'addspop2create']);

            Route::get('/add/oc', [UsersController::class, 'addocShow']);
            Route::post('/add/oc', [UsersController::class, 'addoccreate']);

            Route::get('/add/oc/op1', [UsersController::class, 'addocop1Show']);
            Route::post('/add/oc/op1', [UsersController::class, 'addococ1create']);

            Route::get('/add/oc/op2', [UsersController::class, 'addocop2Show']);
            Route::post('/add/oc/op2', [UsersController::class, 'addococ2create']);

            Route::get('/add/oc/op3', [UsersController::class, 'addocop3Show']);
            Route::post('/add/oc/op3', [UsersController::class, 'addococ3create']);
        
        });
        });

        //settings route
        Route::get('/settings', [SettingsController::class, 'Index'])->middleware('permission:setting.view');
        Route::post('/settings', [SettingsController::class, 'SaveData'])->middleware('permission:setting.view');

        
    });
});

Route::get('/test', [Test::class, 'index'])->name('home');