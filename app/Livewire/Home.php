<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
class Home extends Component
{
    public function tokens()
{
    $user = Auth::User();
// $token = $user->createToken("api-token", ['product:create', '[product:read', 'product:update', 'product:delete']);
return $user;
}
    
    public function render()
    {
        
        return view('livewire.home', [
            'user' => $this->tokens(),
        ]);
    }
}
