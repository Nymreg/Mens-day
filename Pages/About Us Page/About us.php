<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Men's Day</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="About Us.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </head>

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
      <div class="d-flex align-items-center gap-4 ms-0 ">
        <a class="nav-link" href="../Landing Page/Landing Page Men's Day.php">
          Home
        </a>
        <a class="nav-link active" href="../About Us Page/About us.php">
          About
        </a>
        <a class="nav-link" href="../subTops/Tops Sub-Categories.php">
          Products
        </a>
      </div>

      <!-- Spacer -->
      <div class="flex-grow-1"></div>

      <!-- Right: Icons -->
      <div class="ms-0 d-flex align-items-center gap-4">
        <a href="#">
          <img src="https://cdn-icons-png.flaticon.com/512/54/54481.png" width="24" alt="Search" />
        </a>
        <a href="../Login Page/login.php">
          <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" width="24" alt="Profile" />
        </a>
        <a href="#" id="cartIcon">
          <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" width="24" alt="Cart" />
        </a>
      </div>
  </nav>

  <div class="category-bar">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link" href="../subTops/Tops Sub-Categories.php">
          Tops
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subBottoms/Bottoms Sub-Categories.php">
          Bottoms
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subOutwear/Outerwear Sub-Categories.php">
          Outerwear
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subFootwear/Footwear Sub-Categories.php">
          Footwear
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subAccessories/Accessories Sub-Categories.php">
          Accessories
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#discountModal">
          Discounts
        </a>
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
              <span style="color: #212529">
                10% off with code <strong>DISCOUNT10</strong>
              </span>
              <button class="btn btn-sm" style="background-color: black; color: white"
                onclick="copyToClipboard('DISCOUNT10')">
                Copy Code
              </button>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 mb-2 rounded shadow-sm">
              <span style="color: #212529">
                20% off with code <strong>DISCOUNT20</strong>
              </span>
              <button class="btn btn-sm" style="background-color: black; color: white"
                onclick="copyToClipboard('DISCOUNT20')">
                Copy Code
              </button>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 rounded shadow-sm">
              <span style="color: #212529">
                30% off with code <strong>DISCOUNT30</strong>
              </span>
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

  <section class="hero"
    style="position: relative; background: url('man1.jpg') no-repeat center center; background-size: cover; height: 90vh; width: 110%;">

    <h1>
      We Believe<br />
      we can all<br />
      make a difference.
    </h1>
    <p>
      Our way: Exceptional quality. Ethical factories. Radical Transparency.
    </p>
  </section>

  <section class="about-section">
    <h2>Who We Are</h2>
    <p style="font-size: 1.5rem">
      We believe fashion is more than just clothing.<br />
      It’s a statement, an expression, and a journey.<br />
      At Men’s Day, we make trends that don’t just<br />follow the crowd but
      define it. From<br />
      timeless classics to bold, cutting-edge designs, <br />our collections
      are crafted for those who wear their<br />
      personality with pride. Because true style isn’t<br />
      just about what you put on—it’s about the<br />
      confidence you carry. <strong>“Own it.”</strong>
    </p>
  </section>

  <section class="factories-section">
    <div class="content-wrapper">
      <div class="image-container">
        <img src="MeasureChest.png" alt="Premium clothing factory" />
      </div>
      <div class="text-container">
        <h4>Our Factories</h4>
        <h2>We trust only the best.</h2>
        <p>
          We don't just source factories — we craft relationships with
          artisans and innovators who share our obsession with quality. Every
          button, seam, and fabric is a testament to rigorous selection,
          ethical standards, and uncompromising craftsmanship. Because the
          right factory doesn't just make your product — it elevates the
          brand.
        </p>
      </div>
    </div>
  </section>

  <section class="full-width-image">
    <img src="stock3.jpg" alt="Fashion banner" />
  </section>

  <section class="quality-section">
    <div class="content-wrapper">
      <div class="text-container">
        <h4>Our Quality</h4>
        <h2>Quality Woven into Every Fiber</h2>
        <p>
          We don't just create fashion we craft enduring style. Every fabric
          is handpicked, every stitch perfected, and every detail scrutinized
          because quality isn't a step in our process it's the foundation.
          Wear confidence. Wear longevity. Wear craftsmanship that speaks
          before you do.
        </p>
      </div>
      <div class="image-container">
        <img src="hanged.jpg" alt="Premium clothing factory" />
      </div>
    </div>
  </section>

  <section class="full-width-image">
    <img src="mens.jpg" alt="Fashion banner" />
  </section>

  <section class="prices-section">
    <div class="content-wrapper">
      <div class="image-container">
        <img src="Prices.png" alt="Premium clothing factory" />
      </div>
      <div class="text-container">
        <h4>Our Prices</h4>
        <h2>For Affordable Luxury</h2>
        <p>
          Luxury shouldn't demand a ransom. We craft premium style with
          purposeful pricing so excellence is accessible, not exclusive.Pay
          for the planet, not just the product. Our prices reflect ethical
          choices so your style leaves a legacy, not a footprint
        </p>
      </div>
    </div>
  </section>

  <section class="developers-section">
    <h2>Meet Our Developers</h2>
    <div id="developersCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <!-- First group of 3 -->
        <div class="carousel-item active">
          <div class="developer-group">
            <div class="developer-card">
              <img src="../About Us Page/494833143_1230917778622606_4336128861489178075_n.jpg" alt="Developer 1" />
              <h5>Alvin Kent Dela Cruz</h5>
              <p>Lead Developer</p>
            </div>
            <div class="developer-card">
              <img src="../About Us Page/55447156-597b-4c40-8ac2-ade0f91aa135-removebg-preview.png" alt="Developer 2" />
              <h5>Ian Darick S Alcantara</h5>
              <p>Frontend Specialist</p>
            </div>
            <div class="developer-card">
              <img src="../About Us Page/494686325_706243461748092_6007619534696893517_n.jpg" alt="Developer 3" />
              <h5>John Rex Aspiras</h5>
              <p>Frontend Backend Developer</p>
            </div>
          </div>
        </div>

        <!-- Second group of 2 (since you have 5 total) -->
        <div class="carousel-item">
          <div class="developer-group">
            <div class="developer-card">
              <img src="../About Us Page/494689648_2075858322922021_7003184961924938818_n.jpg" alt="Developer 4" />
              <h5>Neo Ynigo Regalado</h5>
              <p>Frontend Backend Developer</p>
            </div>
            <div class="developer-card">
              <img src="../About Us Page/494870612_1582695535730533_282415889975796831_n.png" alt="Developer 5" />
              <h5>Gerald Tegio</h5>
              <p>Frontend Backend Developer</p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#developersCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#developersCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

  <section class="team-section">
    <h2 style="color: black;">More to Explore</h2>
    <div class="container">
      <div class="row">
        <div class="col-md-4 team-member">
          <div class="image-wrapper">
            <a href="../subTops/Tops Sub-Categories.php">
              <img src="clothes.jpg" alt="Products" />
            </a>
          </div>
          <h5><a href="../subTops/Tops Sub-Categories.php" style="color: black;">Our Products</a></h5>
        </div>
        <div class="col-md-4 team-member">
          <div class="image-wrapper">
            <a href="../Store Page/Stores.html">
              <img src="Stores.jpg" alt="Stores" />
            </a>
          </div>
          <h5><a href="../Stores Page/stores.html" style="color: black;">Our Stores</a></h5>
        </div>
        <div class="col-md-4 team-member">
          <div class="image-wrapper">
            <a href="../Landing Page/Landing Page Men's Day.php">
              <img src="career.jpg" alt="career" />
            </a>
          </div>
          <h5><a href="../subTops/Tops Sub-Categories.php" style="color: black;">Careers</a></h5>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer py-5">
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
</body>

</html>