<?php

use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\User\Auth\UserController;
use App\Http\Controllers\User\PostController;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
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

Route::resource('admin', AdminController::class);
Route::namespace('Admin')->middleware('backbutton')->group(function () {
    Route::namespace('Auth')->middleware('guest')->group(function () {
        Route::get('admin-login', [AdminController::class, 'getAdminLogin'])->name('login');
        Route::post('admin-login', [AdminController::class, 'adminLogin'])->name('admin.Login');
        Route::get('admin-logout', [AdminController::class, 'adminLogout'])->withoutMiddleware('guest')->name('admin.Logout');
    });
    Route::middleware('auth:admin')->group(function () {
    });
});
Route::get('admin-dashboard', [AdminController::class, 'getadminDashboard'])->name('admin.Dashboard');
Route::resource('post', PostController::class)->middleware(['userauth:user']);
// Route::resource('user', UserController::class);
Route::namespace('User')->middleware('backbutton')->group(function () {
    Route::namespace('Auth')->middleware('guest')->group(function () {
        Route::get('/', function () {
            return view('user.userLogin');
        })->name('user.Login');
        Route::get('user-register', [UserController::class, 'getSignup'])->name('user.Register');
        Route::post('register', [UserController::class, 'userSignup'])->name('user.Signup');
        Route::post('user-login', [UserController::class, 'userLogin'])->name('user.Logins');
        Route::get('user-logout', [UserController::class, 'userLogout'])->withoutMiddleware('guest')->name('user.Logout');
    });
    Route::middleware('userauth:user')->group(function () {
        Route::get('user-feed', [UserController::class, 'userFeed'])->name('user.Feed');
        Route::get('user-posts', [UserController::class, 'userPosts'])->name('user.Post');
        Route::get('user-account', [UserController::class, 'getAccount'])->name('user.Account');
    });
});

Route::get('send-mail', function () {
    $details = [
        'title' => 'Mail from anuj',
        'body' => 'This is for testing purpose'
    ];
    Mail::to('umagp@webmobtech.com')->send(new MyTestMail($details));
    dd("Email is sent");
});
