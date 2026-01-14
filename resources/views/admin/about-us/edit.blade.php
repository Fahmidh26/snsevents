<x-admin-layout>
    <x-slot name="header">
        About Us Section Settings
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

                <form method="POST" action="{{ route('about-us.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="font-serif text-xl font-bold text-secondary mb-4 flex items-center">
                            <i class="fas fa-info-circle text-primary mr-3"></i> 
                            Main Content
                        </h3>
                        
                        <!-- Title & Subtitle -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Section Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $aboutUs->title) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="subtitle" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Section Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $aboutUs->subtitle) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                            </div>
                        </div>

                         <!-- Main Heading -->
                         <div class="mb-6">
                            <label for="main_heading" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Main Heading</label>
                            <input type="text" name="main_heading" id="main_heading" value="{{ old('main_heading', $aboutUs->main_heading) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                        </div>

                        <!-- Image -->
                        <div class="mb-6">
                            <label for="image_path" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Section Image</label>
                            <div class="flex items-center space-x-6">
                                @if($aboutUs->image_path)
                                    <div class="p-2 border border-gray-200 rounded-lg bg-gray-50">
                                        <img src="{{ asset('storage/' . $aboutUs->image_path) }}" alt="Current Image" class="h-24 object-contain">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="image_path" id="image_path" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-primary/10 file:text-primary
                                        hover:file:bg-primary/20
                                        cursor-pointer
                                    ">
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Description</label>
                            <textarea name="description" id="description" rows="6" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">{{ old('description', $aboutUs->description) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Use new lines to create separate paragraphs.</p>
                        </div>
                    </div>

                    <!-- Statistics Section -->
                    <div class="mb-6">
                        <h3 class="font-serif text-xl font-bold text-secondary mb-4 flex items-center">
                            <i class="fas fa-chart-bar text-primary mr-3"></i> 
                            Statistics
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Events Stats -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <label for="events_count" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wider">Events Count</label>
                                <input type="text" name="events_count" id="events_count" value="{{ old('events_count', $aboutUs->events_count) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 mb-2">
                                <label for="events_label" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wider">Label</label>
                                <input type="text" name="events_label" id="events_label" value="{{ old('events_label', $aboutUs->events_label) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                            </div>

                            <!-- Clients Stats -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <label for="clients_count" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wider">Clients Count</label>
                                <input type="text" name="clients_count" id="clients_count" value="{{ old('clients_count', $aboutUs->clients_count) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 mb-2">
                                <label for="clients_label" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wider">Label</label>
                                <input type="text" name="clients_label" id="clients_label" value="{{ old('clients_label', $aboutUs->clients_label) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                            </div>

                            <!-- Experience Stats -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <label for="experience_years" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wider">Experience Years</label>
                                <input type="text" name="experience_years" id="experience_years" value="{{ old('experience_years', $aboutUs->experience_years) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 mb-2">
                                <label for="experience_label" class="block text-gray-700 text-xs font-bold mb-2 uppercase tracking-wider">Label</label>
                                <input type="text" name="experience_label" id="experience_label" value="{{ old('experience_label', $aboutUs->experience_label) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end border-t border-gray-200 pt-6">
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary uppercase tracking-widest text-sm">
                            Update About Us
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
