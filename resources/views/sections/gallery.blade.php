<section id="gallery" class="gallery-section">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Our Gallery</h2>
      <p>Moments We've Captured</p>
    </div>

    <div class="gallery-filters" data-aos="fade-up" data-aos-delay="100">
      <div class="gallery-filter active" onclick="filterGallery('all')">
        All
      </div>
      @php
          $categories = $eventTypes->pluck('category')->unique()->filter()->values();
      @endphp
      @foreach($categories as $category)
      <div class="gallery-filter" onclick="filterGallery('{{ Str::slug($category) }}')">
         {{ $category }}
      </div>
      @endforeach
    </div>

    <div class="gallery-grid">
      @foreach($eventTypes as $typeIndex => $type)
         @foreach($type->galleries as $galleryIndex => $gallery)
          <div 
            class="gallery-item" 
            data-category="{{ Str::slug($type->category) }}" 
            onclick="viewGalleryImage('{{ asset($gallery->image_path) }}')"
            data-aos="zoom-in"
            data-aos-delay="{{ ($typeIndex * 50) + ($galleryIndex * 30) }}"
            data-aos-duration="500"
          >
            <img
              src="{{ asset($gallery->image_path) }}"
              alt="{{ $gallery->caption ?: $type->name }}"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
         @endforeach
      @endforeach
    </div>
  </div>
</section>
