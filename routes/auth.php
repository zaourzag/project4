<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
// use Illuminate\Support\Facades\App;
// use App\Http\Controllers\Auth\LogoutController;
// use App\Livewire\Actions\Logout;    
use App\Http\Controllers\Auth\SocialiteController;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');
        
        Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('social.login');
        Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('social.callback');
    

    Volt::route('register', 'auth.register')
        ->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');

});


Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

        Route::get('/token/create', function () {
            $token = auth()->user()->createToken('MyApp');
        return response()->json(['api_token' => $token->accessToken]);
        });
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::post('logout', action: App\Livewire\Actions\Logout::class )
    ->name('logout');
