<!-- filepath: c:\Users\zaour\source\web1a\project\project-4-test\socks2\resources\views\components\alert.blade.php -->
@props(['type' => 'info', 'dismissable' => false])

@php
$classes = match($type) {
    'success' => 'bg-green-50 border-green-400 text-green-700 dark:bg-green-800/30 dark:border-green-600 dark:text-green-300',
    'error' => 'bg-red-50 border-red-400 text-red-700 dark:bg-red-800/30 dark:border-red-600 dark:text-red-300',
    'warning' => 'bg-yellow-50 border-yellow-400 text-yellow-700 dark:bg-yellow-800/30 dark:border-yellow-600 dark:text-yellow-300',
    'info' => 'bg-blue-50 border-blue-400 text-blue-700 dark:bg-blue-800/30 dark:border-blue-600 dark:text-blue-300',
    default => 'bg-gray-50 border-gray-400 text-gray-700 dark:bg-gray-800/30 dark:border-gray-600 dark:text-gray-300',
};

$iconColor = match($type) {
    'success' => 'text-green-400',
    'error' => 'text-red-400',
    'warning' => 'text-yellow-400',
    'info' => 'text-blue-400',
    default => 'text-gray-400',
};

$icon = match($type) {
    'success' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />',
    'error' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />',
    'warning' => '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />',
    'info' => '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />',
    default => '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />',
};
@endphp

<div {{ $attributes->merge(['class' => "px-4 py-3 rounded-md border-l-4 {$classes}"]) }} role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 {{ $iconColor }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                {!! $icon !!}
            </svg>
        </div>
        <div class="ml-3">
            @if (session('success'))
                <p class="text-sm font-medium">{{ session('success') }}</p>
            @elseif (session('error'))
                <p class="text-sm font-medium">{{ session('error') }}</p>
            @elseif (session('warning'))
                <p class="text-sm font-medium">{{ session('warning') }}</p>
            @elseif (session('info'))
                <p class="text-sm font-medium">{{ session('info') }}</p>
            @else
                <div class="text-sm">{{ $slot }}</div>
            @endif
        </div>
        
        @if($dismissable)
        <div class="ml-auto pl-3">
            <button type="button" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2" onclick="this.parentElement.parentElement.parentElement.remove()">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        @endif
    </div>
</div>