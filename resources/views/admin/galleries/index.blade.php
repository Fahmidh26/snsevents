<x-admin-layout>
    <x-slot name="header">
        Event Galleries
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table id="galleryTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Image</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Event Type</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Caption</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Featured</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($galleries as $gallery)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->caption }}" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-medium">{{ $gallery->eventType->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <input type="text" name="caption" value="{{ $gallery->caption }}" class="border-b border-gray-300 focus:border-primary outline-none bg-transparent text-sm w-full" placeholder="Add caption...">
                            <button type="submit" class="text-xs text-blue-500 hover:text-blue-700" title="Update Caption">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ $gallery->is_featured ? 'checked' : '' }} onchange="this.form.submit()" class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $gallery->is_featured ? 'Yes' : 'No' }}</span>
                            </label>
                            <!-- Hidden input to ensure unchecked checkbox sends 0 (handled by controller usually, but form submit on change is tricky with toggle) -->
                            <!-- Ideally, controller handles boolean conversion or we use hidden input -->
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        .dataTables_wrapper .dataTables_length select {
            padding-right: 2rem !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            margin-left: 0.5rem;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #d4af37;
            ring: 1px solid #d4af37;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#galleryTable').DataTable({
                responsive: true,
                order: [[1, 'asc']], // Order by Event Type by default
                columnDefs: [
                    { orderable: false, targets: [0, 4] } // Disable sorting on Image and Actions columns
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search images...",
                    lengthMenu: "Show _MENU_ entries"
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>
