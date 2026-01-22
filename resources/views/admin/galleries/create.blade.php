<x-admin-layout>
    <x-slot name="header">
        Upload Gallery Images
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.galleries.index') }}" class="text-gray-500 hover:text-primary flex items-center gap-2 transition-colors">
            <i class="fas fa-arrow-left"></i> Back to Gallery
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Event Type *</label>
                    <select name="event_type_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                        <option value="">Select Event Type</option>
                        @foreach($eventTypes as $type)
                            <option value="{{ $type->id }}" {{ old('event_type_id', request('event_type_id')) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('event_type_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Select Images (Multiple allowed) *</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-primary transition-colors cursor-pointer relative">
                        <input type="file" name="images[]" multiple required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-300 mb-3"></i>
                        <p class="text-sm text-gray-500 font-medium">Click or drag images here to upload</p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG, WEBP (Max 5MB each)</p>
                    </div>
                    @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                    <i class="fas fa-upload"></i> Start Upload
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
