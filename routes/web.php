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
use App\Http\Controllers\admin\WomanController;
use App\Http\Controllers\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Exports\Qrr\QrrListExport;
use App\Exports\Woman\WomanListExport;
use App\Exports\Narcotic\NarcoticListExport;
use App\Http\Controllers\admin\CaseController;

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
    $exitCode = Artisan::call('event:clear');
    // return what you want
});

Route::get('/cache', function () {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('view:cache');
    $exitCode = Artisan::call('event:cache');
    // return what you want
});

Route::get('/storagelink', function () {
    $exitCode = Artisan::call('storage:link');
    // return what you want
});

Route::get('/', [Dashboard::class, 'home']);

//apply middle ware for admin
Route::fallback([Dashboard::class, 'NotFound']);
Route::get('/admin', [Dashboard::class, 'admin']);
Route::prefix('admin')->group(function () {
    Auth::routes(['register' => false, 'logout' => false]);
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    Route::group(['middleware'=> 'auth'], function () {
        Route::get('/adminsidebarcollapase', function (Request $request) {
            if ($request->filled('sidebar')) {
                Session::put('sidebar', $request->input('sidebar'));

                return \redirect()->back();
            }
        });
        Route::get('/dashboard', [Dashboard::class, 'Index'])->name('home');

        Route::get('/districts/{division_id}', [AreaController::class, 'getDistricts']);
        Route::get('/upazilas/{district_id}', [AreaController::class, 'getUpazilas']);
        Route::get('/thanas/{district_id}', [AreaController::class, 'getThanas']);
        Route::get('/circles/{district_id}', [AreaController::class, 'getCircles']);
        Route::get('/circles/thanas/{circle_id}', [AreaController::class, 'getCircleThanas']);
        Route::get('/casesub/type/{parent_id}', [AreaController::class, 'getCasesubType']);


        //admin qrrs route
        Route::get('/qrrs', [QrrsController::class, 'Index'])->middleware('permission:qrr.view');
        Route::get('/qrrs/index/ajax', [QrrsController::class, 'qrrinajax'])->middleware('permission:qrr.view');
        Route::get('/qrrs/add', [QrrsController::class, 'AddQrr'])->middleware('permission:qrr.add');
        Route::post('/qrrs/add', [QrrsController::class, 'Create'])->middleware('permission:qrr.add');
        Route::get('/qrrs/delete/{id}', [QrrsController::class, 'Delete'])->middleware('permission:qrr.delete');
        Route::get('/qrrs/edit/{id}', [QrrsController::class, 'Edit'])->middleware('permission:qrr.edit');
        Route::post('/qrrs/edit/{id}', [QrrsController::class, 'Update'])->middleware('permission:qrr.edit');
        Route::get('/qrrs/details/{id}', [QrrsController::class, 'View'])->middleware('permission:qrr.view');
        Route::get('/qrrs/print-details/{id}', [QrrsController::class, 'PrintView'])->middleware('permission:qrr.view');
        Route::get('/qrrs/pdf-details/{qrr}', [QrrsController::class, 'pdfView'])->middleware('permission:qrr.view');
        Route::get('/qrrs/excel-details/{qrr}', [QrrsController::class, 'excelView'])->middleware('permission:qrr.view');
        Route::get('/qrrs/charts', [QrrsController::class, 'chart'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/report/{report}', [QrrsController::class, 'report'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/srcs', [QrrsController::class, 'srcs'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/srcs/excel', [QrrsController::class, 'qrrscexcel'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/srcs/pdf', [QrrsController::class, 'qrrspdf'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/srcs/data', [QrrsController::class, 'chartdata'])->middleware('permission:qrr.dashboard');
        Route::get('/qrrs/excel', function () {
            $name = uniqid('qrrlist_');

            return (new QrrListExport())->download($name.'.xlsx');
        });

        // Warrant router
        Route::get('/warrant/add', [WarrantController::class, 'addShow'])->middleware('permission:warrant.add');
        Route::post('/warrant/add', [WarrantController::class, 'addData'])->middleware('permission:warrant.add');
        Route::get('/warrant', [WarrantController::class, 'index'])->middleware('permission:warrant.view');
        Route::get('/warrant/dashboard', [WarrantController::class, 'dashs'])->middleware('permission:warrant.dashboard');
        Route::get('/warrant/search', [WarrantController::class, 'dashsp'])->middleware('permission:warrant.dashboard');
        Route::get('/warrant/search/chart', [WarrantController::class, 'chartlink'])->middleware('permission:warrant.dashboard');
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
        Route::get('/narcotic/dashboard', [NarcotiscController::class, 'dashp'])->middleware('permission:narcotic.dashboard');
        Route::get('/narcotic/src', [NarcotiscController::class, 'dashsc'])->middleware('permission:narcotic.dashboard');
        Route::get('/narcotic/chart/data', [NarcotiscController::class, 'chartlink'])->middleware('permission:narcotic.dashboard');
        Route::get('/narcotic/totalcase', [NarcotiscController::class, 'narcoticcase'])->middleware('permission:narcotic.dashboard');
        Route::get('/narcotic/totalcase/src', [NarcotiscController::class, 'tcsrc'])->middleware('permission:narcotic.dashboard');
        Route::get('/narcotic/recover', [NarcotiscController::class, 'narrecover'])->middleware('permission:narcotic.dashboard');
        Route::get('/narcotic/recover/src', [NarcotiscController::class, 'narrecoversrc'])->middleware('permission:narcotic.dashboard');
        Route::get('/narcotic/excel', function () {
            $name = uniqid('narcoticlist_');

            return (new NarcoticListExport())->download($name.'.xlsx');
        });


        // Woman router
        Route::get('/woman', [WomanController::class, 'index'])->middleware('permission:woman.view');
        Route::get('/woman/add', [WomanController::class, 'addWoman'])->middleware('permission:woman.add');
        Route::post('/woman/add', [WomanController::class, 'create'])->middleware('permission:woman.add');
        Route::get('/woman/edit/{woman}', [WomanController::class, 'editShow'])->middleware('permission:woman.edit');
        Route::post('/woman/edit/{woman}', [WomanController::class, 'update'])->middleware('permission:woman.edit');
        Route::get('/woman/delete/{woman}', [WomanController::class, 'delete'])->middleware('permission:woman.delete');
        Route::get('/woman/view/{woman}', [WomanController::class, 'wview'])->middleware('permission:woman.view');
        Route::get('/woman/pview/{woman}', [WomanController::class, 'pview'])->middleware('permission:woman.view');
        Route::get('/woman/dashboard', [WomanController::class, 'dashboard'])->middleware('permission:woman.dashboard');
        Route::get('/woman/src', [WomanController::class, 'dashboardsc'])->middleware('permission:woman.dashboard');
        Route::get('/woman/chart/data', [WomanController::class, 'womancclick'])->middleware('permission:woman.dashboard');
        Route::get('/woman/excel', function () {
            $name = uniqid('womanlist_');

            return (new WomanListExport())->download($name.'.xlsx');
        });


        // Case router
        Route::get('/case', [CaseController::class, 'index'])->middleware('permission:case.view');
        Route::get('/case/add', [CaseController::class, 'addShow'])->middleware('permission:case.add');
        Route::post('/case/add', [CaseController::class, 'create'])->middleware('permission:case.add');
        Route::get('/case/edit/{casedb}', [CaseController::class, 'editShow'])->middleware('permission:case.edit');
        Route::post('/case/edit/{casedb}', [CaseController::class, 'update'])->middleware('permission:case.edit');
        Route::get('/delete/{casedb}', [CaseController::class, 'delete'])->middleware('permission:case.delete');
        Route::get('/case/view/{casedb}', [CaseController::class, 'caseView'])->middleware('permission:case.view');
        Route::get('/case/view/print/{casedb}', [CaseController::class, 'casePrint'])->middleware('permission:case.view');
        Route::get('/case/dashboard', [CaseController::class, 'dashboard'])->middleware('permission:case.dashboard');
        Route::get('/case/dashboard/search', [CaseController::class, 'dashboardsc'])->middleware('permission:case.dashboard');



        // User and Role router
        Route::group(['prefix' => 'users', 'middleware' => 'password.confirm'], function () {
            Route::get('/edit/{id}', [UsersController::class, 'Edit']);
            Route::post('/edit/{id}', [UsersController::class, 'Update']);

            Route::get('/role', [RoleController::class, 'index'])->middleware('permission:role.view');
            Route::get('/role/add', [RoleController::class, 'addShow'])->middleware('permission:role.add');
            Route::post('/role/add', [RoleController::class, 'addData'])->middleware('permission:role.add');
            Route::get('/role/edit/{role}', [RoleController::class, 'editShow'])->middleware('permission:role.edit');
            Route::post('/role/edit/{role}', [RoleController::class, 'editUpdate'])->middleware('permission:role.edit');
            //Route::get('/role/delete/{role}', [RoleController::class, 'delete'])->middleware('permission:role.delete');
            Route::get('/role/show/{role}', [RoleController::class, 'show'])->middleware('permission:role.view');

            //

            Route::get('/', [UsersController::class, 'Index'])->middleware('permission:user.view');
            Route::get('/getdata', [UsersController::class, 'userdata'])->middleware('permission:user.view');
            Route::get('/delete/{id}', [UsersController::class, 'Delete'])->middleware('permission:user.delete');

            Route::get('/uedit/{user}', [UsersController::class, 'ueditshow'])->middleware('permission:user.edit');
            Route::post('/uedit/{user}', [UsersController::class, 'ueditupdate'])->middleware('permission:user.edit');

            Route::group(['middleware' => 'permission:user.add'], function () {
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

Route::get('/test', [Test::class, 'index']);
