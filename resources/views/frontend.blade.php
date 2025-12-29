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
              <a class="nav-link" href="#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pricing">Packages</a>
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

    <!-- About Section -->
    <section id="about" class="about-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>About Us</h2>
          <p>Crafting Perfect Celebrations Since 2010 — Based in Texas</p>
        </div>
        <div class="about-content">
          <div class="about-image" data-aos="fade-right">
            <img
              src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="About Us"
            />
          </div>
          <div class="about-text" data-aos="fade-left">
            @if(isset($companyProfile))
                <h3>About the CEO</h3>
                
                @if($companyProfile->ceo_name)
                    <h4 style="color: var(--primary-color); margin-bottom: 10px;">{{ $companyProfile->ceo_name }}</h4>
                @endif

                @if($companyProfile->ceo_bio)
                    <p><strong>Bio:</strong> {{ $companyProfile->ceo_bio }}</p>
                @endif

                @if($companyProfile->ceo_background)
                    <p><strong>Background:</strong> {{ $companyProfile->ceo_background }}</p>
                @endif

                @if($companyProfile->ceo_why_business)
                    <p><strong>Why in this business:</strong> {{ $companyProfile->ceo_why_business }}</p>
                @endif
                
                <hr style="margin: 30px 0; border-color: var(--primary-color);">

                @if($companyProfile->mission)
                    <h4 style="color: var(--secondary-color);">Our Mission</h4>
                    <p>{{ $companyProfile->mission }}</p>
                @endif

                @if($companyProfile->vision)
                    <h4 style="color: var(--secondary-color);">Our Vision</h4>
                    <p>{{ $companyProfile->vision }}</p>
                @endif

                @if($companyProfile->team_description)
                     <h4 style="color: var(--secondary-color);">Our Team</h4>
                    <p>{{ $companyProfile->team_description }}</p>
                @endif

            @else
                <h3>Your Vision, Our Expertise</h3>
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

            <div class="stats-container">
              <div class="stat-box" data-aos="zoom-in" data-aos-delay="100">
                <h4>500+</h4>
                <p>Events Planned</p>
              </div>
              <div class="stat-box" data-aos="zoom-in" data-aos-delay="200">
                <h4>450+</h4>
                <p>Happy Clients</p>
              </div>
              <div class="stat-box" data-aos="zoom-in" data-aos-delay="300">
                <h4>10+</h4>
                <p>Years Experience</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Our Services</h2>
          <p>Comprehensive Event Planning Solutions</p>
        </div>

        <div class="row">
          <div
            class="col-md-6 col-lg-4"
            data-aos="fade-up"
            data-aos-delay="100"
          >
            <div class="service-card" onclick="showServiceDetail('birthday')">
              <div class="service-image">
                <img
                  src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="Birthday"
                />
                <div class="service-overlay">
                  <h3>Birthdays</h3>
                </div>
              </div>
              <div class="service-content">
                <p>
                  Make your special day truly memorable with our creative
                  birthday celebration planning.
                </p>
                <ul class="service-features">
                  <li><i class="fas fa-check"></i> Custom Theme Design</li>
                  <li>
                    <i class="fas fa-check"></i> Entertainment & Activities
                  </li>
                  <li><i class="fas fa-check"></i> Catering Services</li>
                  <li>
                    <i class="fas fa-check"></i> Photography & Videography
                  </li>
                </ul>
                <button class="btn-pricing mt-3">View Details</button>
              </div>
            </div>
          </div>

          <div
            class="col-md-6 col-lg-4"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <div class="service-card" onclick="showServiceDetail('holud')">
              <div class="service-image">
                <img
                  src="https://images.unsplash.com/photo-1606800052052-a08af7148866?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="Holud"
                />
                <div class="service-overlay">
                  <h3>Holud</h3>
                </div>
              </div>
              <div class="service-content">
                <p>
                  Celebrate this beautiful pre-wedding tradition with authentic
                  cultural touches.
                </p>
                <ul class="service-features">
                  <li><i class="fas fa-check"></i> Traditional Decor</li>
                  <li><i class="fas fa-check"></i> Cultural Music & Dance</li>
                  <li>
                    <i class="fas fa-check"></i> Professional Makeup Artists
                  </li>
                  <li><i class="fas fa-check"></i> Complete Coordination</li>
                </ul>
                <button class="btn-pricing mt-3">View Details</button>
              </div>
            </div>
          </div>

          <div
            class="col-md-6 col-lg-4"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <div class="service-card" onclick="showServiceDetail('proposal')">
              <div class="service-image">
                <img
                  src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="Marriage Proposal"
                />
                <div class="service-overlay">
                  <h3>Marriage Proposal</h3>
                </div>
              </div>
              <div class="service-content">
                <p>
                  Create an unforgettable moment with our romantic proposal
                  planning services.
                </p>
                <ul class="service-features">
                  <li><i class="fas fa-check"></i> Romantic Setups</li>
                  <li><i class="fas fa-check"></i> Surprise Coordination</li>
                  <li><i class="fas fa-check"></i> Professional Photography</li>
                  <li><i class="fas fa-check"></i> Personalized Details</li>
                </ul>
                <button class="btn-pricing mt-3">View Details</button>
              </div>
            </div>
          </div>

          <div
            class="col-md-6 col-lg-4"
            data-aos="fade-up"
            data-aos-delay="100"
          >
            <div class="service-card" onclick="showServiceDetail('reception')">
              <div class="service-image">
                <img
                  src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="Reception"
                />
                <div class="service-overlay">
                  <h3>Reception</h3>
                </div>
              </div>
              <div class="service-content">
                <p>
                  Host an elegant reception that your guests will remember
                  forever.
                </p>
                <ul class="service-features">
                  <li><i class="fas fa-check"></i> Venue Selection</li>
                  <li><i class="fas fa-check"></i> Elegant Decorations</li>
                  <li><i class="fas fa-check"></i> Gourmet Catering</li>
                  <li><i class="fas fa-check"></i> Entertainment Management</li>
                </ul>
                <button class="btn-pricing mt-3">View Details</button>
              </div>
            </div>
          </div>

          <div
            class="col-md-6 col-lg-4"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <div class="service-card" onclick="showServiceDetail('graduation')">
              <div class="service-image">
                <img
                  src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="Graduation"
                />
                <div class="service-overlay">
                  <h3>Graduation</h3>
                </div>
              </div>
              <div class="service-content">
                <p>
                  Celebrate your academic achievements with a memorable
                  graduation party.
                </p>
                <ul class="service-features">
                  <li><i class="fas fa-check"></i> Themed Decorations</li>
                  <li><i class="fas fa-check"></i> Photo Booth Setup</li>
                  <li><i class="fas fa-check"></i> Catering Options</li>
                  <li><i class="fas fa-check"></i> Award Ceremony Setup</li>
                </ul>
                <button class="btn-pricing mt-3">View Details</button>
              </div>
            </div>
          </div>

          <div
            class="col-md-6 col-lg-4"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <div
              class="service-card"
              onclick="showServiceDetail('anniversary')"
            >
              <div class="service-image">
                <img
                  src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="Anniversaries"
                />
                <div class="service-overlay">
                  <h3>Anniversaries</h3>
                </div>
              </div>
              <div class="service-content">
                <p>
                  Renew your vows or celebrate milestones with an intimate
                  anniversary celebration.
                </p>
                <ul class="service-features">
                  <li><i class="fas fa-check"></i> Intimate Setups</li>
                  <li><i class="fas fa-check"></i> Romantic Ambiance</li>
                  <li><i class="fas fa-check"></i> Memory Lane Displays</li>
                  <li><i class="fas fa-check"></i> Special Surprises</li>
                </ul>
                <button class="btn-pricing mt-3">View Details</button>
              </div>
            </div>
          </div>
        </div>
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
          <div class="pricing-tab active" onclick="showPricing('birthday')">
            Birthdays
          </div>
          <div class="pricing-tab" onclick="showPricing('holud')">Holud</div>
          <div class="pricing-tab" onclick="showPricing('proposal')">
            Marriage Proposal
          </div>
          <div class="pricing-tab" onclick="showPricing('reception')">
            Reception
          </div>
          <div class="pricing-tab" onclick="showPricing('graduation')">
            Graduation
          </div>
          <div class="pricing-tab" onclick="showPricing('anniversary')">
            Anniversaries
          </div>
        </div>

        <!-- Birthday Packages -->
        <div class="pricing-content active" id="birthday-pricing">
          <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="pricing-card">
                <h3>Basic</h3>
                <div class="pricing-price">$299<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Basic Decoration</li>
                  <li><i class="fas fa-check"></i> Cake & Snacks</li>
                  <li><i class="fas fa-check"></i> Music System</li>
                  <li><i class="fas fa-check"></i> 3 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 50 Guests</li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Professional Photography
                  </li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Custom Theme
                  </li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="pricing-card featured">
                <span class="pricing-badge">Most Popular</span>
                <h3>Premium</h3>
                <div class="pricing-price">$599<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Premium Decoration</li>
                  <li><i class="fas fa-check"></i> Deluxe Cake & Catering</li>
                  <li><i class="fas fa-check"></i> DJ & Entertainment</li>
                  <li><i class="fas fa-check"></i> 5 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 100 Guests</li>
                  <li><i class="fas fa-check"></i> Professional Photography</li>
                  <li><i class="fas fa-check"></i> Custom Theme</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="pricing-card">
                <h3>Pro</h3>
                <div class="pricing-price">$999<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Luxury Decoration</li>
                  <li><i class="fas fa-check"></i> Premium Catering Menu</li>
                  <li><i class="fas fa-check"></i> Live Band & DJ</li>
                  <li><i class="fas fa-check"></i> Full Day Coverage</li>
                  <li><i class="fas fa-check"></i> Unlimited Guests</li>
                  <li><i class="fas fa-check"></i> Photo & Video Coverage</li>
                  <li><i class="fas fa-check"></i> Custom Everything</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Holud Packages -->
        <div class="pricing-content" id="holud-pricing">
          <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="pricing-card">
                <h3>Basic</h3>
                <div class="pricing-price">$799<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Traditional Decoration</li>
                  <li><i class="fas fa-check"></i> Basic Catering</li>
                  <li><i class="fas fa-check"></i> Cultural Music</li>
                  <li><i class="fas fa-check"></i> 4 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 75 Guests</li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Makeup Artist
                  </li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Professional Video
                  </li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="pricing-card featured">
                <span class="pricing-badge">Most Popular</span>
                <h3>Premium</h3>
                <div class="pricing-price">$1,299<span>/event</span></div>
                <ul class="pricing-features">
                  <li>
                    <i class="fas fa-check"></i> Elegant Traditional Setup
                  </li>
                  <li><i class="fas fa-check"></i> Premium Catering</li>
                  <li>
                    <i class="fas fa-check"></i> Live Cultural Performance
                  </li>
                  <li><i class="fas fa-check"></i> 6 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 150 Guests</li>
                  <li><i class="fas fa-check"></i> Professional Makeup</li>
                  <li><i class="fas fa-check"></i> Photo & Video</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="pricing-card">
                <h3>Pro</h3>
                <div class="pricing-price">$1,999<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Luxury Traditional Decor</li>
                  <li><i class="fas fa-check"></i> Gourmet Menu</li>
                  <li><i class="fas fa-check"></i> Celebrity Performances</li>
                  <li><i class="fas fa-check"></i> Full Day Event</li>
                  <li><i class="fas fa-check"></i> Unlimited Guests</li>
                  <li><i class="fas fa-check"></i> Complete Beauty Team</li>
                  <li><i class="fas fa-check"></i> Cinematic Coverage</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Marriage Proposal Packages -->
        <div class="pricing-content" id="proposal-pricing">
          <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="pricing-card">
                <h3>Basic</h3>
                <div class="pricing-price">$399<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Romantic Setup</li>
                  <li><i class="fas fa-check"></i> Flower Arrangements</li>
                  <li><i class="fas fa-check"></i> Candlelight Ambiance</li>
                  <li><i class="fas fa-check"></i> Music Playlist</li>
                  <li><i class="fas fa-check"></i> 2 Hours Setup</li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Photographer
                  </li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Custom Surprise Elements
                  </li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="pricing-card featured">
                <span class="pricing-badge">Most Popular</span>
                <h3>Premium</h3>
                <div class="pricing-price">$799<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Luxury Romantic Setup</li>
                  <li><i class="fas fa-check"></i> Premium Flowers & Decor</li>
                  <li><i class="fas fa-check"></i> LED Lights & Effects</li>
                  <li><i class="fas fa-check"></i> Live Music/Musician</li>
                  <li><i class="fas fa-check"></i> 3 Hours Coverage</li>
                  <li>
                    <i class="fas fa-check"></i> Professional Photographer
                  </li>
                  <li><i class="fas fa-check"></i> Custom Surprises</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="pricing-card">
                <h3>Pro</h3>
                <div class="pricing-price">$1,499<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Dream Proposal Setup</li>
                  <li><i class="fas fa-check"></i> Exotic Flower Displays</li>
                  <li><i class="fas fa-check"></i> Full Lighting Production</li>
                  <li><i class="fas fa-check"></i> Live Band Performance</li>
                  <li><i class="fas fa-check"></i> Full Day Planning</li>
                  <li><i class="fas fa-check"></i> Photo & Video Team</li>
                  <li><i class="fas fa-check"></i> Elaborate Custom Setup</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Reception Packages -->
        <div class="pricing-content" id="reception-pricing">
          <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="pricing-card">
                <h3>Basic</h3>
                <div class="pricing-price">$1,999<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Elegant Decoration</li>
                  <li><i class="fas fa-check"></i> Standard Catering</li>
                  <li><i class="fas fa-check"></i> DJ Services</li>
                  <li><i class="fas fa-check"></i> 6 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 150 Guests</li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Photo Booth
                  </li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Video Coverage
                  </li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="pricing-card featured">
                <span class="pricing-badge">Most Popular</span>
                <h3>Premium</h3>
                <div class="pricing-price">$3,999<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Premium Venue Decoration</li>
                  <li><i class="fas fa-check"></i> Gourmet Catering</li>
                  <li><i class="fas fa-check"></i> Live Band & DJ</li>
                  <li><i class="fas fa-check"></i> 8 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 300 Guests</li>
                  <li><i class="fas fa-check"></i> Photo Booth & Props</li>
                  <li><i class="fas fa-check"></i> Full Video Coverage</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="pricing-card">
                <h3>Pro</h3>
                <div class="pricing-price">$6,999<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Luxury Ballroom Setup</li>
                  <li><i class="fas fa-check"></i> Five-Star Catering</li>
                  <li><i class="fas fa-check"></i> Celebrity Entertainment</li>
                  <li><i class="fas fa-check"></i> Full Day Event</li>
                  <li><i class="fas fa-check"></i> Unlimited Guests</li>
                  <li><i class="fas fa-check"></i> Multiple Photo Booths</li>
                  <li><i class="fas fa-check"></i> Cinematic Production</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Graduation Packages -->
        <div class="pricing-content" id="graduation-pricing">
          <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="pricing-card">
                <h3>Basic</h3>
                <div class="pricing-price">$399<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Themed Decoration</li>
                  <li><i class="fas fa-check"></i> Snacks & Refreshments</li>
                  <li><i class="fas fa-check"></i> Background Music</li>
                  <li><i class="fas fa-check"></i> 3 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 50 Guests</li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Photo Booth
                  </li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Professional Photography
                  </li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="pricing-card featured">
                <span class="pricing-badge">Most Popular</span>
                <h3>Premium</h3>
                <div class="pricing-price">$699<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Custom Theme Setup</li>
                  <li><i class="fas fa-check"></i> Full Catering Service</li>
                  <li><i class="fas fa-check"></i> DJ & Entertainment</li>
                  <li><i class="fas fa-check"></i> 5 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 100 Guests</li>
                  <li><i class="fas fa-check"></i> Photo Booth Setup</li>
                  <li><i class="fas fa-check"></i> Professional Photography</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="pricing-card">
                <h3>Pro</h3>
                <div class="pricing-price">$1,199<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Premium Venue Decor</li>
                  <li><i class="fas fa-check"></i> Gourmet Food Stations</li>
                  <li><i class="fas fa-check"></i> Live Entertainment</li>
                  <li><i class="fas fa-check"></i> Full Day Coverage</li>
                  <li><i class="fas fa-check"></i> Unlimited Guests</li>
                  <li><i class="fas fa-check"></i> Multiple Photo Booths</li>
                  <li><i class="fas fa-check"></i> Full Video Production</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Anniversary Packages -->
        <div class="pricing-content" id="anniversary-pricing">
          <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="pricing-card">
                <h3>Basic</h3>
                <div class="pricing-price">$499<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Romantic Setup</li>
                  <li><i class="fas fa-check"></i> Intimate Dinner</li>
                  <li><i class="fas fa-check"></i> Soft Music</li>
                  <li><i class="fas fa-check"></i> 3 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 20 Guests</li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Memory Lane Display
                  </li>
                  <li class="disabled">
                    <i class="fas fa-times"></i> Professional Photography
                  </li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
              <div class="pricing-card featured">
                <span class="pricing-badge">Most Popular</span>
                <h3>Premium</h3>
                <div class="pricing-price">$899<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Elegant Romantic Decor</li>
                  <li><i class="fas fa-check"></i> Premium Catering</li>
                  <li><i class="fas fa-check"></i> Live Music Performance</li>
                  <li><i class="fas fa-check"></i> 5 Hours Duration</li>
                  <li><i class="fas fa-check"></i> Up to 50 Guests</li>
                  <li><i class="fas fa-check"></i> Memory Lane Display</li>
                  <li><i class="fas fa-check"></i> Professional Photography</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="pricing-card">
                <h3>Pro</h3>
                <div class="pricing-price">$1,599<span>/event</span></div>
                <ul class="pricing-features">
                  <li><i class="fas fa-check"></i> Luxury Venue Setup</li>
                  <li>
                    <i class="fas fa-check"></i> Gourmet Dining Experience
                  </li>
                  <li>
                    <i class="fas fa-check"></i> Live Band & Entertainment
                  </li>
                  <li><i class="fas fa-check"></i> Full Day Event</li>
                  <li><i class="fas fa-check"></i> Up to 100 Guests</li>
                  <li><i class="fas fa-check"></i> Custom Memory Displays</li>
                  <li><i class="fas fa-check"></i> Photo & Video Coverage</li>
                </ul>
                <button class="btn-pricing">Choose Plan</button>
              </div>
            </div>
          </div>
        </div>
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
          <div class="gallery-filter" onclick="filterGallery('birthday')">
            Birthdays
          </div>
          <div class="gallery-filter" onclick="filterGallery('holud')">
            Holud
          </div>
          <div class="gallery-filter" onclick="filterGallery('proposal')">
            Proposals
          </div>
          <div class="gallery-filter" onclick="filterGallery('reception')">
            Receptions
          </div>
          <div class="gallery-filter" onclick="filterGallery('graduation')">
            Graduations
          </div>
          <div class="gallery-filter" onclick="filterGallery('anniversary')">
            Anniversaries
          </div>
        </div>

        <div class="gallery-grid" data-aos="fade-up" data-aos-delay="200">
          <div class="gallery-item" data-category="birthday">
            <img
              src="https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Birthday Event"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="holud">
            <img
              src="https://images.unsplash.com/photo-1591604021695-0c69b7c05981?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Holud Ceremony"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="proposal">
            <img
              src="https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Marriage Proposal"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="reception">
            <img
              src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Reception"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="graduation">
            <img
              src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Graduation"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="anniversary">
            <img
              src="https://images.unsplash.com/photo-1529634597447-92325fb54b08?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Anniversary"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="birthday">
            <img
              src="https://images.unsplash.com/photo-1558636508-e0db3814bd1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Birthday Party"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="reception">
            <img
              src="https://images.unsplash.com/photo-1478146896981-b80fe463b330?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Wedding Reception"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
          <div class="gallery-item" data-category="holud">
            <img
              src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Holud Event"
            />
            <div class="gallery-overlay">
              <i class="fas fa-search-plus"></i>
            </div>
          </div>
        </div>
      </div>
    </section>

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

      function closeLightbox() {
        document.getElementById("lightbox").classList.remove("active");
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

      // Service Detail Modal Functions
      const serviceDetails = {
        birthday: {
          title: "Birthday Party Planning",
          subtitle: "Celebrate Life's Special Milestones",
          image:
            "https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80",
          description: `
                    <p>Birthdays are special occasions that deserve to be celebrated in style! Whether you're planning a child's first birthday, a sweet sixteen, a milestone 30th, 50th, or even a 100th birthday celebration, our team is here to make it extraordinary.</p>
                    <p>We specialize in creating personalized birthday experiences that reflect the celebrant's personality, interests, and dreams. From intimate gatherings to grand celebrations, we handle every detail so you can focus on creating memories.</p>
                    <p>Our birthday planning services include theme development, venue selection and decoration, entertainment coordination, catering arrangements, cake design, party favors, photography and videography, and complete event management from start to finish.</p>
                `,
          highlights: [
            {
              icon: "fa-palette",
              title: "Custom Themes",
              text: "Unique designs tailored to your vision",
            },
            {
              icon: "fa-users",
              title: "Guest Management",
              text: "RSVP tracking and seating arrangements",
            },
            {
              icon: "fa-birthday-cake",
              title: "Catering Excellence",
              text: "Delicious menus for all tastes",
            },
            {
              icon: "fa-camera",
              title: "Memory Capture",
              text: "Professional photo & video coverage",
            },
          ],
          packages: [
            {
              name: "Basic",
              price: "$299",
              features: [
                {
                  name: "Event Duration",
                  basic: "3 Hours",
                  premium: "5 Hours",
                  pro: "Full Day",
                },
                {
                  name: "Guest Capacity",
                  basic: "Up to 50",
                  premium: "Up to 100",
                  pro: "Unlimited",
                },
                {
                  name: "Venue Decoration",
                  basic: "Basic Setup",
                  premium: "Premium Decor",
                  pro: "Luxury Design",
                },
                {
                  name: "Theme Customization",
                  basic: false,
                  premium: true,
                  pro: true,
                },
                {
                  name: "Balloon & Banner Setup",
                  basic: true,
                  premium: true,
                  pro: true,
                },
                {
                  name: "Table & Chair Arrangements",
                  basic: true,
                  premium: true,
                  pro: true,
                },
                {
                  name: "Cake (Size)",
                  basic: "Standard",
                  premium: "Deluxe 2-Tier",
                  pro: "Custom 3-Tier",
                },
                {
                  name: "Catering",
                  basic: "Snacks Only",
                  premium: "Full Menu",
                  pro: "Gourmet Selection",
                },
                {
                  name: "Beverage Service",
                  basic: "Soft Drinks",
                  premium: "Full Bar",
                  pro: "Premium Bar",
                },
                {
                  name: "Entertainment",
                  basic: false,
                  premium: "DJ & Music",
                  pro: "Live Band & DJ",
                },
                {
                  name: "Photo Booth",
                  basic: false,
                  premium: false,
                  pro: true,
                },
                {
                  name: "Photography",
                  basic: false,
                  premium: "3 Hours",
                  pro: "Full Coverage",
                },
                {
                  name: "Videography",
                  basic: false,
                  premium: false,
                  pro: "Cinematic Video",
                },
                {
                  name: "Party Favors",
                  basic: false,
                  premium: "Basic",
                  pro: "Premium",
                },
                {
                  name: "Event Coordinator",
                  basic: "Support",
                  premium: "Dedicated",
                  pro: "Team + Manager",
                },
                {
                  name: "Setup & Cleanup",
                  basic: true,
                  premium: true,
                  pro: true,
                },
              ],
            },
          ],
        },
        holud: {
          title: "Holud Ceremony Planning",
          subtitle: "Embrace Tradition with Elegance",
          image:
            "https://images.unsplash.com/photo-1606800052052-a08af7148866?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80",
          description: `
                    <p>The Holud ceremony is a beautiful and vibrant pre-wedding tradition that brings families together in celebration. Our specialized Holud planning services honor cultural traditions while adding contemporary elegance to create an unforgettable experience.</p>
                    <p>We understand the importance of this sacred ritual and work closely with you to ensure every traditional element is respectfully incorporated while creating a visually stunning celebration that your guests will remember forever.</p>
                    <p>From authentic traditional decor featuring marigold garlands and brass elements to modern fusion aesthetics, we create the perfect ambiance. Our services include complete ceremony coordination, traditional music and dance arrangements, professional makeup and mehndi artists, catering with traditional cuisine, and comprehensive photo-video documentation.</p>
                `,
          highlights: [
            {
              icon: "fa-om",
              title: "Cultural Authenticity",
              text: "Traditional elements honored perfectly",
            },
            {
              icon: "fa-paint-brush",
              title: "Mehndi Artists",
              text: "Skilled henna application services",
            },
            {
              icon: "fa-music",
              title: "Traditional Music",
              text: "Live cultural performances",
            },
            {
              icon: "fa-utensils",
              title: "Authentic Cuisine",
              text: "Traditional dishes & sweets",
            },
          ],
          packages: [
            {
              name: "Basic",
              price: "$799",
              features: [
                {
                  name: "Event Duration",
                  basic: "4 Hours",
                  premium: "6 Hours",
                  pro: "Full Day",
                },
                {
                  name: "Guest Capacity",
                  basic: "Up to 75",
                  premium: "Up to 150",
                  pro: "Unlimited",
                },
                {
                  name: "Venue Decoration",
                  basic: "Traditional",
                  premium: "Premium Traditional",
                  pro: "Luxury Custom",
                },
                {
                  name: "Marigold Garlands & Setup",
                  basic: true,
                  premium: true,
                  pro: true,
                },
                {
                  name: "Traditional Seating (Piri/Peera)",
                  basic: "Basic",
                  premium: "Elegant",
                  pro: "Luxury",
                },
                {
                  name: "Stage Decoration",
                  basic: "Simple",
                  premium: "Elaborate",
                  pro: "Grand",
                },
                {
                  name: "Lighting & Effects",
                  basic: false,
                  premium: "LED Lights",
                  pro: "Full Production",
                },
                {
                  name: "Mehendi Artists",
                  basic: "1 Artist",
                  premium: "3 Artists",
                  pro: "5+ Artists",
                },
                {
                  name: "Makeup Services",
                  basic: false,
                  premium: "Bride Only",
                  pro: "Full Beauty Team",
                },
                {
                  name: "Traditional Music",
                  basic: "Audio",
                  premium: "Live Musicians",
                  pro: "Full Band",
                },
                {
                  name: "Cultural Dance Performance",
                  basic: false,
                  premium: true,
                  pro: "Celebrity Dancers",
                },
                {
                  name: "Catering",
                  basic: "Standard",
                  premium: "Premium Menu",
                  pro: "Gourmet Spread",
                },
                {
                  name: "Traditional Sweets",
                  basic: "Basic",
                  premium: "Variety",
                  pro: "Premium Selection",
                },
                {
                  name: "Photography",
                  basic: false,
                  premium: "5 Hours",
                  pro: "Full Coverage",
                },
                {
                  name: "Videography",
                  basic: false,
                  premium: "Highlight Video",
                  pro: "Cinematic Film",
                },
                {
                  name: "Event Coordinator",
                  basic: "Support",
                  premium: "Dedicated Team",
                  pro: "Senior Manager",
                },
              ],
            },
          ],
        },
        proposal: {
          title: "Marriage Proposal Planning",
          subtitle: "The Perfect 'Yes' Moment",
          image:
            "https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80",
          description: `
                    <p>A marriage proposal is one of the most important moments of your life, and it deserves to be absolutely perfect. Our proposal planning specialists work with you to create a magical, personalized experience that reflects your unique love story.</p>
                    <p>We handle everything from concept to execution, ensuring that every detail aligns with your vision while maintaining the element of surprise. Whether you envision an intimate rooftop dinner, a beach sunset proposal, a flash mob surprise, or an elaborate destination proposal, we make it happen.</p>
                    <p>Our services include location scouting and booking, complete romantic setup design, surprise coordination, photographer and videographer to capture the moment, backup plans for weather contingencies, and post-proposal celebration arrangements if desired.</p>
                `,
          highlights: [
            {
              icon: "fa-heart",
              title: "Romantic Setups",
              text: "Stunning visual experiences",
            },
            {
              icon: "fa-user-secret",
              title: "Surprise Coordination",
              text: "Flawless timing and execution",
            },
            {
              icon: "fa-camera-retro",
              title: "Moment Capture",
              text: "Professional hidden photography",
            },
            {
              icon: "fa-map-marked-alt",
              title: "Location Scouting",
              text: "Perfect venue selection",
            },
          ],
          packages: [
            {
              name: "Basic",
              price: "$399",
              features: [
                {
                  name: "Planning Duration",
                  basic: "2 Hours",
                  premium: "3 Hours",
                  pro: "Full Day",
                },
                {
                  name: "Location Options",
                  basic: "1 Location",
                  premium: "Choice of 3",
                  pro: "Unlimited",
                },
                {
                  name: "Setup Design",
                  basic: "Romantic",
                  premium: "Luxury",
                  pro: "Dream Proposal",
                },
                {
                  name: "Flower Arrangements",
                  basic: "Roses",
                  premium: "Premium Florals",
                  pro: "Exotic Displays",
                },
                {
                  name: "Candlelight Setup",
                  basic: "Basic",
                  premium: "Extensive",
                  pro: "Elaborate",
                },
                {
                  name: "LED/String Lights",
                  basic: false,
                  premium: "String Lights",
                  pro: "Full Production",
                },
                {
                  name: "Music Arrangement",
                  basic: "Playlist",
                  premium: "Live Musician",
                  pro: "Live Band",
                },
                {
                  name: "Special Effects",
                  basic: false,
                  premium: "Sparklers",
                  pro: "Fireworks/Effects",
                },
                {
                  name: "Personalized Elements",
                  basic: "Letter/Sign",
                  premium: "Custom Props",
                  pro: "Elaborate Setup",
                },
                {
                  name: "Surprise Coordination",
                  basic: "Basic",
                  premium: "Detailed",
                  pro: "Complex",
                },
                {
                  name: "Photography",
                  basic: false,
                  premium: "2 Hours",
                  pro: "Full Coverage",
                },
                {
                  name: "Videography",
                  basic: false,
                  premium: false,
                  pro: "Cinematic Video",
                },
                {
                  name: "Backup Weather Plan",
                  basic: false,
                  premium: true,
                  pro: true,
                },
                {
                  name: "Post-Proposal Celebration",
                  basic: false,
                  premium: "Champagne",
                  pro: "Full Setup",
                },
                {
                  name: "Planning Consultations",
                  basic: "1 Session",
                  premium: "3 Sessions",
                  pro: "Unlimited",
                },
              ],
            },
          ],
        },
        reception: {
          title: "Wedding Reception Planning",
          subtitle: "Celebrate Your Union in Grand Style",
          image:
            "https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80",
          description: `
                    <p>Your wedding reception is the celebration you've been dreaming of - a magical evening where you're surrounded by everyone you love, celebrating the beginning of your new life together. Our comprehensive reception planning services ensure every moment is perfect.</p>
                    <p>From elegant ballroom celebrations to rustic outdoor receptions, garden parties to beachfront gatherings, we create experiences that reflect your unique style and vision. We coordinate with the best vendors, manage timelines, and ensure flawless execution.</p>
                    <p>Our services include complete venue transformation, guest management and seating arrangements, entertainment coordination, catering and bar services, lighting and audio production, photography and videography, cake and dessert coordination, and timeline management to ensure everything flows perfectly.</p>
                `,
          highlights: [
            {
              icon: "fa-rings-wedding",
              title: "Complete Coordination",
              text: "Every detail perfectly managed",
            },
            {
              icon: "fa-glass-cheers",
              title: "Premium Catering",
              text: "Gourmet dining experiences",
            },
            {
              icon: "fa-compact-disc",
              title: "Entertainment",
              text: "Live bands, DJs, and more",
            },
            {
              icon: "fa-lightbulb",
              title: "Ambiance Design",
              text: "Stunning lighting and decor",
            },
          ],
          packages: [
            {
              name: "Basic",
              price: "$1,999",
              features: [
                {
                  name: "Event Duration",
                  basic: "6 Hours",
                  premium: "8 Hours",
                  pro: "Full Day",
                },
                {
                  name: "Guest Capacity",
                  basic: "Up to 150",
                  premium: "Up to 300",
                  pro: "Unlimited",
                },
                {
                  name: "Venue Decoration",
                  basic: "Elegant",
                  premium: "Premium",
                  pro: "Luxury Ballroom",
                },
                {
                  name: "Floral Arrangements",
                  basic: "Centerpieces",
                  premium: "Extensive",
                  pro: "Elaborate",
                },
                {
                  name: "Lighting Design",
                  basic: "Standard",
                  premium: "Custom LED",
                  pro: "Full Production",
                },
                {
                  name: "Stage/Backdrop",
                  basic: "Simple",
                  premium: "Designed",
                  pro: "Grand Setup",
                },
                {
                  name: "Seating Arrangements",
                  basic: "Standard",
                  premium: "Premium",
                  pro: "Luxury",
                },
                {
                  name: "Table Settings",
                  basic: "Standard",
                  premium: "Premium",
                  pro: "Fine China",
                },
                {
                  name: "Catering Service",
                  basic: "Buffet",
                  premium: "Plated Dinner",
                  pro: "5-Star Service",
                },
                {
                  name: "Menu Options",
                  basic: "Standard",
                  premium: "Gourmet",
                  pro: "Chef's Selection",
                },
                {
                  name: "Bar Service",
                  basic: false,
                  premium: "Open Bar",
                  pro: "Premium Bar",
                },
                {
                  name: "Entertainment",
                  basic: "DJ",
                  premium: "Live Band & DJ",
                  pro: "Celebrity Performance",
                },
                {
                  name: "Photo Booth",
                  basic: false,
                  premium: "Standard",
                  pro: "Multiple Stations",
                },
                {
                  name: "Photography",
                  basic: false,
                  premium: "6 Hours",
                  pro: "Full Coverage",
                },
                {
                  name: "Videography",
                  basic: false,
                  premium: "Highlight Film",
                  pro: "Cinematic Production",
                },
                {
                  name: "Wedding Cake",
                  basic: "Standard",
                  premium: "Designer 3-Tier",
                  pro: "Custom Creation",
                },
                {
                  name: "Guest Favors",
                  basic: false,
                  premium: "Standard",
                  pro: "Premium",
                },
                {
                  name: "Event Coordination Team",
                  basic: "2 Staff",
                  premium: "5 Staff",
                  pro: "10+ Staff",
                },
                {
                  name: "Rehearsal Included",
                  basic: false,
                  premium: false,
                  pro: true,
                },
              ],
            },
          ],
        },
        graduation: {
          title: "Graduation Party Planning",
          subtitle: "Celebrate Academic Achievement",
          image:
            "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80",
          description: `
                    <p>Graduation marks a significant milestone in life - the culmination of years of hard work and dedication. Whether it's high school, college, or graduate school, this achievement deserves a memorable celebration that honors the graduate's journey.</p>
                    <p>Our graduation party planning services create fun, sophisticated celebrations that bring together family, friends, and mentors to celebrate this important transition. From casual backyard parties to formal events, we tailor every detail to the graduate's personality and preferences.</p>
                    <p>We handle theme development incorporating school colors and achievements, venue decoration, photo displays showcasing memories, entertainment and activities, catering services, cake and dessert bars, award or recognition ceremony coordination, and memory book or guestbook setup.</p>
                `,
          highlights: [
            {
              icon: "fa-graduation-cap",
              title: "Academic Theme",
              text: "School colors and achievements",
            },
            {
              icon: "fa-images",
              title: "Memory Displays",
              text: "Photo walls and presentations",
            },
            {
              icon: "fa-trophy",
              title: "Recognition Setup",
              text: "Awards and speeches",
            },
            {
              icon: "fa-gift",
              title: "Memorable Favors",
              text: "Personalized keepsakes",
            },
          ],
          packages: [
            {
              name: "Basic",
              price: "$399",
              features: [
                {
                  name: "Event Duration",
                  basic: "3 Hours",
                  premium: "5 Hours",
                  pro: "Full Day",
                },
                {
                  name: "Guest Capacity",
                  basic: "Up to 50",
                  premium: "Up to 100",
                  pro: "Unlimited",
                },
                {
                  name: "Venue Decoration",
                  basic: "Themed",
                  premium: "Custom",
                  pro: "Premium Design",
                },
                {
                  name: "School Colors Integration",
                  basic: true,
                  premium: true,
                  pro: true,
                },
                {
                  name: "Balloon & Banner Setup",
                  basic: "Basic",
                  premium: "Extensive",
                  pro: "Elaborate",
                },
                {
                  name: "Photo Display Wall",
                  basic: false,
                  premium: true,
                  pro: "Multiple Displays",
                },
                {
                  name: "Memory Slideshow",
                  basic: false,
                  premium: true,
                  pro: "Professional Video",
                },
                {
                  name: "Photo Booth",
                  basic: false,
                  premium: false,
                  pro: true,
                },
                {
                  name: "Catering",
                  basic: "Snacks",
                  premium: "Full Menu",
                  pro: "Gourmet Food Stations",
                },
                {
                  name: "Graduation Cake",
                  basic: "Standard",
                  premium: "Custom Design",
                  pro: "Multi-Tier",
                },
                {
                  name: "Dessert Bar",
                  basic: false,
                  premium: false,
                  pro: true,
                },
                {
                  name: "Entertainment",
                  basic: "Music",
                  premium: "DJ",
                  pro: "Live Entertainment",
                },
                {
                  name: "Recognition Ceremony Setup",
                  basic: false,
                  premium: "Basic",
                  pro: "Full Stage",
                },
                {
                  name: "Guest Book Station",
                  basic: true,
                  premium: true,
                  pro: "Interactive Memory Book",
                },
                {
                  name: "Party Favors",
                  basic: false,
                  premium: "Standard",
                  pro: "Custom",
                },
                {
                  name: "Photography",
                  basic: false,
                  premium: "3 Hours",
                  pro: "Full Coverage",
                },
                {
                  name: "Videography",
                  basic: false,
                  premium: false,
                  pro: "Professional Video",
                },
              ],
            },
          ],
        },
        anniversary: {
          title: "Anniversary Celebration Planning",
          subtitle: "Honor Your Love Story",
          image:
            "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80",
          description: `
                    <p>Anniversaries are beautiful milestones that celebrate enduring love and commitment. Whether it's your first anniversary or your golden 50th, each year together deserves to be celebrated in a special way that honors your unique journey.</p>
                    <p>Our anniversary planning services create intimate, romantic, and meaningful celebrations that reflect your relationship. From vow renewals to surprise parties, quiet dinners for two to grand celebrations with all your loved ones, we craft experiences filled with love and nostalgia.</p>
                    <p>We specialize in memory lane displays featuring your journey together, romantic ambiance creation, catering with favorite foods and flavors, entertainment including your special songs, photo and video montages, guest coordination if it's a surprise, and complete event management allowing you to simply enjoy your special day.</p>
                `,
          highlights: [
            {
              icon: "fa-infinity",
              title: "Love Story Telling",
              text: "Display your journey together",
            },
            {
              icon: "fa-candle-holder",
              title: "Romantic Ambiance",
              text: "Intimate and elegant setups",
            },
            {
              icon: "fa-photo-video",
              title: "Memory Preservation",
              text: "Professional documentation",
            },
            {
              icon: "fa-surprise",
              title: "Surprise Coordination",
              text: "Secret planning expertise",
            },
          ],
          packages: [
            {
              name: "Basic",
              price: "$499",
              features: [
                {
                  name: "Event Duration",
                  basic: "3 Hours",
                  premium: "5 Hours",
                  pro: "Full Day",
                },
                {
                  name: "Guest Capacity",
                  basic: "Up to 20",
                  premium: "Up to 50",
                  pro: "Up to 100",
                },
                {
                  name: "Venue Setup",
                  basic: "Romantic",
                  premium: "Elegant",
                  pro: "Luxury",
                },
                {
                  name: "Floral Arrangements",
                  basic: "Roses",
                  premium: "Premium",
                  pro: "Elaborate",
                },
                {
                  name: "Candlelight Setup",
                  basic: "Basic",
                  premium: "Extensive",
                  pro: "Spectacular",
                },
                {
                  name: "Lighting & Ambiance",
                  basic: "String Lights",
                  premium: "Custom LED",
                  pro: "Full Production",
                },
                {
                  name: "Memory Lane Display",
                  basic: false,
                  premium: "Photo Wall",
                  pro: "Interactive Display",
                },
                {
                  name: "Video Montage",
                  basic: false,
                  premium: "Basic",
                  pro: "Professional Edit",
                },
                {
                  name: "Music",
                  basic: "Playlist",
                  premium: "Live Music",
                  pro: "Live Band",
                },
                {
                  name: "Catering",
                  basic: "Dinner for Two",
                  premium: "Full Menu",
                  pro: "Gourmet Experience",
                },
                {
                  name: "Anniversary Cake",
                  basic: "Standard",
                  premium: "Elegant Design",
                  pro: "Custom Creation",
                },
                {
                  name: "Champagne Service",
                  basic: false,
                  premium: true,
                  pro: "Premium Selection",
                },
                {
                  name: "Vow Renewal Coordination",
                  basic: false,
                  premium: false,
                  pro: true,
                },
                {
                  name: "Surprise Planning",
                  basic: false,
                  premium: "Basic",
                  pro: "Elaborate",
                },
                {
                  name: "Photography",
                  basic: false,
                  premium: "3 Hours",
                  pro: "Full Coverage",
                },
                {
                  name: "Videography",
                  basic: false,
                  premium: false,
                  pro: "Cinematic Film",
                },
                {
                  name: "Guest Coordination",
                  basic: false,
                  premium: true,
                  pro: true,
                },
              ],
            },
          ],
        },
      };

      function showServiceDetail(serviceType) {
        const modal = document.getElementById("serviceDetailModal");
        const body = document.getElementById("serviceDetailBody");
        const service = serviceDetails[serviceType];

        let highlightsHTML = "";
        service.highlights.forEach((highlight) => {
          highlightsHTML += `
                    <div class="highlight-box">
                        <i class="fas ${highlight.icon}"></i>
                        <h4>${highlight.title}</h4>
                        <p>${highlight.text}</p>
                    </div>
                `;
        });

        let tableHTML =
          '<table><thead><tr><th>Features</th><th>Basic</th><th class="featured-package">Premium</th><th>Pro</th></tr></thead><tbody>';

        // Add price row
        tableHTML += `
                <tr class="package-price-row">
                    <td>Package Price</td>
                    <td>${
                      service.packages[0].features[0].basic === "2 Hours"
                        ? "$399"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "birthday"
                        ? "$299"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "graduation"
                        ? "$399"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "anniversary"
                        ? "$499"
                        : service.packages[0].features[0].basic === "4 Hours"
                        ? "$799"
                        : service.packages[0].features[0].basic === "6 Hours"
                        ? "$1,999"
                        : "$399"
                    }</td>
                    <td>${
                      service.packages[0].features[0].basic === "2 Hours"
                        ? "$799"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "birthday"
                        ? "$599"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "graduation"
                        ? "$699"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "anniversary"
                        ? "$899"
                        : service.packages[0].features[0].basic === "4 Hours"
                        ? "$1,299"
                        : service.packages[0].features[0].basic === "6 Hours"
                        ? "$3,999"
                        : "$799"
                    }</td>
                    <td>${
                      service.packages[0].features[0].basic === "2 Hours"
                        ? "$1,499"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "birthday"
                        ? "$999"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "graduation"
                        ? "$1,199"
                        : service.packages[0].features[0].basic === "3 Hours" &&
                          serviceType === "anniversary"
                        ? "$1,599"
                        : service.packages[0].features[0].basic === "4 Hours"
                        ? "$1,999"
                        : service.packages[0].features[0].basic === "6 Hours"
                        ? "$6,999"
                        : "$1,499"
                    }</td>
                </tr>
            `;

        service.packages[0].features.forEach((feature) => {
          tableHTML += `<tr><td>${feature.name}</td>`;

          // Basic column
          if (typeof feature.basic === "boolean") {
            tableHTML += `<td>${
              feature.basic
                ? '<i class="fas fa-check check-icon"></i>'
                : '<i class="fas fa-times cross-icon"></i>'
            }</td>`;
          } else {
            tableHTML += `<td>${feature.basic}</td>`;
          }

          // Premium column
          if (typeof feature.premium === "boolean") {
            tableHTML += `<td class="featured-package">${
              feature.premium
                ? '<i class="fas fa-check check-icon"></i>'
                : '<i class="fas fa-times cross-icon"></i>'
            }</td>`;
          } else {
            tableHTML += `<td class="featured-package">${feature.premium}</td>`;
          }

          // Pro column
          if (typeof feature.pro === "boolean") {
            tableHTML += `<td>${
              feature.pro
                ? '<i class="fas fa-check check-icon"></i>'
                : '<i class="fas fa-times cross-icon"></i>'
            }</td>`;
          } else {
            tableHTML += `<td>${feature.pro}</td>`;
          }

          tableHTML += "</tr>";
        });

        tableHTML += "</tbody></table>";

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
                
                <div class="service-highlights">
                    ${highlightsHTML}
                </div>
                
                <div class="package-comparison">
                    <h3>Package Comparison</h3>
                    <div class="package-table">
                        ${tableHTML}
                    </div>
                </div>
                
                <div class="detail-cta">
                    <h3>Ready to Plan Your Event?</h3>
                    <p>Contact us today to discuss your vision and get a customized quote for your perfect celebration.</p>
                    <button class="btn-primary-custom" onclick="closeServiceDetail(); document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">Get Started</button>
                </div>
            `;

        modal.classList.add("active");
        document.body.style.overflow = "hidden";
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