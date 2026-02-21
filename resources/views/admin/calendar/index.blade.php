@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
        <div>
            <h1 class="text-3xl font-serif text-secondary font-bold">Booking Calendar</h1>
            <p class="text-gray-500 mt-1">Overview of all Counseling and Management sessions.</p>
        </div>
        <div class="flex gap-4">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
                <span class="text-xs text-gray-600">Counseling (Confirmed)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                <span class="text-xs text-gray-600">Counseling (Pending)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                <span class="text-xs text-gray-600">Management (Confirmed)</span>
            </div>
             <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-purple-500"></span>
                <span class="text-xs text-gray-600">Management (Pending)</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Event Details Modal -->
<div id="eventModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeModal()"></div>

        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-calendar-check text-primary text-xl"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-xl leading-6 font-serif font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 flex justify-between items-center" id="modal-title">
                            Booking Details
                            <span id="modal-type-badge" class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-600 font-sans">Type</span>
                        </h3>
                        
                        <div class="mt-4 space-y-4">
                            <!-- Name -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 mt-0.5">
                                    <i class="fas fa-user text-gray-400 text-sm"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Client Name</p>
                                    <p class="text-sm font-semibold text-gray-800" id="modal-name">Name</p>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 mt-0.5">
                                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email Address</p>
                                    <a href="#" id="modal-email-link" class="text-sm text-primary hover:text-accent font-medium">email@example.com</a>
                                </div>
                            </div>
                            
                            <!-- Phone -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 mt-0.5">
                                    <i class="fas fa-phone text-gray-400 text-sm"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</p>
                                    <p class="text-sm text-gray-800" id="modal-phone">Phone</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <!-- Status -->
                                <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Status</p>
                                    <p class="text-sm font-bold capitalize text-gray-800" id="modal-status">Status</p>
                                </div>
                                
                                <!-- Amount -->
                                <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Amount Paid</p>
                                    <p class="text-sm font-bold text-green-600" id="modal-amount">$0.00</p>
                                </div>
                            </div>
                            
                            <!-- Time -->
                            <div class="bg-primary/5 rounded-lg p-3 border border-primary/20">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="far fa-clock text-primary"></i>
                                    <p class="text-xs font-medium text-primary uppercase tracking-wider">Session Time</p>
                                </div>
                                <p class="text-sm font-semibold text-gray-800" id="modal-time">Time</p>
                            </div>

                            <!-- Meet Link -->
                            <div class="mt-4" id="modal-meet-container">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Google Meet Link</p>
                                <a href="#" target="_blank" id="modal-meet-link" class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-50 text-blue-700 hover:bg-blue-100 text-sm font-medium rounded-lg border border-blue-200 transition-colors">
                                    <i class="fas fa-video mr-2"></i> Join Google Meet
                                </a>
                                <p id="modal-meet-none" class="text-sm text-gray-500 italic hidden">No link generated yet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                <button type="button" onclick="closeModal()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gray-900 text-base font-medium text-white hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                    Close Details
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
    /* FullCalendar Customizations for Premium Look */
    .fc-theme-standard .fc-scrollgrid {
        border-color: #f3f4f6;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .fc-theme-standard td, .fc-theme-standard th {
        border-color: #f3f4f6;
    }
    .fc-col-header-cell {
        background-color: #f9fafb;
        padding: 12px 0 !important;
    }
    .fc-col-header-cell-cushion {
        color: #374151;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }
    .fc-daygrid-day-number {
        color: #4b5563;
        font-weight: 500;
        padding: 8px !important;
    }
    .fc-event {
        border-radius: 4px;
        padding: 2px 4px;
        font-size: 0.75rem;
        font-weight: 500;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: transform 0.1s ease, box-shadow 0.1s ease;
    }
    .fc-event:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .fc-event-main {
        padding: 2px;
    }
    .fc-toolbar-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700 !important;
        color: #1a1a1a;
        font-size: 1.5rem !important;
    }
    .fc-button-primary {
        background-color: #d4af37 !important;
        border-color: #d4af37 !important;
        font-family: 'Poppins', sans-serif !important;
        text-transform: capitalize !important;
        font-weight: 500 !important;
    }
    .fc-button-primary:hover, .fc-button-primary:active, .fc-button-primary.fc-button-active {
        background-color: #c9a961 !important;
        border-color: #c9a961 !important;
    }
    .fc-today-button {
        background-color: #1a1a1a !important;
        border-color: #1a1a1a !important;
    }
    .fc-day-today {
        background-color: #fffbeb !important; /* light yellow bg for today */
    }
</style>
@endpush

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            height: 'auto',
            aspectRatio: 1.5,
            events: '{{ route('admin.calendar.events') }}',
            eventClick: function(info) {
                // Prevent browser navigation
                info.jsEvent.preventDefault();
                
                var props = info.event.extendedProps;
                
                // Populate Modal Data
                document.getElementById('modal-type-badge').innerText = props.type;
                document.getElementById('modal-name').innerText = props.name;
                
                var emailLink = document.getElementById('modal-email-link');
                emailLink.innerText = props.email;
                emailLink.href = 'mailto:' + props.email;
                
                document.getElementById('modal-phone').innerText = props.phone;
                
                var statusEl = document.getElementById('modal-status');
                statusEl.innerText = props.status;
                if(props.status === 'confirmed') {
                    statusEl.className = 'text-sm font-bold capitalize text-green-600';
                } else {
                    statusEl.className = 'text-sm font-bold capitalize text-amber-600';
                }

                document.getElementById('modal-amount').innerText = props.amount_paid;
                
                // Format times for display
                var startOptions = { weekday: 'short', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                var endOptions = { hour: '2-digit', minute: '2-digit' };
                var timeString = info.event.start.toLocaleDateString('en-US', startOptions);
                if(info.event.end) {
                    timeString += ' - ' + info.event.end.toLocaleTimeString('en-US', endOptions);
                }
                document.getElementById('modal-time').innerText = timeString;

                // Handle Meet Link
                var meetLinkEl = document.getElementById('modal-meet-link');
                var meetNoneEl = document.getElementById('modal-meet-none');
                
                if (props.meet_link && props.meet_link !== 'Not Generated') {
                    meetLinkEl.href = props.meet_link;
                    meetLinkEl.style.display = 'inline-flex';
                    meetNoneEl.style.display = 'none';
                } else {
                    meetLinkEl.style.display = 'none';
                    meetNoneEl.style.display = 'block';
                }

                // Show Modal
                var modal = document.getElementById('eventModal');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.querySelector('.transform').classList.remove('scale-95', 'opacity-0');
                    modal.querySelector('.transform').classList.add('scale-100', 'opacity-100');
                }, 10);
            },
            loading: function(isLoading) {
                if (isLoading) {
                    // Could add a loading spinner here
                }
            }
        });
        
        calendar.render();
    });

    function closeModal() {
        var modal = document.getElementById('eventModal');
        modal.querySelector('.transform').classList.remove('scale-100', 'opacity-100');
        modal.querySelector('.transform').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }
</script>
@endpush
