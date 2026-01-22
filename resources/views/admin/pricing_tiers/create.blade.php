<x-admin-layout>
    <x-slot name="header">
        Add Pricing Tier
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.pricing-tiers.index') }}" class="text-gray-500 hover:text-primary flex items-center gap-2 transition-colors">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl" x-data="{ features: [''] }">
        <form action="{{ route('admin.pricing-tiers.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Event Type *</label>
                    <select name="event_type_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                        <option value="">Select Event Type</option>
                        @foreach($eventTypes as $type)
                            <option value="{{ $type->id }}" {{ old('event_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('event_type_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tier Name * (e.g. Basic, Premium)</label>
                    <input type="text" name="tier_name" value="{{ old('tier_name') }}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                    @error('tier_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2 text-gray-400">$</span>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full pl-8 pr-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tier Image</label>
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all cursor-pointer">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Short Description</label>
                    <textarea name="description" rows="2" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">{{ old('description') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Key Features (One per line)</label>
                    <div class="space-y-3">
                        <template x-for="(feature, index) in features" :key="index">
                            <div class="flex gap-2">
                                <input type="text" name="features[]" x-model="features[index]" class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Enter a feature...">
                                <button type="button" @click="if(features.length > 1) features.splice(index, 1)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </template>
                        <button type="button" @click="features.push('')" class="text-primary hover:text-accent font-semibold text-sm flex items-center gap-1">
                            <i class="fas fa-plus"></i> Add Feature
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" id="status" checked class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                    <label for="status" class="text-sm font-semibold text-gray-700">Active</label>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-primary hover:bg-accent text-white px-8 py-3 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                    <i class="fas fa-save"></i> Save Pricing Tier
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
