<x-admin-layout>
    <x-slot name="header">
        SEO Management
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm flex items-center" role="alert">
                        <i class="fas fa-check-circle mr-2 text-xl"></i>
                        <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-6">
                    <p class="text-gray-600">Manage SEO settings for different pages of your website. These settings help improve your search engine rankings.</p>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @foreach($seoDetails as $seo)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="font-serif text-xl font-bold text-secondary capitalize">
                                            {{ str_replace('_', ' ', $seo->page_identifier) }}
                                        </h3>
                                        @if($seo->is_active)
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">Inactive</span>
                                        @endif
                                    </div>
                                    
                                    <div class="space-y-2 text-sm">
                                        <div>
                                            <span class="font-semibold text-gray-700">Title:</span>
                                            <span class="text-gray-600">{{ $seo->title ?? 'Not set' }}</span>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-700">Description:</span>
                                            <span class="text-gray-600">{{ Str::limit($seo->meta_description, 100) ?? 'Not set' }}</span>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-700">Keywords:</span>
                                            <span class="text-gray-600">{{ Str::limit($seo->meta_keywords, 80) ?? 'Not set' }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ route('admin.seo.edit', $seo->id) }}" class="ml-4 bg-primary hover:bg-accent text-white font-bold py-2 px-6 rounded-full shadow-md transform transition hover:-translate-y-1 hover:shadow-lg text-sm">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
