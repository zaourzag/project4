<?php
namespace App\Livewire;

use Illuminate\Database\Eloquent\Casts\Json;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
// USE App\Livewire\CartCount;
use App\Traits\MessageTrait;
use Livewire\Attributes\on;

use app\http\Controllers\ShoppingCartController;
// use App\Livewire\CartCount;

class Shop extends Component
{
    // protected $listeners = ['cartUpdated' => 'showSuccessMessage'];
    use MessageTrait;
    public function render()    
    {
        $products = Product::all();
        return view('livewire.shop', ['products' => $products]);
    }

   

    
}
