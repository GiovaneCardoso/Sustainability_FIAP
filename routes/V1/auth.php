<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;

Route::prefix('auth')->name('auth.')
    ->group(function() {

    ####################

    //Router's without authentication
    Route::group(['middleware' => ['web'],  'excluded_middleware' => ['api']],function (){

    });

    Route::post('login', [AuthController::class, 'login']);

    //Router's with authentication
    Route::middleware(['api', 'jwt'])->group(function() {
    });
});
