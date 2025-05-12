<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class LocaleSwitcher extends Component
{
    public string $currentLocale;
    public $locale = '';

    public function mount()
    {
        $this->currentLocale = App::getLocale();
    }

    public function switchLocale($locale): void
    {
        Log::info('Switching locale to: ' . $locale);
        if (in_array($locale, config('app.available_locales', ['en']))) {
            App::setLocale($locale);
            Session::set('locale', $locale);
            $this->currentLocale = $locale;
            $this->dispatch('localeChanged', ['locale' => $locale]); // Pass locale in the event
        }
    }

    public function render()
    {
        return view('livewire.locale-switcher');
    }
}
