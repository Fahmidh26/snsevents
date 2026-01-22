<x-admin-layout>
    <x-slot name="header">
        Add New FAQ
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Question -->
                    <div>
                        <label for="question" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Question *</label>
                        <input type="text" name="question" id="question" value="{{ old('question') }}" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                            required placeholder="e.g. How far in advance should I book your services?">
                        @error('question')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Answer -->
                    <div>
                        <label for="answer" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Answer *</label>
                        <textarea name="answer" id="answer" rows="6" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out" 
                            required>{{ old('answer') }}</textarea>
                        @error('answer')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <!-- Display Order -->
                        <div>
                            <label for="display_order" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Display Order</label>
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>

                        <!-- Active Status -->
                        <div>
                            <label class="flex items-center mt-6">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                                    class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700 font-semibold">Active (Show on website)</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <a href="{{ route('admin.faqs.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>Back to List
                        </a>
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary uppercase tracking-widest text-sm">
                            Create FAQ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

