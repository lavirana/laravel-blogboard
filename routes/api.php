<?php

use App\Http\Controllers\Api;

Route::prefix('v1')->group(function () {

    Route::apiResource('posts', Api\PostController::class);

    Route::apiResource('jobs', Api\JobListingController::class);

});
