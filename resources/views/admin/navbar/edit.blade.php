<x-admin-layout>
    <x-slot name="header">
        Edit Menu Item
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{ route('admin.navbar-items.update', $navbarItem->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <!-- Label -->
                    <div>
                        <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                        <input type="text" name="label" id="label" value="{{ $navbarItem->label }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                    </div>

                    <!-- Parent -->
                    <div>
                        <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Item</label>
                        <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="">None (Top Level)</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ $navbarItem->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->label }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Select a parent if this is a dropdown item.</p>
                    </div>

                    <!-- Link Destination Helper -->
                    <div>
                        <label for="link_helper" class="block text-sm font-medium text-gray-700">Link Destination</label>
                        <select id="link_helper" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <optgroup label="Pages">
                                <option value="url|/">Home Page</option>
                                <option value="route|about-us">About Us</option>
                                <option value="route|services.index">Services (All)</option>
                                <option value="route|custom-package">Custom Package</option>
                                <option value="route|counseling">Book Coaching Session</option>
                                <option value="route|management-session">Book Management Session</option>
                            </optgroup>
                            <optgroup label="Sections">
                                <option value="url|/#gallery">Gallery Section</option>
                                <option value="url|/#testimonials">Testimonials Section</option>
                                <option value="url|/#faq">FAQ Section</option>
                                <option value="url|/#contact">Contact Section</option>
                            </optgroup>
                            <option value="custom">Custom Link...</option>
                        </select>
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="type" id="type" value="{{ $navbarItem->type }}">
                    <input type="hidden" name="route_name" id="route_name" value="{{ $navbarItem->route_name }}">

                    <!-- Custom URL Input (Conditional) -->
                    <div id="url_container" class="hidden">
                        <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                        <input type="text" name="url" id="url" value="{{ $navbarItem->url }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="https://example.com or /some-page">
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" name="order" id="order" value="{{ $navbarItem->order }}" class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $navbarItem->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.navbar-items.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 mr-3">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-primary-dark shadow-lg">Update Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const linkHelper = document.getElementById('link_helper');
            const typeInput = document.getElementById('type');
            const routeNameInput = document.getElementById('route_name');
            const urlInput = document.getElementById('url');
            const urlContainer = document.getElementById('url_container');

            // Current Values
            const currentType = "{{ $navbarItem->type }}";
            const currentRoute = "{{ $navbarItem->route_name }}";
            const currentUrl = "{{ $navbarItem->url }}"; // Note: might be empty if route

            // Initialize Helper Dropdown
            function initHelper() {
                let found = false;
                
                // Try to find matching option
                for (let i = 0; i < linkHelper.options.length; i++) {
                    const optVal = linkHelper.options[i].value;
                    if (optVal === 'custom') continue;
                    
                    const parts = optVal.split('|');
                    const type = parts[0];
                    const val = parts[1];
                    
                    if (currentType === 'route' && type === 'route' && val === currentRoute) {
                        linkHelper.selectedIndex = i;
                        found = true;
                        break;
                    }
                    if (currentType === 'url' && type === 'url' && val === currentUrl) {
                        linkHelper.selectedIndex = i;
                        found = true;
                        break;
                    }
                }
                
                if (!found) {
                    // Select custom
                    for (let i = 0; i < linkHelper.options.length; i++) {
                        if (linkHelper.options[i].value === 'custom') {
                            linkHelper.selectedIndex = i;
                            break;
                        }
                    }
                    // Since it's custom, we ensure URL container is shown
                    urlContainer.classList.remove('hidden');
                } else {
                    // Predefined, hide URL container initially
                    urlContainer.classList.add('hidden');
                }
            }

            function updateFields() {
                const value = linkHelper.value;
                
                if (value === 'custom') {
                    typeInput.value = 'url';
                    routeNameInput.value = '';
                    urlInput.readOnly = false;
                    urlContainer.classList.remove('hidden');
                } else {
                    const parts = value.split('|');
                    const type = parts[0];
                    const val = parts[1];

                    typeInput.value = type;
                    urlContainer.classList.add('hidden');
                    
                    if (type === 'route') {
                        routeNameInput.value = val;
                        urlInput.value = ''; 
                    } else { // type === 'url'
                        routeNameInput.value = '';
                        urlInput.value = val;
                    }
                }
            }

            linkHelper.addEventListener('change', updateFields);
            
            // Run initialization
            initHelper();
        });
    </script>
    @endpush
</x-admin-layout>
