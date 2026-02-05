<x-admin-layout>
    <x-slot name="header">
        Service Areas (Locations)
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

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div class="md:w-1/2">
                        <h3 class="text-lg font-bold text-gray-800">Locations List</h3>
                        <p class="text-gray-500 text-sm mt-1">Manage specific locations for local SEO. Use the settings button to customize the page header.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <a href="{{ route('admin.service-areas.settings') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-cog mr-2 text-gray-400"></i> Page Settings
                        </a>
                        <a href="{{ route('admin.service-areas.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent focus:bg-accent active:bg-accent focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            <i class="fas fa-plus mr-2"></i> Add Location
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City / Zip</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($serviceAreas as $area)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $area->display_order }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $area->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $area->slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $area->city }}</div>
                                        <div class="text-sm text-gray-500">{{ $area->zip_code }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($area->is_active)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.service-areas.edit', $area->id) }}" class="text-primary hover:text-accent mr-3">Edit</a>
                                        <form action="{{ route('admin.service-areas.destroy', $area->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this location?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
