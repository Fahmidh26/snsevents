<section id="contact" class="contact-section">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Get In Touch</h2>
      <p>Let's Plan Your Perfect Event</p>
    </div>

    <div class="contact-container">
      <div class="contact-info" data-aos="fade-right" data-aos-duration="700">
        <h3>Contact Information</h3>
        @if($contactInfo && $contactInfo->description)
          <p>{{ $contactInfo->description }}</p>
        @else
          <p>
            Ready to start planning your dream event? Get in touch with us
            today, and let's create something extraordinary together!
          </p>
        @endif

        @if($contactInfo && $contactInfo->phone)
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="contact-details">
              <h5>Phone</h5>
              <p>{{ $contactInfo->phone }}</p>
            </div>
          </div>
        @endif

        @if($contactInfo && $contactInfo->email)
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-details">
              <h5>Email</h5>
              <p>{{ $contactInfo->email }}</p>
            </div>
          </div>
        @endif

        @if($contactInfo && $contactInfo->address)
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-details">
              <h5>Address</h5>
              <p>{!! nl2br(e($contactInfo->address)) !!}</p>
            </div>
          </div>
        @endif

        @if($contactInfo && $contactInfo->office_hours)
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-clock"></i>
            </div>
            <div class="contact-details">
              <h5>Office Hours</h5>
              <p>{!! nl2br(e($contactInfo->office_hours)) !!}</p>
            </div>
          </div>
        @endif

        @if($contactInfo && $contactInfo->map_url)
          <div class="contact-map-section">
            <h5><i class="fas fa-map-marked-alt"></i> Location Map</h5>
            <div class="contact-map">
              <iframe 
                src="{{ $contactInfo->map_url }}" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>
        @endif
      </div>

      <div class="contact-form" data-aos="fade-left" data-aos-duration="700">
        <form id="contactForm" onsubmit="submitForm(event)">
          <div class="form-group">
            <label for="name">Your Name *</label>
            <input type="text" id="name" name="name" required />
          </div>

          <div class="form-group">
            <label for="email">Your Email *</label>
            <input type="email" id="email" name="email" required />
          </div>

          <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required />
          </div>

          <div class="form-group">
            <label for="event-type">Event Type *</label>
            <select id="event-type" name="event-type" required>
              <option value="">Select an event type</option>
              <option value="birthday">Birthday</option>
              <option value="holud">Holud</option>
              <option value="proposal">Marriage Proposal</option>
              <option value="reception">Reception</option>
              <option value="graduation">Graduation</option>
              <option value="anniversary">Anniversary</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label for="date">Preferred Event Date</label>
            <input type="date" id="date" name="date" />
          </div>

          <div class="form-group">
            <label for="message">Tell Us About Your Event *</label>
            <textarea
              id="message"
              name="message"
              rows="5"
              required
            ></textarea>
          </div>

          <button type="submit" class="btn-submit">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>
