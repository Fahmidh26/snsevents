<x-admin-layout>
    <x-slot name="header">
        Edit Slot
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm flex items-center" role="alert">
                        <i class="fas fa-check-circle mr-2 text-xl"></i>
                        <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('admin.counseling.slots') }}" class="text-gray-500 hover:text-primary transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Slots
                    </a>
                </div>

                @if($slot->is_booked && $slot->booking)
                    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-r">
                        <div class="flex items-start">
                            <i class="fas fa-user-check mr-3 mt-1"></i>
                            <div>
                                <p class="font-medium">This slot is booked</p>
                                <p class="text-sm mt-1">Booked by: {{ $slot->booking->name }} ({{ $slot->booking->email }})</p>
                                <p class="text-sm">Status: <span class="font-medium">{{ ucfirst($slot->booking->status) }}</span></p>
                                <a href="{{ route('admin.counseling.bookings') }}" class="text-sm underline mt-2 inline-block">View all bookings →</a>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.counseling.slots.update', $slot->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Date -->
                    <div class="mb-6">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" name="date" id="date" value="{{ old('date', $slot->date->format('Y-m-d')) }}" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration and Price -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <!-- Duration -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Session Duration</label>
                            <select name="duration" id="duration" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required onchange="calculateEndTime()">
                                <option value="30" {{ old('duration', $slot->duration) == 30 ? 'selected' : '' }}>30 minutes</option>
                                <option value="45" {{ old('duration', $slot->duration) == 45 ? 'selected' : '' }}>45 minutes</option>
                                <option value="60" {{ old('duration', $slot->duration) == 60 ? 'selected' : '' }}>60 minutes</option>
                                <option value="90" {{ old('duration', $slot->duration) == 90 ? 'selected' : '' }}>90 minutes</option>
                                <option value="120" {{ old('duration', $slot->duration) == 120 ? 'selected' : '' }}>2 hours</option>
                            </select>
                            @error('duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $slot->price) }}" step="0.01" min="0"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="e.g., 50.00" required>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Time Selection -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <!-- Start Time -->
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($slot->start_time)->format('H:i')) }}" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required onchange="calculateEndTime()">
                            @error('start_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Time (Auto-calculated) -->
                        <div>
                            <label for="end_time_display" class="block text-sm font-medium text-gray-700 mb-2">End Time <span class="text-xs text-gray-400">(auto-calculated)</span></label>
                            <input type="text" id="end_time_display" 
                                class="w-full rounded-lg border-gray-200 bg-gray-50 shadow-sm text-gray-600" readonly>
                            <input type="hidden" name="end_time" id="end_time" value="{{ old('end_time', \Carbon\Carbon::parse($slot->end_time)->format('H:i')) }}">
                        </div>
                    </div>

                    <!-- Availability Toggle -->
                    <div class="mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_available" value="1" {{ $slot->is_available ? 'checked' : '' }} 
                                class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary" {{ $slot->is_booked ? 'disabled' : '' }}>
                            <span class="ml-3 text-sm font-medium text-gray-700">Available for booking</span>
                        </label>
                        @if($slot->is_booked)
                            <p class="text-xs text-gray-500 mt-1 ml-8">This slot is booked and cannot be made unavailable.</p>
                        @else
                            <p class="text-xs text-gray-500 mt-1 ml-8">Uncheck to temporarily hide this slot from users.</p>
                        @endif
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (optional)</label>
                        <textarea name="notes" id="notes" rows="2" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Internal notes for this slot...">{{ old('notes', $slot->notes) }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('admin.counseling.slots') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-full transition">
                            Cancel
                        </a>
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-md transform transition hover:-translate-y-1 hover:shadow-lg">
                            <i class="fas fa-save mr-2"></i>Update Slot
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculateEndTime() {
            const startTime = document.getElementById('start_time').value;
            const duration = parseInt(document.getElementById('duration').value);
            
            if (startTime && duration) {
                const [hours, minutes] = startTime.split(':').map(Number);
                const startDate = new Date();
                startDate.setHours(hours, minutes, 0, 0);
                
                // Add duration in minutes
                const endDate = new Date(startDate.getTime() + duration * 60000);
                
                // Format end time
                const endHours = String(endDate.getHours()).padStart(2, '0');
                const endMinutes = String(endDate.getMinutes()).padStart(2, '0');
                const endTime = `${endHours}:${endMinutes}`;
                
                // Set hidden input
                document.getElementById('end_time').value = endTime;
                
                // Display formatted time
                const displayTime = endDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
                document.getElementById('end_time_display').value = displayTime;
            }
        }

        // Calculate on page load
        document.addEventListener('DOMContentLoaded', function() {
            calculateEndTime();
        });
    </script>
</x-admin-layout>
