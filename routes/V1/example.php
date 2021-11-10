<?php

use App\Http\Controllers\V1\ExampleController;
use Illuminate\Support\Facades\Route;

Route::prefix('example')->name('example.')
    ->group(function() {

        //not authenticated rule
        Route::get('/examples-no-auth', function (){

            return response()->json(['no data, only example ;), now... get out here!!']);
        });

        //Router's with authentication
        Route::middleware(['jwt'])->group(function() {
            Route::get('/', [ExampleController::class, 'index']);
            Route::post('/', [ExampleController::class, 'store']);
            Route::put('/create', [ExampleController::class, 'create']);
            Route::delete('/delete/{id}', [ExampleController::class, 'create'])
                ->whereUuid('id');
            Route::patch('/update', [ExampleController::class, 'update']);
        });

    });
