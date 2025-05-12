import 'flowbite';
import { default as axios } from 'axios';

axios.defaults.baseURL = 'https://php.zakariao.nl'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true
import './echo.js';
document.addEventListener('DOMContentLoaded', () => {
    // Get stored locale or default to null
    const storedLocale = localStorage.getItem('locale');

    if (storedLocale) {
        // If we have a stored locale, trigger the switch
        Livewire.dispatch('switchLocale', { locale: storedLocale });
    }
});

// Listen for locale changes
Livewire.on('localeChanged', (event) => {
    // Store the new locale in localStorage
    localStorage.setItem('locale', event.locale);
});
