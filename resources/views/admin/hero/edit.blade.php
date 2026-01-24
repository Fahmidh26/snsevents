<x-admin-layout>
    <x-slot name="header">
        Edit Slide
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                <form method="POST" action="{{ route('hero.update', $hero->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="font-serif text-xl font-bold text-secondary mb-4 flex items-center">
                            <i class="fas fa-edit text-primary mr-3"></i> 
                            Edit Slide Details
                        </h3>
                        
                        <!-- Heading & Subheading -->
                        <div class="mb-6">
                            <label for="heading" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Heading</label>
                            <input type="text" name="heading" id="heading" value="{{ old('heading', $hero->heading) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                        </div>

                        <div class="mb-6">
                            <label for="subheading" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Subheading</label>
                            <input type="text" name="subheading" id="subheading" value="{{ old('subheading', $hero->subheading) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                        </div>

                        <!-- Button Text -->
                        <div class="mb-6">
                            <label for="button_text" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Button Text</label>
                            <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $hero->button_text) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                        </div>

                        <!-- Image -->
                        <div class="mb-6">
                            <label for="background_image_path" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Background Image</label>
                            
                            @if($hero->background_image_path)
                                <div class="mb-3 p-2 border border-gray-200 rounded-lg bg-gray-50 inline-block">
                                    <img src="{{ asset('storage/' . $hero->background_image_path) }}" alt="Current Slide" class="h-32 object-cover rounded">
                                    <p class="text-xs text-gray-500 mt-1">Current Image</p>
                                </div>
                            @endif

                            <input type="file" name="background_image_path" id="background_image_path" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary/10 file:text-primary
                                hover:file:bg-primary/20
                                cursor-pointer
                            ">
                        </div>

                         <!-- Video -->
                         <div class="mb-6">
                            <label for="background_video_path" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Background Video (Optional)</label>
                            
                            @if($hero->background_video_path)
                                <div class="mb-3 p-2 border border-gray-200 rounded-lg bg-gray-50 inline-block">
                                    <video src="{{ asset('storage/' . $hero->background_video_path) }}" class="h-32 object-cover rounded" controls></video>
                                    <p class="text-xs text-gray-500 mt-1">Current Video</p>
                                </div>
                            @endif

                            <input type="file" name="background_video_path" id="background_video_path" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary/10 file:text-primary
                                hover:file:bg-primary/20
                                cursor-pointer
                            ">
                            <p class="mt-1 text-xs text-gray-500">Max size: 100MB. Supported formats: MP4, MOV, OGG, WEBM.</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <!-- Order -->
                            <div>
                                <label for="sort_order" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $hero->sort_order) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-center pt-8">
                                <label for="is_active" class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" id="is_active" class="form-checkbox h-5 w-5 text-primary rounded focus:ring-primary border-gray-300" {{ $hero->is_active ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700 font-medium">Active (Visible on website)</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end border-t border-gray-200 pt-6 space-x-4">
                         <a href="{{ route('hero.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm uppercase tracking-wider">Cancel</a>
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary uppercase tracking-widest text-sm">
                            Update Slide
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
