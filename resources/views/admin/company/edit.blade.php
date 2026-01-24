<x-admin-layout>
    <x-slot name="header">
        CEO Section Settings
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

                <form method="POST" action="{{ route('company-profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Branding Section -->
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="font-serif text-xl font-bold text-secondary mb-4 flex items-center">
                            <i class="fas fa-gem text-primary mr-3"></i> 
                            Brand Identity
                        </h3>
                        
                        <!-- Logo -->
                        <div class="mb-6">
                            <label for="logo" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Company Logo</label>
                            <div class="flex items-center space-x-6">
                                @if($companyProfile->logo_path)
                                    <div class="p-2 border border-gray-200 rounded-lg bg-gray-50">
                                        <img src="{{ asset('storage/' . $companyProfile->logo_path) }}" alt="Current Logo" class="h-24 object-contain">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="logo" id="logo" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-primary/10 file:text-primary
                                        hover:file:bg-primary/20
                                        cursor-pointer
                                    ">
                                    <p class="mt-1 text-xs text-gray-500">Recommended: PNG with transparent background.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Leadership Section -->
                     <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="font-serif text-xl font-bold text-secondary mb-4 flex items-center">
                            <i class="fas fa-user-tie text-primary mr-3"></i> 
                            Leadership Info
                        </h3>

                        <!-- Section Config -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="ceo_section_title" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Section Title</label>
                                <input type="text" name="ceo_section_title" id="ceo_section_title" value="{{ old('ceo_section_title', $companyProfile->ceo_section_title ?? 'Leadership & Vision') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                            </div>
                            <div>
                                <label for="ceo_section_subtitle" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Section Subtitle</label>
                                <input type="text" name="ceo_section_subtitle" id="ceo_section_subtitle" value="{{ old('ceo_section_subtitle', $companyProfile->ceo_section_subtitle ?? 'The Driving Force Behind SNS Events') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                            </div>
                        </div>

                         <!-- CEO Image -->
                        <div class="mb-6">
                            <label for="ceo_image" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">CEO Image</label>
                            <div class="flex items-center space-x-6">
                                @if($companyProfile->ceo_image_path)
                                    <div class="p-2 border border-gray-200 rounded-lg bg-gray-50">
                                        <img src="{{ asset('storage/' . $companyProfile->ceo_image_path) }}" alt="Current CEO Image" class="h-24 object-contain">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="ceo_image" id="ceo_image" class="block w-full text-sm text-gray-500
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

                        <!-- CEO Name -->
                        <div class="mb-6">
                            <label for="ceo_name" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">CEO Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="ceo_name" id="ceo_name" value="{{ old('ceo_name', $companyProfile->ceo_name) }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">
                            </div>
                        </div>

                        <!-- CEO Bio -->
                        <div class="mb-6">
                            <label for="ceo_bio" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">CEO Bio</label>
                            <textarea name="ceo_bio" id="ceo_bio" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('ceo_bio', $companyProfile->ceo_bio) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Brief introduction about the CEO.</p>
                        </div>

                        <!-- CEO Background -->
                        <div class="mb-6">
                            <label for="ceo_background" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Background Experience</label>
                            <textarea name="ceo_background" id="ceo_background" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('ceo_background', $companyProfile->ceo_background) }}</textarea>
                        </div>

                         <!-- CEO Why Business -->
                         <div class="mb-4">
                            <label for="ceo_why_business" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Why in this Business?</label>
                            <textarea name="ceo_why_business" id="ceo_why_business" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('ceo_why_business', $companyProfile->ceo_why_business) }}</textarea>
                        </div>
                    </div>

                    <!-- Company Fundamentals -->
                     <div class="mb-6">
                        <h3 class="font-serif text-xl font-bold text-secondary mb-4 flex items-center">
                            <i class="fas fa-bullseye text-primary mr-3"></i> 
                            Company Fundamentals
                        </h3>

                        <!-- Mission -->
                        <div class="mb-6">
                            <label for="mission" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Our Mission</label>
                            <textarea name="mission" id="mission" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('mission', $companyProfile->mission) }}</textarea>
                        </div>

                        <!-- Vision -->
                        <div class="mb-6">
                            <label for="vision" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Our Vision</label>
                            <textarea name="vision" id="vision" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('vision', $companyProfile->vision) }}</textarea>
                        </div>

                        <!-- Team Description -->
                        <div class="mb-6">
                            <label for="team_description" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Team Description</label>
                            <textarea name="team_description" id="team_description" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50 transition duration-150 ease-in-out">{{ old('team_description', $companyProfile->team_description) }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end border-t border-gray-200 pt-6">
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary uppercase tracking-widest text-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
