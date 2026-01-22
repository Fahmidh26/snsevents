<x-admin-layout>
    <x-slot name="header">
        General Settings
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-8">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Admin Email Address</label>
                    <p class="text-xs text-gray-500 mb-3">Inquiries and custom requests will be sent to this email.</p>
                    <input type="email" name="admin_email" value="{{ old('admin_email', $adminEmail) }}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="admin@snsevents.com">
                    @error('admin_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
