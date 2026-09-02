<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="about-us.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>
<link rel="stylesheet" href="ProDet.css" />

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
        <a class="nav-link" href="../About Us Page/About us.php">
          About
        </a>
        <a class="nav-link active" href="../subTops/Tops Sub-Categories.php">
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
        <a href="../Login Page/login.html">
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
        <a class="nav-link active" href="../subTops/Tops Sub-Categories.php">
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

  <section class="product-details-section">
    <div class="container my-5">
      <div class="row">
        <!-- First Column: Image Grid -->
        <div class="col-md-6">
          <div class="row g-2">
            <div class="col-6">
              <img src="hoodie1.jpg" class="img-fluid" alt="Product Image 1">
            </div>
            <div class="col-6">
              <img src="hoodie2.jpg" class="img-fluid" alt="Product Image 2">
            </div>
            <div class="col-6">
              <img src="hoodie3.jpg" class="img-fluid" alt="Product Image 3">
            </div>
            <div class="col-6">
              <img src="hoodie4.jpg" class="img-fluid" alt="Product Image 4">
            </div>
          </div>
        </div>

        <!-- Second Column: Product Details -->
        <div class="col-md-6">
          <h4>Multi-Color Hoodie</h4>
          <p class="price"></p>
          <span class="text-muted text-decoration-line-through">Php 3,995</span>
          <span class="current-price fw-bold">Php 2,995</span>
          <span class="discount text-danger">-25%</span>
          </p>

          <div class="mb-3">
            <label class="form-label">Color: Black / Dark Blue</label>
            <div class="d-flex gap-2"></div>
            <div class="color-square"
              style="width: 24px; height: 24px; background-color: black; border: 1px solid #ccc;"></div>
            <div class="color-square"
              style="width: 24px; height: 24px; background-color: rgb(0, 0, 49); border: 1px solid #ccc;"></div>
          </div>

          <hr>
          <p class="text-muted">
            S Delivery in 8 to 20 working days<br><br>
            M Delivery in 8 to 20 working days<br><br>
            L Delivery in 8 to 20 working days<br><br>
            XL Delivery in 8 to 20 working days<br><br>
            XXL Delivery in 8 to 20 working days
          </p>
          <hr>

          <div class="d-flex flex-column align-items-center">
            <button class="btn btn-dark mt-2 w-75" style="border-radius: 20px;">Add to Cart</button>
            <button class="btn btn-light mt-2 w-75" style="border: 1px solid gray; border-radius: 20px;">Buy
              Now</button>
          </div>

          <div class="additional-info mt-4">
            <p><strong>Free shipping</strong> on all around Philippines</p>
            <p><strong>Easy Returns:</strong> Extend returns on just one week upon delivery</p>
            <p><strong>Send it as a Gift:</strong> Add a free personalized note during checkout</p>
          </div>

          <div class="product-description mt-4">
            <h5>Description</h5>
            <p>
              Constructed from high-quality cotton fleece, this hoodie offers a perfect combination of comfort,<br>
              strength, and timeless style. Its reinforced seams and classic design make it a dependable<br>
              choice for everyday wear.
            </p>
          </div>

        </div>

        <!-- Recommended Products Section -->
        <div class="recommended-products text-center mt-5">
          <h3>Recommended Products</h3>
          <div class="row mt-4">
            <div class="col-md-4">
              <div class="card">
                <img src="Polo Shirt.png" class="card-img-top" alt="Product 1" style="width: 60%; margin: 0 auto;">
                <div class="card-body">
                  <h6 class="card-title">Polo Shirt</h6>
                  <p class="card-text">Php 1,995</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <img src="Sweaters.png" class="card-img-top" alt="Product 2" style="width: 60%; margin: 0 auto;">
                <div class="card-body">
                  <h6 class="card-title">Sweater</h6>
                  <p class="card-text">Php 2,495</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <img src="Shirts.png" class="card-img-top" alt="Product 3" style="width: 60%; margin: 0 auto;">
                <div class="card-body">
                  <h6 class="card-title">Shirt for men</h6>
                  <p class="card-text">Php 3,495</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Reviews Section -->
        <div class="reviews-section mt-5">
          <h3 class="text-center">Customer Reviews</h3>
          <div class="review mt-4">
            <p><strong>John Doe:</strong> "Amazing quality! The material feels premium and the fit is perfect. Highly
              recommend!"</p>
            <div class="stars">
              &#9733; &#9733; &#9733; &#9733; &#9733;
            </div>
          </div>
          <div class="review mt-3">
            <p><strong>Jane Smith:</strong> "Great product at a reasonable price. Delivery was quick and hassle-free."
            </p>
            <div class="stars">
              &#9733; &#9733; &#9733; &#9733; &#9734;
            </div>
          </div>
        </div>

        <div class="transparent-pricing text-center mt-5">
          <h4>Transparent Pricing</h4>
          <p style="text-align: center; text-indent: 2em;"></p>
          We publish what it costs us to make every one of our products. There are a lot of costs we can't neatly
          account for - like design, fittings, wear testing, rent on office and retail space - but we believe you
          deserve to know what goes into making the products you love.
          </p>
        </div>

        <div class="sustainability text-center mt-5">
          <h4>Sustainability</h4>
          <p style="text-align: center; text-indent: 2em;"></p>
          We are committed to making our products in a way that is good for the planet and the people who make them. We
          are working hard to reduce our carbon footprint and use more sustainable materials in our products.
          </p>

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
                      <input type="email" class="form-control" placeholder="Email Address" aria-label="Email">
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
              <div class="footer-copyright">
                &copy; 2023 All Rights Reserved
              </div>
            </div>
          </footer>
</body>

</html>