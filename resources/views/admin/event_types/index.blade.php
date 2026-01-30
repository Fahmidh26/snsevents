<x-admin-layout>
    <x-slot name="header">
        Event Types
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-gray-600">Manage your event categories here.</p>
        <a href="{{ route('admin.event-types.create') }}" class="bg-primary hover:bg-accent text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Event Type
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table id="eventTypesTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Image</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Order</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($eventTypes as $type)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        @if($type->featured_image)
                            <img src="{{ asset($type->featured_image) }}" alt="{{ $type->name }}" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                        @else
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-secondary">{{ $type->name }}</div>
                        <div class="text-xs text-gray-500">{{ $type->slug }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($type->status)
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $type->display_order }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.event-types.edit', $type) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.event-types.destroy', $type) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event type?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
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
            $('#eventTypesTable').DataTable({
                responsive: true,
                order: [[3, 'asc']], // Order by 'Display Order' column by default
                columnDefs: [
                    { orderable: false, targets: [0, 4] } // Disable sorting on Image and Actions columns
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search events...",
                    lengthMenu: "Show _MENU_ entries"
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>
