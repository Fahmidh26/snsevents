<x-admin-layout>
    <x-slot name="header">
        Package Inquiries
    </x-slot>

    <div class="mb-6">
        <p class="text-gray-600">Review and manage inquiries for specific pricing packages.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Customer</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Requested Package</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Event Date</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($inquiries as $inquiry)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-secondary">{{ $inquiry->name }}</div>
                            <div class="text-xs text-gray-500 flex flex-col gap-1">
                                <span><i class="fas fa-envelope mr-1 w-4"></i> {{ $inquiry->email }}</span>
                                <span><i class="fas fa-phone mr-1 w-4"></i> {{ $inquiry->phone }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-primary">{{ $inquiry->pricingTier->tier_name }}</div>
                            <div class="text-xs text-gray-500">{{ $inquiry->pricingTier->eventType->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $inquiry->event_date ? $inquiry->event_date->format('M d, Y') : 'Not specified' }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.inquiries.update-status', $inquiry) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded-full px-3 py-1 border-0 shadow-sm outline-none cursor-pointer
                                    {{ $inquiry->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $inquiry->status == 'contacted' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $inquiry->status == 'converted' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $inquiry->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    <option value="pending" {{ $inquiry->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="converted" {{ $inquiry->status == 'converted' ? 'selected' : '' }}>Converted</option>
                                    <option value="rejected" {{ $inquiry->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2" x-data="{ showDetails: false }">
                                <button @click="showDetails = true" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="View All Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Inquiry">
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
                                                    <h3 class="text-xl font-serif font-bold italic tracking-wide">Package Inquiry Details</h3>
                                                    <button @click="showDetails = false" class="text-white hover:text-gray-200 transition-colors">
                                                        <i class="fas fa-times text-xl"></i>
                                                    </button>
                                                </div>
                                                
                                                <div class="p-8">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                                        <!-- Left Column: Customer Info -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Customer Information</h4>
                                                            <div class="space-y-3">
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-user"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Full Name</p>
                                                                        <p class="font-bold text-secondary">{{ $inquiry->name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Email Address</p>
                                                                        <p class="font-bold text-secondary">{{ $inquiry->email }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-phone"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Phone Number</p>
                                                                        <p class="font-bold text-secondary">{{ $inquiry->phone }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Right Column: Package Info -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Package Details</h4>
                                                            <div class="space-y-3">
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-box"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Selected Package</p>
                                                                        <p class="font-bold text-secondary">{{ $inquiry->pricingTier->tier_name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-calendar-day"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Service Name</p>
                                                                        <p class="font-bold text-secondary">{{ $inquiry->pricingTier->eventType->name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-calendar-alt"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Event Date</p>
                                                                        <p class="font-bold text-secondary">{{ $inquiry->event_date ? $inquiry->event_date->format('F d, Y') : 'Not Specified' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-8 border-t border-gray-100 pt-8">
                                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Inquiry Message</h4>
                                                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 text-gray-700 leading-relaxed italic relative">
                                                            <i class="fas fa-quote-left text-primary/20 text-4xl absolute top-4 left-4"></i>
                                                            <div class="relative z-10 pl-8">
                                                                {{ $inquiry->message ?: 'The customer did not provide a specific message.' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="bg-gray-50 px-8 py-4 flex justify-end gap-3">
                                                    <button @click="showDetails = false" class="px-6 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-sm">
                                                        Close
                                                    </button>
                                                    <a href="mailto:{{ $inquiry->email }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-semibold text-sm flex items-center gap-2">
                                                        <i class="fas fa-reply"></i> Reply via Email
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
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 mt-10">
                             <i class="fas fa-inbox text-4xl mb-4 block opacity-20"></i>
                            No package inquiries yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

