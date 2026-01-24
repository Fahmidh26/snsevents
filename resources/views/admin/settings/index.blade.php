<x-admin-layout>
    <x-slot name="header">
        General Site Settings
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- General Info -->
                <div class="mb-8 border-b border-gray-100 pb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-globe text-primary mr-2"></i> General Information
                    </h3>
                    <div class="space-y-6">
                         <!-- Admin Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Admin Email Address</label>
                            <p class="text-xs text-gray-500 mb-3">Inquiries will be sent here.</p>
                            <input type="email" name="admin_email" value="{{ old('admin_email', $settings->admin_email) }}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                            @error('admin_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Site Title -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Site Title</label>
                                <input type="text" name="site_title" value="{{ old('site_title', $settings->site_title) }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                                @error('site_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                             <!-- Footer Text -->
                             <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Footer Copyright Text</label>
                                <input type="text" name="footer_text" value="{{ old('footer_text', $settings->footer_text) }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="© 2024 SNS Events. All rights reserved.">
                                @error('footer_text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Footer Description -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Footer Description (About Text)</label>
                            <textarea name="footer_description" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Short description about the company displayed in the footer.">{{ old('footer_description', $settings->footer_description) }}</textarea>
                            @error('footer_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Site Description -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Site Description</label>
                            <textarea name="site_description" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">{{ old('site_description', $settings->site_description) }}</textarea>
                            @error('site_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>


                        <!-- Logo -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Company Logo</label>
                            <div class="flex items-center gap-4">
                                @if($settings->logo_path)
                                    <div class="p-2 border border-gray-100 rounded bg-gray-50 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="Current Logo" class="h-16 object-contain">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="logo" class="block w-full text-sm text-gray-500 
                                    file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 
                                    file:text-sm file:font-semibold file:bg-primary/10 file:text-primary 
                                    hover:file:bg-primary/20 cursor-pointer">
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Recommended: PNG with transparent background.</p>
                            @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Favicon -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Favicon</label>
                             <div class="flex items-center gap-4">
                                @if($settings->favicon_path)
                                    <div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center p-1">
                                        <img src="{{ asset('storage/' . $settings->favicon_path) }}" alt="Favicon" class="max-w-full max-h-full">
                                    </div>
                                @endif
                                <input type="file" name="favicon" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Recommended: .ico or .png, 32x32px</p>
                            @error('favicon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                 <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-share-alt text-primary mr-2"></i> Social Media Links
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Facebook URL</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fab fa-facebook-f"></i></span>
                                <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Instagram URL</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fab fa-instagram"></i></span>
                                <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Twitter (X) URL</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fab fa-twitter"></i></span>
                                <input type="url" name="twitter_url" value="{{ old('twitter_url', $settings->twitter_url) }}" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">LinkedIn URL</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i class="fab fa-linkedin-in"></i></span>
                                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url) }}" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
