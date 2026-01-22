<x-admin-layout>
    <x-slot name="header">
        Edit Service Area - {{ $serviceArea->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                <form method="POST" action="{{ route('admin.service-areas.update', $serviceArea->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Location Name -->
                        <div>
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Location Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $serviceArea->name) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                                required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">City</label>
                            <input type="text" name="city" id="city" value="{{ old('city', $serviceArea->city) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- State -->
                        <div>
                            <label for="state" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">State</label>
                            <input type="text" name="state" id="state" value="{{ old('state', $serviceArea->state) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                                required>
                        </div>

                        <!-- Zip Code -->
                        <div>
                            <label for="zip_code" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Zip Code</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $serviceArea->zip_code) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Short Description</label>
                        <textarea name="description" id="description" rows="3" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('description', $serviceArea->description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Briefly describe your services in this area (good for SEO).</p>
                    </div>

                    <!-- Map URL -->
                    <div>
                        <label for="map_url" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Google Maps URL</label>
                        <input type="url" name="map_url" id="map_url" value="{{ old('map_url', $serviceArea->map_url) }}" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <!-- Display Order -->
                        <div>
                            <label for="display_order" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Display Order</label>
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $serviceArea->display_order) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>

                        <!-- Active Status -->
                        <div>
                            <label class="flex items-center mt-6">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $serviceArea->is_active) ? 'checked' : '' }} 
                                    class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700 font-semibold">Active (Show on website)</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <a href="{{ route('admin.service-areas.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>Back to List
                        </a>
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary uppercase tracking-widest text-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
