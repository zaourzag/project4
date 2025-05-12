<div>
    <select wire:change="switchLocale($event.target.value)" class="p-2 rounded-md border" :filter="false">
        @foreach(config('app.available_locales', ['en' => 'English']) as $localeCode => $localeName)
            <option value="{{ $localeCode }}" {{ $currentLocale === $localeCode ? 'selected' : '' }}>
                {{ $localeName }}
            </option>
        @endforeach
    </select>

</div>
