@props([
    'label' => null,
    'name',
    'type' => 'text',
    'icon' => null,
    'placeholder' => '',
    'required' => false,
    'value' => null,
])

<div class="space-y-2" @if ($type === 'password') x-data="{ show: false }" @elseif ($type === 'file') x-data="{ hasFile: false }" @endif>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-bold text-gray-700 mb-2">
            {{ $label }}@if ($required)<span class="text-red-500 ml-0.5">*</span>@endif
        </label>
    @endif

    <div class="relative group">
        @if ($icon)
            <div
                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            </div>
        @endif

        @php
            $hasError = $errors->has($name);
            $id = $attributes->get('id', $name);
            $baseClasses =
                'block w-full ' .
                ($icon ? 'pl-12' : 'px-4') .
                (in_array($type, ['password', 'file']) ? ' pr-12' : ' pr-4') .
                ' py-4 transition-all outline-none';
            $stateClasses = $hasError
                ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-300 focus:ring-4 focus:ring-red-500/10 focus:border-red-500'
                : 'bg-gray-50/50 border-gray-200 text-gray-900 placeholder-gray-400 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500';
        @endphp

        <input
            @if ($type === 'password') :type="show ? 'text' : 'password'" @else type="{{ $type }}" @endif
            @if ($type === 'file') x-ref="fileInput" @change="hasFile = $event.target.files.length > 0" @endif
            id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }} value="{{ old($name, $value) }}"
            {{ $attributes->merge(['class' => $baseClasses . ' border ' . $stateClasses]) }}>

        @if ($type === 'password')
            <button type="button" @click="show = !show"
                class="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-primary-500 transition-colors">
                <x-heroicon-o-eye x-show="!show" class="h-5 w-5" />
                <x-heroicon-o-eye-slash x-show="show" class="h-5 w-5" x-cloak />
            </button>
        @endif

        @if ($type === 'file')
            <button type="button" x-show="hasFile" x-cloak
                @click="$refs.fileInput.value = ''; hasFile = false; $refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }))"
                class="absolute right-4 top-1/2 -translate-y-1/2 p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors cursor-pointer"
                title="Remove file" aria-label="Remove file">
                <x-heroicon-o-x-mark class="h-5 w-5" />
            </button>
        @endif

        {{ $slot }}
    </div>

    <p class="mt-2 text-sm text-red-500 font-medium error-message {{ $errors->has($name) ? '' : 'hidden' }}"
        data-error-for="{{ $name }}">
        {{ $errors->first($name) }}
    </p>
</div>
