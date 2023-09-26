<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\SekolahController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Jurusan;
use App\Http\Controllers\JurusanController;

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
    return view('welcome');
});

// Route::get('/', [ProductController::class, 'index']);
// Route::get('/cart', [ProductController::class, 'cart']);
// Route::get('/categories', [ProductController::class, 'categories']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){

    Route::get('dashboard', [DashboardController::class, 'dashboard']);

    // Rute untuk menampilkan semua siswa
    Route::get('sekolah', [StudentController::class, 'sekolah'])->name('admin.sekolah');

    // Rute untuk menampilkan form penambahan siswa
    Route::get('sekolah-add', [StudentController::class, 'create'])->name('student.create');

    // Rute untuk menyimpan data siswa baru
    Route::post('sekolah-add', [StudentController::class, 'store'])->name('student.store');

    // Rute untuk menampilkan form edit siswa
    Route::get('students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');

    // Rute untuk memperbarui data siswa
    Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update');

    Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
    Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
    Route::delete('students/{id}/force-delete', [StudentController::class, 'forceDelete'])->name('students.forceDelete');

    Route::resource('students', StudentController::class);
    Route::get('admin/student-detail/{id}', [StudentController::class, 'getStudentDetail'])->name('student.detail');
});

