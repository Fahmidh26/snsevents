<x-admin-layout>
    <x-slot name="header">
        Create New Management Slot
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                <div class="mb-6">
                    <a href="{{ route('admin.management-session.slots') }}" class="text-gray-500 hover:text-primary transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Slots
                    </a>
                </div>

                <p class="text-gray-600 mb-6">Create a new available time slot for management sessions.</p>

                <form id="create-slot-form" action="{{ route('admin.management-session.slots.store') }}" method="POST">
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
                        <!-- Duration -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Session Duration</label>
                            
                            <!-- Actual submitted value -->
                            <input type="hidden" name="duration" id="duration" value="{{ old('duration', 60) }}">
                            
                            <!-- UI Selector -->
                            <select id="duration_select" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" onchange="handleDurationChange()">
                                <option value="30">30 minutes</option>
                                <option value="45">45 minutes</option>
                                <option value="60">60 minutes</option>
                                <option value="75">75 minutes</option>
                                <option value="90">90 minutes</option>
                                <option value="custom">Custom Duration...</option>
                            </select>
                            
                            <!-- Custom Input -->
                            <div id="custom_duration_container" class="mt-2 hidden">
                                <label class="text-xs text-gray-500 mb-1 block">Enter duration in minutes:</label>
                                <div class="relative">
                                    <input type="number" id="custom_duration_input" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 pr-12" placeholder="e.g. 120" oninput="updateCustomDuration()">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">min</span>
                                    </div>
                                </div>
                            </div>

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
                        <a href="{{ route('admin.management-session.slots') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-full transition">
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
        function toggleRecurring() {
            const checkbox = document.getElementById('create_recurring');
            const options = document.getElementById('recurring_options');
            if (checkbox.checked) {
                options.classList.remove('hidden');
            } else {
                options.classList.add('hidden');
            }
        }

        function handleDurationChange() {
            const select = document.getElementById('duration_select');
            const customContainer = document.getElementById('custom_duration_container');
            const hiddenInput = document.getElementById('duration');
            const customInput = document.getElementById('custom_duration_input');
            
            if (select.value === 'custom') {
                customContainer.classList.remove('hidden');
                hiddenInput.value = customInput.value || ''; 
            } else {
                customContainer.classList.add('hidden');
                hiddenInput.value = select.value;
            }
            calculateEndTime();
        }

        function updateCustomDuration() {
            const hiddenInput = document.getElementById('duration');
            const customInput = document.getElementById('custom_duration_input');
            hiddenInput.value = customInput.value;
            calculateEndTime();
        }

        function initDuration() {
            const hiddenInput = document.getElementById('duration');
            const select = document.getElementById('duration_select');
            const customInput = document.getElementById('custom_duration_input');
            
            const standardValues = ['30', '45', '60', '75', '90'];
            
            if (standardValues.includes(hiddenInput.value)) {
                select.value = hiddenInput.value;
            } else {
                select.value = 'custom';
                customInput.value = hiddenInput.value;
                document.getElementById('custom_duration_container').classList.remove('hidden');
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

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            initDuration();
            calculateEndTime();
        });
    </script>
</x-admin-layout>
