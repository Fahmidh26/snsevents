<x-admin-layout>
    <x-slot name="header">
        Dashboard Overview
    </x-slot>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Events -->
        <a href="{{ route('admin.event-types.index') }}" class="block bg-white rounded-xl shadow-sm p-6 border-l-4 border-primary hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Events</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">{{ $stats['total_events'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4">Event types available</p>
        </a>

        <!-- Total Inquiries -->
        <a href="{{ route('admin.inquiries.index') }}" class="block bg-white rounded-xl shadow-sm p-6 border-l-4 border-accent hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Inquiries</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">{{ $stats['total_inquiries'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center text-accent">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
            </div>
            <p class="text-xs {{ $inquiry_growth >= 0 ? 'text-green-600' : 'text-red-600' }} mt-4 font-medium flex items-center">
                <i class="fas fa-arrow-{{ $inquiry_growth >= 0 ? 'up' : 'down' }} mr-1"></i> 
                {{ abs($inquiry_growth) }}% from last month
            </p>
        </a>

        <!-- Services -->
        <a href="{{ route('admin.service-areas.index') }}" class="block bg-white rounded-xl shadow-sm p-6 border-l-4 border-secondary hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Service Areas</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">{{ $stats['total_services'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center text-secondary">
                    <i class="fas fa-concierge-bell text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4">Active locations served</p>
        </a>

        <!-- Gallery Images -->
        <a href="{{ route('admin.galleries.index') }}" class="block bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Gallery Images</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">{{ $stats['total_gallery_images'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-500">
                    <i class="fas fa-images text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4">Across all albums</p>
        </a>
    </div>

    <!-- Secondary Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Pending Inquiries -->
        <a href="{{ route('admin.inquiries.index') }}" class="block bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-sm p-6 border border-orange-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-orange-700 font-medium uppercase tracking-wider">Pending Inquiries</p>
                    <h3 class="text-2xl font-bold text-orange-900 mt-1">{{ $stats['pending_inquiries'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-orange-200 rounded-full flex items-center justify-center text-orange-700">
                    <i class="fas fa-clock text-lg"></i>
                </div>
            </div>
        </a>

        <!-- Custom Requests -->
        <a href="{{ route('admin.custom-requests.index') }}" class="block bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-sm p-6 border border-blue-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-700 font-medium uppercase tracking-wider">Custom Requests</p>
                    <h3 class="text-2xl font-bold text-blue-900 mt-1">{{ $stats['total_custom_requests'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center text-blue-700">
                    <i class="fas fa-star text-lg"></i>
                </div>
            </div>
        </a>

        <!-- Counseling Bookings -->
        <a href="{{ route('admin.counseling.bookings') }}" class="block bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-sm p-6 border border-green-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-700 font-medium uppercase tracking-wider">Counseling</p>
                    <h3 class="text-2xl font-bold text-green-900 mt-1">{{ $stats['total_counseling_bookings'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center text-green-700">
                    <i class="fas fa-user-friends text-lg"></i>
                </div>
            </div>
        </a>

        <!-- Testimonials -->
        <a href="{{ route('admin.testimonials.index') }}" class="block bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl shadow-sm p-6 border border-pink-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-pink-700 font-medium uppercase tracking-wider">Testimonials</p>
                    <h3 class="text-2xl font-bold text-pink-900 mt-1">{{ $stats['total_testimonials'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-pink-200 rounded-full flex items-center justify-center text-pink-700">
                    <i class="fas fa-quote-right text-lg"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Inquiry Status Breakdown -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-serif text-lg font-bold text-secondary mb-4 border-b pb-2 flex items-center">
                <i class="fas fa-chart-pie text-primary mr-2"></i> Inquiry Status
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Pending</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['pending_inquiries'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Contacted</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['contacted_inquiries'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Converted</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['converted_inquiries'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Rejected</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['rejected_inquiries'] }}</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t">
                <div class="text-xs text-gray-500 mb-2">Today: <span class="font-bold text-secondary">{{ $stats['new_inquiries_today'] }}</span></div>
                <div class="text-xs text-gray-500 mb-2">This Week: <span class="font-bold text-secondary">{{ $stats['new_inquiries_this_week'] }}</span></div>
                <div class="text-xs text-gray-500">This Month: <span class="font-bold text-secondary">{{ $stats['new_inquiries_this_month'] }}</span></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-serif text-lg font-bold text-secondary mb-4 border-b pb-2 flex items-center">
                <i class="fas fa-tasks text-blue-500 mr-2"></i> Custom Requests
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Pending</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['pending_custom_requests'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Processing</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['processing_custom_requests'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Completed</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['completed_custom_requests'] }}</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t">
                <div class="text-xs text-gray-500">New Today: <span class="font-bold text-secondary">{{ $stats['new_custom_requests_today'] }}</span></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-serif text-lg font-bold text-secondary mb-4 border-b pb-2 flex items-center">
                <i class="fas fa-calendar-alt text-green-500 mr-2"></i> Counseling Sessions
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Pending</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['pending_counseling'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Confirmed</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['confirmed_counseling'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                        <span class="text-sm text-gray-600">Completed</span>
                    </div>
                    <span class="text-sm font-bold text-secondary">{{ $stats['completed_counseling'] }}</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t">
                <div class="text-xs text-gray-500">Upcoming: <span class="font-bold text-secondary">{{ $stats['upcoming_counseling'] }}</span></div>
            </div>
        </div>
    </div>

    <!-- Monthly Trends Chart -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <h3 class="font-serif text-xl font-bold text-secondary mb-6 border-b pb-2 flex items-center">
            <i class="fas fa-chart-line text-primary mr-2"></i> Monthly Trends (Last 6 Months)
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Month</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Package Inquiries</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Custom Requests</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthly_trends as $trend)
                    <tr class="border-b hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4 text-sm font-medium text-secondary">{{ $trend['month'] }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-primary/10 text-primary">
                                {{ $trend['inquiries'] }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
                                {{ $trend['custom_requests'] }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-secondary/10 text-secondary">
                                {{ $trend['inquiries'] + $trend['custom_requests'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popular Event Types -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <h3 class="font-serif text-xl font-bold text-secondary mb-6 border-b pb-2 flex items-center">
            <i class="fas fa-fire text-orange-500 mr-2"></i> Most Popular Event Types
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            @forelse($popular_event_types as $eventType)
            <a href="{{ route('admin.event-types.edit', $eventType->id) }}" class="block bg-gradient-to-br from-primary/5 to-primary/10 rounded-lg p-4 border border-primary/20 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold text-secondary text-sm">{{ $eventType->name }}</h4>
                    <span class="text-xs bg-primary text-white px-2 py-1 rounded-full">{{ $eventType->package_inquiries_count }}</span>
                </div>
                <p class="text-xs text-gray-500">inquiries</p>
            </a>
            @empty
            <div class="col-span-5 text-center py-8 text-gray-400">
                <i class="fas fa-inbox text-3xl mb-2"></i>
                <p>No event types with inquiries yet</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Package Inquiries -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-serif text-xl font-bold text-secondary mb-4 border-b pb-2 flex items-center">
                <i class="fas fa-envelope-open-text text-primary mr-2"></i> Recent Package Inquiries
            </h3>
            <div class="space-y-4">
                @forelse($recent_inquiries as $inquiry)
                <div class="flex items-start border-b pb-3 last:border-b-0">
                    <div class="w-2 h-2 mt-2 rounded-full 
                        {{ $inquiry->status === 'pending' ? 'bg-yellow-500' : '' }}
                        {{ $inquiry->status === 'contacted' ? 'bg-blue-500' : '' }}
                        {{ $inquiry->status === 'completed' ? 'bg-green-500' : '' }}
                        mr-3">
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-secondary">{{ $inquiry->name }}</p>
                                <p class="text-xs text-gray-500">{{ $inquiry->email }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    <i class="fas fa-calendar-alt mr-1"></i>{{ $inquiry->event_date }}
                                </p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $inquiry->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $inquiry->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}">
                                {{ ucfirst($inquiry->status) }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">{{ $inquiry->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-inbox text-3xl mb-2"></i>
                    <p>No recent inquiries</p>
                </div>
                @endforelse
            </div>
            @if($recent_inquiries->count() > 0)
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-primary hover:text-primary/80 font-medium flex items-center justify-center">
                    View All Inquiries <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @endif
        </div>

        <!-- Recent Custom Requests -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-serif text-xl font-bold text-secondary mb-4 border-b pb-2 flex items-center">
                <i class="fas fa-star text-blue-500 mr-2"></i> Recent Custom Requests
            </h3>
            <div class="space-y-4">
                @forelse($recent_custom_requests as $request)
                <div class="flex items-start border-b pb-3 last:border-b-0">
                    <div class="w-2 h-2 mt-2 rounded-full 
                        {{ $request->status === 'pending' ? 'bg-yellow-500' : '' }}
                        {{ $request->status === 'processing' ? 'bg-blue-500' : '' }}
                        {{ $request->status === 'completed' ? 'bg-green-500' : '' }}
                        mr-3">
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-secondary">{{ $request->name }}</p>
                                <p class="text-xs text-gray-500">{{ $request->email }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    Budget: ${{ number_format($request->budget, 2) }}
                                </p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $request->status === 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $request->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">{{ $request->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-inbox text-3xl mb-2"></i>
                    <p>No recent custom requests</p>
                </div>
                @endforelse
            </div>
            @if($recent_custom_requests->count() > 0)
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('admin.custom-requests.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center justify-center">
                    View All Custom Requests <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Recent Counseling Bookings -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <h3 class="font-serif text-xl font-bold text-secondary mb-4 border-b pb-2 flex items-center">
            <i class="fas fa-user-friends text-green-500 mr-2"></i> Recent Counseling Bookings
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Name</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Email</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Date</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Time</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Booked</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_counseling as $booking)
                    <tr class="border-b hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4 text-sm font-medium text-secondary">{{ $booking->name }}</td>
                        <td class="py-3 px-4 text-sm text-gray-600">{{ $booking->email }}</td>
                        <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $booking->slot ? \Carbon\Carbon::parse($booking->slot->date)->format('M d, Y') : 'N/A' }}</td>
                        <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $booking->slot ? \Carbon\Carbon::parse($booking->slot->start_time)->format('h:i A') : 'N/A' }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $booking->status === 'confirmed' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $booking->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center text-xs text-gray-400">{{ $booking->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2"></i>
                            <p>No recent counseling bookings</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($recent_counseling->count() > 0)
        <div class="mt-4 pt-4 border-t">
            <a href="{{ route('admin.counseling.bookings') }}" class="text-sm text-green-600 hover:text-green-700 font-medium flex items-center justify-center">
                View All Counseling Bookings <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-serif text-xl font-bold text-secondary mb-4 border-b pb-2 flex items-center">
            <i class="fas fa-bolt text-primary mr-2"></i> Quick Actions
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <a href="{{ route('company-profile.edit') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-3 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-user-tie text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-primary transition-colors text-center">CEO Section</span>
            </a>
            
            <a href="{{ route('admin.service-areas.index') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-accent hover:bg-accent/5 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center text-accent mb-3 group-hover:bg-accent group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-concierge-bell text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-accent transition-colors text-center">Service Areas</span>
            </a>

            <a href="{{ route('admin.event-types.index') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-secondary hover:bg-secondary/5 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center text-secondary mb-3 group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-secondary transition-colors text-center">Event Types</span>
            </a>
            
            <a href="{{ route('admin.galleries.index') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-500 mb-3 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-images text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-purple-500 transition-colors text-center">Gallery</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-gray-500 hover:bg-gray-50 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 mb-3 group-hover:bg-gray-500 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-cog text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-gray-700 transition-colors text-center">Settings</span>
            </a>
            
            <a href="/" target="_blank" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-eye text-xl"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-green-600 transition-colors text-center">View Website</span>
            </a>
        </div>
    </div>
</x-admin-layout>