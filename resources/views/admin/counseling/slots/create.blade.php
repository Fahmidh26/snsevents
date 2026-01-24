<x-admin-layout>
    <x-slot name="header">
        Create New Slot
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                <div class="mb-6">
                    <a href="{{ route('admin.counseling.slots') }}" class="text-gray-500 hover:text-primary transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Slots
                    </a>
                </div>

                <p class="text-gray-600 mb-6">Create a new available time slot for counseling sessions.</p>

                <form id="create-slot-form" action="{{ route('admin.counseling.slots.store') }}" method="POST">
                    @csrf

                    <!-- Date -->
                    <div class="mb-6">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" name="date" id="date" value="{{ old('date') }}" 
                            min="{{ date('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration and Price (moved up for logical flow) -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <!-- Duration -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Session Duration</label>
                            <select name="duration" id="duration" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required onchange="calculateEndTime()">
                                <option value="30" {{ old('duration') == 30 ? 'selected' : '' }}>30 minutes</option>
                                <option value="45" {{ old('duration') == 45 ? 'selected' : '' }}>45 minutes</option>
                                <option value="60" {{ old('duration', 60) == 60 ? 'selected' : '' }}>60 minutes</option>
                                <option value="90" {{ old('duration') == 90 ? 'selected' : '' }}>90 minutes</option>
                                <option value="120" {{ old('duration') == 120 ? 'selected' : '' }}>2 hours</option>
                            </select>
                            @error('duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="e.g., 50.00" required>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Availability Display -->
                    <div id="availability_info" class="mb-6 hidden">
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700 font-medium">Slots already scheduled for <span id="selected_date_display" class="font-bold"></span>:</p>
                                    <ul id="taken_slots_list" class="mt-2 text-sm text-blue-600 list-disc list-inside">
                                        <!-- Populated via JS -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time Selection -->
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <!-- Start Time -->
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time', '09:00') }}" 
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
                            <input type="hidden" name="end_time" id="end_time" value="{{ old('end_time', '10:00') }}">
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (optional)</label>
                        <textarea name="notes" id="notes" rows="2" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Internal notes for this slot...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-6">

                    <!-- Recurring Option -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <label class="flex items-center cursor-pointer mb-3">
                            <input type="checkbox" name="create_recurring" id="create_recurring" value="1" {{ old('create_recurring') ? 'checked' : '' }} 
                                class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary" onchange="toggleRecurring()">
                            <span class="ml-3 text-sm font-medium text-gray-700">Create recurring slots</span>
                        </label>
                        <p class="text-xs text-gray-500 mb-3">This will create the same slot for multiple weeks on the same day.</p>
                        
                        <div id="recurring_options" class="{{ old('create_recurring') ? '' : 'hidden' }}">
                            <label for="recurring_weeks" class="block text-sm font-medium text-gray-700 mb-2">Number of additional weeks</label>
                            <input type="number" name="recurring_weeks" id="recurring_weeks" value="{{ old('recurring_weeks', 4) }}" 
                                min="1" max="12" class="w-32 rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">e.g., 4 = creates slots for the next 4 weeks</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('admin.counseling.slots') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-full transition">
                            Cancel
                        </a>
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-md transform transition hover:-translate-y-1 hover:shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Create Slot
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let existingSlots = [];

        function toggleRecurring() {
            const checkbox = document.getElementById('create_recurring');
            const options = document.getElementById('recurring_options');
            if (checkbox.checked) {
                options.classList.remove('hidden');
            } else {
                options.classList.add('hidden');
            }
        }

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

        async function checkAvailability() {
            const dateInput = document.getElementById('date');
            const date = dateInput.value;
            const infoDiv = document.getElementById('availability_info');
            const list = document.getElementById('taken_slots_list');
            const dateDisplay = document.getElementById('selected_date_display');

            if (!date) {
                infoDiv.classList.add('hidden');
                existingSlots = [];
                return;
            }

            try {
                const response = await fetch(`{{ route('admin.counseling.check-availability') }}?date=${date}`);
                existingSlots = await response.json();

                if (existingSlots.length > 0) {
                    dateDisplay.textContent = date;
                    list.innerHTML = existingSlots.map(slot => `<li>${slot.start_time.slice(0, 5)} - ${slot.end_time.slice(0, 5)} (${slot.duration}m)</li>`).join('');
                    infoDiv.classList.remove('hidden');
                } else {
                    infoDiv.classList.add('hidden');
                }
            } catch (error) {
                console.error('Error checking availability:', error);
                existingSlots = [];
            }
        }

        function validateForm(e) {
            if (existingSlots.length === 0) return true;

            const newStart = document.getElementById('start_time').value;
            const newEnd = document.getElementById('end_time').value; // Calculated end time

            if (!newStart || !newEnd) return true;

            // Convert strings "HH:MM" to comparable minutes or date objects
            const getMinutes = (timeStr) => {
                const [h, m] = timeStr.split(':').map(Number);
                return h * 60 + m;
            };

            const newStartMins = getMinutes(newStart);
            const newEndMins = getMinutes(newEnd);

            const hasOverlap = existingSlots.some(slot => {
                const existingStartMins = getMinutes(slot.start_time);
                const existingEndMins = getMinutes(slot.end_time);

                // Overlap condition: (StartA < EndB) and (EndA > StartB)
                return (newStartMins < existingEndMins) && (newEndMins > existingStartMins);
            });

            if (hasOverlap) {
                e.preventDefault();
                alert('ERROR: The time slot you selected overlaps with an existing slot on this date.\n\nPlease choose a different time.');
                return false;
            }

            return true;
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            calculateEndTime();
            const dateInput = document.getElementById('date');
            if(dateInput.value) {
                checkAvailability();
            }
            
            // Attach form validation
            const form = document.getElementById('create-slot-form');
            if (form) {
                form.addEventListener('submit', validateForm);
            }
        });

        document.getElementById('date').addEventListener('change', checkAvailability);
    </script>
</x-admin-layout>
