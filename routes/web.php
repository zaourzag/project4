<?php
use App\Livewire\Contact;
use App\Livewire\Jsgame1;
use App\Livewire\Jsgame2;
use App\Livewire\Jsgame3;
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
use App\Livewire\Dash\Addproduct;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MailController;
// use App\Livewire\Dash\Addproduct;
Route::group([], function () {
    Route::get('cart', Cart::class)->name('cart');
    Route::get('shop', Shop::class)->name('shop');
    Route::get('about', About::class)->name('about');
    Route::get('/', Home::class)->name('home');
    Route::get('/games/memory', Jsgame1::class)->name('memory');
    Route::get('/games/game2', Jsgame2::class)->name('jsgame2');
    Route::get('/game/game3', Jsgame3::class)->name('jsgame3');
    Route::get('/contact', Contact::class)->name('contact');
});
Route::post('/send-mail', [MailController::class, 'send']);



// Route::get('login/authentik', function () {
//     return Socialite::driver('authentik')->redirect();
// });


Route::post('/broadcast-event', [EventController::class, 'broadcastEvent']);
Route::prefix('api/cart')->group(function () {

    Route::post('/add', [ShoppingCartController::class, 'add'])->name('cart.add');
    Route::post('/remove', [ShoppingCartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [ShoppingCartController::class, 'clear'])->name('cart.clear');
});
Route::prefix('/dashboard')->middleware('auth:sanctum')->group(function () {
  Route::get('/add-product', Addproduct::class)->name('add-product');
});

Route::get('zoek-producten', ZoekProducten::class)->name('zoek-producten');
Route::middleware('auth:sanctum')->get('/dashboard', function () {
    return view('dashboard'); // Ensure the 'dashboard.blade.php' file exists in 'resources/views'
})->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
   
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


// Register Folio pages


// Basic routes


// Admin routes with explicit definitions


// Laravel Folio configuration (register after explicit routes)
use Laravel\Folio\Folio;

Folio::path(resource_path('views/pages'))->middleware([
    'admin/*' => ['web', 'auth'], // Add appropriate middleware
]); 
require __DIR__.'/auth.php';
