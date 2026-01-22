<x-admin-layout>
    <x-slot name="header">
        Event Galleries
    </x-slot>

    <div class="mb-6 flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.galleries.index') }}" method="GET" class="flex gap-4 items-center">
            <label class="text-sm font-semibold text-gray-700">Filter by Event:</label>
            <select name="event_type_id" class="px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" onchange="this.form.submit()">
                <option value="">All Events</option>
                @foreach($eventTypes as $type)
                    <option value="{{ $type->id }}" {{ request('event_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
            @if(request('event_type_id'))
                <a href="{{ route('admin.galleries.index') }}" class="text-xs text-red-500 hover:underline">Clear Filter</a>
            @endif
        </form>
        <a href="{{ route('admin.galleries.create') }}" class="bg-primary hover:bg-accent text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <i class="fas fa-upload"></i> Upload Images
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galleries as $gallery)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group relative">
                <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->caption }}" class="w-full h-48 object-cover">
                
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold px-2 py-1 bg-gray-100 text-gray-600 rounded">{{ $gallery->eventType->name }}</span>
                        @if($gallery->is_featured)
                            <span class="text-xs font-semibold px-2 py-1 bg-primary/20 text-primary rounded flex items-center gap-1">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>
                    
                    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PUT')
                        <input type="text" name="caption" value="{{ $gallery->caption }}" placeholder="Add caption..." class="w-full text-xs px-2 py-1 border border-gray-100 rounded focus:border-primary outline-none">
                        
                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-1 text-[10px] text-gray-500 cursor-pointer">
                                <input type="checkbox" name="is_featured" {{ $gallery->is_featured ? 'checked' : '' }} onchange="this.form.submit()" class="w-3 h-3 text-primary border-gray-300 rounded focus:ring-primary">
                                Set as Featured
                            </label>
                            
                            <div class="flex gap-1">
                                <button type="submit" class="p-1 text-blue-500 hover:bg-blue-50 rounded" title="Save Caption">
                                    <i class="fas fa-check text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white p-2 rounded-full shadow-lg hover:bg-red-600">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white rounded-xl border border-dashed border-gray-300">
                <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500">No gallery images found.</p>
                <a href="{{ route('admin.galleries.create') }}" class="text-primary hover:underline mt-2 inline-block">Upload some now</a>
            </div>
        @endforelse
    </div>
</x-admin-layout>
