<?php

use App\Http\Controllers\V1\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->name('company.')
    ->group(function() {

    ####################
    Route::get('/categories', fn () => response()->json(
        [ 'Alimentos',
            'Estetica',
            'Moda',
            'Cosmeticos',]
    ));
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/by/{category}', [CompanyController::class, 'indexByCategory']);

    Route::get('/{id}', [CompanyController::class, 'show']);


    //Router's with authentication
    Route::middleware(['api', 'jwt'])->group(function() {
    });
});
