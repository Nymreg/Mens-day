<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Men's Day</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="Landing Page Men's Day.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
  .hero {
    position: relative;
    background: url("https://images.unsplash.com/photo-1600180758890-6b94519c8c49?auto=format&fit=crop&w=1500&q=80") no-repeat center center;
    background-size: cover;
    height: 90vh;
    color: white;
    display: flex;
    align-items: center;
  }

  .hero-overlay {
    background: rgba(0, 0, 0, 0.4);
    padding: 40px;
    max-width: 500px;
    margin-left: 5%;
    border-radius: 8px;
  }

  .hero h1 {
    font-size: 2.5rem;
    font-weight: bold;
  }

  .hero p {
    font-size: 1.1rem;
  }

  .btn-shop {
    background-color: white;
    color: black;
    border: none;
    padding: 10px 25px;
    margin-top: 15px;
    font-weight: bold;
    border-radius: 25px;
    transition: background 0.2s, color 0.2s;
  }

  .btn-shop:hover {
    background: #222;
    color: #fff;
  }

  .shop-category-title {
    text-align: center;
    font-size: 1.5rem;
    margin: 48px 0 32px 0;
    font-weight: 500;
    letter-spacing: 0.5px;
  }

  .category-img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    border-radius: 6px;
    transition: transform 0.2s;
  }

  .category-img:hover {
    transform: scale(1.03);
  }

  .category-label {
    margin-top: 10px;
    text-align: center;
    font-size: 1rem;
    color: #444;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
    cursor: pointer;
    transition: color 0.2s;
  }

  .category-label:hover {
    color: #b86e36;
    text-decoration: underline;
  }

  .featured-grid {
    margin: 56px 0 32px 0;
  }

  .featured-card {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    min-height: 340px;
    background: #eee;
    cursor: pointer;
    transition: box-shadow 0.2s;
    height: 100%;
  }

  .featured-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.85);
    transition: filter 0.3s;
  }

  .featured-card:hover img {
    filter: brightness(0.7);
  }

  .featured-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: rgba(34, 34, 34, 0.22);
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
    padding: 24px;
  }

  .featured-title {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 18px;
  }

  .featured-btn {
    background: #fff;
    color: #222;
    border-radius: 0;
    font-weight: 600;
    padding: 10px 28px;
    border: none;
    font-size: 1rem;
    transition: background 0.2s, color 0.2s;
  }

  .featured-btn:hover {
    background: #222;
    color: #fff;
  }

  @media (max-width: 991px) {
    .featured-title {
      font-size: 1.5rem;
    }

    .featured-card {
      min-height: 220px;
    }
  }

  @media (max-width: 767px) {
    .hero {
      min-height: 38vh;
    }

    .shop-category-title {
      font-size: 1.2rem;
    }

    .featured-title {
      font-size: 1.2rem;
    }

    .featured-card {
      min-height: 160px;
    }

    .category-label {
      font-size: 0.9rem;
    }
  }

  .category-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 18px;
    max-width: 1140px;
    margin-bottom: 2.5rem;
    margin-left: auto;
    margin-right: auto;
  }

  .category-grid>div {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .category-img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    border-radius: 6px;
    transition: transform 0.2s;
  }

  .category-label {
    margin-top: 8px;
    text-align: center;
    font-size: 1rem;
    color: #444;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
    cursor: pointer;
    transition: color 0.2s;
  }

  .category-img:hover {
    transform: scale(1.03);
  }

  .category-label:hover {
    color: #b86e36;
    text-decoration: underline;
  }

  @media (max-width: 991.98px) {
    .category-grid {
      grid-template-columns: repeat(3, 1fr);
      max-width: 720px;
    }
  }

  @media (max-width: 767.98px) {
    .category-grid {
      grid-template-columns: repeat(2, 1fr);
      max-width: 95vw;
    }
  }

  @media (max-width: 575.98px) {
    .category-grid {
      grid-template-columns: 1fr;
      max-width: 95vw;
    }
  }

  .impact-banner {
    min-height: 210px;
    background: url("Landing Page Image.png") center center/cover no-repeat;
    border-radius: 0;
    margin-top: 0;
  }

  .banner-content {
    padding: 40px 0;
  }

  .banner-btn {
    background: #fff;
    color: #222;
    border-radius: 0;
    font-weight: 600;
    padding: 10px 38px;
    border: none;
    font-size: 1.1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: background 0.2s, color 0.2s;
  }

  .banner-btn:hover {
    background: #222;
    color: #fff;
  }

  .card-img-top {
    object-fit: cover;
    aspect-ratio: 3/4;
    width: 100%;
    border-radius: 0;
    background: #eee;
  }

  .carousel-control-prev,
  .carousel-control-next {
    width: 3%;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-size: 80% 80%;
  }

  @media (max-width: 991.98px) {
    .impact-banner {
      min-height: 120px;
    }

    .banner-content h2 {
      font-size: 1.3rem;
    }
  }

  @media (max-width: 767.98px) {
    .card-img-top {
      aspect-ratio: 7/8;
    }
  }

  .impact-banner {
    min-height: 210px;
    background: url("Landing Page Image.png") center center/cover no-repeat;
    border-radius: 0;
    margin-top: 0;
  }

  .banner-content {
    padding: 40px 0;
  }

  .banner-btn {
    background: #fff;
    color: #222;
    border-radius: 0;
    font-weight: 600;
    padding: 10px 38px;
    border: none;
    font-size: 1.1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: background 0.2s, color 0.2s;
  }

  .banner-btn:hover {
    background: #222;
    color: #fff;
  }

  .card-img-top {
    object-fit: cover;
    aspect-ratio: 3/4;
    width: 100%;
    border-radius: 0;
    background: #eee;
  }

  .carousel-indicators {
    position: static;
    margin-top: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1px;
    padding: 0;
  }

  .carousel-indicators button.active {
    background-color: #333;
    transform: scale(1.2);
  }

  .carousel-control-prev-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='black' viewBox='0 0 16 16'%3E%3Cpath d='M11 2L5 8l6 6' stroke='black' stroke-width='2' fill='none'/%3E%3C/svg%3E");
  }

  .carousel-control-next-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='black' viewBox='0 0 16 16'%3E%3Cpath d='M5 2l6 6-6 6' stroke='black' stroke-width='2' fill='none'/%3E%3C/svg%3E");
  }

  .fixed-size-img {
    width: 100%;
    /* Ensures the image scales responsively */
    max-width: 400px;
    /* Set max width */
    height: 600px;
    /* Set a fixed height */
    object-fit: cover;
    /* Ensures the image is cropped to fit within the container */
  }

  .divider {
    border-top: 1px solid #000000;
    margin: 2rem 0;
  }

  .image-card {
    transition: transform 0.3s;
  }

  .image-card:hover {
    transform: scale(1.02);
  }

  .btn-link {
    font-weight: bold;
    text-decoration: underline;
  }

  .subtitle {
    color: #000000;
    font-size: 0.9rem;
    margin-top: 0.5rem;
  }

  .black-text {
    color: black;
  }

  /* Cart icon overlay */
  .cart-overlay {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #fff;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .cart-overlay svg {
    width: 22px;
    height: 22px;
    color: #222;
  }

  /* Fix for hidden inactive items */
  #menCarousel .carousel-inner {
    overflow: hidden;
  }

  #menCarousel .carousel-item {
    display: none;
    /* Hide all items by default */
    transition: transform 0.5s ease;
  }

  #menCarousel .carousel-item.active {
    display: block;
    /* Only the active item will be displayed */
  }

  #menCarousel .row {
    margin: 0;
    width: 100%;
  }

  #menCarousel .col {
    padding: 0 10px;
    display: flex;
    justify-content: center;
  }

  #menCarousel .card {
    border: none;
    background: none;
    box-shadow: none;
    position: relative;
    width: 230px;
    aspect-ratio: 1 / 1;
    height: 230px;
    overflow: hidden;
  }

  #menCarousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 6px;
  }

  /* Carousel controls positioned outside carousel images */
  #menCarousel .carousel-control-prev,
  #menCarousel .carousel-control-next {
    width: 4vw;
    min-width: 40px;
    max-width: 60px;
    opacity: 0.8;
    top: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #menCarousel .carousel-control-prev {
    left: -2vw;
  }

  #menCarousel .carousel-control-next {
    right: -2vw;
  }

  #menCarousel .carousel-control-prev-icon,
  #menCarousel .carousel-control-next-icon {
    background-size: 70% 70%;
  }

  /* Remove outline on control click */
  #menCarousel .carousel-control-prev:focus,
  #menCarousel .carousel-control-next:focus {
    outline: none;
    box-shadow: none;
  }

  .footer {
    background: #f7f6f6;
    font-family: "Arial", sans-serif;
    font-size: 14px;
    letter-spacing: 0.5px;
  }

  .footer .footer-title {
    font-weight: 750;
    margin-bottom: 0.75rem;
  }

  .footer a {
    color: #333;
    text-decoration: none;
    display: block;
    margin-bottom: 0.5rem;
    transition: color 0.2s;
  }

  .footer a:hover {
    color: #000;
  }

  .footer .form-control {
    border-radius: 0;
    border-right: none;
    box-shadow: none;
  }

  .footer .input-group-text {
    background: #2a2a2a;
    color: #fff;
    border: none;
    border-radius: 0;
    font-size: 1.25rem;
    cursor: pointer;
    transition: background 0.2s;
  }

  .footer .input-group-text:hover {
    background: #000;
  }

  .footer-bottom {
    border-top: 1px solid #eee;
    margin-top: 2rem;
    padding-top: 1rem;
    font-size: 13px;
    color: #555;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
  }

  .footer-copyright {
    text-align: center;
    margin-top: 0.5rem;
    font-size: 13px;
    color: #555;
  }

  @media (max-width: 991.98px) {
    .footer .row>[class^="col-"] {
      margin-bottom: 2rem;
    }
  }

  @media (max-width: 767.98px) {
    .footer {
      font-size: 13px;
    }

    .footer .footer-title {
      margin-bottom: 0.5rem;
    }

    .footer-bottom {
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
    }
  }

  /* Remove input shadow on focus */
  .footer .form-control:focus {
    box-shadow: none;
    border-color: #ccc;
  }

  .cart-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.18);
    z-index: 2000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
  }

  .cart-modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
  }

  /* Modal Panel -- RIGHT SIDE */
  .cart-modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: auto;
    width: 400px;
    max-width: 100vw;
    background: #fff;
    box-shadow: -2px 0 24px rgba(0, 0, 0, 0.13);
    z-index: 2100;
    display: flex;
    flex-direction: column;
    transform: translateX(100%);
    transition: transform 0.35s cubic-bezier(0.68, -0.55, 0.27, 1.55);
  }

  .cart-modal-overlay.active .cart-modal {
    transform: translateX(0);
  }

  .cart-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 22px 24px 10px 24px;
    font-weight: 600;
    font-size: 1.2rem;
  }

  .cart-modal-close {
    background: none;
    border: none;
    font-size: 2rem;
    cursor: pointer;
    color: #333;
    line-height: 1;
  }

  .cart-items-list {
    padding: 0 24px;
    flex: 0 0 auto;
  }

  .cart-item {
    display: flex;
    gap: 16px;
    margin-bottom: 18px;
    align-items: flex-start;
  }

  .cart-item-img {
    width: 60px;
    height: 76px;
    object-fit: cover;
    border-radius: 3px;
    border: 1px solid #f1f1f1;
    background: #fafafa;
  }

  .cart-item-details {
    flex: 1;
    min-width: 0;
  }

  .cart-item-title {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 2px;
    color: #222;
    line-height: 1.3;
    white-space: normal;
  }

  .cart-item-meta {
    font-size: 0.85rem;
    color: #767676;
    margin-bottom: 3px;
  }

  .cart-item-pricing {
    font-size: 0.93rem;
    margin-bottom: 7px;
  }

  .cart-item-oldprice {
    color: #aaa;
    text-decoration: line-through;
    margin-right: 6px;
  }

  .cart-item-newprice {
    color: #222;
    font-weight: 600;
    margin-right: 6px;
  }

  .cart-item-discount {
    color: #e44a2d;
    font-size: 0.93rem;
    font-weight: 500;
  }

  .cart-item-actions {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .cart-qty-btn {
    border: 1px solid #ccc;
    background: #fff;
    color: #222;
    width: 26px;
    height: 26px;
    border-radius: 2px;
    font-size: 1.1rem;
    cursor: pointer;
    font-weight: 500;
  }

  .cart-qty-value {
    min-width: 18px;
    text-align: center;
    font-weight: 500;
    font-size: 1rem;
    margin: 0 2px;
  }

  .cart-item-remove {
    background: none;
    border: none;
    cursor: pointer;
    color: #aaa;
    margin-left: 12px;
    padding: 2px;
    transition: color 0.18s;
  }

  .cart-item-remove:hover {
    color: #e44a2d;
  }

  /* Upsell section */
  .cart-upsell-section {
    margin: 16px 0 0 0;
    padding: 0 24px;
  }

  .cart-upsell-title {
    font-size: 1rem;
    font-weight: 600;
    color: #222;
    margin-bottom: 8px;
  }

  .cart-upsell-box {
    border: 1px solid #e5e5e5;
    border-radius: 4px;
    background: #fafafa;
    display: flex;
    align-items: center;
    padding: 12px;
    gap: 14px;
    margin-bottom: 8px;
  }

  .cart-upsell-img {
    width: 56px;
    height: 56px;
    object-fit: cover;
    border-radius: 2px;
    border: 1px solid #f1f1f1;
    background: #fafafa;
  }

  .cart-upsell-details {
    flex: 1;
    min-width: 0;
  }

  .cart-upsell-title2 {
    font-size: 1rem;
    font-weight: 500;
    color: #222;
    line-height: 1.25;
  }

  .cart-upsell-meta {
    font-size: 0.88rem;
    color: #767676;
    margin-bottom: 2px;
  }

  .cart-upsell-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 6px;
  }

  .cart-upsell-price {
    font-size: 1rem;
    color: #222;
    font-weight: 500;
  }

  .cart-upsell-add {
    background: #222;
    color: #fff;
    border: none;
    border-radius: 2px;
    padding: 7px 22px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.15s;
  }

  .cart-upsell-add:hover {
    background: #444;
  }

  /* Dots for upsell carousel (static) */
  .cart-upsell-dots {
    display: flex;
    gap: 4px;
    margin-top: 4px;
    justify-content: flex-start;
    padding-left: 4px;
  }

  .cart-upsell-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #ddd;
    display: inline-block;
  }

  .cart-upsell-dot.active {
    background: #444;
  }

  /* Cart Footer */
  .cart-modal-footer {
    margin-top: auto;
    background: linear-gradient(0deg,
        #f5f5f5 70%,
        rgba(245, 245, 245, 0) 100%);
    padding: 18px 24px 10px 24px;
    border-top: 1px solid #ececec;
    box-shadow: 0 -4px 16px -8px rgba(0, 0, 0, 0.05);
  }

  .cart-subtotal-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 13px;
    color: #222;
  }

  .cart-checkout-btn {
    width: 100%;
    background: #222;
    color: #fff;
    border: none;
    border-radius: 2px;
    font-size: 1.13rem;
    padding: 13px 0;
    font-weight: 600;
    margin-bottom: 7px;
    cursor: pointer;
    letter-spacing: 0.05em;
    transition: background 0.15s;
  }

  .cart-checkout-btn:hover {
    background: #444;
  }

  .cart-footer-note {
    font-size: 0.93rem;
    color: #888;
    text-align: center;
    margin-top: 2px;
  }

  @media (max-width: 500px) {
    .cart-modal {
      width: 100vw;
    }
  }
</style>

<body>
  <div class="top-bar d-flex justify-content-center align-items-center">
    <p class="m-0">
      Get early access on launches and offers.
      <a href="#">Sign Up For Texts →</a>
    </p>
  </div>

  <div class="main-header text-center my-3">
    <h1>Men’s Day</h1>
  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- Left: Menu -->
      <div class="d-flex align-items-center gap-4">
        <a class="nav-link active" href="../Landing Page/Landing Page Men's Day.php">Home</a>
        <a class="nav-link " href="../About Us Page/About us.php">About</a>
        <a class="nav-link" href="../subTops/Tops Sub-Categories.php">Products</a>
        <?php
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
                echo '<a class="nav-link" href="../Admin Page/account_management.php">Admin</a>'; // Assuming your admin page is in an 'admin' folder
            }
            ?>
      </div>

      <div class="d-flex align-items-center gap-4">
        <a href="#">
          <img src="https://cdn-icons-png.flaticon.com/512/54/54481.png" width="24" alt="Search" />
        </a>
        <a href="../Login Page/login.html">
          <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" width="24" alt="Profile" />
        </a>
        <a href="#" id="cartIcon">
          <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" width="24" alt="Cart" />
        </a>
      </div>
    </div>
  </nav>

  <div class="category-bar">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link" href="../subTops/Tops Sub-Categories.php">Tops</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subBottoms/Bottoms Sub-Categories.php">Bottoms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subOutwear/Outerwear Sub-Categories.php">Outerwear</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subFootwear/Footwear Sub-Categories.php">Footwear</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subAccessories/Accessories Sub-Categories.php">Accessories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#discountModal">Discounts</a>
      </li>
    </ul>
  </div>

  <!-- Discount Modal -->
  <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow-lg rounded-4">
        <div class="modal-header bg-dark text-white rounded-top-4">
          <h5 class="modal-title" id="discountModalLabel">
            🎉 Exclusive Discounts
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4" style="background-color: #f8f9fa">
          <p class="mb-4" style="font-size: 1.1em; color: #333">
            Check out our latest deals and coupons to save on your favorite
            outfits!
          </p>
          <ul class="list-group">
            <li
              class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 mb-2 rounded shadow-sm">
              <span style="color: #212529">10% off with code <strong>DISCOUNT10</strong></span>
              <button class="btn btn-sm" style="background-color: black; color: white"
                onclick="copyToClipboard('DISCOUNT10')">
                Copy Code
              </button>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 mb-2 rounded shadow-sm">
              <span style="color: #212529">20% off with code <strong>DISCOUNT20</strong></span>
              <button class="btn btn-sm" style="background-color: black; color: white"
                onclick="copyToClipboard('DISCOUNT20')">
                Copy Code
              </button>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 rounded shadow-sm">
              <span style="color: #212529">30% off with code <strong>DISCOUNT30</strong></span>
              <button class="btn btn-sm" style="background-color: black; color: white"
                onclick="copyToClipboard('DISCOUNT30')">
                Copy Code
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <section class="hero" style="background-image: url('landing-background.png')">
    <div class="hero-overlay text-white" style="background-color: rgba(0, 0, 0, 0.18)">
      <h1>Your Cozy Era</h1>
      <p>Get peak comfy-chic with new winter essentials.</p>
      <button class="btn btn-shop">Shop Now</button>
    </div>
  </section>
  <div class="container">
    <div class="shop-category-title">Shop by Category</div>
    <div class="category-grid mb-5 mx-auto">
      <div>
        <img src="Tops.png" class="category-img" alt="Tops" />
        <div class="category-label">TOPS</div>
      </div>
      <div>
        <img src="Bottoms.png" class="category-img" alt="Bottoms" />
        <div class="category-label">BOTTOMS</div>
      </div>
      <div>
        <img src="Outerwear.png" class="category-img" alt="Outerwear" />
        <div class="category-label">OUTERWEAR</div>
      </div>
      <div>
        <img src="Footwear.png" class="category-img" alt="Footwear" />
        <div class="category-label">FOOTWEAR</div>
      </div>
      <div>
        <img src="Accessories.png" class="category-img" alt="Accessories" />
        <div class="category-label">ACCESSORIES</div>
      </div>
    </div>

    <!-- FEATURED GRID -->
    <div class="row featured-grid justify-content-center">
      <div class="col-12 col-md-4 mb-4 mb-md-0">
        <div class="featured-card" onclick="window.location='#';">
          <img src="New Arrivals.png" alt="New Arrivals" />
          <div class="featured-overlay">
            <div class="featured-title">New Arrivals</div>
            <button class="btn featured-btn">SHOP THE LATEST</button>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 mb-4 mb-md-0">
        <div class="featured-card" onclick="window.location='#';">
          <img src="Best-Sellers.png" alt="Best Sellers" />
          <div class="featured-overlay">
            <div class="featured-title">Best-Sellers</div>
            <button class="btn featured-btn">SHOP YOUR FAVORITES</button>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="featured-card" onclick="window.location='#';">
          <img src="The Holiday Outfit.png" alt="The Holiday Outfit" />
          <div class="featured-overlay">
            <div class="featured-title">The Holiday Outfit</div>
            <button class="btn featured-btn">SHOP OCCASION</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid my-5 px-0">
    <div class="impact-banner d-flex align-items-center justify-content-center">
      <div class="text-center w-100 banner-content">
        <h2 class="text-white mb-3">
          We’re on a Mission To Clean Up the Industry
        </h2>
        <div class="text-white mb-4 fs-5">
          Read about our progress in our latest Impact Report.
        </div>
        <a href="#" class="btn banner-btn">LEARN MORE</a>
      </div>
    </div>
  </div>
  <br />
  <br />

  <div class="container my-5">
    <div class="text-center mb-2" style="font-size: 2rem; font-weight: 500">
      Men’s Day Favorites
    </div>
    <div class="text-center mb-4" style="font-size: 1.08rem; color: black">
      Beautifully Functional. Purposefully Designed. Consciously Crafted.
    </div>

    <div id="favoritesCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <!-- First Carousel Item (Active) -->
        <div class="carousel-item active">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite1.png" class="card-img-top" alt="The Waffle Long-Sleeve Crew" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">
                    The Waffle Long-Sleeve Crew
                  </div>
                  <div class="text-muted small mb-1">Bone</div>
                  <div class="fw-semibold">$60</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite2.png" class="card-img-top" alt="The Bomber Jacket | Uniform" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">
                    The Bomber Jacket | Uniform
                  </div>
                  <div class="text-muted small mb-1">Toasted Coconut</div>
                  <div class="fw-semibold">$148</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite3.png" class="card-img-top" alt="The Slim 4-Way Stretch Organic Jean | Uniform" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">
                    The Slim 4-Way | Uniform
                  </div>
                  <div class="text-muted small mb-1">Dark Indigo</div>
                  <div class="fw-semibold">$98</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite4.png" class="card-img-top" alt="The Essential Organic Crew" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">
                    The Essential Organic Crew
                  </div>
                  <div class="text-muted small mb-1">Vintage Black</div>
                  <div class="fw-semibold">$30</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite5.png" class="card-img-top" alt="The Heavyweight" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Heavyweight</div>
                  <div class="text-muted small mb-1">Heathered Brown</div>
                  <div class="fw-semibold">$30</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Second Carousel Item -->
        <div class="carousel-item">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite6.jpg" class="card-img-top" alt="The Lightweight Hoodie" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Lightweight Hoodie</div>
                  <div class="text-muted small mb-1">Charcoal Grey</div>
                  <div class="fw-semibold">$50</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite7.jpg" class="card-img-top" alt="The Classic T-Shirt" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Classic T-Shirt</div>
                  <div class="text-muted small mb-1">White</div>
                  <div class="fw-semibold">$25</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite8.jpg" class="card-img-top" alt="The Quilted Vest" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Quilted Vest</div>
                  <div class="text-muted small mb-1">Olive Green</div>
                  <div class="fw-semibold">$120</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite9.jpg" class="card-img-top" alt="The Cargo Pants" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Cargo Pants</div>
                  <div class="text-muted small mb-1">Navy Blue</div>
                  <div class="fw-semibold">$70</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite10.jpg" class="card-img-top" alt="The Zip-Up Hoodie" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Zip-Up Hoodie</div>
                  <div class="text-muted small mb-1">Dark Grey</div>
                  <div class="fw-semibold">$55</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Add 8 more carousel items as needed -->
        <div class="carousel-item">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite11.jpg" class="card-img-top" alt="The Casual Shirt" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Casual Shirt</div>
                  <div class="text-muted small mb-1">Sky Blue</div>
                  <div class="fw-semibold">$40</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite12.jpg" class="card-img-top" alt="The Running Shorts" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Running Shorts</div>
                  <div class="text-muted small mb-1">Black</div>
                  <div class="fw-semibold">$28</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite13.jpg" class="card-img-top" alt="The Hiking Boots" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Hiking Boots</div>
                  <div class="text-muted small mb-1">Dark Brown</div>
                  <div class="fw-semibold">$135</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite14.jpg" class="card-img-top" alt="The Denim Jacket" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Denim Jacket</div>
                  <div class="text-muted small mb-1">Light Wash</div>
                  <div class="fw-semibold">$95</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite15.jpg" class="card-img-top" alt="The Wool Sweater" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Wool Sweater</div>
                  <div class="text-muted small mb-1">Forest Green</div>
                  <div class="fw-semibold">$80</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite16.jpg" class="card-img-top" alt="The Everyday Polo" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Everyday Polo</div>
                  <div class="text-muted small mb-1">Slate Blue</div>
                  <div class="fw-semibold">$45</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite17.jpg" class="card-img-top" alt="The Lounge Jogger" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Lounge Jogger</div>
                  <div class="text-muted small mb-1">Heather Grey</div>
                  <div class="fw-semibold">$55</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite18.jpg" class="card-img-top" alt="The Linen Shorts" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Linen Shorts</div>
                  <div class="text-muted small mb-1">Khaki</div>
                  <div class="fw-semibold">$38</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite19.jpg" class="card-img-top" alt="The Travel Blazer" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Travel Blazer</div>
                  <div class="text-muted small mb-1">Charcoal</div>
                  <div class="fw-semibold">$160</div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0 h-100">
                <img src="favorite20.jpg" class="card-img-top" alt="The Flannel Shirt" />
                <div class="card-body p-2 pb-0">
                  <div class="fw-semibold small">The Flannel Shirt</div>
                  <div class="text-muted small mb-1">Red Plaid</div>
                  <div class="fw-semibold">$65</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="3"
            aria-label="Slide 4"></button>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#favoritesCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#favoritesCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="container my-5">
      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row align-items-center">
              <div class="col-md-6 p-5">
                <h6>People Are Talking</h6>
                <div class="stars mb-3">★★★★★</div>
                <p class="fs-5">
                  “Love this shirt! Fits perfectly and the fabric is thick
                  without being stiff.”
                </p>
                <p class="mt-4">
                  -- JonSnSF,
                  <a href="#" style="color: black">The Heavyweight Overshirt</a>
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img src="Reviews.png" class="img-fluid rounded fixed-size-img" alt="Overshirt Image" />
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row align-items-center">
              <div class="col-md-6 p-5">
                <h6>What Our Customers Are Saying</h6>
                <div class="stars mb-3">★★★★★</div>
                <p class="fs-5">
                  “The fit is amazing, and the material feels so premium. Will
                  definitely buy more!”
                </p>
                <p class="mt-4">
                  -- SarahLee,
                  <a href="#" style="color: black">The Luxe T-Shirt</a>
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img src="Reviews1.png" class="img-fluid rounded fixed-size-img" alt="Luxe T-Shirt Image" />
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row align-items-center">
              <div class="col-md-6 p-5">
                <h6>Customer Feedback</h6>
                <div class="stars mb-3">★★★★★</div>
                <p class="fs-5">
                  “Absolutely in love with my purchase. The quality is
                  top-notch and the design is stylish.”
                </p>
                <p class="mt-4">
                  -- MikeR,
                  <a href="#" style="color: black">The Designer Hoodie</a>
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img src="Reviews2.png" class="img-fluid rounded fixed-size-img" alt="Designer Hoodie Image" />
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row align-items-center">
              <div class="col-md-6 p-5">
                <h6>What Our Fans Are Saying</h6>
                <div class="stars mb-3">★★★★★</div>
                <p class="fs-5">
                  “The fit is just perfect for me. Great value for the money,
                  and it’s comfy!”
                </p>
                <p class="mt-4">
                  -- EmilyK,
                  <a href="#" style="color: black">The Classic Hoodie</a>
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img src="Reviews3.png" class="img-fluid rounded fixed-size-img" alt="Classic Hoodie Image" />
              </div>
            </div>
          </div>
        </div>

        <div id="carouselExampleDark" class="carousel carousel-dark slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active"
              aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"
              aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"
              aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="3"
              aria-label="Slide 4"></button>
          </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
      </div>
    </div>

    <div class="container text-center">
      <div class="divider"></div>

      <div class="row align-items-center">
        <div class="col-md-6 mb-4">
          <h5>Our Holiday Gift Picks</h5>
          <br />
          <img src="Our Holiday Picks.png" alt="Holiday Gift Picks" class="img-fluid image-card rounded" />
          <p class="subtitle">The best presents for everyone on your list.</p>
          <a href="#" style="color: black">Read More</a>
        </div>

        <div class="col-md-6 mb-4">
          <h5>Cleaner Fashion</h5>
          <br />
          <img src="Cleaner Fashion.png" alt="Cleaner Fashion" class="img-fluid image-card rounded" />
          <p class="subtitle">
            See the sustainability efforts behind each of our products.
          </p>
          <a href="#" style="color: black">Learn More</a>
        </div>
      </div>
      <div class="divider"></div>
    </div>

    <div class="container text-center my-5">
      <h3 class="black-text">Men’s Day On You</h3>
      <p class="subtitle">
        Share your latest look with <strong>#EverLaneOnYou</strong> for a
        chance to be featured.<br />
        <a href="#" class="btn-link">Add Your Photo</a>
      </p>

      <div id="menCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <!-- First Carousel Item (Page 1) -->
          <div class="carousel-item active">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-0">
              <!-- Product Card 1 -->
              <div class="col">
                <div class="card">
                  <img src="Features1.png" class="card-img-top" alt="The Waffle Long-Sleeve Crew" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 2 -->
              <div class="col">
                <div class="card">
                  <img src="Features2.png" class="card-img-top" alt="The Bomber Jacket | Uniform" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 3 -->
              <div class="col">
                <div class="card">
                  <img src="Features3.png" class="card-img-top" alt="Product 3" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 4 -->
              <div class="col">
                <div class="card">
                  <img src="Features4.png" class="card-img-top" alt="Product 4" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 5 -->
              <div class="col">
                <div class="card">
                  <img src="Features5.png" class="card-img-top" alt="Product 5" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Second Carousel Item (Page 2) -->
          <div class="carousel-item">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-0">
              <!-- Product Card 6 -->
              <div class="col">
                <div class="card">
                  <img src="Features6.jpg" class="card-img-top" alt="Product 6" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 7 -->
              <div class="col">
                <div class="card">
                  <img src="Features7.jpg" class="card-img-top" alt="Product 7" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 8 -->
              <div class="col">
                <div class="card">
                  <img src="Features8.jpg" class="card-img-top" alt="Product 8" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 9 -->
              <div class="col">
                <div class="card">
                  <img src="Features9.jpg" class="card-img-top" alt="Product 9" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Product Card 10 -->
              <div class="col">
                <div class="card">
                  <img src="Features10.jpg" class="card-img-top" alt="Product 10" />
                  <div class="cart-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 0 0 7 17h10a1 1 0 0 0 .95-1.3L17 13M7 13L5.4 5M17 13l1.6-8M9 21a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="carouselExampleDark" class="carousel carousel-dark slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active"
              aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"
              aria-label="Slide 2"></button>
          </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#menCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#menCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="row text-center g-4">
      <div class="col-md-4">
        <img src="box.png" width="40" alt="Shipping Icon" />
        <h6 class="mt-2 black-text">Complimentary Shipping</h6>
        <p class="small-text">
          Enjoy free shipping on Philippines orders over $100.
        </p>
      </div>
      <div class="col-md-4">
        <img src="recycle.png" width="40" alt="Conscious Icon" />
        <h6 class="mt-2 black-text">Consciously Crafted</h6>
        <p class="small-text">Designed with you and the planet in mind.</p>
      </div>
      <div class="col-md-4">
        <img src="marker.png" width="40" alt="Location Icon" />
        <h6 class="mt-2 black-text">Come Say Hi</h6>
        <p class="small-text">
          938 Aurora Boulevard, Cubao, Quezon City 1109 Quezon City Metro
          Manila
        </p>
      </div>
    </div>
  </div>

  <!-- Cart Modal Overlay & Panel -->
  <div class="cart-modal-overlay" id="cartModalOverlay">
    <aside class="cart-modal" id="cartModal" tabindex="-1" aria-modal="true">
      <!-- Modal Header -->
      <div class="cart-modal-header">
        <div class="cart-modal-title">Your Cart</div>
        <button class="cart-modal-close" id="cartModalClose" aria-label="Close">
          &times;
        </button>
      </div>
      <!-- Cart Modal -->
      <div class="cart-modal-overlay" id="cartModalOverlay">
        <aside class="cart-modal" id="cartModal" tabindex="-1" aria-modal="true">
          <div class="cart-modal-header">
            <div class="cart-modal-title">Your Cart</div>
            <button class="cart-modal-close" id="cartModalClose" aria-label="Close">&times;</button>
          </div>
          <div class="cart-items-list" id="cartItemsList"></div>
          <div class="cart-modal-footer">
            <div class="cart-coupon-row" style="display:flex;gap:8px;margin-bottom:15px;">
              <input type="text" id="cartCouponInput" class="form-control" placeholder="Enter coupon code"
                style="flex:1;">
              <button id="applyCouponBtn" class="btn" type="button" style="background-color: black; color: white;">Apply
                Coupon</button>
            </div>
            <div id="cartCouponMsg" style="min-height:22px;font-size:0.95em;color:#2d7a2d;margin-bottom:10px;"></div>
            <div class="cart-subtotal-row">
              <span id="cartSubtotalLabel">Subtotal (0 items)</span>
              <span id="cartSubtotalAmount">$0</span>
            </div>
            <button class="cart-checkout-btn">CONTINUE TO CHECKOUT</button>
            <div class="cart-footer-note">Psst, get it now before it sells out.</div>
          </div>
        </aside>
      </div>

  </div>

  <div class="container">
    <div class="row justify-content-between align-items-start">
      <!-- Account -->
      <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
        <div class="footer-title">Acount</div>
        <a href="#">Log In</a>
        <a href="#">Sign Up</a>
        <a href="#">Redeem a Gift Card</a>
      </div>
      <!-- Company -->
      <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
        <div class="footer-title">Company</div>
        <a href="#">About</a>
        <a href="#">Environmental Initiatives</a>
        <a href="#">Factories</a>
        <a href="#">DEI</a>
        <a href="#">Careers</a>
        <a href="#">International</a>
        <a href="#">Accessibility</a>
      </div>
      <!-- Get Help -->
      <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
        <div class="footer-title">Get Help</div>
        <a href="#">Help Center</a>
        <a href="#">Return Policy</a>
        <a href="#">Shipping Info</a>
        <a href="#">Bulk Orders</a>
      </div>
      <!-- Connect -->
      <div class="col-12 col-sm-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
        <div class="footer-title">Connect</div>
        <a href="#">Facebook</a>
        <a href="#">Instagram</a>
        <a href="#">Twitter</a>
        <a href="#">Affiliates</a>
        <a href="#">Out Stores</a>
      </div>
      <!-- Newsletter -->
      <div class="col-12 col-lg-4">
        <form>
          <div class="input-group mt-2 mt-lg-0">
            <input type="email" class="form-control" placeholder="Email Address" aria-label="Email" />
            <button class="input-group-text" type="submit" aria-label="Subscribe">
              &#8594;
            </button>
          </div>
        </form>
      </div>
    </div>



    <footer class="footer py-5">
      <!-- Bottom links -->
      <div class="footer-bottom mt-4">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Do Not Sell or Share My Personal Information</a>
        <a href="#">CS Supply Chain Transparency</a>
        <a href="#">Vendor Code of Conduct</a>
        <a href="#">Sitemap Pages</a>
        <a href="#">Sitemap Products</a>
      </div>
      <div class="footer-copyright">&copy; 2023 All Rights Reserved</div>
  </div>
  </footer>

  <script>
    const cartIcon = document.getElementById("cartIcon");
    const cartModalOverlay = document.getElementById("cartModalOverlay");
    const cartModalClose = document.getElementById("cartModalClose");
    // Open modal
    cartIcon.addEventListener("click", function (e) {
      e.preventDefault();
      cartModalOverlay.classList.add("active");
      document.body.style.overflow = "hidden";
    });
    // Close modal
    function closeCartModal() {
      cartModalOverlay.classList.remove("active");
      document.body.style.overflow = "";
    }
    cartModalClose.addEventListener("click", closeCartModal);
    cartModalOverlay.addEventListener("click", function (e) {
      if (e.target === cartModalOverlay) closeCartModal();
    });
    // Optional: ESC key to close
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") closeCartModal();
    });
  </script>
</body>

</html>