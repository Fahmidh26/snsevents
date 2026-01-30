<x-admin-layout>
    <x-slot name="header">
        Create Event Type
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.event-types.index') }}" class="text-gray-500 hover:text-primary flex items-center gap-2 transition-colors">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <form action="{{ route('admin.event-types.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Event Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="e.g. Birthday Party">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                    <input type="text" name="category" list="categories" value="{{ old('category') }}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="e.g. Event Planning & Management">
                    <datalist id="categories">
                        <option value="Event Planning & Management">
                        <option value="General Decoration & Design">
                        <option value="Holiday & Seasonal Lighting">
                        <option value="Special Occasions & Celebrations">
                        <option value="Wedding & Engagement Specials">
                        <option value="Cultural & Religious Events">
                    </datalist>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Short description about this event type...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Featured Image</label>
                    <input type="file" name="featured_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all cursor-pointer">
                    @error('featured_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                    @error('display_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" id="status" checked class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                    <label for="status" class="text-sm font-semibold text-gray-700">Active (Visible on website)</label>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="show_on_home" id="show_on_home" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                    <label for="show_on_home" class="text-sm font-semibold text-gray-700">Show on Home Page</label>
                </div>
            </div>

            <!-- SEO Section -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-search text-primary"></i> SEO Settings (Optional)
                </h3>
                <p class="text-sm text-gray-500 mb-6">Customize how this event type appears in search engines and social media. Leave blank to use defaults.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}" maxlength="255" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="e.g. Birthday Party Planning - SNS Events">
                        <p class="text-xs text-gray-500 mt-1">Recommended: 50-60 characters. Leave blank to use event name.</p>
                        @error('meta_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" maxlength="500" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Brief description for search engines...">{{ old('meta_description') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Recommended: 150-160 characters. This appears in search results.</p>
                        @error('meta_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" maxlength="255" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="birthday, party planning, decorations, texas">
                        <p class="text-xs text-gray-500 mt-1">Comma-separated keywords related to this event type.</p>
                        @error('meta_keywords') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2 pt-4 border-t border-gray-100">
                        <h4 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                            <i class="fab fa-facebook text-blue-600"></i> Social Media / Open Graph
                        </h4>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">OG Title (Social Media)</label>
                        <input type="text" name="og_title" value="{{ old('og_title') }}" maxlength="255" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Leave blank to use Meta Title">
                        <p class="text-xs text-gray-500 mt-1">Title shown when shared on Facebook, Twitter, etc.</p>
                        @error('og_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">OG Description (Social Media)</label>
                        <textarea name="og_description" rows="3" maxlength="500" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Leave blank to use Meta Description">{{ old('og_description') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Description shown when shared on social media.</p>
                        @error('og_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">OG Image (Social Media)</label>
                        <input type="file" name="og_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all cursor-pointer">
                        <p class="text-xs text-gray-500 mt-1">Recommended: 1200x630px. Leave blank to use Featured Image.</p>
                        @error('og_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                    <i class="fas fa-save"></i> Save Event Type
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
