<x-admin-layout>
    <x-slot name="header">
        Management Session Bookings
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

                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">View and manage management session bookings.</p>
                    
                    <!-- Status Filter -->
                    <form method="GET" action="{{ route('admin.management-session.bookings') }}" class="flex items-center gap-2">
                        <label for="status" class="text-sm text-gray-600">Filter:</label>
                        <select name="status" id="status" onchange="this.form.submit()" class="rounded-lg border-gray-300 shadow-sm text-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Bookings</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-mono font-medium text-primary">{{ $booking->confirmation_code }}</span>
                                        <div class="text-xs text-gray-400 mt-1">{{ $booking->created_at->format('M j, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $booking->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->email }}</div>
                                        <div class="text-xs text-gray-400">{{ $booking->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $booking->event_type }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->event_date ? $booking->event_date->format('M j, Y') : 'Date not set' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->slot)
                                            <div class="text-sm font-medium text-gray-900">{{ $booking->slot->date->format('D, M j, Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }}</div>
                                        @else
                                            <span class="text-gray-400">Slot deleted</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.management-session.bookings.status', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-sm rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50
                                                {{ $booking->status == 'pending' ? 'bg-yellow-50 text-yellow-800' : '' }}
                                                {{ $booking->status == 'confirmed' ? 'bg-green-50 text-green-800' : '' }}
                                                {{ $booking->status == 'completed' ? 'bg-blue-50 text-blue-800' : '' }}
                                                {{ $booking->status == 'cancelled' ? 'bg-red-50 text-red-800' : '' }}">
                                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($booking->message)
                                            <button onclick="showMessage('{{ addslashes($booking->message) }}')" class="text-gray-500 hover:text-primary mr-3" title="View Message">
                                                <i class="fas fa-comment-alt"></i>
                                            </button>
                                        @endif
                                        <form action="{{ route('admin.management-session.bookings.destroy', $booking->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this booking? This will free up the slot.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                        <p>No bookings found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($bookings->hasPages())
                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-serif text-xl font-bold text-secondary">Client's Message</h3>
                <button onclick="closeMessage()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="messageContent" class="text-gray-600 whitespace-pre-wrap"></div>
            <div class="mt-6 text-right">
                <button onclick="closeMessage()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-full transition">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function showMessage(message) {
            document.getElementById('messageContent').textContent = message;
            document.getElementById('messageModal').classList.remove('hidden');
        }
        
        function closeMessage() {
            document.getElementById('messageModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
