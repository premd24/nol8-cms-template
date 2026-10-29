@extends('layouts.app')

@section('content')
    <div class="space-y-10">
        <!-- Page Header -->
        <x-ui.page-header title="UI Component Library" description="Browse and preview the common UI components built for this boilerplate theme.">
            <x-slot name="actions">
                <x-button type="button" variant="primary" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: { name: 'demo-modal' } }))" icon-start="heroicon-o-swatch">
                    Open Demo Modal
                </x-button>
                <x-button type="button" variant="outline" onclick="window.dispatchEvent(new CustomEvent('open-drawer', { detail: { name: 'demo-drawer' } }))" icon-start="heroicon-o-arrow-left-end-on-rectangle">
                    Open Side Drawer
                </x-button>
            </x-slot>
        </x-ui.page-header>

        <!-- Stat Cards Showcase -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 border-b border-gray-150 pb-2">Stat Cards (<code class="text-xs text-primary-700 bg-primary-50 px-1.5 py-0.5 rounded font-mono">&lt;x-ui.stat-card&gt;</code>)</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-ui.stat-card label="Total Income" value="$48,259.00" icon="heroicon-o-currency-dollar" trend="12.5" trendType="up" variant="emerald" />
                <x-ui.stat-card label="Active Users" value="2,845" icon="heroicon-o-users" trend="4.2" trendType="up" variant="blue" />
                <x-ui.stat-card label="Bounce Rate" value="42.3%" icon="heroicon-o-arrow-trending-down" trend="1.8" trendType="down" variant="amber" />
            </div>

        <!-- Buttons Showcase -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 border-b border-gray-150 pb-2">Buttons (<code class="text-xs text-primary-700 bg-primary-50 px-1.5 py-0.5 rounded font-mono">&lt;x-button&gt;</code>)</h2>
            <x-ui.card class="space-y-6">
                <!-- Variants -->
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Variants</h3>
                    <div class="flex flex-wrap gap-4">
                        <x-button variant="primary">Primary</x-button>
                        <x-button variant="secondary">Secondary</x-button>
                        <x-button variant="outline">Outline</x-button>
                        <x-button variant="secondary-outline">Sec Outline</x-button>
                        <x-button variant="white">White</x-button>
                        <x-button variant="danger">Danger</x-button>
                        <x-button variant="ghost">Ghost</x-button>
                    </div>
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Sizes</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <x-button size="sm">Small</x-button>
                        <x-button size="md">Medium</x-button>
                        <x-button size="lg">Large</x-button>
                        <x-button size="xl">Extra Large</x-button>
                    </div>
                </div>

                <!-- Icons & State -->
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Icons & Loading</h3>
                    <div class="flex flex-wrap gap-4">
                        <x-button icon-start="heroicon-o-arrow-left">Back</x-button>
                        <x-button icon="heroicon-o-arrow-right">Next</x-button>
                        <x-button loading>Loading Button</x-button>
                        <x-button disabled>Disabled</x-button>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Forms & Inputs Showcase -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 border-b border-gray-150 pb-2">Inputs & Form Controls</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Text Inputs & Selects -->
                <x-ui.card class="space-y-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider pb-2 border-b border-gray-50">Standard Fields</h3>
                    
                    <x-ui.input 
                        label="Text Input" 
                        name="example_text" 
                        placeholder="Enter text..." 
                        icon="heroicon-o-user" 
                    />

                    <x-ui.input 
                        label="Password Input" 
                        name="example_password" 
                        type="password" 
                        placeholder="Enter password..." 
                        icon="heroicon-o-lock-closed" 
                    />

                    <x-ui.select 
                        label="Dropdown Select" 
                        name="example_select" 
                        :options="['opt1' => 'Option One', 'opt2' => 'Option Two', 'opt3' => 'Option Three']" 
                        value="opt1" 
                    />
                </x-ui.card>

                <!-- Textareas & Toggles -->
                <x-ui.card class="space-y-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider pb-2 border-b border-gray-50">Area & Checkbox Fields</h3>

                    <x-ui.textarea 
                        label="Textarea Field" 
                        name="example_textarea" 
                        placeholder="Type something..." 
                        rows="3" 
                    />

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700">Checkbox</label>
                            <x-ui.checkbox label="Receive notifications" name="notify" checked />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700">Toggle Switch</label>
                            <div>
                                <x-ui.switch label="Maintenance mode" name="maintenance" checked />
                            </div>
                        </div>
                    </div>
                </x-ui.card>

                <!-- File Upload Fields -->
                <x-ui.card class="space-y-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider pb-2 border-b border-gray-50">File Uploads</h3>

                    <x-ui.input 
                        label="Standard File Input" 
                        name="std_file_example" 
                        type="file" 
                    />

                    <x-ui.dropzone 
                        label="Drag & Drop Upload" 
                        name="example_drop_file[]" 
                        id="demo-dropzone" 
                        inputId="demo-file-input" 
                        accept=".jpg,.png,.pdf" 
                        maxSize="15MB" 
                    />
                </x-ui.card>
            </div>
        </div>

        <!-- Date & Time Pickers -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 border-b border-gray-150 pb-2">Date & Time Pickers (<code class="text-xs text-primary-700 bg-primary-50 px-1.5 py-0.5 rounded font-mono">&lt;x-ui.date-picker&gt;</code> <code class="text-xs text-primary-700 bg-primary-50 px-1.5 py-0.5 rounded font-mono">&lt;x-ui.time-picker&gt;</code> <code class="text-xs text-primary-700 bg-primary-50 px-1.5 py-0.5 rounded font-mono">&lt;x-ui.datetime-picker&gt;</code>)</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <x-ui.card class="space-y-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider pb-2 border-b border-gray-50">Date</h3>

                    <x-ui.date-picker label="Date Picker" name="example_date" :value="now()->format('Y-m-d')" />

                    <x-ui.date-picker label="Date Range" name="example_date_range" range placeholder="Select a date range..." />

                    <x-ui.date-picker label="Future Dates Only" name="example_future_date" min="today" />
                </x-ui.card>

                <x-ui.card class="space-y-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider pb-2 border-b border-gray-50">Time</h3>

                    <x-ui.time-picker label="Time Picker" name="example_time" value="09:30" />

                    <x-ui.time-picker label="24-Hour Time" name="example_time_24" time24 />

                    <x-ui.time-picker label="Business Hours (09:00 – 18:00)" name="example_business_time" min="09:00" max="18:00" />
                </x-ui.card>

                <x-ui.card class="space-y-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider pb-2 border-b border-gray-50">Date & Time</h3>

                    <x-ui.datetime-picker label="Date & Time Picker" name="example_datetime" :value="now()->format('Y-m-d H:i')" />

                    <x-ui.datetime-picker label="24-Hour Date & Time" name="example_datetime_24" time24 />

                    <p class="text-xs text-gray-500">Submitted values use <code class="font-mono">Y-m-d</code>, <code class="font-mono">H:i</code> and <code class="font-mono">Y-m-d H:i</code>, ready for Laravel's <code class="font-mono">date</code> / <code class="font-mono">date_format</code> rules. Ranges submit as <code class="font-mono">start to end</code>.</p>
                </x-ui.card>
            </div>
        </div>

        <!-- Interactive Components: Dropdown, Section Card, Empty State -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 border-b border-gray-150 pb-2">Containers & Interactive Utilities</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Dropdown -->
                <x-ui.card class="flex flex-col justify-between h-64">
                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Dropdown Action</h3>
                        <p class="text-xs text-gray-500">Clicking the trigger opens a customizable menu with color tags.</p>
                    </div>
                    
                    <div class="my-auto">
                        <x-ui.dropdown align="left" width="w-48">
                            <x-slot name="trigger">
                                <x-button type="button" variant="outline" size="sm" icon="heroicon-o-chevron-down">
                                    Options
                                </x-button>
                            </x-slot>

                            <x-ui.dropdown-item color="sky">
                                Info Tag
                            </x-ui.dropdown-item>
                            <x-ui.dropdown-item color="emerald">
                                Success Tag
                            </x-ui.dropdown-item>
                            <x-ui.dropdown-item color="purple">
                                Secondary Tag
                            </x-ui.dropdown-item>
                        </x-ui.dropdown>
                    </div>
                </x-ui.card>

                <!-- Section Card -->
                <x-ui.section-card title="Section Title" subtitle="Subtitle/Section Tag" errorName="example_err" class="h-64">
                    <x-slot name="action">
                        <x-button size="sm" variant="ghost" icon="heroicon-o-arrow-path"></x-button>
                    </x-slot>
                    <p class="text-sm text-gray-600">This container encapsulates grouped content with optional header action slots and error message boundaries.</p>
                </x-ui.section-card>

                <!-- Empty State -->
                <x-ui.empty-state title="No Records Found" description="Try creating a new record or modifying search filters." icon="heroicon-o-magnifying-glass" class="h-64 rounded-2xl bg-white">
                    <x-slot name="action">
                        <x-button size="sm" variant="primary">Create Item</x-button>
                    </x-slot>
                </x-ui.empty-state>
            </div>
        </div>

        <!-- Side Drawer -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 border-b border-gray-150 pb-2">Side Drawer (<code class="text-xs text-primary-700 bg-primary-50 px-1.5 py-0.5 rounded font-mono">&lt;x-ui.drawer&gt;</code>)</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <x-ui.card class="flex flex-col justify-between gap-6">
                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Live Demo</h3>
                        <p class="text-xs text-gray-500">Off-canvas panel for forms, filters and record details. Closes on backdrop click, the close button or Escape.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <x-button type="button" variant="primary" size="sm" onclick="window.dispatchEvent(new CustomEvent('open-drawer', { detail: { name: 'demo-drawer' } }))">
                            Open Right Drawer
                        </x-button>
                        <x-button type="button" variant="outline" size="sm" onclick="window.dispatchEvent(new CustomEvent('open-drawer', { detail: { name: 'demo-drawer-left' } }))">
                            Open Left Drawer
                        </x-button>
                    </div>
                </x-ui.card>

                <x-ui.card class="lg:col-span-2 space-y-4">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider pb-2 border-b border-gray-50">Usage</h3>
                    <pre class="text-xs font-mono bg-gray-50 border border-gray-100 rounded-xl p-4 overflow-x-auto text-gray-700">@verbatim<x-ui.drawer name="edit-item" title="Edit Item" subtitle="Optional subtitle" position="right" width="md">
    ...content...
    <x-slot name="footer">...actions...</x-slot>
</x-ui.drawer>

// Open / close from anywhere
window.dispatchEvent(new CustomEvent('open-drawer', { detail: { name: 'edit-item' } }));
window.dispatchEvent(new CustomEvent('close-drawer', { detail: { name: 'edit-item' } }));@endverbatim</pre>
                    <p class="text-xs text-gray-500"><code class="font-mono">position</code>: <code class="font-mono">right</code> (default) or <code class="font-mono">left</code>. <code class="font-mono">width</code>: <code class="font-mono">sm</code>, <code class="font-mono">md</code> (default), <code class="font-mono">lg</code>, <code class="font-mono">xl</code>, <code class="font-mono">2xl</code>, <code class="font-mono">3xl</code>. Full width on mobile.</p>
                </x-ui.card>
            </div>
        </div>

        <!-- Demo Side Drawers -->
        <x-ui.drawer name="demo-drawer" title="Edit Sample Item" subtitle="Changes are not saved in this demo">
            <div class="space-y-6">
                <x-ui.input label="Item Name" name="drawer_item_name" placeholder="e.g. Starter Pack A" />
                <x-ui.select label="Status" name="drawer_item_status" :options="['active' => 'Active', 'inactive' => 'Inactive']" value="active" />
                <x-ui.date-picker label="Publish Date" name="drawer_publish_date" />
                <x-ui.textarea label="Description" name="drawer_item_description" placeholder="Type something..." rows="4" />
            </div>

            <x-slot name="footer">
                <x-button type="button" variant="secondary-outline" onclick="window.dispatchEvent(new CustomEvent('close-drawer', { detail: { name: 'demo-drawer' } }))">
                    Cancel
                </x-button>
                <x-button type="button" variant="primary" onclick="window.dispatchEvent(new CustomEvent('close-drawer', { detail: { name: 'demo-drawer' } }))">
                    Save Changes
                </x-button>
            </x-slot>
        </x-ui.drawer>

        <x-ui.drawer name="demo-drawer-left" title="Filters" position="left" width="sm">
            <div class="space-y-6">
                <x-ui.date-picker label="Created Between" name="drawer_filter_range" range placeholder="Select a date range..." />
                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700">Visibility</label>
                    <x-ui.checkbox label="Active items" name="drawer_filter_active" checked />
                    <x-ui.checkbox label="Inactive items" name="drawer_filter_inactive" />
                </div>
            </div>

            <x-slot name="footer">
                <x-button type="button" variant="primary" class="w-full" onclick="window.dispatchEvent(new CustomEvent('close-drawer', { detail: { name: 'demo-drawer-left' } }))">
                    Apply Filters
                </x-button>
            </x-slot>
        </x-ui.drawer>

        <!-- Demo Modal Component -->
        <x-ui.modal name="demo-modal" title="Component Showcase Modal">
            <div class="space-y-4">
                <p class="text-sm text-gray-600">This modal leverages Alpine.js, Blade teleports, and custom events for smooth opening/closing transitions.</p>
                <x-ui.input label="Modal Field Input" name="modal_input" placeholder="Type here..." />
            </div>
            
            <x-slot name="footer">
                <x-button type="button" variant="secondary-outline" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: 'demo-modal' } }))">
                    Cancel
                </x-button>
                <x-button type="button" variant="primary" onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: 'demo-modal' } }))">
                    Confirm Action
                </x-button>
            </x-slot>
        </x-ui.modal>
    </div>
@endsection
