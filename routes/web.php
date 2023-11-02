<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/employees',[EmployeesController::class,'index'])->name('employees.index');
Route::get('/employees/create',[EmployeesController::class,'create'])->name('employees.create');
Route::post('/employees',[EmployeesController::class,'store'])->name('employees.store');
Route::get('/employees/{employee}/edit',[EmployeesController::class,'edit'])->name('employees.edit');
Route::put('/employees/{employee}',[EmployeesController::class,'update'])->name('employees.update');
Route::delete('/employees/{employee}',[EmployeesController::class,'destroy'])->name('employees.destroy');


