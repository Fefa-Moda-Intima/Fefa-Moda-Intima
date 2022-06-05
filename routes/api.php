<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('auth/logout', [LoginController::class, 'logout']);
    Route::get('user', [UserController::class, 'current']);
    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
});

Route::group(['middleware'=>['auth:api','adm:api']], function(){
    /*Roles*/ 
    Route::post('auth/role', [RoleController::class, 'register']);
    
    /*Products*/
    Route::post('product', [ProductController:: class, 'register']);
    Route::put('product/{id}', [ProductController:: class, 'update']);
    Route::delete('product/{id}', [ProductController:: class, 'destroy']);
    Route::post('product/addImage/{id}', [ProductController:: class, 'addImage']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('auth/login', [LoginController::class, 'login']);
    Route::post('auth/user', [RegisterController::class, 'register']);
    Route::post('user/complements/{id}', [UserController::class, 'registerComplements']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');

    /*Devs*/
    Route::get('dev', [DevController::class, 'show']);
    Route::get('dev/{id}', [DevController::class, 'detail']);
    Route::post('dev/register', [DevController::class, 'register']);
    Route::put('dev/update/{id}', [DevController::class, 'update']);
    Route::delete('dev/delete/{id}', [DevController::class, 'destroy']);

    /*Products*/ 
    Route::get('product', [ProductController:: class, 'show']);
    Route::get('product/{id}', [ProductController:: class, 'detail']);
});

