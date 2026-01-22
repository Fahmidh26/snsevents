<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SNS Events - Premium Event Planning</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
      :root {
        --primary-color: #d4af37;
        --secondary-color: #1a1a1a;
        --accent-color: #c9a961;
        --light-bg: #f8f9fa;
        --text-dark: #2c3e50;
        --text-light: #6c757d;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Poppins", sans-serif;
        color: var(--text-dark);
        overflow-x: hidden;
      }

      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        font-family: "Playfair Display", serif;
      }

      /* Navbar */
      .navbar {
        background: rgba(26, 26, 26, 0.95);
        backdrop-filter: blur(10px);
        padding: 1rem 0;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
      }

      .navbar-brand {
        font-family: "Playfair Display", serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color) !important;
        text-transform: uppercase;
        letter-spacing: 2px;
      }

      .navbar-nav .nav-link {
        color: #fff !important;
        margin: 0 15px;
        font-weight: 500;
        position: relative;
        transition: color 0.3s ease;
      }

      .navbar-nav .nav-link:hover {
        color: var(--primary-color) !important;
      }

      .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-color);
        transition: width 0.3s ease;
      }

      .navbar-nav .nav-link:hover::after {
        width: 100%;
      }

      /* Hero Section */
      .hero-section {
        height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
          url("https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
      }

      .hero-content h1 {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInDown 1s ease;
      }

      .hero-content p {
        font-size: 1.5rem;
        margin-bottom: 30px;
        animation: fadeInUp 1s ease 0.3s backwards;
      }

      .hero-content .btn-primary-custom {
        background: var(--primary-color);
        color: #fff;
        padding: 15px 40px;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        animation: fadeInUp 1s ease 0.6s backwards;
      }

      .hero-content .btn-primary-custom:hover {
        background: var(--accent-color);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
      }

      /* Floating particles */
      .hero-section::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(
          circle,
          rgba(212, 175, 55, 0.1) 1px,
          transparent 1px
        );
        background-size: 50px 50px;
        animation: float 20s infinite linear;
      }

      @keyframes float {
        0% {
          transform: translateY(0);
        }
        100% {
          transform: translateY(-50px);
        }
      }

      @keyframes fadeInDown {
        from {
          opacity: 0;
          transform: translateY(-30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* Section Titles */
      .section-title {
        text-align: center;
        margin-bottom: 60px;
      }

      .section-title h2 {
        font-size: 3rem;
        font-weight: 700;
        color: var(--secondary-color);
        position: relative;
        display: inline-block;
        padding-bottom: 20px;
      }

      .section-title h2::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(
          to right,
          transparent,
          var(--primary-color),
          transparent
        );
      }

      .section-title p {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-top: 15px;
      }

      /* About Section */
      .about-section {
        padding: 100px 0;
        background: var(--light-bg);
      }

      .about-content {
        display: flex;
        align-items: center;
        gap: 50px;
      }

      .about-image {
        flex: 1;
        position: relative;
      }

      .about-image img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      }

      .about-text {
        flex: 1;
      }

      .about-text h3 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--secondary-color);
      }

      .about-text p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-light);
        margin-bottom: 15px;
      }

      .stats-container {
        display: flex;
        gap: 30px;
        margin-top: 30px;
      }

      .stat-box {
        flex: 1;
        text-align: center;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      }

      .stat-box h4 {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 10px;
      }

      .stat-box p {
        font-size: 0.9rem;
        color: var(--text-light);
        margin: 0;
      }

      /* Services Section */
      .services-section {
        padding: 100px 0;
      }

      .service-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        cursor: pointer;
      }

      .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 60px rgba(0, 0, 0, 0.15);
      }

      .service-image {
        height: 250px;
        overflow: hidden;
        position: relative;
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

      .service-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7));
        display: flex;
        align-items: flex-end;
        padding: 20px;
      }

      .service-overlay h3 {
        color: #fff;
        font-size: 1.8rem;
        margin: 0;
      }

      .service-content {
        padding: 30px;
      }

      .service-content p {
        color: var(--text-light);
        margin-bottom: 20px;
      }

      .service-features {
        list-style: none;
        padding: 0;
      }

      .service-features li {
        padding: 8px 0;
        color: var(--text-light);
      }

      .service-features li i {
        color: var(--primary-color);
        margin-right: 10px;
      }

      /* Pricing Section */
      .pricing-section {
        padding: 100px 0;
        background: var(--light-bg);
      }

      .pricing-tabs {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 50px;
        flex-wrap: wrap;
      }

      .pricing-tab {
        padding: 12px 30px;
        background: #fff;
        border: 2px solid var(--primary-color);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        color: var(--secondary-color);
      }

      .pricing-tab:hover,
      .pricing-tab.active {
        background: var(--primary-color);
        color: #fff;
      }

      .pricing-content {
        display: none;
      }

      .pricing-content.active {
        display: block;
        animation: fadeIn 0.5s ease;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .pricing-card {
        background: #fff;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
      }

      .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 60px rgba(0, 0, 0, 0.15);
      }

      .pricing-card.featured {
        border: 3px solid var(--primary-color);
        position: relative;
      }

      .pricing-badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary-color);
        color: #fff;
        padding: 5px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
      }

      .pricing-card h3 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: var(--secondary-color);
      }

      .pricing-price {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 10px;
      }

      .pricing-price span {
        font-size: 1.2rem;
        color: var(--text-light);
      }

      .pricing-features {
        list-style: none;
        padding: 0;
        margin: 30px 0;
        text-align: left;
      }

      .pricing-features li {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        color: var(--text-light);
      }

      .pricing-features li i {
        color: var(--primary-color);
        margin-right: 10px;
      }

      .pricing-features li.disabled {
        text-decoration: line-through;
        opacity: 0.5;
      }

      .btn-pricing {
        background: var(--primary-color);
        color: #fff;
        padding: 12px 40px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        margin-top: 20px;
      }

      .btn-pricing:hover {
        background: var(--accent-color);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
      }

      /* Gallery Section */
      .gallery-section {
        padding: 100px 0;
      }

      .gallery-filters {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 50px;
        flex-wrap: wrap;
      }

      .gallery-filter {
        padding: 10px 25px;
        background: #fff;
        border: 2px solid var(--primary-color);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        color: var(--secondary-color);
      }

      .gallery-filter:hover,
      .gallery-filter.active {
        background: var(--primary-color);
        color: #fff;
      }

      .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
      }

      .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        height: 300px;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
      }

      .gallery-item:hover img {
        transform: scale(1.1);
      }

      .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(212, 175, 55, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
      }

      .gallery-item:hover .gallery-overlay {
        opacity: 1;
      }

      .gallery-overlay i {
        font-size: 3rem;
        color: #fff;
      }

      /* Lightbox */
      .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 9999;
        justify-content: center;
        align-items: center;
      }

      .lightbox.active {
        display: flex;
      }

      .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
      }

      .lightbox-close {
        position: absolute;
        top: 30px;
        right: 30px;
        font-size: 3rem;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .lightbox-close:hover {
        color: var(--primary-color);
      }

      /* Testimonials Section */
      .testimonials-section {
        padding: 100px 0;
        background: var(--light-bg);
      }

      .testimonial-slider {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
      }

      .testimonial-card {
        background: #fff;
        padding: 50px;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        text-align: center;
      }

      .testimonial-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 30px;
        border: 5px solid var(--primary-color);
        overflow: hidden;
      }

      .testimonial-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .testimonial-text {
        font-size: 1.2rem;
        font-style: italic;
        color: var(--text-light);
        margin-bottom: 30px;
        line-height: 1.8;
      }

      .testimonial-author {
        font-weight: 600;
        color: var(--secondary-color);
        font-size: 1.1rem;
      }

      .testimonial-role {
        color: var(--primary-color);
        font-size: 0.9rem;
      }

      .testimonial-rating {
        color: var(--primary-color);
        margin-top: 15px;
      }

      .slider-controls {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
      }

      .slider-btn {
        background: var(--primary-color);
        color: #fff;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .slider-btn:hover {
        background: var(--accent-color);
        transform: scale(1.1);
      }

      /* FAQ Section */
      .faq-section {
        padding: 100px 0;
      }

      .faq-container {
        max-width: 900px;
        margin: 0 auto;
      }

      .faq-item {
        background: #fff;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
      }

      .faq-question {
        padding: 25px 30px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        background: #fff;
      }

      .faq-question:hover {
        background: var(--light-bg);
      }

      .faq-question h4 {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin: 0;
        flex: 1;
      }

      .faq-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        transition: transform 0.3s ease;
      }

      .faq-item.active .faq-icon {
        transform: rotate(180deg);
      }

      .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
      }

      .faq-answer-content {
        padding: 0 30px 25px;
        color: var(--text-light);
        line-height: 1.8;
      }

      /* Contact Section */
      .contact-section {
        padding: 100px 0;
        background: var(--light-bg);
      }

      .contact-container {
        display: flex;
        gap: 50px;
        align-items: stretch;
      }

      .contact-info {
        flex: 1;
      }

      .contact-info h3 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--secondary-color);
      }

      .contact-info p {
        color: var(--text-light);
        margin-bottom: 30px;
        line-height: 1.8;
      }

      .contact-item {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
      }

      .contact-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.5rem;
      }

      .contact-details h5 {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin-bottom: 5px;
      }

      .contact-details p {
        margin: 0;
        color: var(--text-light);
      }

      .contact-form {
        flex: 1;
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      }

      .form-group {
        margin-bottom: 25px;
      }

      .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--secondary-color);
        font-weight: 600;
      }

      .form-group input,
      .form-group textarea,
      .form-group select {
        width: 100%;
        padding: 15px;
        border: 2px solid #eee;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
      }

      .form-group input:focus,
      .form-group textarea:focus,
      .form-group select:focus {
        outline: none;
        border-color: var(--primary-color);
      }

      .form-group textarea {
        resize: vertical;
        min-height: 120px;
      }

      .btn-submit {
        background: var(--primary-color);
        color: #fff;
        padding: 15px 50px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
      }

      .btn-submit:hover {
        background: var(--accent-color);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
      }

      /* Footer */
      .footer {
        background: var(--secondary-color);
        color: #fff;
        padding: 60px 0 20px;
      }

      .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
      }

      .footer-section h3 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: var(--primary-color);
      }

      .footer-section p {
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.8;
      }

      .footer-section ul {
        list-style: none;
        padding: 0;
      }

      .footer-section ul li {
        margin-bottom: 12px;
      }

      .footer-section ul li a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: color 0.3s ease;
      }

      .footer-section ul li a:hover {
        color: var(--primary-color);
      }

      .social-links {
        display: flex;
        gap: 15px;
        margin-top: 20px;
      }

      .social-link {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transition: all 0.3s ease;
      }

      .social-link:hover {
        background: var(--primary-color);
        transform: translateY(-3px);
      }

      .footer-bottom {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.7);
      }

      /* Scroll to top button */
      .scroll-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 999;
      }

      .scroll-top.active {
        opacity: 1;
        visibility: visible;
      }

      .scroll-top:hover {
        background: var(--accent-color);
        transform: translateY(-5px);
      }

      /* Service Detail Modal */
      .service-detail-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10000;
        overflow-y: auto;
      }

      .service-detail-modal.active {
        display: block;
      }

      .service-detail-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 10001;
      }

      .service-detail-content {
        position: relative;
        max-width: 1200px;
        margin: 50px auto;
        background: #fff;
        border-radius: 20px;
        z-index: 10002;
        animation: slideDown 0.4s ease;
      }

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-50px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .service-detail-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10003;
      }

      .service-detail-close:hover {
        background: var(--accent-color);
        transform: rotate(90deg);
      }

      .service-detail-body {
        padding: 50px;
      }

      .service-detail-header {
        text-align: center;
        margin-bottom: 50px;
      }

      .service-detail-header h2 {
        font-size: 3rem;
        color: var(--secondary-color);
        margin-bottom: 15px;
      }

      .service-detail-header p {
        font-size: 1.2rem;
        color: var(--text-light);
      }

      .service-detail-banner {
        width: 100%;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 50px;
      }

      .service-detail-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .service-description {
        margin-bottom: 50px;
      }

      .service-description h3 {
        font-size: 2rem;
        color: var(--secondary-color);
        margin-bottom: 20px;
      }

      .service-description p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-light);
        margin-bottom: 15px;
      }

      .service-highlights {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin: 40px 0;
      }

      .highlight-box {
        background: var(--light-bg);
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s ease;
      }

      .highlight-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      }

      .highlight-box i {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 15px;
      }

      .highlight-box h4 {
        font-size: 1.3rem;
        color: var(--secondary-color);
        margin-bottom: 10px;
      }

      .highlight-box p {
        font-size: 0.95rem;
        color: var(--text-light);
        margin: 0;
      }

      .package-comparison {
        margin-top: 60px;
      }

      .package-comparison h3 {
        font-size: 2.5rem;
        color: var(--secondary-color);
        text-align: center;
        margin-bottom: 40px;
      }

      .package-table {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      }

      .package-table table {
        width: 100%;
        border-collapse: collapse;
      }

      .package-table thead {
        background: var(--secondary-color);
      }

      .package-table th {
        padding: 25px 20px;
        color: #fff;
        font-size: 1.3rem;
        font-weight: 600;
        text-align: center;
      }

      .package-table th:first-child {
        text-align: left;
      }

      .package-table td {
        padding: 20px;
        border-bottom: 1px solid #eee;
        text-align: center;
        color: var(--text-light);
      }

      .package-table td:first-child {
        text-align: left;
        font-weight: 600;
        color: var(--secondary-color);
      }

      .package-table tbody tr:hover {
        background: var(--light-bg);
      }

      .package-table .check-icon {
        color: var(--primary-color);
        font-size: 1.5rem;
      }

      .package-table .cross-icon {
        color: #ccc;
        font-size: 1.5rem;
      }

      .package-price-row td {
        background: var(--light-bg);
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        padding: 30px 20px;
      }

      .package-price-row td:first-child {
        color: var(--secondary-color);
        font-size: 1.2rem;
      }

      .featured-package {
        background: linear-gradient(
          135deg,
          rgba(212, 175, 55, 0.1),
          rgba(212, 175, 55, 0.05)
        );
      }

      .detail-cta {
        text-align: center;
        margin-top: 50px;
        padding: 40px;
        background: var(--light-bg);
        border-radius: 15px;
      }

      .detail-cta h3 {
        font-size: 2rem;
        color: var(--secondary-color);
        margin-bottom: 20px;
      }

      .detail-cta p {
        font-size: 1.1rem;
        color: var(--text-light);
        margin-bottom: 30px;
      }

      /* Responsive */
      @media (max-width: 768px) {
        .hero-content h1 {
          font-size: 2.5rem;
        }

        .hero-content p {
          font-size: 1.2rem;
        }

        .about-content {
          flex-direction: column;
        }

        .stats-container {
          flex-direction: column;
        }

        .contact-container {
          flex-direction: column;
        }

        .section-title h2 {
          font-size: 2rem;
        }

        .pricing-tabs {
          flex-direction: column;
          align-items: center;
        }

        .gallery-grid {
          grid-template-columns: 1fr;
        }

        .service-detail-body {
          padding: 30px 20px;
        }

        .service-detail-header h2 {
          font-size: 2rem;
        }

        .package-table {
          overflow-x: auto;
        }

        .package-table th,
        .package-table td {
          padding: 15px 10px;
          font-size: 0.9rem;
        }
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          @if(isset($companyProfile) && $companyProfile->logo_path)
              <img src="{{ asset('storage/' . $companyProfile->logo_path) }}" alt="SNS Events" style="height: 50px;">
          @else
              SNS Events
          @endif
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('events.index') }}">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('custom-package') }}">Custom Package</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#testimonials">Testimonials</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    @if(isset($heroSlides) && $heroSlides->count() > 0)
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach($heroSlides as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="height: 100vh; background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ Str::startsWith($slide->background_image_path, 'http') ? $slide->background_image_path : ($slide->background_image_path ? asset('storage/' . $slide->background_image_path) : 'https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') }}'); background-size: cover; background-position: center;">
                     <div class="d-flex align-items-center justify-content-center h-100">
                          <div class="hero-content text-center text-white">
                                <h1 data-aos="fade-down">{{ $slide->heading }}</h1>
                                <p data-aos="fade-up" data-aos-delay="200">{{ $slide->subheading }}</p>
                                <button class="btn-primary-custom" data-aos="fade-up" data-aos-delay="400" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">
                                    {{ $slide->button_text }}
                                </button>
                          </div>
                     </div>
                </div>
                @endforeach
            </div>
            @if($heroSlides->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            @endif
        </div>
    @else
        <section id="home" class="hero-section">
          <div class="hero-content">
            <h1 data-aos="fade-down">Creating Unforgettable Moments</h1>
            <p data-aos="fade-up" data-aos-delay="200">Where Dreams Meet Reality</p>
            <button
              class="btn-primary-custom"
              data-aos="fade-up"
              data-aos-delay="400"
              onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})"
            >
              Plan Your Event
            </button>
          </div>
        </section>
    @endif

    <!-- About Section -->
    <!-- About Section -->
    <section id="about" class="about-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>{{ $aboutUs->title ?? 'About Us' }}</h2>
          <p>{{ $aboutUs->subtitle ?? 'Crafting Perfect Celebrations Since 2010 — Based in Texas' }}</p>
        </div>
        <div class="about-content">
          <div class="about-image" data-aos="fade-right">
            @if(isset($aboutUs) && $aboutUs->image_path)
                <img src="{{ asset('storage/' . $aboutUs->image_path) }}" alt="{{ $aboutUs->title }}">
            @else
                <img
                  src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="About Us"
                />
            @endif
          </div>
          <div class="about-text" data-aos="fade-left">
            <h3>{{ $aboutUs->main_heading ?? 'Your Vision, Our Expertise' }}</h3>
            
            @if(isset($aboutUs) && $aboutUs->description)
                @foreach(explode("\n", $aboutUs->description) as $paragraph)
                    @if(trim($paragraph))
                        <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                    @endif
                @endforeach
            @else
                <p>
                  At SNS Events, based in Texas, we believe every celebration is
                  unique and deserves to be treated as such. With over a decade of
                  experience in creating magical moments, we've mastered the art of
                  turning dreams into reality.
                </p>
                <p>
                  Our team of dedicated professionals works tirelessly to ensure
                  every detail is perfect, from the initial concept to the final
                  execution. We pride ourselves on our creativity, attention to
                  detail, and unwavering commitment to excellence.
                </p>
            @endif

            @if(isset($companyProfile) && $companyProfile->team_description)
                <h4 style="color: var(--secondary-color); margin-top: 20px;">Our Team</h4>
                <p>{{ $companyProfile->team_description }}</p>
            @endif

            <div class="stats-container">
              <div class="stat-box" data-aos="zoom-in" data-aos-delay="100">
                <h4>{{ $aboutUs->events_count ?? '500+' }}</h4>
                <p>{{ $aboutUs->events_label ?? 'Events Planned' }}</p>
              </div>
              <div class="stat-box" data-aos="zoom-in" data-aos-delay="200">
                <h4>{{ $aboutUs->clients_count ?? '450+' }}</h4>
                <p>{{ $aboutUs->clients_label ?? 'Happy Clients' }}</p>
              </div>
              <div class="stat-box" data-aos="zoom-in" data-aos-delay="300">
                <h4>{{ $aboutUs->experience_years ?? '10+' }}</h4>
                <p>{{ $aboutUs->experience_label ?? 'Years Experience' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CEO & Vision Section -->
    @if(isset($companyProfile) && ($companyProfile->ceo_name || $companyProfile->mission || $companyProfile->vision))
    <section id="ceo" class="about-section" style="background-color: #fff; position: relative;">
      <!-- Decorative Element -->
      <div style="position: absolute; top: 0; right: 0; width: 300px; height: 300px; background: radial-gradient(circle, rgba(212, 175, 55, 0.1) 0%, rgba(255,255,255,0) 70%); z-index: 0;"></div>

      <div class="container" style="position: relative; z-index: 1;">
        <div class="section-title" data-aos="fade-up">
          <h2>{{ $companyProfile->ceo_section_title ?? 'Leadership & Vision' }}</h2>
          <p>{{ $companyProfile->ceo_section_subtitle ?? 'The Driving Force Behind SNS Events' }}</p>
        </div>
        
        <div class="row align-items-center">
            <!-- CEO Image -->
             <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                <div style="position: relative; padding: 20px;">
                    <div style="position: absolute; top: 0; left: 0; width: 100px; height: 100px; border-top: 5px solid var(--primary-color); border-left: 5px solid var(--primary-color);"></div>
                    <div style="position: absolute; bottom: 0; right: 0; width: 100px; height: 100px; border-bottom: 5px solid var(--primary-color); border-right: 5px solid var(--primary-color);"></div>
                    <img 
                        src="{{ $companyProfile->ceo_image_path ? asset('storage/' . $companyProfile->ceo_image_path) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                        alt="CEO"
                        class="img-fluid"
                        style="width: 100%; box-shadow: 0 20px 50px rgba(0,0,0,0.1); filter: grayscale(20%); transition: all 0.5s ease;"
                        onmouseover="this.style.filter='grayscale(0%)'; this.style.transform='scale(1.02)'"
                        onmouseout="this.style.filter='grayscale(20%)'; this.style.transform='scale(1)'"
                    >
                </div>
             </div>

             <!-- CEO Content -->
             <div class="col-lg-7 ps-lg-5" data-aos="fade-left">
                @if($companyProfile->ceo_name)
                    <div class="mb-4">
                        <h5 style="color: var(--primary-color); letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem; font-weight: 600; margin-bottom: 10px;">Meet the CEO</h5>
                        <h3 style="font-size: 2.5rem; font-family: 'Playfair Display', serif; color: var(--secondary-color);">{{ $companyProfile->ceo_name }}</h3>
                    </div>
                @endif

                <div style="background: var(--light-bg); padding: 30px; border-left: 4px solid var(--primary-color); border-radius: 0 10px 10px 0; margin-bottom: 30px;">
                    @if($companyProfile->ceo_bio)
                        <p style="font-style: italic; font-size: 1.1rem; color: #555; margin-bottom: 15px;">"{{ $companyProfile->ceo_bio }}"</p>
                    @endif
                    
                    @if($companyProfile->ceo_why_business)
                         <p style="font-size: 0.95rem; color: #777; margin-bottom: 0;"><strong>Why I started:</strong> {{ $companyProfile->ceo_why_business }}</p>
                    @endif
                </div>

                @if($companyProfile->ceo_background)
                    <div class="mb-5">
                         <h5 style="font-size: 1.1rem; color: var(--secondary-color); font-weight: 600; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-briefcase" style="color: var(--primary-color);"></i> Professional Background
                         </h5>
                        <p style="color: var(--text-light); line-height: 1.7;">{{ $companyProfile->ceo_background }}</p>
                    </div>
                @endif
                
                <div class="row g-4">
                    @if($companyProfile->mission)
                    <div class="col-md-6">
                        <div style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; transition: transform 0.3s ease; border-top: 3px solid var(--secondary-color);" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                            <div style="width: 50px; height: 50px; background: rgba(26, 26, 26, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; color: var(--secondary-color);">
                                <i class="fas fa-bullseye text-xl"></i>
                            </div>
                            <h4 style="font-size: 1.2rem; margin-bottom: 10px;">Our Mission</h4>
                            <p style="font-size: 0.9rem; color: #666; margin: 0;">{{ $companyProfile->mission }}</p>
                        </div>
                    </div>
                    @endif

                    @if($companyProfile->vision)
                    <div class="col-md-6">
                        <div style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); height: 100%; transition: transform 0.3s ease; border-top: 3px solid var(--primary-color);" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                             <div style="width: 50px; height: 50px; background: rgba(212, 175, 55, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; color: var(--primary-color);">
                                <i class="fas fa-eye text-xl"></i>
                            </div>
                            <h4 style="font-size: 1.2rem; margin-bottom: 10px;">Our Vision</h4>
                             <p style="font-size: 0.9rem; color: #666; margin: 0;">{{ $companyProfile->vision }}</p>
                        </div>
                    </div>
                    @endif
                </div>
             </div>
        </div>
      </div>
    </section>
    @endif

    <!-- Services Section -->
    <section id="services" class="services-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Our Services</h2>
          <p>Comprehensive Event Planning Solutions</p>
        </div>

        <div class="row">
          @foreach($eventTypes as $type)
          <div
            class="col-md-6 col-lg-4 mb-4"
            data-aos="fade-up"
            data-aos-delay="{{ $loop->index * 100 }}"
          >
            <div class="service-card h-100" onclick="showServiceDetail('{{ $type->slug }}')">
              <div class="service-image">
                <img
                  src="{{ $type->featured_image ? asset($type->featured_image) : 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                  alt="{{ $type->name }}"
                />
                <div class="service-overlay">
                  <h3>{{ $type->name }}</h3>
                </div>
              </div>
              <div class="service-content">
                <p>
                  {{ Str::limit(strip_tags($type->description), 100) }}
                </p>
                <ul class="service-features">
                  @if($type->pricingTiers->isNotEmpty() && !empty($type->pricingTiers->first()->features))
                    @foreach(array_slice($type->pricingTiers->first()->features, 0, 4) as $feature)
                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                    @endforeach
                  @else
                    <li><i class="fas fa-check"></i> Custom Planning</li>
                    <li><i class="fas fa-check"></i> Venue Selection</li>
                    <li><i class="fas fa-check"></i> Decoration</li>
                    <li><i class="fas fa-check"></i> Coordination</li>
                  @endif
                </ul>
                <button class="btn-pricing mt-3">View Details</button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </section>

    <!-- Service Detail Modal -->
    <div class="service-detail-modal" id="serviceDetailModal">
      <div class="service-detail-overlay" onclick="closeServiceDetail()"></div>
      <div class="service-detail-content">
        <button class="service-detail-close" onclick="closeServiceDetail()">
          <i class="fas fa-times"></i>
        </button>
        <div class="service-detail-body" id="serviceDetailBody">
          <!-- Content will be dynamically loaded here -->
        </div>
      </div>
    </div>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Our Packages</h2>
          <p>Choose the Perfect Package for Your Event</p>
        </div>

        <div class="pricing-tabs" data-aos="fade-up" data-aos-delay="100">
          @foreach($eventTypes as $type)
          <div class="pricing-tab {{ $loop->first ? 'active' : '' }}" onclick="showPricing('{{ $type->slug }}')">
             {{ $type->name }}
          </div>
           @endforeach
        </div>

        @foreach($eventTypes as $type)
        <!-- {{ $type->name }} Packages -->
        <div class="pricing-content {{ $loop->first ? 'active' : '' }}" id="{{ $type->slug }}-pricing">
          <div class="row">
            @forelse($type->pricingTiers as $tier)
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
              <div class="pricing-card {{ $loop->index == 1 ? 'featured' : '' }}">
                @if($loop->index == 1)
                <span class="pricing-badge">Most Popular</span>
                @endif
                <h3>{{ $tier->tier_name }}</h3>
                <div class="pricing-price">${{ number_format($tier->price, 0) }}<span>/event</span></div>
                <ul class="pricing-features">
                  @foreach($tier->features as $feature)
                  <li><i class="fas fa-check"></i> {{ $feature }}</li>
                  @endforeach
                </ul>
                <button class="btn-pricing" onclick="window.location.href='{{ route('events.show', $type->slug) }}'">Choose Plan</button>
              </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No packages defined for this event type yet.</p>
            </div>
            @endforelse
          </div>
        </div>
        @endforeach
      </div>
    </section>

    <!-- Gallery Section -->
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
          @foreach($eventTypes as $type)
          <div class="gallery-filter" onclick="filterGallery('{{ $type->slug }}')">
             {{ $type->name }}
          </div>
          @endforeach
        </div>

        <div class="gallery-grid" data-aos="fade-up" data-aos-delay="200">
          @foreach($eventTypes as $type)
             @foreach($type->galleries as $gallery)
              <div class="gallery-item" data-category="{{ $type->slug }}" onclick="viewGalleryImage('{{ asset($gallery->image_path) }}')">
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



    <!-- Gallery Section -->


    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
      <span class="lightbox-close">&times;</span>
      <img src="" alt="Gallery Image" id="lightbox-img" />
    </div>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>What Our Clients Say</h2>
          <p>Real Stories from Real People</p>
        </div>

        <div class="testimonial-slider" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-card" id="testimonial-1">
            <div class="testimonial-image">
              <img
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                alt="Client"
              />
            </div>
            <div class="testimonial-text">
              "SNS Events made our daughter's birthday absolutely magical! From
              the decoration to the entertainment, every detail was perfect. Our
              guests are still talking about it!"
            </div>
            <div class="testimonial-author">Sarah Johnson</div>
            <div class="testimonial-role">Birthday Party Client</div>
            <div class="testimonial-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
          </div>

          <div
            class="testimonial-card"
            id="testimonial-2"
            style="display: none"
          >
            <div class="testimonial-image">
              <img
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                alt="Client"
              />
            </div>
            <div class="testimonial-text">
              "They organized our Holud ceremony with such authenticity and
              grace. The traditional elements were beautifully incorporated, and
              our families were thoroughly impressed. Highly recommend!"
            </div>
            <div class="testimonial-author">Arif Rahman</div>
            <div class="testimonial-role">Holud Ceremony Client</div>
            <div class="testimonial-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
          </div>

          <div
            class="testimonial-card"
            id="testimonial-3"
            style="display: none"
          >
            <div class="testimonial-image">
              <img
                src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                alt="Client"
              />
            </div>
            <div class="testimonial-text">
              "My proposal was a dream come true, thanks to SNS Events! They
              created such a romantic atmosphere, and everything went exactly as
              planned. She said yes!"
            </div>
            <div class="testimonial-author">Michael Chen</div>
            <div class="testimonial-role">Marriage Proposal Client</div>
            <div class="testimonial-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
          </div>

          <div
            class="testimonial-card"
            id="testimonial-4"
            style="display: none"
          >
            <div class="testimonial-image">
              <img
                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                alt="Client"
              />
            </div>
            <div class="testimonial-text">
              "Our wedding reception was absolutely stunning! The team handled
              everything with such professionalism, and we could actually enjoy
              our special day without worrying about a thing."
            </div>
            <div class="testimonial-author">David & Emily Thompson</div>
            <div class="testimonial-role">Reception Clients</div>
            <div class="testimonial-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
          </div>
        </div>

        <div class="slider-controls">
          <button class="slider-btn" onclick="changeTestimonial(-1)">
            <i class="fas fa-chevron-left"></i>
          </button>
          <button class="slider-btn" onclick="changeTestimonial(1)">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Frequently Asked Questions</h2>
          <p>Everything You Need to Know</p>
        </div>

        <div class="faq-container">
          <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>How far in advance should I book your services?</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                We recommend booking at least 3-6 months in advance for major
                events like weddings and receptions. For smaller events, 1-2
                months should be sufficient. However, we always try our best to
                accommodate last-minute bookings based on availability.
              </div>
            </div>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>Do you provide customized packages?</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Absolutely! While we offer three standard packages (Basic,
                Premium, and Pro), we understand that every event is unique.
                We're happy to create a customized package tailored to your
                specific needs, preferences, and budget.
              </div>
            </div>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>What is included in your catering services?</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Our catering services vary by package but generally include
                appetizers, main courses, desserts, and beverages. We offer
                multiple menu options including vegetarian, vegan, and special
                dietary requirements. Our Premium and Pro packages include live
                cooking stations and premium beverage selections.
              </div>
            </div>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>Can I visit your office for a consultation?</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Yes! We encourage in-person consultations where we can discuss
                your vision in detail, show you our portfolio, and answer all
                your questions. Please book an appointment in advance to ensure
                one of our event planners is available to meet with you.
              </div>
            </div>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>What is your cancellation policy?</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Cancellations made 30+ days before the event receive a full
                refund minus a 10% processing fee. Cancellations made 15-30 days
                before receive a 50% refund. Cancellations made less than 15
                days before the event are non-refundable. We recommend event
                insurance for added protection.
              </div>
            </div>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>Do you handle venue selection and booking?</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Yes! We have partnerships with various venues and can help you
                find the perfect location for your event. We'll handle all venue
                communications, contract negotiations, and booking procedures.
                If you already have a venue, we're happy to work with your
                choice.
              </div>
            </div>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="700">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>
                What makes your services different from other event planners?
              </h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Our attention to detail, personalized approach, and 10+ years of
                experience set us apart. We don't just plan events; we create
                experiences. Our team is dedicated to understanding your vision
                and bringing it to life, ensuring every moment is memorable.
                Plus, we offer 24/7 support leading up to your event.
              </div>
            </div>
          </div>

          <div class="faq-item" data-aos="fade-up" data-aos-delay="800">
            <div class="faq-question" onclick="toggleFaq(this)">
              <h4>Do you provide services outside your local area?</h4>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Yes! While we're based locally, we've successfully planned and
                executed events in various cities and even internationally.
                Travel and accommodation costs for our team would be added to
                the package price for out-of-area events.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Get In Touch</h2>
          <p>Let's Plan Your Perfect Event</p>
        </div>

        <div class="contact-container">
          <div class="contact-info" data-aos="fade-right">
            <h3>Contact Information</h3>
            <p>
              Ready to start planning your dream event? Get in touch with us
              today, and let's create something extraordinary together!
            </p>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-phone"></i>
              </div>
              <div class="contact-details">
                <h5>Phone</h5>
                <p>+1 (555) 123-4567</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="contact-details">
                <h5>Email</h5>
                <p>info@snsevents.com</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="contact-details">
                <h5>Address</h5>
                <p>123 Event Street, Suite 456<br />Austin, TX 78701</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="contact-details">
                <h5>Office Hours</h5>
                <p>Mon - Fri: 9:00 AM - 6:00 PM<br />Sat: 10:00 AM - 4:00 PM</p>
              </div>
            </div>
          </div>

          <div class="contact-form" data-aos="fade-left">
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

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-section">
            <h3>SNS Events</h3>
            <p>
              Creating unforgettable moments since 2010. Based in Texas, we
              transform your vision into reality with meticulous planning and
              flawless execution.
            </p>
            <div class="social-links">
              <a href="#" class="social-link"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="#" class="social-link"
                ><i class="fab fa-instagram"></i
              ></a>
              <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
              <a href="#" class="social-link"
                ><i class="fab fa-pinterest"></i
              ></a>
              <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
            </div>
          </div>

          <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="#home">Home</a></li>
              <li><a href="#about">About Us</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#pricing">Packages</a></li>
              <li><a href="#gallery">Gallery</a></li>
            </ul>
          </div>

          <div class="footer-section">
            <h3>Services</h3>
            <ul>
              <li><a href="#services">Birthdays</a></li>
              <li><a href="#services">Holud Ceremonies</a></li>
              <li><a href="#services">Marriage Proposals</a></li>
              <li><a href="#services">Receptions</a></li>
              <li><a href="#services">Graduations</a></li>
              <li><a href="#services">Anniversaries</a></li>
            </ul>
          </div>

          <div class="footer-section">
            <h3>Newsletter</h3>
            <p>
              Subscribe to our newsletter for event planning tips and exclusive
              offers!
            </p>
            <form style="margin-top: 20px">
              <input
                type="email"
                placeholder="Your email"
                style="
                  width: 100%;
                  padding: 12px;
                  border: none;
                  border-radius: 5px;
                  margin-bottom: 10px;
                "
              />
              <button type="submit" class="btn-submit" style="width: 100%">
                Subscribe
              </button>
            </form>
          </div>
        </div>

        <div class="footer-bottom">
          <p>
            &copy; 2025 SNS Events. All rights reserved. |
            <a href="#" style="color: inherit">Privacy Policy</a> |
            <a href="#" style="color: inherit">Terms of Service</a>
          </p>
        </div>
      </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop" onclick="scrollToTop()">
      <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
      // Initialize AOS
      AOS.init({
        duration: 1000,
        once: true,
        offset: 100,
      });

      // Navbar scroll effect
      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        const scrollTop = document.getElementById("scrollTop");

        if (window.scrollY > 100) {
          navbar.style.background = "rgba(26, 26, 26, 0.98)";
          scrollTop.classList.add("active");
        } else {
          navbar.style.background = "rgba(26, 26, 26, 0.95)";
          scrollTop.classList.remove("active");
        }
      });

      // Smooth scroll for navigation links
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          if (target) {
            target.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      // Pricing tabs
      function showPricing(category) {
        // Hide all pricing content
        document.querySelectorAll(".pricing-content").forEach((content) => {
          content.classList.remove("active");
        });

        // Remove active class from all tabs
        document.querySelectorAll(".pricing-tab").forEach((tab) => {
          tab.classList.remove("active");
        });

        // Show selected pricing content
        document.getElementById(category + "-pricing").classList.add("active");

        // Add active class to clicked tab
        event.target.classList.add("active");
      }

      // Gallery filter
      function filterGallery(category) {
        const items = document.querySelectorAll(".gallery-item");
        const filters = document.querySelectorAll(".gallery-filter");

        // Remove active class from all filters
        filters.forEach((filter) => filter.classList.remove("active"));

        // Add active class to clicked filter
        event.target.classList.add("active");

        // Show/hide gallery items
        items.forEach((item) => {
          if (category === "all" || item.dataset.category === category) {
            item.style.display = "block";
            setTimeout(() => {
              item.style.opacity = "1";
              item.style.transform = "scale(1)";
            }, 10);
          } else {
            item.style.opacity = "0";
            item.style.transform = "scale(0.8)";
            setTimeout(() => {
              item.style.display = "none";
            }, 300);
          }
        });
      }

      // Lightbox functionality
      document.querySelectorAll(".gallery-item").forEach((item) => {
        item.addEventListener("click", function () {
          const imgSrc = this.querySelector("img").src;
          const lightbox = document.getElementById("lightbox");
          const lightboxImg = document.getElementById("lightbox-img");

          lightboxImg.src = imgSrc;
          lightbox.classList.add("active");
        });
      });

      function viewGalleryImage(src) {
        const lightbox = document.getElementById("lightbox");
        const lightboxImg = document.getElementById("lightbox-img");
        lightboxImg.src = src;
        lightbox.classList.add("active");
        document.body.style.overflow = "hidden";
      }

      function closeLightbox() {
        document.getElementById("lightbox").classList.remove("active");
        document.body.style.overflow = "auto";
      }

      // Testimonial slider
      let currentTestimonial = 1;
      const totalTestimonials = 4;

      function changeTestimonial(direction) {
        // Hide current testimonial
        document.getElementById(
          "testimonial-" + currentTestimonial
        ).style.display = "none";

        // Calculate new testimonial
        currentTestimonial += direction;

        // Loop around
        if (currentTestimonial > totalTestimonials) {
          currentTestimonial = 1;
        } else if (currentTestimonial < 1) {
          currentTestimonial = totalTestimonials;
        }

        // Show new testimonial
        document.getElementById(
          "testimonial-" + currentTestimonial
        ).style.display = "block";
      }

      // Auto-advance testimonials
      setInterval(() => {
        changeTestimonial(1);
      }, 6000);

      // FAQ toggle
      function toggleFaq(element) {
        const faqItem = element.parentElement;
        const answer = faqItem.querySelector(".faq-answer");
        const answerContent = answer.querySelector(".faq-answer-content");

        // Close all other FAQs
        document.querySelectorAll(".faq-item").forEach((item) => {
          if (item !== faqItem && item.classList.contains("active")) {
            item.classList.remove("active");
            item.querySelector(".faq-answer").style.maxHeight = "0";
          }
        });

        // Toggle current FAQ
        faqItem.classList.toggle("active");

        if (faqItem.classList.contains("active")) {
          answer.style.maxHeight = answerContent.offsetHeight + "px";
        } else {
          answer.style.maxHeight = "0";
        }
      }

      // Form submission
      function submitForm(e) {
        e.preventDefault();

        // Get form data
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);

        // Show success message
        alert(
          "Thank you for contacting us! We will get back to you within 24 hours."
        );

        // Reset form
        e.target.reset();

        // In a real application, you would send this data to your server
        console.log("Form submitted:", data);
      }

      // Scroll to top function
      function scrollToTop() {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      }

      // Dynamic Service Details
      @php
        $details = $eventTypes->mapWithKeys(function($type) {
            return [$type->slug => [
                'title' => $type->name,
                'subtitle' => 'Premium Event Services',
                'image' => $type->featured_image ? asset($type->featured_image) : 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'description' => $type->description,
                'tiers' => $type->pricingTiers
            ]];
        });
      @endphp
      const serviceDetails = @json($details);

      function showServiceDetail(serviceType) {
        const modal = document.getElementById("serviceDetailModal");
        const body = document.getElementById("serviceDetailBody");
        const service = serviceDetails[serviceType];

        if (!service) return;

        let tiersHTML = '<div class="row">';
        if (service.tiers && service.tiers.length > 0) {
            service.tiers.forEach(tier => {
                 tiersHTML += `
                 <div class="col-md-4 mb-3">
                    <div class="pricing-card h-100" style="padding: 20px; text-align: left;">
                        <h4 style="color: var(--primary-color)">${tier.tier_name}</h4>
                        <div class="pricing-price" style="font-size: 1.5rem; margin: 10px 0;">$${tier.price}</div>
                        <ul class="pricing-features" style="padding-left: 0; list-style: none;">
                            ${tier.features.map(f => `<li><i class="fas fa-check" style="color: var(--secondary-color); margin-right: 8px;"></i> ${f}</li>`).join('')}
                        </ul>
                    </div>
                 </div>
                 `;
            });
        } else {
            tiersHTML += '<div class="col-12"><p>Contact us for custom pricing.</p></div>';
        }
        tiersHTML += '</div>';

        body.innerHTML = `
            <div class="service-detail-header">
                <h2>${service.title}</h2>
                <p>${service.subtitle}</p>
            </div>
            <div class="service-detail-banner">
                <img src="${service.image}" alt="${service.title}">
            </div>
            <div class="service-description">
                <h3>About This Service</h3>
                ${service.description}
            </div>
            <div class="package-comparison">
                 <h3>Available Packages</h3>
                 ${tiersHTML}
            </div>
            <div class="detail-cta">
                <h3>Ready to Plan?</h3>
                <button class="btn-primary-custom" onclick="window.location.href='/events/${serviceType}'">View Full Details</button>
            </div>
        `;

        modal.classList.add("active");
        document.body.style.overflow = "hidden";
      }

      function showPricing(category) {
        const tabs = document.querySelectorAll('.pricing-tab');
        tabs.forEach(tab => {
            if(tab.getAttribute('onclick').includes(`('${category}')`)) {
                tab.classList.add('active');
            } else {
                tab.classList.remove('active');
            }
        });

        document.querySelectorAll('.pricing-content').forEach(content => {
            content.classList.remove('active');
            if (content.id === `${category}-pricing`) {
                content.classList.add('active');
            }
        });
      }

      function filterGallery(category) {
        const filters = document.querySelectorAll('.gallery-filter');
        filters.forEach(filter => {
             if(filter.getAttribute('onclick').includes(`('${category}')`)) {
                filter.classList.add('active');
            } else {
                filter.classList.remove('active');
            }
        });

        const items = document.querySelectorAll('.gallery-item');
        items.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        if(typeof AOS !== 'undefined') {
            AOS.refresh();
        }
      }


      function closeServiceDetail() {
        const modal = document.getElementById("serviceDetailModal");
        modal.classList.remove("active");
        document.body.style.overflow = "auto";
      }

      // Close modal on escape key
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          closeServiceDetail();
        }
      });

      // Counter animation for stats
      function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);

        const counter = setInterval(() => {
          start += increment;
          if (start >= target) {
            element.textContent = target + "+";
            clearInterval(counter);
          } else {
            element.textContent = Math.floor(start) + "+";
          }
        }, 16);
      }

      // Trigger counter animation when in viewport
      const observerOptions = {
        threshold: 0.5,
        rootMargin: "0px",
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (
            entry.isIntersecting &&
            !entry.target.classList.contains("counted")
          ) {
            entry.target.classList.add("counted");
            const target = parseInt(entry.target.textContent);
            animateCounter(entry.target, target);
          }
        });
      }, observerOptions);

      document.querySelectorAll(".stat-box h4").forEach((stat) => {
        observer.observe(stat);
      });
    </script>
  </body>
</html>