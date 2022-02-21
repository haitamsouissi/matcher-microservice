<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Property as PropertyResource;
use App\Property;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    
    #Route::apiResource('property', 'PropertyController')->parameters([
    #    'property' => 'match',
    #]);
    Route::get('match/{property}', function ($property) {
        return new PropertyResource(Property::findOrFail($property));
    });
    #Route::apiResource('property', 'PropertyController');
    #return redirect()->route('property')
    


});
