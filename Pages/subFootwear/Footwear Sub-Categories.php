<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Men's Day</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="search.css" />
</head>

<body>
  <!-- Top black bar -->
  <div class="top-bar d-flex justify-content-center align-items-center">
    <p class="m-0">
      Get early access on launches and offers.
      <a href="#">Sign Up For Texts →</a>
    </p>
  </div>

  <!-- Main Header -->
  <div class="main-header text-center my-3">
    <h1>Men’s Day</h1>
  </div>

  <!-- Main Header with Left Menu and Right Icons -->
  <nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- Left: Menu -->
      <div class="d-flex align-items-center gap-4">
        <a class="nav-link" href="../Landing Page/Landing Page Men's Day.php ">Home</a>
        <a class="nav-link" href="../About Us Page/About us.php">About</a>
        <a class="nav-link active" href="../subTops/Tops Sub-Categories.php">Products</a>
      </div>

      <!-- Right: Icons -->
      <div class="d-flex align-items-center gap-4">
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/54/54481.png" width="24" alt="Search" /></a>
        <a href="../Login Page/login.html"><img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" width="24"
            alt="Profile" /></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" width="24" alt="Cart" /></a>
      </div>
    </div>
  </nav>

  <!-- Second Navbar (Categories) -->
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
        <a class="nav-link active" href="../subFootwear/Footwear Sub-Categories.php"
          style="text-decoration: underline">Footwear</a>
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

  <!-- Search Bar -->
  <div class="search-bar">
    <input type="text" placeholder="Popular Tops" />
    <span class="cancel-text">Cancel</span>
  </div>

  <!-- Popular Tops Section -->
  <div class="container popular-tops my-5">
    <h5>“Popular Footwear”</h5>
    <div class="row text-center mt-4">
      <div class="col">
        <a href="Sneakers Products/Sneakers page.php">
          <img src="Footwear1.png" class="img-fluid" alt="Sneakers" />
        </a>
        <div><a href="Sneakers Products/Sneakers page.php">Sneakers</a></div>
      </div>
      <div class="col">
        <a href="Boots Products/Boots page.php">
          <img src="Footwear2.png" class="img-fluid" alt="Boots" />
        </a>
        <div><a href="Boots Products/Boots page.php">Boots</a></div>
      </div>
      <div class="col">
        <a href="Sandals Products/Sandals page.php">
          <img src="Footwear3.png" class="img-fluid" alt="Sandals" />
        </a>
        <div><a href="Sandals Products/Sandals page.php">Sandals</a></div>
      </div>
      <div class="col">
        <a href="Slippers Products/Slippers page.php">
          <img src="Footwear4.png" class="img-fluid" alt="Slippers" />
        </a>
        <div><a href="Slippers Products/Slippers page.php">Slippers</a></div>
      </div>
      <div class="col">
        <a href="Dress Shoes Products/Dress Shoes page.php">
          <img src="Footwear5.png" class="img-fluid" alt="Dress Shoes" />
        </a>
        <div>
          <a href="Dress Shoes Products/Dress Shoes page.php">Dress Shoes</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Script for this search page -->
  <script src="../Search Page/search.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>