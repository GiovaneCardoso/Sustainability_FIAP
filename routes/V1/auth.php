<?php

use App\Http\Controllers\V1\AuthFacebookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;

Route::prefix('auth')->name('auth.')
    ->group(function() {

    ####################

    //Router's without authentication
    Route::group(['middleware' => ['web'],  'excluded_middleware' => ['api']],function (){

        Route::get('facebook/sign-up', [AuthFacebookController::class, 'signUp'])
            //->domain(\Config::get('app.url', null))
            ->name('facebook.sign-up');

        Route::get('facebook/sign-in', [AuthFacebookController::class, 'signIn'])
            //->domain(\Config::get('app.url', null))
            ->name('facebook.sign-in');
    });

    Route::post('login', [AuthController::class, 'login']);

    //Router's with authentication
    Route::middleware(['api', 'jwt'])->group(function() {
    });
});
