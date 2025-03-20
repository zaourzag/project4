<?php

namespace App\Traits;

trait MessageTrait
{
    public function showMessage($state, $message)
    {
        $state ??= 'success';
        $this->alert($state, $message);
            
    }
}
