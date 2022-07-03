<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Front\Customer\LoginController;
use App\Http\Controllers\Front\Customer\PasswordController;
use App\Http\Controllers\Front\Customer\RegisterController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\SettingController;

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('logout', [AdminController::class, 'admin__logout'])->name('admin.logout');
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password');
    Route::post('change-password', [AdminController::class, 'updatePassword'])->name('update.password');
    Route::resource('news', NewsController::class);
    Route::get('/get-todays-news' , [NewsController::class, 'getTodayNews'])->name('news.getTodayNews');
    Route::get('/categories' , [CategoryController::class, 'index'])->name('category.index');
    Route::get('/users' , [UsersController::class, 'index'])->name('users.index');
    Route::get('/settings/{setting}' , [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{setting}' , [SettingController::class, 'update'])->name('settings.update');

});
Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'postLogin'])->name('admin.postLogin');
Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
Route::get('/customer-dashboard',[AdminController::class,'customerDashboard'])->name('customer-dashboard');
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('login', [LoginController::class,'form'])->name('login-form');
    Route::post('login', [LoginController::class,'submit'])->name('login');
    Route::get('register', [RegisterController::class,'form'])->name('register-form');
    Route::post('register', [RegisterController::class,'submit'])->name('register');
    Route::get('verify/{hash}', [RegisterController::class,'verify'])->name('verify');
    Route::get('forgot-password', [PasswordController::class,'forgetPassword'])->name('forgot-password');
    Route::post('reset-password', [PasswordController::class,'resetLink'])->name('reset-link');
    Route::get('reset-password/{hash}', [PasswordController::class,'resetPassword'])->name('reset-password');
    Route::post('save-password', [PasswordController::class,'savePassword'])->name('save-password');
});

//Google Routes
Route::get('/login/google', [LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class,'handleGoogleCallback']);

//Front Routes
Route::get('/', [FrontController::class,'index'])->name('home');
Route::get('/news-inner/{slug}', [FrontController::class,'newsInner'])->name('newsInner');
Route::get('/category/{slug}', [FrontController::class,'newsByCategory'])->name('newsByCategory');
Route::get('news/',[FrontController::class,'searchNews'])->name('searchNews');



