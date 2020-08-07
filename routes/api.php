<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::fallback('NotFoundController@notFound');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/animalTypes')->group(function () {
    Route::get('/', 'AnimalController@listTypes');

    Route::prefix('{typeId}')->group(function () {
        Route::get('/', 'AnimalController@animalOfId');

        Route::prefix('list')->group(function () {
            Route::get('/', 'AnimalController@animalsOfType');
            Route::get('{age}', 'AnimalController@animalWithAge');
        });
    });
});

Route::prefix('/animals')->group(function () {
    Route::post('/', 'AnimalController@addAnimal');
});

// signed URL
Route::get('/one/{two}/{three}/four', function ($two, $three) {
    return sprintf("two: $two\nthree: $three");
})->name('one')->middleware('signed');

Route::get('/routes', function () {
    return sprintf(
        "%s\n%s\n%s\n",
        URL::route('one', ['two' => 222, 'three' => 333]),
        URL::signedRoute('one', ['two' => 222, 'three' => '333']),
        URL::temporarySignedRoute('one', now()->addMinute(), ['two' => 222, 'three' => '333'])
    );
});
