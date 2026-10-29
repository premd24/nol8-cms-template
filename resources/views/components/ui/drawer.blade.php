@props(['name', 'title' => null, 'subtitle' => null, 'position' => 'right', 'width' => 'md'])

@php
    $width = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
    ][$width];

    $isLeft = $position === 'left';
    $hiddenTranslate = $isLeft ? '-translate-x-full' : 'translate-x-full';

    // Shares the modal stack so Escape / scroll-lock behave correctly when drawers and modals are stacked
    $stackKey = 'drawer:' . $name;
@endphp

<template x-teleport="body">
    <div {{ $attributes->merge(['class' => 'fixed inset-0 z-50 overflow-hidden', 'style' => 'display: none;', 'name' => $name]) }}
        x-data="{ show: false }" x-show="show"
        x-init="$watch('show', value => {
            window.openModals = window.openModals || [];
            if (value) {
                // Reserve the scrollbar's width so the page doesn't jump sideways when scrolling is locked
                if (!document.body.classList.contains('overflow-hidden')) {
                    const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
                    if (scrollbarWidth > 0) document.body.style.paddingRight = `${scrollbarWidth}px`;
                }
                document.body.classList.add('overflow-hidden');
                if (!window.openModals.includes('{{ $stackKey }}')) {
                    window.openModals.push('{{ $stackKey }}');
                }
            } else {
                window.openModals = window.openModals.filter(m => m !== '{{ $stackKey }}');
                if (window.openModals.length === 0) {
                    document.body.classList.remove('overflow-hidden');
                    document.body.style.paddingRight = '';
                }
            }
        })"
        x-on:open-drawer.window="if ($event.detail.name === '{{ $name }}') show = true"
        x-on:close-drawer.window="if ($event.detail.name === '{{ $name }}') show = false"
        x-on:keydown.escape.window="if (show && window.openModals && window.openModals[window.openModals.length - 1] === '{{ $stackKey }}') show = false">
        <!-- Background backdrop -->
        <div x-show="show" class="fixed inset-0 transition-opacity" x-on:click="show = false"
            x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-900/50"></div>
        </div>

        <!-- Drawer Panel -->
        <div x-show="show"
            class="fixed inset-y-0 {{ $isLeft ? 'left-0 border-r' : 'right-0 border-l' }} w-full {{ $width }} bg-white border-gray-100 shadow-[0_20px_70px_rgba(0,0,0,0.3)] flex flex-col transform-gpu"
            x-transition:enter="transition-transform duration-500 ease-[cubic-bezier(0.32,0.72,0,1)]" x-transition:enter-start="{{ $hiddenTranslate }}"
            x-transition:enter-end="translate-x-0" x-transition:leave="transition-transform duration-300 ease-[cubic-bezier(0.4,0,1,1)]"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="{{ $hiddenTranslate }}"
            role="dialog" aria-modal="true" @if ($title) aria-label="{{ $title }}" @endif>
            <div class="px-6 py-4 flex items-center justify-between gap-4 border-b border-dashed bg-gray-50/50 shrink-0">
                <div class="min-w-0">
                    @if ($title)
                        <h3 class="drawer-title text-xl font-bold text-gray-800 tracking-tight truncate">{{ $title }}</h3>
                    @endif
                    @if ($subtitle)
                        <p class="text-sm text-gray-500 font-medium truncate">{{ $subtitle }}</p>
                    @endif
                </div>
                <button type="button" @click="show = false"
                    class="h-8 w-8 shrink-0 rounded-full hover:bg-gray-200/50 text-gray-400 hover:text-gray-600 transition-all flex items-center justify-center cursor-pointer"
                    aria-label="Close">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </button>
            </div>

            <div class="p-6 overflow-y-auto flex-1 min-h-0">
                {{ $slot }}
            </div>

            @if (isset($footer))
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex justify-end gap-3 shrink-0">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</template>
