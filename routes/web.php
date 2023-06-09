<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\EmployeeTypesController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\TimesheetsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RateCardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProjectManagerController;
use App\Http\Controllers\Admin\TeamLeaderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', function () {
        return view('auth.login');
    });
    Auth::routes();
});

Route::group(['prefix' => 'admin','as' => 'admin.','middleware' => ['auth']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('home');
    Route::resource('profile', ProfileController::class);

    /* Designation Master */
    Route::resource('designation', DesignationController::class);
    Route::get('getDesignation', [DesignationController::class,'getDesignation'])->name('getDesignation');

    /* Projects Master */
    Route::resource('project-type', ProjectTypeController::class);
    Route::get('getProjectType', [ProjectTypeController::class,'getProjectType'])->name('getProjectType');

    /* Project Module */
    Route::resource('projects', ProjectsController::class);
    Route::get('getProject', [ProjectsController::class,'getProject'])->name('getProject');

    /* Project Managers Master */
    Route::resource('project-managers', ProjectManagerController::class);
    Route::get('getProjectManager', [ProjectManagerController::class,'getProjectManager'])->name('getProjectManager');

    /* Client Module */
    Route::resource('clients', ClientController::class);
    Route::get('getClient', [ClientController::class,'getClient'])->name('getClient');

    /* Teamleader Master */
    Route::resource('team-leaders', TeamLeaderController::class);
    Route::get('getTeamLeader', [TeamLeaderController::class,'getTeamLeader'])->name('getTeamLeader');

    /*Route::group(['middleware' => ['role:admin']], function () {*/
        /* User Master */
        Route::resource('users', UserController::class);
        Route::get('getUser', [UserController::class,'getUser'])->name('getUser');
    //});

    /* UserType Master */
    Route::resource('employee-types', EmployeeTypesController::class);
    Route::get('getEmployeeType', [EmployeeTypesController::class,'getEmployeeType'])->name('getEmployeeType');

    /* User Module */
    Route::resource('employees', EmployeeController::class);
    Route::get('getEmployee', [EmployeeController::class,'getEmployee'])->name('getEmployee');

    /* Timesheet Module */
    Route::resource('timesheets', TimesheetsController::class);
    Route::post('createTimesheet', [TimesheetsController::class,'createTimesheet'])->name('createTimesheet');
    Route::get('getTimesheet', [TimesheetsController::class,'getTimesheet'])->name('getTimesheet');


    /* Timesheet Module */
    Route::resource('rates', RateCardController::class);
    Route::get('getRates', [RateCardController::class,'getRates'])->name('getRates');

    /* Role Management */
    Route::resource('roles', RoleController::class);
    Route::get('getRole', [RoleController::class, 'getRole'])->name('getRole');

    /* Report */
    Route::resource('report', ReportController::class);
    Route::get('getReport', [ReportController::class, 'getReport'])->name('getReport');
    Route::get('getReportTeam', [ReportController::class,'getReportTeam'])->name('getReportTeam');
});
