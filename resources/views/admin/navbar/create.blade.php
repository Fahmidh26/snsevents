<x-admin-layout>
    <x-slot name="header">
        Add Menu Item
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{ route('admin.navbar-items.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <!-- Label -->
                    <div>
                        <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                        <input type="text" name="label" id="label" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                    </div>

                    <!-- Parent -->
                    <div>
                        <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Item</label>
                        <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="">None (Top Level)</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->label }}</option>
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
                    <input type="hidden" name="type" id="type" value="url">
                    <input type="hidden" name="route_name" id="route_name">

                    <!-- Custom URL Input (Conditional) -->
                    <div id="url_container" class="hidden">
                        <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                        <input type="text" name="url" id="url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="https://example.com or /some-page">
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                        <input type="number" name="order" id="order" value="0" class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.navbar-items.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 mr-3">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-primary-dark shadow-lg">Create Item</button>
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

            function updateFields() {
                const value = linkHelper.value;
                
                if (value === 'custom') {
                    typeInput.value = 'url';
                    routeNameInput.value = '';
                    urlInput.readOnly = false;
                    urlContainer.classList.remove('hidden');
                    // Don't clear URL input, user might be editing
                } else {
                    const parts = value.split('|');
                    const type = parts[0];
                    const val = parts[1];

                    typeInput.value = type;
                    urlContainer.classList.add('hidden'); // Hide input for predefined
                    
                    if (type === 'route') {
                        routeNameInput.value = val;
                        urlInput.value = ''; // Clear URL for routes
                    } else { // type === 'url' (predefined)
                        routeNameInput.value = '';
                        urlInput.value = val;
                    }
                }
            }

            linkHelper.addEventListener('change', updateFields);
            
            // Initialize
            updateFields();
        });
    </script>
    @endpush
</x-admin-layout>
