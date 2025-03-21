<?php

namespace App\Livewire;

use Livewire\Component;
use livewire\Attributes;
use Livewire\Attributes\on;
class CartCount extends Component
{
    public $count = 0;

    // Listen for the 'cartUpdated' event
    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }
    #[On('cartUpdated')] 

    public function updateCartCount()
    {
        $cart = session('cart', []);
        $this->count = array_sum(array_column($cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}