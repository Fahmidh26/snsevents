<x-admin-layout>
    <x-slot name="header">
        Contact Information Settings
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-primary">
            <div class="p-8 text-secondary">
                
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm flex items-center" role="alert">
                        <i class="fas fa-check-circle mr-2 text-xl"></i>
                        <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact-info.update') }}" class="space-y-6">
                    @csrf
                    
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="font-serif text-xl font-bold text-secondary mb-4 flex items-center">
                            <i class="fas fa-address-book text-primary mr-3"></i> 
                            Contact Details
                        </h3>
                        
                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Description</label>
                            <textarea name="description" id="description" rows="3" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">{{ old('description', $contactInfo->description) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Brief introduction text shown above contact information.</p>
                        </div>

                        <!-- Phone -->
                        <div class="mb-6">
                            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $contactInfo->phone) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50"
                                placeholder="+1 (555) 123-4567">
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $contactInfo->email) }}" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50"
                                placeholder="info@snsevents.com">
                        </div>

                        <!-- Address -->
                        <div class="mb-6">
                            <label for="address" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Address</label>
                            <textarea name="address" id="address" rows="3" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">{{ old('address', $contactInfo->address) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">You can use line breaks for multi-line addresses.</p>
                        </div>

                        <!-- Office Hours -->
                        <div class="mb-6">
                            <label for="office_hours" class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-wider">Office Hours</label>
                            <textarea name="office_hours" id="office_hours" rows="3" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50 focus:ring-opacity-50">{{ old('office_hours', $contactInfo->office_hours) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">e.g., Mon - Fri: 9:00 AM - 6:00 PM<br />Sat: 10:00 AM - 4:00 PM</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end border-t border-gray-200 pt-6">
                        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary uppercase tracking-widest text-sm">
                            Update Contact Information
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

