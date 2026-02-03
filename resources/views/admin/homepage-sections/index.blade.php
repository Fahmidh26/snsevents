<x-admin-layout>
    <x-slot name="header">
        Manage Homepage Layout
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-serif text-xl font-bold text-secondary">
                <i class="fas fa-layer-group text-primary mr-2"></i> Homepage Sections
            </h3>
            <p class="text-gray-500 text-sm">Drag and drop to reorder. Toggle visibility.</p>
        </div>

        <ul id="sortable-sections" class="space-y-3">
            @foreach($sections as $section)
            <li class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center justify-between group hover:border-primary/50 transition-colors" data-id="{{ $section->id }}">
                <div class="flex items-center gap-4">
                    <div class="cursor-move text-gray-400 hover:text-primary p-2">
                        <i class="fas fa-grip-vertical"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-secondary">{{ $section->display_name }}</h4>
                        <p class="text-xs text-gray-400">Section ID: {{ $section->name }}</p>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <label for="toggle-{{ $section->id }}" class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" id="toggle-{{ $section->id }}" class="sr-only visibility-toggle" data-id="{{ $section->id }}" {{ $section->is_visible ? 'checked' : '' }}>
                            <div class="w-10 h-6 bg-gray-200 rounded-full shadow-inner toggle-bg transition-colors duration-300 {{ $section->is_visible ? 'bg-green-500' : '' }}"></div>
                            <div class="dot absolute w-4 h-4 bg-white rounded-full shadow -left-1 -top-1 transition transform duration-300" style="top: 0.25rem; left: 0.25rem; {{ $section->is_visible ? 'transform: translateX(100%);' : '' }}"></div>
                        </div>
                        <div class="ml-3 text-sm font-medium text-gray-700 status-label">
                            {{ $section->is_visible ? 'Visible' : 'Hidden' }}
                        </div>
                    </label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // SortableJS
            var el = document.getElementById('sortable-sections');
            var sortable = Sortable.create(el, {
                handle: '.cursor-move',
                animation: 150,
                ghostClass: 'bg-blue-50',
                onEnd: function (evt) {
                    var order = [];
                    document.querySelectorAll('#sortable-sections li').forEach(function (row) {
                        order.push(row.getAttribute('data-id'));
                    });

                    fetch("{{ route('admin.homepage-sections.update-order') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            console.log('Order updated');
                        }
                    });
                }
            });

            // Visibility Toggle
            document.querySelectorAll('.visibility-toggle').forEach(function (toggle) {
                toggle.addEventListener('change', function () {
                    var id = this.getAttribute('data-id');
                    var isVisible = this.checked;
                    var container = this.closest('label');
                    var label = container.querySelector('.status-label');
                    
                    // Optimistic UI update
                    var dot = container.querySelector('.dot');
                    var bg = container.querySelector('.toggle-bg');
                    
                    if(isVisible) {
                        bg.classList.add('bg-green-500');
                        bg.classList.remove('bg-gray-200');
                        dot.style.transform = 'translateX(100%)';
                        label.textContent = 'Visible';
                    } else {
                        bg.classList.remove('bg-green-500');
                        bg.classList.add('bg-gray-200');
                        dot.style.transform = 'translateX(0)';
                        label.textContent = 'Hidden';
                    }

                    fetch("{{ route('admin.homepage-sections.toggle-visibility') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id: id, is_visible: isVisible })
                    })
                    .then(response => response.json())
                    .then(data => {
                         console.log('Visibility updated');
                    });
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>
