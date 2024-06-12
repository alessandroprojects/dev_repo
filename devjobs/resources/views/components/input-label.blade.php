@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-500 font-bold uppercase mb-2 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
