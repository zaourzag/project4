<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Component;
use App\Traits\MessageTrait;
class ZoekProducten extends Component
{
    use WithPagination;
    use MessageTrait;

    #[Url]
    public $query = '';
    public $sortField = 'naam'; // Default sorting field
    public $sortDirection = 'asc'; // Default sorting direction

    public function search()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function render()
    {
        $producten = Product::where('naam', 'like', '%'.$this->query.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.zoek-producten', [
            'producten' => $producten,
        ]);
    }

    

}