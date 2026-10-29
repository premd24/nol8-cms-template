@props([
    'align' => 'right',
    'width' => 'w-56',
])

{{-- The panel is teleported to <body> and positioned against the trigger so overflow-hidden parents (cards, modals) can't clip it --}}
<div class="relative"
    x-data="{
        open: false,
        panel: null,
        align: @js($align),
        toggle() {
            this.open ? this.close() : this.show();
        },
        show() {
            this.open = true;
            this.$nextTick(() => this.position());
        },
        close() {
            this.open = false;
        },
        position() {
            if (!this.open || !this.panel) return;

            const rect = this.$refs.trigger.getBoundingClientRect();
            const gap = 8;
            const panelHeight = this.panel.offsetHeight;
            const spaceBelow = window.innerHeight - rect.bottom;

            if (this.align === 'left') {
                this.panel.style.left = `${rect.left}px`;
                this.panel.style.right = '';
            } else {
                this.panel.style.right = `${document.documentElement.clientWidth - rect.right}px`;
                this.panel.style.left = '';
            }

            // Flip above the trigger when there isn't room below it
            if (spaceBelow < panelHeight + gap && rect.top > panelHeight + gap) {
                this.panel.style.top = `${rect.top - panelHeight - gap}px`;
            } else {
                this.panel.style.top = `${rect.bottom + gap}px`;
            }
        },
    }"
    x-init="
        window.addEventListener('scroll', () => position(), true);
        window.addEventListener('resize', () => position());
    "
    @keydown.escape.window="close()"
    {{ $attributes }}>
    {{-- Trigger --}}
    <div x-ref="trigger" @click="toggle()">
        {{ $trigger }}
    </div>

    {{-- Dropdown Panel --}}
    <template x-teleport="body">
        <div x-show="open" x-init="panel = $el"
            @click.outside="if (!$refs.trigger.contains($event.target)) close()"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="fixed {{ $width }} bg-white border border-gray-100 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.08)] py-2 z-[60] overflow-hidden"
            x-cloak>
            {{ $slot }}
        </div>
    </template>
</div>
