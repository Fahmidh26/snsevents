<x-admin-layout>
    <x-slot name="header">
        Edit SEO Settings - {{ ucwords(str_replace('_', ' ', $seoDetail->page_identifier)) }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm flex items-center" role="alert">
                        <i class="fas fa-check-circle mr-2 text-xl"></i>
                        <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.seo.update', $seoDetail->id) }}" class="space-y-6">
                    @csrf
                    
                    <!-- Page Title -->
                    <div>
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">
                            <i class="fas fa-heading text-primary mr-2"></i>Page Title
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $seoDetail->title) }}" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                            required>
                        <p class="text-xs text-gray-500 mt-1">Appears in browser tab and search results (50-60 characters recommended)</p>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">
                            <i class="fas fa-align-left text-primary mr-2"></i>Meta Description
                        </label>
                        <textarea name="meta_description" id="meta_description" rows="3" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                            required>{{ old('meta_description', $seoDetail->meta_description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Shown in search results (150-160 characters recommended)</p>
                        @error('meta_description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div>
                        <label for="meta_keywords" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">
                            <i class="fas fa-tags text-primary mr-2"></i>Meta Keywords
                        </label>
                        <textarea name="meta_keywords" id="meta_keywords" rows="2" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                            required>{{ old('meta_keywords', $seoDetail->meta_keywords) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Comma-separated keywords (e.g., event decoration texas, wedding decor dallas)</p>
                        @error('meta_keywords')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Open Graph Title -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="font-serif text-lg font-bold text-secondary mb-4">
                            <i class="fab fa-facebook text-primary mr-2"></i>Social Media Preview (Open Graph)
                        </h3>
                        
                        <div class="mb-4">
                            <label for="og_title" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">OG Title</label>
                            <input type="text" name="og_title" id="og_title" value="{{ old('og_title', $seoDetail->og_title) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                            <p class="text-xs text-gray-500 mt-1">Title when shared on social media (leave blank to use Page Title)</p>
                        </div>

                        <div class="mb-4">
                            <label for="og_description" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">OG Description</label>
                            <textarea name="og_description" id="og_description" rows="2" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('og_description', $seoDetail->og_description) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Description when shared on social media</p>
                        </div>

                        <div>
                            <label for="og_image" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">OG Image URL</label>
                            <input type="url" name="og_image" id="og_image" value="{{ old('og_image', $seoDetail->og_image) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                            <p class="text-xs text-gray-500 mt-1">Full URL to image (1200x630px recommended)</p>
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div class="border-t border-gray-200 pt-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $seoDetail->is_active) ? 'checked' : '' }} 
                                class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700 font-semibold">Active (Enable SEO for this page)</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <a href="{{ route('admin.seo.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>Back to SEO List
                        </a>
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary uppercase tracking-widest text-sm">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
