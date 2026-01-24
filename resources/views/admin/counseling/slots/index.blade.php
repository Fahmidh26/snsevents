<x-admin-layout>
    <x-slot name="header">
        Counseling Time Slots
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

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm flex items-center" role="alert">
                        <i class="fas fa-exclamation-circle mr-2 text-xl"></i>
                        <span class="block sm:inline font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">Manage available time slots for counseling sessions.</p>
                    <a href="{{ route('admin.counseling.slots.create') }}" class="bg-primary hover:bg-accent text-white font-bold py-2 px-6 rounded-full shadow-md transform transition hover:-translate-y-1 hover:shadow-lg text-sm">
                        <i class="fas fa-plus mr-2"></i>Add New Slot
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($slots as $slot)
                                <tr class="{{ $slot->date < now()->startOfDay() ? 'bg-gray-50 opacity-60' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $slot->date->format('D, M j, Y') }}</div>
                                        @if($slot->date < now()->startOfDay())
                                            <span class="text-xs text-gray-400">Past</span>
                                        @elseif($slot->date->isToday())
                                            <span class="text-xs text-green-600 font-medium">Today</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $slot->duration }} mins
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">
                                        ${{ number_format($slot->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($slot->is_booked)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                <i class="fas fa-user-check mr-1"></i> Booked
                                            </span>
                                        @elseif($slot->is_available)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i> Available
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                <i class="fas fa-ban mr-1"></i> Unavailable
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($slot->booking)
                                            <div class="text-gray-900">{{ $slot->booking->name }}</div>
                                            <div class="text-gray-500 text-xs">{{ $slot->booking->email }}</div>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.counseling.slots.edit', $slot->id) }}" class="text-primary hover:text-accent mr-3">Edit</a>
                                        @if(!$slot->is_booked)
                                            <form action="{{ route('admin.counseling.slots.destroy', $slot->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this slot?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                                        <p>No slots created yet.</p>
                                        <a href="{{ route('admin.counseling.slots.create') }}" class="text-primary hover:underline mt-2 inline-block">Create your first slot</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($slots->hasPages())
                    <div class="mt-6">
                        {{ $slots->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
