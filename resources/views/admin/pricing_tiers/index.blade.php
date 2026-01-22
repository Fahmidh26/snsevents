<x-admin-layout>
    <x-slot name="header">
        Pricing Tiers
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-gray-600">Manage pricing packages for each event type.</p>
        <a href="{{ route('admin.pricing-tiers.create') }}" class="bg-primary hover:bg-accent text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Pricing Tier
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Event Type</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Tier Name</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Price</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pricingTiers as $tier)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-medium">{{ $tier->eventType->name }}</span>
                    </td>
                    <td class="px-6 py-4 font-medium text-secondary">
                        {{ $tier->tier_name }}
                    </td>
                    <td class="px-6 py-4 text-primary font-bold">
                        ${{ number_format($tier->price, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        @if($tier->status)
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.pricing-tiers.edit', $tier) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pricing-tiers.destroy', $tier) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this pricing tier?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        No pricing tiers found. <a href="{{ route('admin.pricing-tiers.create') }}" class="text-primary hover:underline">Add your first one!</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
