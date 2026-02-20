<x-admin-layout>
    <x-slot name="header">
        Reschedule Requests
    </x-slot>

    {{-- Pending badge --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-gray-600">Manage client requests to move their sessions.</p>
        @if($pendingCount > 0)
        <span class="bg-amber-100 text-amber-800 text-sm font-bold px-4 py-2 rounded-full">
            {{ $pendingCount }} Pending
        </span>
        @endif
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-4 mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle text-green-500"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-5 py-4 mb-6 flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-red-500"></i> {{ session('error') }}
    </div>
    @endif

    @if($requests->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center text-gray-400">
        <i class="fas fa-calendar-check text-5xl mb-4 block"></i>
        <p class="font-semibold text-lg">No reschedule requests yet</p>
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-left">Client</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-left">Type</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-left">Current Slot</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-left">Requested Slot</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-left">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-left">Submitted</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($requests as $req)
                @php
                    $booking     = $req->bookingModel;
                    $currentSlot = $booking?->slot;
                    $newSlot     = $req->requestedSlotModel;
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $booking?->name ?? '—' }}</div>
                        <div class="text-xs text-gray-400">{{ $booking?->confirmation_code ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold
                            {{ $req->booking_type === 'counseling' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $req->booking_type === 'counseling' ? 'Coaching' : 'Management' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        @if($currentSlot)
                            {{ $currentSlot->date->format('M j, Y') }}<br>
                            <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($currentSlot->start_time)->format('g:i A') }}</span>
                        @else —
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                        @if($newSlot)
                            {{ $newSlot->date->format('M j, Y') }}<br>
                            <span class="text-xs text-gray-400 font-normal">{{ \Carbon\Carbon::parse($newSlot->start_time)->format('g:i A') }}</span>
                        @else —
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusColors = [
                                'pending'  => 'bg-amber-100 text-amber-700',
                                'approved' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($req->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $req->created_at->format('M j, Y') }}<br>
                        <span class="text-xs">{{ $req->created_at->format('g:i A') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($req->status === 'pending')
                        <div class="flex items-center gap-2">
                            {{-- Approve --}}
                            <form method="POST" action="{{ route('admin.reschedule-requests.approve', $req->id) }}"
                                  onsubmit="return confirm('Approve this reschedule request?')">
                                @csrf
                                <input type="hidden" name="admin_note" value="">
                                <button type="submit"
                                    class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            {{-- Reject --}}
                            <button type="button" onclick="openRejectModal({{ $req->id }})"
                                class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        </div>
                        @else
                        <span class="text-xs text-gray-400 italic">{{ ucfirst($req->status) }}</span>
                        @if($req->admin_note)
                            <div class="text-xs text-gray-400 mt-1">Note: {{ $req->admin_note }}</div>
                        @endif
                        @endif

                        @if($req->reason)
                        <div class="text-xs text-gray-400 mt-1" title="{{ $req->reason }}">
                            <i class="fas fa-comment-alt"></i> {{ \Str::limit($req->reason, 40) }}
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- Reject Modal --}}
    <div id="reject-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4">
            <h3 class="text-lg font-bold text-gray-900 mb-4"><i class="fas fa-times-circle text-red-500 mr-2"></i>Reject Request</h3>
            <form id="reject-form" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Note to Client <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea name="admin_note" rows="3" placeholder="Reason for rejection…"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-red-400 resize-none"></textarea>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 text-sm hover:bg-gray-50 transition">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-bold hover:bg-red-700 transition">Reject Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openRejectModal(id) {
        document.getElementById('reject-form').action = `/admin/reschedule-requests/${id}/reject`;
        document.getElementById('reject-modal').classList.remove('hidden');
    }
    function closeRejectModal() {
        document.getElementById('reject-modal').classList.add('hidden');
    }
    document.getElementById('reject-modal').addEventListener('click', function(e) {
        if (e.target === this) closeRejectModal();
    });
    </script>

</x-admin-layout>
