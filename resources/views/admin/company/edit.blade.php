<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('company-profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Logo -->
                        <div class="mb-4">
                            <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Company Logo</label>
                            @if($companyProfile->logo_path)
                                <img src="{{ tap(asset('storage/' . $companyProfile->logo_path), function($path) { \Illuminate\Support\Facades\Log::info('Logo Asset Path: ' . $path); }) }}" alt="Current Logo" class="mb-2 h-20">
                            @endif
                            <input type="file" name="logo" id="logo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- CEO Name -->
                        <div class="mb-4">
                            <label for="ceo_name" class="block text-gray-700 text-sm font-bold mb-2">CEO Name</label>
                            <input type="text" name="ceo_name" id="ceo_name" value="{{ old('ceo_name', $companyProfile->ceo_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <!-- CEO Bio -->
                        <div class="mb-4">
                            <label for="ceo_bio" class="block text-gray-700 text-sm font-bold mb-2">CEO Bio</label>
                            <textarea name="ceo_bio" id="ceo_bio" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('ceo_bio', $companyProfile->ceo_bio) }}</textarea>
                        </div>

                        <!-- CEO Background -->
                        <div class="mb-4">
                            <label for="ceo_background" class="block text-gray-700 text-sm font-bold mb-2">CEO Background Experience</label>
                            <textarea name="ceo_background" id="ceo_background" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('ceo_background', $companyProfile->ceo_background) }}</textarea>
                        </div>

                         <!-- CEO Why Business -->
                         <div class="mb-4">
                            <label for="ceo_why_business" class="block text-gray-700 text-sm font-bold mb-2">Why in this Business?</label>
                            <textarea name="ceo_why_business" id="ceo_why_business" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('ceo_why_business', $companyProfile->ceo_why_business) }}</textarea>
                        </div>

                        <!-- Mission -->
                        <div class="mb-4">
                            <label for="mission" class="block text-gray-700 text-sm font-bold mb-2">Company Mission</label>
                            <textarea name="mission" id="mission" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('mission', $companyProfile->mission) }}</textarea>
                        </div>

                        <!-- Vision -->
                        <div class="mb-4">
                            <label for="vision" class="block text-gray-700 text-sm font-bold mb-2">Company Vision</label>
                            <textarea name="vision" id="vision" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('vision', $companyProfile->vision) }}</textarea>
                        </div>

                        <!-- Team Description -->
                        <div class="mb-4">
                            <label for="team_description" class="block text-gray-700 text-sm font-bold mb-2">Team Description</label>
                            <textarea name="team_description" id="team_description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('team_description', $companyProfile->team_description) }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
