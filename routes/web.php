<?php

use App\Http\Controllers\AllocationController;
use App\Models\Allocation;
use App\Models\Classroom;
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

Route::get('/', function () {
    return view('template');
})->middleware('login');
//Route::get('classrooms',function(){
//    $classrooms = Classroom::query()
//        ->where('code','like','%'.request()->query('search').'%')
//        ->orderBy('code','ASC')
//        ->paginate(15);
//    return view('classroom',compact('classrooms'));
//});
Route::resource('allocation', AllocationController::class)->middleware('login');
Route::post('/restoreAllocation',[AllocationController::class,'restore'])->name('restoreAllocation')->middleware('login');
//Route::get('/createAllocation', AllocationController::class,'create2')->name('createallocation');
//    function(){
//    $subjects = \App\Models\Subject::all();
//    $classrooms=Classroom::all();
//    $lecturers=\App\Models\Lecturer::all();
//   return view('createallocation',compact('subjects','classrooms','lecturers')) ;
//})->name('createallocation');

Route::resource('classrooms',\App\Http\Controllers\ClassroomController::class)->middleware('login');
Route::resource('lecturer',\App\Http\Controllers\LecturerController::class)->middleware('login');
Route::resource('subject',\App\Http\Controllers\SubjectController::class)->middleware('login');

Route::resource('student',\App\Http\Controllers\StudentController::class)->middleware('login');
Route::post('/restoreStudent',[\App\Http\Controllers\StudentController::class,'restore'])->name('restoreStudent')->middleware('login');

//Route::get('/loginPage',function(){
//   return view('login');
//});
Route::resource('login',\App\Http\Controllers\LoginController::class);
Route::post('/loginVal',[\App\Http\Controllers\LoginController::class,'validation']);
Route::get('/logout',[\App\Http\Controllers\LoginController::class,'logout'])->name('logout');
