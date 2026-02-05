<x-admin-layout>
    <x-slot name="header">
        Service Areas Page Settings
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Page Cover & Titles</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Customize the look and feel of the "Areas We Serve" page main header section.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('admin.service-areas.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            
                            <!-- Hero Image -->
                            <div class="col-span-6 sm:col-span-4 mb-6">
                                <label class="block font-medium text-sm text-gray-700" for="hero_image">
                                    Hero Cover Image
                                </label>
                                
                                <div class="mt-2 flex items-center space-x-6">
                                    <div class="shrink-0">
                                        @if($settings->hero_image_path)
                                            <img class="h-32 w-48 object-cover rounded-md border border-gray-200" src="{{ asset('storage/' . $settings->hero_image_path) }}" alt="Hero Image">
                                        @else
                                            <div class="h-32 w-48 bg-gray-100 flex items-center justify-center rounded-md border border-gray-200">
                                                <span class="text-gray-400 text-sm">No Image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose file</span>
                                        <input type="file" name="hero_image" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-primary-50 file:text-primary-700
                                        hover:file:bg-primary-100
                                        "/>
                                    </label>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">Recommended size: 1920x600px. Max 2MB.</p>

                                @if($settings->hero_image_path)
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="remove_hero_image" value="1" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                                        <span class="ml-2 text-sm text-gray-600">Remove current image (Revert to default)</span>
                                    </label>
                                </div>
                                @endif
                            </div>

                            <!-- Heading -->
                            <div class="col-span-6 sm:col-span-4 mb-4">
                                <label for="heading" class="block font-medium text-sm text-gray-700">Main Heading</label>
                                <input type="text" name="heading" id="heading" value="{{ old('heading', $settings->heading) }}" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <!-- SubHeading -->
                            <div class="col-span-6 sm:col-span-4 mb-4">
                                <label for="subheading" class="block font-medium text-sm text-gray-700">Sub Heading</label>
                                <input type="text" name="subheading" id="subheading" value="{{ old('subheading', $settings->subheading) }}" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-5">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>

                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">SEO Settings</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Optimize this specific page for search engines.
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label for="seo_title" class="block font-medium text-sm text-gray-700">SEO Title</label>
                                            <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $settings->seo_title) }}" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Areas We Serve - SNS Events">
                                        </div>

                                        <div class="col-span-6">
                                            <label for="seo_description" class="block font-medium text-sm text-gray-700">Meta Description</label>
                                            <textarea name="seo_description" id="seo_description" rows="3" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('seo_description', $settings->seo_description) }}</textarea>
                                        </div>

                                        <div class="col-span-6">
                                            <label for="seo_keywords" class="block font-medium text-sm text-gray-700">Keywords (Comma separated)</label>
                                            <input type="text" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords', $settings->seo_keywords) }}" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <a href="{{ route('admin.service-areas.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition mr-2">
                                        Cancel
                                    </a>
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-accent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Save Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
