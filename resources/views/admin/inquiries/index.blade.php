<x-admin-layout>
    <x-slot name="header">
        Package Inquiries
    </x-slot>

    <div class="mb-6">
        <p class="text-gray-600">Review and manage inquiries for specific pricing packages.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
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
                            <span><i class="fas fa-envelope mr-1"></i> {{ $inquiry->email }}</span>
                            <span><i class="fas fa-phone mr-1"></i> {{ $inquiry->phone }}</span>
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
                            <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded-full px-2 py-1 border-0 shadow-sm outline-none 
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
                        <div class="flex justify-end gap-2" x-data="{ showMsg: false }">
                            <button @click="showMsg = !showMsg" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors" title="View Message">
                                <i class="fas fa-comment-alt"></i>
                            </button>
                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            
                            <!-- Message Modal Placeholder / Inline -->
                            <template x-if="showMsg">
                                <div class="fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
                                    <div class="bg-white rounded-xl max-w-lg w-full p-6 shadow-2xl" @click.away="showMsg = false">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="font-serif text-xl font-bold">Inquiry Message</h3>
                                            <button @click="showMsg = false"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="text-left text-gray-700 bg-gray-50 p-4 rounded-lg italic">
                                            {{ $inquiry->message ?: 'No message provided.' }}
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
                        No package inquiries yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
