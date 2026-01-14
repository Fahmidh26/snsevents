<x-admin-layout>
    <x-slot name="header">
        Hero Section Slides
    </x-slot>

    <div class="max-w-6xl mx-auto">
        
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm flex items-center" role="alert">
                <i class="fas fa-check-circle mr-2 text-xl"></i>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex justify-end mb-6">
            <a href="{{ route('hero.create') }}" class="bg-primary hover:bg-accent text-white font-bold py-2 px-6 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none uppercase tracking-wider text-sm flex items-center">
                <i class="fas fa-plus mr-2"></i> Add New Slide
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-6">
                @if($slides->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($slides as $slide)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($slide->background_image_path)
                                                <img src="{{ asset('storage/' . $slide->background_image_path) }}" alt="Slide Image" class="h-16 w-24 object-cover rounded shadow-sm">
                                            @else
                                                <div class="h-16 w-24 bg-gray-100 flex items-center justify-center rounded text-gray-400 text-xs">No Image</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-secondary">{{ $slide->heading }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($slide->subheading, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $slide->sort_order }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $slide->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $slide->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                            <a href="{{ route('hero.edit', $slide->id) }}" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('hero.destroy', $slide->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-lg">No slides found. Start by creating one!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
