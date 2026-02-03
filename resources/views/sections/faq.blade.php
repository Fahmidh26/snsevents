<section id="faq" class="faq-section">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Frequently Asked Questions</h2>
      <p>Everything You Need to Know</p>
    </div>

    <div class="faq-container">
      @if($faqs && $faqs->count() > 0)
        @foreach($faqs as $index => $faq)
          <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>{{ $faq->question }}</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                {!! nl2br(e($faq->answer)) !!}
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="faq-item" data-aos="fade-up">
          <div class="faq-question" onclick="toggleFaq(this)">
            <h4>No FAQs available yet.</h4>
            <i class="fas fa-chevron-down faq-icon"></i>
          </div>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Please check back later for frequently asked questions.
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>
</section>
