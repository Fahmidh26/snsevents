@extends('layouts.frontend')

@section('title', $seo->title ?? 'Our Services - SNS Events')

@section('meta')
    <meta name="description" content="{{ $seo->meta_description ?? '' }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}" />
@endsection

@section('styles')
<style>
    /* Service Card Styles */
    .service-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .service-image {
        height: 250px;
        position: relative;
        overflow: hidden;
    }
    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .service-card:hover .service-image img {
        transform: scale(1.1);
    }
    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(5px);
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .service-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .service-title {
        font-size: 1.25rem;
        margin-bottom: 10px;
        color: var(--secondary-color);
    }
    .service-price {
        color: var(--primary-color);
        font-weight: 700;
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .dropdown-wrapper {
        position: relative;
        z-index: 100;
    }
    /* Searchable Dropdown Styling */
    .custom-dropdown {
        position: relative;
        max-width: 400px;
        margin: 0 auto;
        /* z-index: 1000; - Moved to wrapper */
    }

    .dropdown-btn {
        width: 100%;
        padding: 12px 20px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 50px;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 500;
        color: #555;
    }
    .dropdown-btn:hover, .dropdown-btn.active {
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .dropdown-menu-custom {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        margin-top: 10px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        z-index: 100;
        overflow: hidden;
        border: 1px solid #eee;
    }
    .dropdown-search {
        padding: 10px;
        background: #f9f9f9;
        border-bottom: 1px solid #eee;
    }
    .dropdown-search input {
        width: 100%;
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
    }
    .dropdown-search input:focus {
        outline: none;
        border-color: var(--primary-color);
    }
    .dropdown-list {
        max-height: 250px;
        overflow-y: auto;
    }
    .dropdown-item-custom {
        padding: 10px 20px;
        cursor: pointer;
        transition: background 0.2s;
        font-size: 0.9rem;
        color: #555;
    }
    .dropdown-item-custom:hover {
        background: #f5f5f5;
        color: var(--primary-color);
    }
    .dropdown-item-custom.selected {
        background: rgba(201, 162, 39, 0.1);
        color: var(--primary-color);
        font-weight: 600;
        background-color: rgba(201, 162, 39, 0.05); /* Highlight selected */
    }
    [x-cloak] { display: none !important; }

    /* Pagination Styles */
    .pagination-custom {
        gap: 5px;
    }
    .pagination-custom .page-link {
        border: none;
        color: var(--text-dark);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .pagination-custom .page-link:hover {
        background-color: #f0f0f0;
        color: var(--primary-color);
        transform: translateY(-2px);
    }
    .pagination-custom .page-item.active .page-link {
        background: var(--primary-gradient);
        color: #fff;
        box-shadow: 0 4px 10px rgba(201, 162, 39, 0.3);
    }
    .pagination-custom .page-item.disabled .page-link {
        color: #ccc;
        background: transparent;
        cursor: not-allowed;
    }

    /* Golden View Details Button */
    .btn-view-details {
        border: 1px solid var(--primary-color); /* Gold border */
        color: var(--primary-color); /* Gold text */
        background: transparent;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-view-details:hover {
        background: var(--primary-color); /* Gold background on hover */
        color: #fff; /* White text on hover */
        box-shadow: 0 4px 15px rgba(201, 162, 39, 0.4); /* Golden glow */
        transform: translateY(-2px);
    }
    /* Service Search Input */
    .search-wrapper {
        position: relative;
    }
    .service-search-input {
        padding: 12px 20px 12px 45px;
        border-radius: 50px;
        border: 1px solid #ddd;
        font-size: 1rem;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .service-search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 4px 15px rgba(201, 162, 39, 0.15);
        outline: none;
    }
    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        pointer-events: none;
    }
</style>
@endsection

@section('content')
<!-- Filter Logic with Alpine.js -->
<div x-data="eventsList">

    <!-- Inner Page Hero -->
    <section class="inner-page-hero">
        <div class="container">
            <h1 data-aos="fade-down">Our Services</h1>
            <p data-aos="fade-up" data-aos-delay="200">Exquisite decorations for every special occasion</p>
        </div>
    </section>

    <!-- Filter & Grid Section -->
    <section class="py-5 bg-light">
        <div class="container">
            
            <!-- Search and Filter Section -->
            <div class="row mb-5 align-items-center justify-content-center g-3" data-aos="fade-up" style="position: relative; z-index: 1000;">
                
                <!-- Service Search -->
                <div class="col-md-6 col-lg-5">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" x-model="serviceSearchQuery" class="form-control service-search-input" placeholder="Search for any service...">
                    </div>
                </div>

                <!-- Category Dropdown -->
                <div class="col-md-6 col-lg-4">
                    <div class="custom-dropdown" @click.away="dropdownOpen = false">
                        <div class="dropdown-btn" @click="dropdownOpen = !dropdownOpen" :class="{ 'active': dropdownOpen }">
                            <span x-text="activeCategory"></span>
                            <i class="fas fa-chevron-down ms-2 transition-transform duration-300" :style="dropdownOpen ? 'transform: rotate(180deg)' : ''"></i>
                        </div>

                        <div class="dropdown-menu-custom" x-show="dropdownOpen" x-transition.origin.top.duration.200ms style="display: none;">
                            <div class="dropdown-search">
                                <input type="text" x-model="searchQuery" placeholder="Filter categories..." @click.stop>
                            </div>
                            
                            <div class="dropdown-list custom-scrollbar">
                                <div class="dropdown-item-custom" 
                                     @click="activeCategory = 'All Services'; dropdownOpen = false; searchQuery = ''"
                                     :class="{ 'selected': activeCategory === 'All Services' }"
                                     x-show="searchQuery === '' || 'all services'.includes(searchQuery.toLowerCase())">
                                    All Services
                                </div>
                                
                                <template x-for="category in filteredCategories" :key="category">
                                    <div class="dropdown-item-custom" 
                                         @click="activeCategory = category; dropdownOpen = false; searchQuery = ''"
                                         :class="{ 'selected': activeCategory === category }"
                                         x-text="category">
                                    </div>
                                </template>
                                
                                <div x-show="filteredCategories.length === 0 && !'all services'.includes(searchQuery.toLowerCase())" class="p-3 text-center text-muted small">
                                    No categories found
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row g-4" id="services-grid" x-cloak>
                <template x-for="(item, index) in paginatedItems" :key="item.slug">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" :data-aos-delay="index * 50">
                        <div class="service-card shadow-sm" @click="window.location.href=item.url" style="cursor: pointer;">
                            <div class="service-image">
                                <img :src="item.image" :alt="item.name">
                                <div class="category-badge" x-show="item.category" x-text="item.category"></div>
                            </div>
                            <div class="service-content">
                                <h3 class="service-title" x-text="item.name"></h3>
                                <p class="text-muted small mb-4" x-text="item.description"></p>
                                
                                <div class="service-price">
                                    <span>
                                        <span x-show="item.price">From $<span x-text="Math.round(item.price).toLocaleString()"></span></span>
                                        <span x-show="!item.price">Custom Pricing</span>
                                    </span>
                                    <span class="btn btn-sm btn-view-details rounded-pill px-3">View Details</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Pagination Controls -->
            <div class="row mt-5" x-show="totalPages > 1" x-cloak>
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-custom mb-0">
                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                <button class="page-link" @click="prevPage()" aria-label="Previous">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </li>
                            <template x-for="page in totalPages" :key="page">
                                <li class="page-item" :class="{ 'active': currentPage === page }">
                                    <button class="page-link" @click="goToPage(page)" x-text="page"></button>
                                </li>
                            </template>
                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                <button class="page-link" @click="nextPage()" aria-label="Next">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-12 text-center mt-2 text-muted small">
                    Showing <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> - <span x-text="Math.min(currentPage * itemsPerPage, filteredItems.length)"></span> of <span x-text="filteredItems.length"></span> services
                </div>
            </div>

            <!-- Empty State -->
            <div x-show="filteredItems.length === 0" class="text-center py-5" x-cloak>
                <div class="mb-3">
                    <i class="fas fa-search fa-3x text-muted opacity-25"></i>
                </div>
                <h4 class="text-muted">No services found</h4>
                <p class="text-muted mb-4">Try selecting a different category.</p>
                <button @click="activeCategory = 'All Services'" class="btn btn-outline-primary rounded-pill">View All Services</button>
            </div>
            
        </div>
    </section>

    <!-- Custom Package CTA -->
    <section class="py-5">
        <div class="container text-center">
            <div class="p-5 rounded-4 border-2 border-dashed" style="border: 2px dashed #c9a227; background-color: rgba(201, 162, 39, 0.05);">
                <h3 class="mb-3">Needs something more specific?</h3>
                <p class="text-muted mb-4">We can create a completely custom package tailored to your unique vision.</p>
                <a href="{{ route('custom-package') }}" class="btn-primary-custom">Request Custom Package</a>
            </div>
        </div>
    </section>

</div>
@endsection



@section('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventsList', () => ({
            items: {!! collect([[
                'name' => 'Coaching Session',
                'category' => 'Counseling',
                'description' => 'Book a professional counseling or coaching session to guide your personal or professional journey.',
                'image' => $counselingSettings->hero_image ? asset('storage/' . $counselingSettings->hero_image) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'slug' => 'counseling',
                'price' => null,
                'url' => route('counseling')
            ]])->concat($eventTypes->map(function($item) {
                return [
                    'name' => $item->name,
                    'category' => $item->category,
                    'description' => \Illuminate\Support\Str::limit($item->description, 100),
                    'image' => $item->featured_image ? asset($item->featured_image) : 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'slug' => $item->slug,
                    'price' => $item->pricingTiers->min('price') ?? null,
                    'url' => route('events.show', $item->slug)
                ];
            }))->toJson() !!},
            originalCategories: {!! $categories->concat(['Counseling'])->unique()->sort()->values()->toJson() !!},
            activeCategory: 'All Services',
            serviceSearchQuery: '',
            searchQuery: '', // For category dropdown
            dropdownOpen: false,
            
            // Pagination
            currentPage: 1,
            itemsPerPage: 9,

            get filteredItems() {
                let items = this.items;

                // Category Filter
                if (this.activeCategory !== 'All Services') {
                    items = items.filter(item => item.category === this.activeCategory);
                }

                // Search Filter
                if (this.serviceSearchQuery !== '') {
                    const query = this.serviceSearchQuery.toLowerCase();
                    items = items.filter(item => 
                        item.name.toLowerCase().includes(query) || 
                        item.description.toLowerCase().includes(query)
                    );
                }

                return items;
            },
            
            get filteredCategories() {
                if (this.searchQuery === '') {
                    return this.originalCategories;
                }
                return this.originalCategories.filter(cat => 
                    cat.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            },

            get paginatedItems() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.filteredItems.slice(start, end);
            },

            get totalPages() {
                return Math.ceil(this.filteredItems.length / this.itemsPerPage);
            },

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    this.scrollToTop();
                }
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.scrollToTop();
                }
            },

            goToPage(page) {
                this.currentPage = page;
                this.scrollToTop();
            },

            scrollToTop() {
                const grid = document.getElementById('services-grid');
                if(grid) {
                    grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            },

            init() {
                this.$watch('activeCategory', () => this.currentPage = 1);
                this.$watch('serviceSearchQuery', () => this.currentPage = 1);
            }
        }));

        // Re-initialize AOS effect
        Alpine.effect(() => {
            setTimeout(() => {
                if(typeof AOS !== 'undefined') AOS.refresh();
            }, 100);
        });
    });
</script>
@endsection
