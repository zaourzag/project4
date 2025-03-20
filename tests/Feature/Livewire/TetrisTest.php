<?php

use App\Livewire\Tetris;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Tetris::class)
        ->assertStatus(200);
});
