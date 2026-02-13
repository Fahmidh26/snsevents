<x-admin-layout>
    <x-slot name="header">
        Counseling Settings
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

                <p class="text-gray-600 mb-6">Configure your counseling booking page settings, intro text, and session details.</p>

                <form action="{{ route('admin.counseling.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Active Status -->
                    <div class="mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $settings->is_active ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="ml-3 text-sm font-medium text-gray-700">Enable Counseling Booking Page</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1 ml-8">When disabled, the counseling page will return a 404 error.</p>
                    </div>

                    <hr class="my-6">

                    <!-- Page Title -->
                    <div class="mb-6">
                        <label for="page_title" class="block text-sm font-medium text-gray-700 mb-2">Page Title</label>
                        <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $settings->page_title) }}" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        @error('page_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Page Subtitle -->
                    <div class="mb-6">
                        <label for="page_subtitle" class="block text-sm font-medium text-gray-700 mb-2">Page Subtitle</label>
                        <input type="text" name="page_subtitle" id="page_subtitle" value="{{ old('page_subtitle', $settings->page_subtitle) }}" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        @error('page_subtitle')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-6">

                    <!-- Card Display Settings -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Service Card Display Settings</h3>
                        <p class="text-sm text-gray-600 mb-4">These settings control how this service appears on the homepage and services page.</p>
                        
                        <!-- Card Name -->
                        <div class="mb-4">
                            <label for="card_name" class="block text-sm font-medium text-gray-700 mb-2">Card Name</label>
                            <input type="text" name="card_name" id="card_name" value="{{ old('card_name', $settings->card_name ?? 'Coaching Session') }}" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                            <p class="text-xs text-gray-500 mt-1">The name displayed on the service card (e.g., "Coaching Session")</p>
                            @error('card_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Card Category -->
                        <div class="mb-4">
                            <label for="card_category" class="block text-sm font-medium text-gray-700 mb-2">Card Category</label>
                            <input type="text" name="card_category" id="card_category" value="{{ old('card_category', $settings->card_category ?? 'Counseling') }}" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                            <p class="text-xs text-gray-500 mt-1">The category badge shown on the card (e.g., "Counseling")</p>
                            @error('card_category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Card Description -->
                        <div class="mb-4">
                            <label for="card_description" class="block text-sm font-medium text-gray-700 mb-2">Card Description</label>
                            <textarea name="card_description" id="card_description" rows="3" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('card_description', $settings->card_description ?? 'Book a professional counseling or coaching session to guide your personal or professional journey.') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Short description shown on the service card (max 500 characters)</p>
                            @error('card_description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Visibility Toggles -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="show_on_homepage" value="1" {{ ($settings->show_on_homepage ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-3 text-sm font-medium text-gray-700">Show on Homepage</span>
                                </label>
                                <p class="text-xs text-gray-500 mt-1 ml-8">Display this service in the "Our Services" section on the homepage</p>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="show_on_services_page" value="1" {{ ($settings->show_on_services_page ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-3 text-sm font-medium text-gray-700">Show on Services Page</span>
                                </label>
                                <p class="text-xs text-gray-500 mt-1 ml-8">Display this service on the /services listing page</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-6">

                    <!-- Intro Title -->
                    <div class="mb-6">
                        <label for="intro_title" class="block text-sm font-medium text-gray-700 mb-2">Introduction Title</label>
                        <input type="text" name="intro_title" id="intro_title" value="{{ old('intro_title', $settings->intro_title ?? 'A Safe Space to Heal') }}" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        @error('intro_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Intro Text -->
                    <div class="mb-6">
                        <label for="intro_text" class="block text-sm font-medium text-gray-700 mb-2">Introduction Text</label>
                        <textarea name="intro_text" id="intro_text" rows="10" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>{{ old('intro_text', $settings->intro_text) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">This text will appear at the top of the counseling booking page. You can use line breaks for paragraphs.</p>
                        @error('intro_text')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-6">

                    <!-- Images -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Page Images</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Hero Image -->
                            <div>
                                <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Hero Background</label>
                                @if($settings->hero_image)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings->hero_image) }}" alt="Current Hero" class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                                <input type="file" name="hero_image" id="hero_image" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-accent cursor-pointer">
                                @error('hero_image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Intro Image -->
                            <div>
                                <label for="intro_image" class="block text-sm font-medium text-gray-700 mb-2">Intro Section Image</label>
                                @if($settings->intro_image)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings->intro_image) }}" alt="Current Intro" class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                                <input type="file" name="intro_image" id="intro_image" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-accent cursor-pointer">
                                @error('intro_image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Booking Image -->
                            <div>
                                <label for="booking_image" class="block text-sm font-medium text-gray-700 mb-2">Booking Form Image</label>
                                @if($settings->booking_image)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings->booking_image) }}" alt="Current Booking" class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                                <input type="file" name="booking_image" id="booking_image" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-accent cursor-pointer">
                                @error('booking_image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Session Duration -->
                        <div>
                            <label for="session_duration" class="block text-sm font-medium text-gray-700 mb-2">Session Duration (minutes)</label>
                            <input type="number" name="session_duration" id="session_duration" value="{{ old('session_duration', $settings->session_duration) }}" 
                                min="15" max="480" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                            @error('session_duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (optional - for display)</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">$</span>
                                <input type="number" name="price" id="price" value="{{ old('price', $settings->price) }}" step="0.01" min="0"
                                    class="flex-1 rounded-none rounded-r-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Label -->
                        <div>
                            <label for="price_label" class="block text-sm font-medium text-gray-700 mb-2">Price Label</label>
                            <input type="text" name="price_label" id="price_label" value="{{ old('price_label', $settings->price_label) }}" 
                                placeholder="e.g., per session, per hour" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            @error('price_label')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Contact Email -->
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                            <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings->contact_email) }}" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Displayed on confirmation page for clients to reach out.</p>
                            @error('contact_email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Phone -->
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                            <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            @error('contact_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-6">

                    <!-- SEO Settings -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>
                        
                        <!-- SEO Title -->
                        <div class="mb-4">
                            <label for="seo_title" class="block text-sm font-medium text-gray-700 mb-2">SEO Meta Title</label>
                            <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $settings->seo_title) }}" 
                                placeholder="Relationship Counseling - SNS Events" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            @error('seo_title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SEO Description -->
                        <div class="mb-4">
                            <label for="seo_description" class="block text-sm font-medium text-gray-700 mb-2">SEO Meta Description</label>
                            <textarea name="seo_description" id="seo_description" rows="3" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('seo_description', $settings->seo_description) }}</textarea>
                            @error('seo_description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SEO Keywords -->
                        <div class="mb-4">
                            <label for="seo_keywords" class="block text-sm font-medium text-gray-700 mb-2">SEO Keywords</label>
                            <input type="text" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords', $settings->seo_keywords) }}" 
                                placeholder="counseling, relationship, therapy, mental health" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            @error('seo_keywords')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-md transform transition hover:-translate-y-1 hover:shadow-lg">
                            <i class="fas fa-save mr-2"></i>Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
