<?php

use App\Livewire\Cart;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Cart::class)
        ->assertStatus(200);
});
