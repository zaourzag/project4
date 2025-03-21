<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];

});
Route::post('/tokens/revoke', function (Request $request) {
    $request->user()->tokens()->where('id', $request->token_id)->delete();

    return response()->noContent();
});
Route::prefix('/products')->middleware('auth')->group(function () {
    Route::get('/', [productController::class, 'index']);
    Route::post('/create', [productController::class, 'addProduct']);
    
});
