@props([
    'label' => null,
    'name',
    'type' => 'date', // date | time | datetime
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'min' => null, // e.g. "2026-01-01", "today", "09:00"
    'max' => null,
    'range' => false, // date / datetime only: submits "Y-m-d to Y-m-d"
    'time24' => false,
    'icon' => null,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);

    // Submitted value stays machine-friendly (Laravel's date/date_format rules); the visible input is human-friendly
    [$valueFormat, $displayFormat, $defaultIcon, $defaultPlaceholder] = match ($type) {
        'time' => ['H:i', $time24 ? 'H:i' : 'h:i K', 'heroicon-o-clock', 'Select time...'],
        'datetime' => ['Y-m-d H:i', $time24 ? 'M j, Y H:i' : 'M j, Y h:i K', 'heroicon-o-calendar-days', 'Select date & time...'],
        default => ['Y-m-d', 'M j, Y', 'heroicon-o-calendar', 'Select date...'],
    };

    $config = array_filter([
        'mode' => $range && $type !== 'time' ? 'range' : 'single',
        'enableTime' => $type !== 'date',
        'noCalendar' => $type === 'time',
        'dateFormat' => $valueFormat,
        'altInput' => true,
        'altFormat' => $displayFormat,
        'time_24hr' => (bool) $time24,
        'minDate' => $type !== 'time' ? $min : null,
        'maxDate' => $type !== 'time' ? $max : null,
        'minTime' => $type === 'time' ? $min : null,
        'maxTime' => $type === 'time' ? $max : null,
        'allowInput' => false,
        'disableMobile' => true,
    ], fn ($option) => $option !== null);

    $classes =
        'block w-full pl-12 pr-12 py-4 border transition-all outline-none cursor-pointer ' .
        ($hasError
            ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-300 focus:ring-4 focus:ring-red-500/10 focus:border-red-500'
            : 'bg-gray-50/50 border-gray-200 text-gray-900 placeholder-gray-400 focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500');
@endphp

<div class="space-y-2">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-bold text-gray-700 mb-2">
            {{ $label }}@if ($required)<span class="text-red-500 ml-0.5">*</span>@endif
        </label>
    @endif

    <div class="relative group" data-datepicker-wrapper>
        <div
            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors z-10">
            <x-dynamic-component :component="$icon ?? $defaultIcon" class="h-5 w-5" />
        </div>

        <input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder ?? $defaultPlaceholder }}" autocomplete="off"
            {{ $required ? 'required' : '' }}
            data-datepicker='@json($config)'
            {{ $attributes->merge(['class' => $classes]) }}>

        <button type="button" data-datepicker-clear
            class="hidden absolute right-4 top-1/2 -translate-y-1/2 p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors cursor-pointer z-10"
            title="Clear" aria-label="Clear">
            <x-heroicon-o-x-mark class="h-5 w-5" />
        </button>
    </div>

    <p class="mt-2 text-sm text-red-500 font-medium error-message {{ $hasError ? '' : 'hidden' }}"
        data-error-for="{{ $name }}">
        {{ $errors->first($name) }}
    </p>
</div>
