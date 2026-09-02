<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Men's Day</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="search.css" />
  <link rel="stylesheet" href="cart-sidebar.css" />
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
        <a class="nav-link active" href="../Landing Page/Landing Page Men's Day.html ">Home</a>
        <a class="nav-link" href="#">About</a>
        <a class="nav-link" href="#">Stories</a>
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
        <a class="nav-link" href="../subTops/Tops Sub-Categories.html">Tops</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subBottoms/Bottoms Sub-Categories.html">Bottoms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subOutwear/Outerwear Sub-Categories.html">Outerwear</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subFootwear/Footwear Sub-Categories.html">Footwear</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subAccessories/Accessories Sub-Categories.html">Accessories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="#">Discounts</a>
      </li>
    </ul>
  </div>

  <!-- Search Bars -->
  <div class="search-bar">
    <input type="text" placeholder="Popular Tops" />
    <span class="cancel-text">Cancel</span>
  </div>

  <!-- Popular Tops Section -->
  <div class="container popular-tops my-5">
    <h5>“Popular Tops”</h5>
    <div class="row text-center mt-4">
      <div class="col">
        <a href="#">
          <img src="../images/T-shirt.png" class="img-fluid" alt="T-shirt" />
          <div>T-shirts</div>
        </a>
      </div>
      <div class="col">
        <a href="#">
          <img src="../images/Shirts.png" class="img-fluid" alt="Shirt" />
          <div>Shirts</div>
        </a>
      </div>
      <div class="col">
        <a href="#">
          <img src="../images/hoodies.png" class="img-fluid" alt="Hoodie" />
          <div>Hoodies</div>
        </a>
      </div>
      <div class="col">
        <a href="#">
          <img src="../images/Polo Shirt.png" class="img-fluid" alt="Polo Shirt" />
          <div>Polo Shirts</div>
        </a>
      </div>
      <div class="col">
        <a href="#">
          <img src="../images/Sweaters.png" class="img-fluid" alt="Sweater" />
          <div>Sweaters</div>
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script for this search page -->
  <script src="search.js"></script>
</body>

</html>