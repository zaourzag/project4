<?php

use App\Livewire\Teertris3;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Teertris3::class)
        ->assertStatus(200);
});
