<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    $lead = json_decode(Storage::disk('local')->get('data.json')); 
    return view('welcome',compact('lead'));
});
Route::post('employees', 'EmployeeController@add');

Route::resource('employees', EmployeeController::class);