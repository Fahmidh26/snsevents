<x-admin-layout>
    <x-slot name="header">
        Dashboard Overview
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-primary hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Events</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">124</h3>
                </div>
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4">Lifetime events managed</p>
        </div>

         <!-- Stat Card 2 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-accent hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">New Inquiries</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">8</h3>
                </div>
                <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center text-accent">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-green-600 mt-4 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 12% from last month
            </p>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-secondary hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Services</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">6</h3>
                </div>
                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center text-secondary">
                    <i class="fas fa-concierge-bell text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4">Active service packages</p>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-gray-400 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Gallery Images</p>
                    <h3 class="text-3xl font-bold text-secondary mt-1">48</h3>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-500">
                    <i class="fas fa-images text-xl"></i>
                </div>
            </div>
             <p class="text-xs text-gray-400 mt-4">Across all albums</p>
        </div>
    </div>

    <!-- Quick Actions / Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-serif text-xl font-bold text-secondary mb-4 border-b pb-2 flex items-center">
                <i class="fas fa-bolt text-primary mr-2"></i> Quick Actions
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('company-profile.edit') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-3 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-building text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold text-gray-600 group-hover:text-primary transition-colors">Company Info</span>
                </a>
                
                 <button class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                    <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center text-accent mb-3 group-hover:bg-accent group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-plus text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold text-gray-600 group-hover:text-accent transition-colors">Add New Service</span>
                </button>

                 <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                    <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center text-secondary mb-3 group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-user-cog text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold text-gray-600 group-hover:text-secondary transition-colors">My Profile</span>
                </a>
                
                <a href="/" target="_blank" class="flex flex-col items-center justify-center p-6 border border-gray-200 rounded-lg hover:border-primary hover:bg-primary/5 transition-all group cursor-pointer shadow-sm hover:shadow-md">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold text-gray-600 group-hover:text-green-600 transition-colors">View Website</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-serif text-xl font-bold text-secondary mb-4 border-b pb-2 flex items-center">
                <i class="fas fa-history text-gray-400 mr-2"></i> Recent Activity
            </h3>
            <div class="space-y-4">
               <div class="flex items-start">
                   <div class="w-2 h-2 mt-2 rounded-full bg-green-500 mr-3"></div>
                   <div>
                       <p class="text-sm font-medium text-secondary">New inquiry received</p>
                       <p class="text-xs text-gray-400">2 hours ago</p>
                   </div>
               </div>
               <div class="flex items-start">
                   <div class="w-2 h-2 mt-2 rounded-full bg-primary mr-3"></div>
                   <div>
                       <p class="text-sm font-medium text-secondary">Updated Gallery "Summer Weddings"</p>
                       <p class="text-xs text-gray-400">Yesterday at 4:30 PM</p>
                   </div>
               </div>
               <div class="flex items-start">
                   <div class="w-2 h-2 mt-2 rounded-full bg-blue-500 mr-3"></div>
                   <div>
                       <p class="text-sm font-medium text-secondary">Company Profile updated</p>
                       <p class="text-xs text-gray-400">2 days ago</p>
                   </div>
               </div>
            </div>
        </div>
    </div>
</x-admin-layout>