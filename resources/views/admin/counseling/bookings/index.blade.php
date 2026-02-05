<x-admin-layout>
    <x-slot name="header">
        Counseling Bookings
    </x-slot>

    <div class="mb-6">
        <p class="text-gray-600">Review and manage counseling session bookings.</p>
    </div>

    <!-- Status Filter -->
    <div class="mb-6 flex justify-between items-center">
        <div class="flex gap-4">
            <a href="{{ route('admin.counseling.bookings', ['status' => 'all']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('status', 'all') == 'all' ? 'bg-primary text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100' }}">All</a>
            <a href="{{ route('admin.counseling.bookings', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100' }}">Pending</a>
            <a href="{{ route('admin.counseling.bookings', ['status' => 'confirmed']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'confirmed' ? 'bg-green-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100' }}">Confirmed</a>
            <a href="{{ route('admin.counseling.bookings', ['status' => 'completed']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'completed' ? 'bg-blue-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100' }}">Completed</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Reference</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Client</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Session</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-sm font-mono font-bold text-primary">{{ $booking->confirmation_code }}</span>
                            <div class="text-[10px] text-gray-400 mt-1 uppercase">Booked: {{ $booking->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-secondary">{{ $booking->name }}</div>
                            <div class="text-xs text-gray-500 flex flex-col gap-1">
                                <span><i class="fas fa-envelope mr-1 w-4"></i> {{ $booking->email }}</span>
                                <span><i class="fas fa-phone mr-1 w-4"></i> {{ $booking->phone }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($booking->slot)
                                <div class="text-sm font-semibold text-gray-700">{{ $booking->slot->date->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }}
                                </div>
                            @else
                                <span class="text-xs text-red-400 italic">Slot Deleted</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.counseling.bookings.status', $booking->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded-full px-3 py-1 border-0 shadow-sm outline-none cursor-pointer
                                    {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $booking->status == 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2" x-data="{ showDetails: false }">
                                <button @click="showDetails = true" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="View Full Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.counseling.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Booking">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                
                                <!-- Detailed Info Modal -->
                                <template x-if="showDetails">
                                    <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showDetails = false" aria-hidden="true"></div>

                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100">
                                                <div class="bg-primary px-6 py-4 flex justify-between items-center text-white">
                                                    <div class="flex items-center gap-3">
                                                        <i class="fas fa-heart text-white/80"></i>
                                                        <h3 class="text-xl font-serif font-bold italic tracking-wide">Counseling Booking Details</h3>
                                                    </div>
                                                    <button @click="showDetails = false" class="text-white hover:text-gray-200 transition-colors">
                                                        <i class="fas fa-times text-xl"></i>
                                                    </button>
                                                </div>
                                                
                                                <div class="p-8">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                                        <!-- Left Column: Client Info -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Client Information</h4>
                                                            <div class="space-y-3">
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-user-circle"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-[10px] text-gray-500 uppercase">Full Name</p>
                                                                        <p class="font-bold text-secondary">{{ $booking->name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-envelope-open"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-[10px] text-gray-500 uppercase">Email Address</p>
                                                                        <p class="font-bold text-secondary">{{ $booking->email }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-mobile-alt"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-[10px] text-gray-500 uppercase">Phone Number</p>
                                                                        <p class="font-bold text-secondary">{{ $booking->phone }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Right Column: Session Info -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Appointment Details</h4>
                                                            <div class="space-y-3">
                                                                @if($booking->slot)
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-calendar-check"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-[10px] text-gray-500 uppercase">Session Date</p>
                                                                        <p class="font-bold text-secondary">{{ $booking->slot->date->format('F d, Y') }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-clock"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-[10px] text-gray-500 uppercase">Time Slot</p>
                                                                        <p class="font-bold text-secondary">
                                                                            {{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-hourglass-half"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-[10px] text-gray-500 uppercase">Duration</p>
                                                                        <p class="font-bold text-secondary">{{ $booking->slot->duration }} Minutes</p>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="p-4 bg-red-50 text-red-600 rounded-lg text-sm italic">
                                                                    The associated time slot has been deleted.
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8 border-t border-gray-100 pt-8">
                                                        <!-- Logistics -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Payment & Reference</h4>
                                                            <div class="flex gap-8">
                                                                <div>
                                                                    <p class="text-[10px] text-gray-500 uppercase">Confirmation</p>
                                                                    <p class="text-sm font-mono font-bold text-primary">{{ $booking->confirmation_code }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-[10px] text-gray-500 uppercase">Price</p>
                                                                    <p class="font-bold text-secondary">${{ number_format($booking->slot->price ?? 0, 2) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Status -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Current Status</h4>
                                                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold
                                                                {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                                {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                                                {{ $booking->status == 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                                                                {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                                                <i class="fas fa-circle text-[8px] mr-2"></i>
                                                                {{ ucfirst($booking->status) }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- What the user wrote -->
                                                    <div class="mt-8 border-t border-gray-100 pt-8">
                                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Client's Message & Concerns</h4>
                                                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 text-gray-700 leading-relaxed italic relative">
                                                            <i class="fas fa-quote-left text-primary/20 text-4xl absolute top-4 left-4"></i>
                                                            <div class="relative z-10 pl-8">
                                                                {{ $booking->message ?: 'The client did not provide a specific message with this booking.' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="bg-gray-50 px-8 py-4 flex justify-end gap-3">
                                                    <button @click="showDetails = false" class="px-6 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-sm">
                                                        Close
                                                    </button>
                                                    <a href="mailto:{{ $booking->email }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-semibold text-sm flex items-center gap-2 shadow-sm">
                                                        <i class="fas fa-paper-plane"></i> Contact Client
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-4 block opacity-20"></i>
                            No counseling bookings found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($bookings->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>

