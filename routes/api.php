<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsPublicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('news/{news}/publish',[NewsPublicationController::class, 'store'])->name('api.news.publish');
Route::delete('news/{news}/unpublish', [NewsPublicationController::class, 'destroy'])->name('api.news.unpublish');

Route::put('news/{news}/verify',[NewsPublicationController::class, 'verify'])->name('api.news.verify');
Route::delete('news/{news}/unverify', [NewsPublicationController::class, 'unverify'])->name('api.news.unverify');