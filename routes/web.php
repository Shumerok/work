<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::post('/employers/getEmployees/',[EmployerController::class, 'getEmployees'])->name('employees.getEmployees');
    Route::get('/employers/tree/',[EmployerController::class, 'buildTree'])->name('employees.buildTree');
    Route::get('ajaxdata',[EmployerController::class, 'getData'])->name('employer.getData');
    Route::resource('employers', EmployerController::class);
    Route::resource('positions', PositionController::class);
});