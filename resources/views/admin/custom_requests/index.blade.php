<x-admin-layout>
    <x-slot name="header">
        Custom Package Requests
    </x-slot>

    <div class="mb-6">
        <p class="text-gray-600">Review and respond to custom event decoration requests.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Customer</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Event Details</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Estimates</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($requests as $req)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-secondary">{{ $req->name }}</div>
                            <div class="text-xs text-gray-500 flex flex-col gap-1">
                                <span><i class="fas fa-envelope mr-1 w-4"></i> {{ $req->email }}</span>
                                <span><i class="fas fa-phone mr-1 w-4"></i> {{ $req->phone }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-primary uppercase">{{ $req->event_type }}</div>
                            <div class="text-xs text-gray-500 flex flex-col gap-1">
                                <span><i class="fas fa-calendar mr-1 w-4"></i> {{ $req->event_date ? $req->event_date->format('M d, Y') : 'N/A' }}</span>
                                <span><i class="fas fa-map-marker-alt mr-1 w-4"></i> {{ $req->venue ?: 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs text-gray-600 space-y-1">
                                <div><span class="font-semibold text-gray-400">Guests:</span> {{ $req->guest_count ?: 'N/A' }}</div>
                                <div><span class="font-semibold text-gray-400">Budget:</span> ${{ number_format($req->budget, 2) ?: 'N/A' }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.custom-requests.update-status', $req) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded-full px-3 py-1 border-0 shadow-sm outline-none cursor-pointer
                                    {{ $req->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $req->status == 'contacted' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $req->status == 'quoted' ? 'bg-purple-100 text-purple-700' : '' }}
                                    {{ $req->status == 'converted' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="contacted" {{ $req->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="quoted" {{ $req->status == 'quoted' ? 'selected' : '' }}>Quoted</option>
                                    <option value="converted" {{ $req->status == 'converted' ? 'selected' : '' }}>Converted</option>
                                    <option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2" x-data="{ showDetails: false }">
                                <button @click="showDetails = true" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="View All Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.custom-requests.destroy', $req) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
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
                                                    <h3 class="text-xl font-serif font-bold italic tracking-wide">Custom Package Inquiry Details</h3>
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
                                                                        <p class="font-bold text-secondary">{{ $req->name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Email Address</p>
                                                                        <p class="font-bold text-secondary">{{ $req->email }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-phone"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Phone Number</p>
                                                                        <p class="font-bold text-secondary">{{ $req->phone }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Right Column: Event Info -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Event Details</h4>
                                                            <div class="space-y-3">
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-magic"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Event Type</p>
                                                                        <p class="font-bold text-secondary">{{ $req->event_type }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-calendar-alt"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Event Date</p>
                                                                        <p class="font-bold text-secondary">{{ $req->event_date ? $req->event_date->format('F d, Y') : 'Not Specified' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                                                        <i class="fas fa-map-marker-alt"></i>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-xs text-gray-500 capitalize">Venue</p>
                                                                        <p class="font-bold text-secondary">{{ $req->venue ?: 'Not Specified' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8 border-t border-gray-100 pt-8">
                                                        <!-- Logistics -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Logistics & Budget</h4>
                                                            <div class="flex gap-8">
                                                                <div>
                                                                    <p class="text-xs text-gray-500 capitalize">Guest Count</p>
                                                                    <p class="font-bold text-secondary">{{ $req->guest_count ?: 'N/A' }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-xs text-gray-500 capitalize">Budget</p>
                                                                    <p class="font-bold text-primary font-serif">${{ number_format($req->budget, 2) ?: 'N/A' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Status -->
                                                        <div>
                                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Admin Status</h4>
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                                {{ $req->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                                {{ $req->status == 'contacted' ? 'bg-blue-100 text-blue-700' : '' }}
                                                                {{ $req->status == 'quoted' ? 'bg-purple-100 text-purple-700' : '' }}
                                                                {{ $req->status == 'converted' ? 'bg-green-100 text-green-700' : '' }}
                                                                {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                                                <i class="fas fa-circle text-[8px] mr-2"></i>
                                                                {{ ucfirst($req->status) }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- What the user wrote -->
                                                    <div class="mt-8 border-t border-gray-100 pt-8">
                                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Requirements & Message</h4>
                                                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 text-gray-700 leading-relaxed italic relative">
                                                            <i class="fas fa-quote-left text-primary/20 text-4xl absolute top-4 left-4"></i>
                                                            <div class="relative z-10 pl-8">
                                                                {{ $req->requirements ?: 'The customer did not provide any specific requirements.' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="bg-gray-50 px-8 py-4 flex justify-end gap-3">
                                                    <button @click="showDetails = false" class="px-6 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-sm">
                                                        Close
                                                    </button>
                                                    <a href="mailto:{{ $req->email }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-semibold text-sm flex items-center gap-2">
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
                            No custom requests yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

