<x-admin-layout>
    <x-slot name="header">
        Contact Submission Details
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.contact-submissions.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span class="font-medium">Back to All Submissions</span>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-secondary flex items-center gap-2">
                        <i class="fas fa-user-circle text-primary"></i>
                        Contact Information
                    </h3>
                    <span class="text-xs text-gray-400 font-medium">ID: #{{ sprintf('%04d', $submission->id) }}</span>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Full Name</p>
                            <p class="text-base font-bold text-secondary">{{ $submission->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Email Address</p>
                            <a href="mailto:{{ $submission->email }}" class="text-base font-bold text-primary hover:underline">{{ $submission->email }}</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                            <i class="fas fa-phone text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Phone Number</p>
                            <a href="tel:{{ $submission->phone }}" class="text-base font-bold text-primary hover:underline">{{ $submission->phone }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Details Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-secondary flex items-center gap-2 mb-6">
                    <i class="fas fa-calendar-star text-primary"></i>
                    Event Details
                </h3>

                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                            <i class="fas fa-tag text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Event Type</p>
                            <p class="text-base font-bold text-secondary">{{ ucfirst($submission->event_type) }}</p>
                        </div>
                    </div>

                    @if($submission->preferred_date)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                            <i class="fas fa-calendar-day text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Preferred Event Date</p>
                            <p class="text-base font-bold text-secondary">{{ $submission->preferred_date->format('F d, Y') }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="p-4 bg-gray-50 rounded-2xl">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Message</p>
                        <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $submission->message }}</p>
                    </div>
                </div>
            </div>

            <!-- Admin Notes Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-secondary flex items-center gap-2 mb-6">
                    <i class="fas fa-sticky-note text-primary"></i>
                    Admin Notes
                </h3>

                <form action="{{ route('admin.contact-submissions.update-notes', $submission->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="admin_notes" rows="6" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Add internal notes about this submission...">{{ $submission->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-primary/20 hover:shadow-primary/30 hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>
                        Save Notes
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-lg font-bold text-secondary mb-6">Submission Status</h3>
                
                <form action="{{ route('admin.contact-submissions.update-status', $submission->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Current Status</label>
                            <select name="status" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                <option value="new" {{ $submission->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="read" {{ $submission->status === 'read' ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ $submission->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                <option value="archived" {{ $submission->status === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-primary/20 hover:shadow-primary/30 hover:-translate-y-0.5">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

            <!-- Timeline Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-lg font-bold text-secondary mb-6">Timeline</h3>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <i class="fas fa-paper-plane text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-secondary">Submitted</p>
                            <p class="text-xs text-gray-400">{{ $submission->created_at->format('M d, Y h:i A') }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $submission->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    @if($submission->read_at)
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
                            <i class="fas fa-eye text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-secondary">First Viewed</p>
                            <p class="text-xs text-gray-400">{{ $submission->read_at->format('M d, Y h:i A') }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $submission->read_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endif

                    @if($submission->updated_at != $submission->created_at)
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-600 flex-shrink-0">
                            <i class="fas fa-edit text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-secondary">Last Updated</p>
                            <p class="text-xs text-gray-400">{{ $submission->updated_at->format('M d, Y h:i A') }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $submission->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-lg font-bold text-secondary mb-6">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="mailto:{{ $submission->email }}" class="w-full flex items-center justify-center gap-2 bg-primary/10 text-primary hover:bg-primary hover:text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                        <i class="fas fa-reply"></i>
                        Reply via Email
                    </a>
                    
                    <a href="tel:{{ $submission->phone }}" class="w-full flex items-center justify-center gap-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                        <i class="fas fa-phone"></i>
                        Call Now
                    </a>
                    
                    <form action="{{ route('admin.contact-submissions.destroy', $submission->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this submission? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                            <i class="fas fa-trash-alt"></i>
                            Delete Submission
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out;
        }
    </style>
    @endpush
</x-admin-layout>
