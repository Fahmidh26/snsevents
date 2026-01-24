<x-admin-layout>
    <x-slot name="header">
        Manage Privacy Policy
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.privacy-policy.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-shield-alt text-primary mr-2"></i> Privacy Policy Content
                    </h3>

                    <!-- Hero Image Upload -->
                    <div class="mb-6 bg-gray-50 p-6 rounded-lg border border-gray-100">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hero Image (Optional)</label>
                        <p class="text-xs text-gray-500 mb-3">Upload a custom image for the page header. Recommended size: 1920x600px.</p>
                        
                        <div class="flex items-center gap-6">
                            @if($privacyPolicy->image_path)
                                <div class="w-32 h-20 rounded-lg overflow-hidden border border-gray-200">
                                    <img src="{{ asset('storage/' . $privacyPolicy->image_path) }}" alt="Current Hero" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input type="file" name="image_path" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        </div>
                        @error('image_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
                        <p class="text-xs text-gray-500 mb-3">Use the editor below to format your privacy policy.</p>
                        <textarea name="content" id="privacy-editor" rows="20" class="w-full rounded-lg border border-gray-200" required>{{ old('content', $privacyPolicy->content) }}</textarea>
                        @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                    <!-- SEO Section -->
                    <div class="mb-8 border-t border-gray-100 pt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-search text-primary mr-2"></i> SEO Optimization
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ old('meta_title', $privacyPolicy->meta_title) }}" class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:ring-primary focus:border-primary">
                                <p class="text-xs text-gray-500 mt-1">Recommended length: 50-60 characters</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Meta Description</label>
                                <textarea name="meta_description" rows="3" class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:ring-primary focus:border-primary">{{ old('meta_description', $privacyPolicy->meta_description) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Recommended length: 150-160 characters</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Meta Keywords</label>
                                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $privacyPolicy->meta_keywords) }}" class="w-full rounded-lg border border-gray-200 px-4 py-2 focus:ring-primary focus:border-primary">
                                <p class="text-xs text-gray-500 mt-1">Separate keywords with commas</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#privacy-editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                        ]
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
</x-admin-layout>
