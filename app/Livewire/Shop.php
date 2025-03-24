<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Shop extends Component
{
    use WithPagination;

    #[Url]
    public $paginate = 10; // Default to 10 items per page

    // Add this method to handle pagination updates
    public function updatedPaginate($value)
    {
        \Log::info('Paginate updated to: ' . $value); // Debug log
        $this->resetPage();
    }

    public function render()
    {
        // Check if "all" is selected, fetch all products without pagination
        $products = $this->paginate === 'all'
            ? Product::all()
            : Product::paginate($this->paginate);

        return view('livewire.shop', ['products' => $products]);
    }
}