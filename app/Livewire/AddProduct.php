<?php

namespace App\Livewire;
use App\Models\Product;
use Livewire\Component;

class AddProduct extends Component
{
    public function render()
    {
        return view('livewire.add-product');
    }
}
