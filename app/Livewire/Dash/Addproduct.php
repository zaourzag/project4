<?php

namespace App\Livewire\Dash;

use Livewire\Component;
use App\Traits\MessageTrait;
// use Livewire\Component;
// use dispatchBr
use App\Events\ImageUploaded;
use App\Events\MessageBroadcasted;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
class Addproduct extends Component
{
    use MessageTrait, WithFileUploads;
    public $photo;

    public function uploadImage()
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imagePath = $this->photo->store('images/uploads', 'public');
        $imageUrl = asset('storage/' . $imagePath);
    
        // Emit the event
        // event(new ImageUploaded($imageUrl));
        ImageUploaded::dispatch($imageUrl);
        MessageBroadcasted::dispatch('success','Imagee uploaded successfully');
        // Dispatch the image URL to the frontend
        // $this->dispatch('imageUploaded', ['url' => $imageUrl]);
    }
    
    public function render()
    {
        return view('livewire.dash.addproduct');
    }


}
