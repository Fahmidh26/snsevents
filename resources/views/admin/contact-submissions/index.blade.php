<x-admin-layout>
    <x-slot name="header">
        Contact Form Submissions
    </x-slot>

    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <p class="text-gray-500 font-medium">Manage customer inquiries and contact requests.</p>
            <div class="flex items-center gap-2 mt-1">
                <span class="w-2 h-2 rounded-full bg-primary/40 animate-pulse"></span>
                <span class="text-xs text-gray-400">Updates in real-time</span>
            </div>
        </div>
        <a href="{{ route('admin.contact-submissions.export') }}" class="group bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl transition-all duration-300 flex items-center gap-2 shadow-lg shadow-emerald-600/20 hover:shadow-emerald-600/30 hover:-translate-y-0.5">
            <i class="fas fa-file-csv text-lg group-hover:scale-110 transition-transform"></i>
            <span class="font-semibold">Export to CSV</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm animate-fade-in-down">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
                <button type="button" class="ml-auto text-emerald-500 hover:text-emerald-700 transition-colors" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <!-- Total Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex items-center gap-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[100px] -mr-16 -mt-16 group-hover:bg-primary/10 transition-colors"></div>
            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-envelope text-3xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total</p>
                <h3 class="text-4xl font-extrabold text-secondary mt-1 tracking-tight">{{ $submissions->total() }}</h3>
            </div>
        </div>

        <!-- New Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex items-center gap-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[100px] -mr-16 -mt-16 group-hover:bg-blue-100/50 transition-colors"></div>
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-star text-3xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">New</p>
                <h3 class="text-4xl font-extrabold text-secondary mt-1 tracking-tight">{{ $newCount }}</h3>
            </div>
        </div>

        <!-- Read Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex items-center gap-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[100px] -mr-16 -mt-16 group-hover:bg-emerald-100/50 transition-colors"></div>
            <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-eye text-3xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Read</p>
                <h3 class="text-4xl font-extrabold text-secondary mt-1 tracking-tight">{{ $submissions->where('status', 'read')->count() }}</h3>
            </div>
        </div>

        <!-- Replied Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex items-center gap-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-bl-[100px] -mr-16 -mt-16 group-hover:bg-purple-100/50 transition-colors"></div>
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-reply text-3xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Replied</p>
                <h3 class="text-4xl font-extrabold text-secondary mt-1 tracking-tight">{{ $submissions->where('status', 'replied')->count() }}</h3>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden mb-12">
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/30">
            <h3 class="font-bold text-secondary text-lg flex items-center gap-2">
                <i class="fas fa-list-ul text-primary"></i>
                Contact Submissions
            </h3>
            <div class="text-xs text-gray-400 font-medium">
                Showing {{ $submissions->firstItem() ?? 0 }} - {{ $submissions->lastItem() ?? 0 }} of {{ $submissions->total() }} results
            </div>
        </div>
        <div class="overflow-x-auto p-4">
            <table id="contactTable" class="w-full text-left">
                <thead>
                    <tr class="text-xs font-bold uppercase tracking-widest text-gray-400 border-b border-gray-100">
                        <th class="px-6 py-5"># ID</th>
                        <th class="px-6 py-5">Contact Info</th>
                        <th class="px-6 py-5">Event Details</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-6 py-5">Submitted</th>
                        <th class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($submissions as $submission)
                    <tr class="group hover:bg-gray-50/80 transition-all duration-200">
                        <td class="px-6 py-5 text-sm font-bold text-gray-400">
                            {{ sprintf('%04d', $submission->id) }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center text-primary border border-primary/10 group-hover:scale-105 transition-transform">
                                    <span class="font-serif font-black text-lg">{{ strtoupper(substr($submission->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <span class="block font-bold text-secondary text-base">{{ $submission->name }}</span>
                                    <span class="text-xs text-gray-400 flex items-center gap-1">
                                        <i class="fas fa-envelope text-[10px]"></i> {{ $submission->email }}
                                    </span>
                                    <span class="text-xs text-gray-400 flex items-center gap-1">
                                        <i class="fas fa-phone text-[10px]"></i> {{ $submission->phone }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="text-sm font-semibold text-secondary">{{ ucfirst($submission->event_type) }}</div>
                            @if($submission->preferred_date)
                            <div class="text-xs text-gray-400 mt-1">
                                <i class="far fa-calendar"></i> {{ $submission->preferred_date->format('M d, Y') }}
                            </div>
                            @endif
                            <div class="text-xs text-gray-500 mt-1 line-clamp-2">{{ Str::limit($submission->message, 50) }}</div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center">
                                @if($submission->status === 'new')
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 shadow-sm shadow-blue-500/5">
                                        <span class="w-1.5 h-1.5 mr-2 rounded-full bg-blue-500 animate-pulse"></span>
                                        New
                                    </span>
                                @elseif($submission->status === 'read')
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm shadow-emerald-500/5">
                                        <span class="w-1.5 h-1.5 mr-2 rounded-full bg-emerald-500"></span>
                                        Read
                                    </span>
                                @elseif($submission->status === 'replied')
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-purple-50 text-purple-700 border border-purple-100 shadow-sm shadow-purple-500/5">
                                        <span class="w-1.5 h-1.5 mr-2 rounded-full bg-purple-500"></span>
                                        Replied
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-gray-50 text-gray-700 border border-gray-100 shadow-sm shadow-gray-500/5">
                                        <span class="w-1.5 h-1.5 mr-2 rounded-full bg-gray-400"></span>
                                        Archived
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="text-sm font-semibold text-secondary">
                                {{ $submission->created_at->format('M d, Y') }}
                            </div>
                            <div class="text-[11px] font-bold text-gray-400 mt-0.5 flex items-center gap-1.5 uppercase tracking-tighter">
                                <i class="far fa-clock"></i> {{ $submission->created_at->format('h:i A') }}
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.contact-submissions.show', $submission->id) }}" 
                                   class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary hover:bg-primary hover:text-white rounded-xl transition-all duration-300 shadow-sm"
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.contact-submissions.destroy', $submission->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 shadow-sm"
                                            onclick="return confirm('Are you sure you want to delete this submission? This action cannot be undone.')"
                                            title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 text-3xl">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <p class="text-gray-400 font-medium italic">No contact submissions found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($submissions->hasPages())
        <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/20">
            {{ $submissions->links() }}
        </div>
        @endif
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        /* DataTables Premium Styling */
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 2rem;
            float: left;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 1rem;
            border: 1px solid #f3f4f6;
            padding: 0.75rem 1.25rem 0.75rem 2.5rem;
            background-color: #f9fafb;
            width: 300px;
            font-size: 0.875rem;
            transition: all 0.3s;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 0.75rem center;
            background-size: 1.1rem;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #d4af37;
            background-color: #fff;
            box-shadow: 0 10px 15px -3px rgba(212, 175, 55, 0.1);
            width: 350px;
        }
        .dataTables_wrapper .dataTables_filter label {
            font-size: 0;
        }
        table.dataTable thead th {
            border-bottom: 1px solid #f9fafb !important;
        }
        table.dataTable.no-footer {
            border-bottom: none !important;
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($('#contactTable tbody tr').length > 1 || !$('#contactTable tbody tr td').hasClass('text-center')) {
                $('#contactTable').DataTable({
                    responsive: true,
                    paging: false,
                    info: false,
                    searching: true,
                    ordering: true,
                    order: [[4, 'desc']], // Submitted date desc
                    language: {
                        search: "",
                        searchPlaceholder: "Search by name, email, or event type...",
                    },
                    columnDefs: [
                        { orderable: false, targets: [1, 2, 5] } // Disable sorting on Info and Actions
                    ]
                });
            }
        });
    </script>
    @endpush
</x-admin-layout>
