<x-admin-layout>
    <x-slot name="header">
        Custom Package Requests
    </x-slot>

    <div class="mb-6">
        <p class="text-gray-600">Review and respond to custom event decoration requests.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
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
                            <span><i class="fas fa-envelope mr-1"></i> {{ $req->email }}</span>
                            <span><i class="fas fa-phone mr-1"></i> {{ $req->phone }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-primary uppercase">{{ $req->event_type }}</div>
                        <div class="text-xs text-gray-500 flex flex-col gap-1">
                            <span><i class="fas fa-calendar mr-1"></i> {{ $req->event_date ? $req->event_date->format('M d, Y') : 'N/A' }}</span>
                            <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $req->venue ?: 'N/A' }}</span>
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
                            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded-full px-2 py-1 border-0 shadow-sm outline-none 
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
                        <div class="flex justify-end gap-2" x-data="{ showReqs: false }">
                            <button @click="showReqs = !showReqs" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors" title="View Requirements">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <form action="{{ route('admin.custom-requests.destroy', $req) }}" method="POST" onsubmit="return confirm('Delete this request?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            
                            <!-- Requirements Modal -->
                            <template x-if="showReqs">
                                <div class="fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
                                    <div class="bg-white rounded-xl max-w-lg w-full p-6 shadow-2xl" @click.away="showReqs = false">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="font-serif text-xl font-bold">Special Requirements</h3>
                                            <button @click="showReqs = false"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="text-left text-gray-700 bg-gray-50 p-4 rounded-lg italic">
                                            {{ $req->requirements ?: 'No special requirements listed.' }}
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        No custom requests yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
