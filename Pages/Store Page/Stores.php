<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Stores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="About Us.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>
<link rel="stylesheet" href="Stores.css" />

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
        <a class="nav-link active" href="../../Landing Page/Landing Page Men's Day.php ">Home</a>
        <a class="nav-link" href="../About Us Page/About us.php">About</a>
        <a class="nav-link" href="../subTops/Tops Sub-Categories.php">Products</a>
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

  <section class="Store-section text-center">
    <p><br /></p>
    <h1>Stores</h1>
    <p style="font-size: 1.5rem">Find one of our 11 stores nearest you.</p>
  </section>
  <div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card h-100">
          <div class="card-img-container">
            <img src="store.webp" class="card-img-top" alt="Store 1" style="height: 300px; object-fit: cover" />
          </div>
          <div class="card-body">
            <h5 class="card-title">SM Mall of Asia</h5>
            <p class="card-text">
              Visit our flagship store located in the heart of the city.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-img-container">
            <img src="Store2.jpg" class="card-img-top" alt="Store 2" style="height: 300px; object-fit: cover" />
          </div>
          <div class="card-body">
            <h5 class="card-title">Bonifacio Global City</h5>
            <p class="card-text">
              Experience our premium collection at this location.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="Store3.jpg" class="card-img-top" alt="Store 3" style="height: 300px; object-fit: cover" />
          <div class="card-body">
            <h5 class="card-title">SM North Edsa</h5>
            <p class="card-text">
              Find exclusive deals and offers at this store.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="store4.jpg" class="card-img-top" alt="Store 4" style="height: 300px; object-fit: cover" />
          <div class="card-body">
            <h5 class="card-title">Gateway Cubao</h5>
            <p class="card-text">
              A perfect destination for all your fashion needs.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="store5.jpg" class="card-img-top" alt="Store 5" style="height: 300px; object-fit: cover" />
          <div class="card-body">
            <h5 class="card-title">SM Megamall</h5>
            <p class="card-text">
              Discover our latest arrivals at this location.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="Store6.webp" class="card-img-top" alt="Store 6" style="height: 300px; object-fit: cover" />
          <div class="card-body">
            <h5 class="card-title">Uptown Mall</h5>
            <p class="card-text">
              Enjoy a personalized shopping experience here.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="Store7.jpg" class="card-img-top" alt="Store 7" style="height: 300px; object-fit: cover" />
          <div class="card-body">
            <h5 class="card-title">Opus Mall</h5>
            <p class="card-text">
              Explore our wide range of products at this store.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="store8.jpg" class="card-img-top" alt="Store 8" style="height: 300px; object-fit: cover" />
          <div class="card-body">
            <h5 class="card-title">Trinoma</h5>
            <p class="card-text">
              Find the perfect outfit for any occasion here.
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="store9.avif" class="card-img-top" alt="Store 9" style="height: 300px; object-fit: cover" />
          <div class="card-body">
            <h5 class="card-title">Shangri-La Plaza</h5>
            <p class="card-text">
              Visit us for an unmatched shopping experience.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

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