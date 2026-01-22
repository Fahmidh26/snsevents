<x-admin-layout>
    <x-slot name="header">
        Edit Testimonial - {{ $testimonial->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Client Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                                required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Role/Position</label>
                            <input type="text" name="role" id="role" value="{{ old('role', $testimonial->role) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                    </div>

                    <!-- Testimonial Text -->
                    <div>
                        <label for="text" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Testimonial Text *</label>
                        <textarea name="text" id="text" rows="4" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                            required>{{ old('text', $testimonial->text) }}</textarea>
                        @error('text')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Image -->
                        <div>
                            <label for="image_path" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Client Photo</label>
                            @if($testimonial->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $testimonial->image_path) }}" alt="{{ $testimonial->name }}" class="h-20 w-20 rounded-full object-cover">
                                    <p class="text-xs text-gray-500 mt-1">Current photo</p>
                                </div>
                            @endif
                            <input type="file" name="image_path" id="image_path" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-accent">
                            <p class="text-xs text-gray-500 mt-1">Leave empty to keep current photo.</p>
                        </div>

                        <!-- Rating -->
                        <div>
                            <label for="rating" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Rating *</label>
                            <select name="rating" id="rating" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                                required>
                                <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                                <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                                <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                                <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                                <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <!-- Display Order -->
                        <div>
                            <label for="display_order" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Display Order</label>
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $testimonial->display_order) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>

                        <!-- Active Status -->
                        <div>
                            <label class="flex items-center mt-6">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }} 
                                    class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700 font-semibold">Active (Show on website)</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <a href="{{ route('admin.testimonials.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
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

