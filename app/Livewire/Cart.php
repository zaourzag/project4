<?php

namespace App\Livewire;

use Livewire\Component;
use livewire\Attributes\on;
use App\Traits\MessageTrait;

class Cart extends Component
{
    use MessageTrait;

    protected $listeners = [
        'clearCart' => 'clearCart',
        'cartUpdated2' => 'refreshCart',
    ];

    public $cart = [];
    public $total = 0;

    public function mount() 
    {
        $this->cart = session('cart', []);
        $this->calculateTotal();
    }

    public function render()
    {
        return view('livewire.cart', [
            'cart' => $this->cart,
            'total' => $this->total,
        ]);
    }

    public function refreshCart()
    {
        // Refresh the cart data from the session
        $this->cart = session('cart', []);
        $this->calculateTotal();
    }

    #[on("clearCart")]
    public function clearCart()
    {
        session()->forget('cart');
        $this->dispatch('cartUpdated'); // Emit the event to notify other components
        $this->refreshCart(); // Refresh the cart data
        $this->dispatch('showMessage', 'success', 'Cart cleared!');
    }

    public function removeItem($itemId)
    {
        // Remove the item from the session cart
        $cart = session('cart', []);
        unset($cart[$itemId]);
        session(['cart' => $cart]);

        // Refresh the cart and emit events
        $this->dispatch('cartUpdated'); // Emit the event to notify other components

        $this->refreshCart();
    }

    private function calculateTotal()
    {
        $this->total = array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }
}