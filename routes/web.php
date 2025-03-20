<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Laravel\Socialite\Facades\Socialite;
use App\Livewire\Shop;
use App\Livewire\Cart;
use App\Livewire\Home;
use App\Livewire\About;
use App\Http\Controllers\ShoppingCartController;
use App\Livewire\ZoekProducten;

Route::get('cart', Cart::class)->name('cart');

Route::get('shop', Shop::class)->name('shop');
Route::get('about', About::class)->name('about');
Route::get('/', Home::class)->name('home');


// Route::get('login/authentik', function () {
//     return Socialite::driver('authentik')->redirect();
// });


Route::prefix('api/cart')->group(function () {

    Route::post('/add', [ShoppingCartController::class, 'add'])->name('cart.add');
    Route::post('/remove', [ShoppingCartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [ShoppingCartController::class, 'clear'])->name('cart.clear');
});

Route::get('zoek-producten', ZoekProducten::class)->name('zoek-producten');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
   
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
