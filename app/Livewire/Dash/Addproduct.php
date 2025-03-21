<?php

namespace App\Livewire\Dash;

use Livewire\Component;
use App\Traits\MessageTrait;
// use Livewire\Component;
// use dispatchBr
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
class Addproduct extends Component
{
    use MessageTrait, WithFileUploads;
    public $photo;

    public function uploadImage()
    {
        // Validate the uploaded file
        // $this->validate([
        //     'photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure it's an image
        // ]);

        // Move the uploaded file to the desired directory
        $imagePath = $this->photo->store('images/uploads', 'public');

        // Generate the public URL for the uploaded image
        $imageUrl = asset('storage/' . $imagePath);

        // Return the image URL to the frontend
        $this->dispatch('imageUploaded', ['url' => $imageUrl])->self();
    }

    
    public function render()
    {
        return view('livewire.dash.addproduct');
    }


}
