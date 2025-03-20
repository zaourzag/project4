<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShopTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Shop::class)
            ->assertStatus(200);
    }
}
