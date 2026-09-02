<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Men's Day</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="Sandals page.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>
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
      <a class="nav-link active" href="../../Landing Page/Landing Page Men's Day.php">Home</a>
      <a class="nav-link" href="../../About Us Page/About us.php">About</a>
      <a class="nav-link" href="#">Stories</a>
    </div>

    <div class="d-flex align-items-center gap-4">
      <a href="../../Search Page/search.php">
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
      <a class="nav-link" href="../../subTops/Tops Sub-Categories.php">Tops</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../../subBottoms/Bottoms Sub-Categories.php">Bottoms</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../../subOutwear/Outerwear Sub-Categories.php">Outerwear</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../../subFootwear/Footwear Sub-Categories.php"
        style="text-decoration: underline;">Footwear</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../../subAccessories/Accessories Sub-Categories.php">Accessories</a>
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
        <h5 class="modal-title" id="discountModalLabel">🎉 Exclusive Discounts</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4" style="background-color: #f8f9fa;">
        <p class="mb-4" style="font-size: 1.1em; color: #333;">Check out our latest deals and coupons to save on your
          favorite outfits!</p>
        <ul class="list-group">
          <li
            class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 mb-2 rounded shadow-sm">
            <span style="color: #212529;">10% off with code <strong>DISCOUNT10</strong></span>
            <button class="btn btn-sm" style="background-color: black; color: white;"
              onclick="copyToClipboard('DISCOUNT10')">Copy Code</button>
          </li>
          <li
            class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 mb-2 rounded shadow-sm">
            <span style="color: #212529;">20% off with code <strong>DISCOUNT20</strong></span>
            <button class="btn btn-sm" style="background-color: black; color: white;"
              onclick="copyToClipboard('DISCOUNT20')">Copy Code</button>
          </li>
          <li
            class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 rounded shadow-sm">
            <span style="color: #212529;">30% off with code <strong>DISCOUNT30</strong></span>
            <button class="btn btn-sm" style="background-color: black; color: white;"
              onclick="copyToClipboard('DISCOUNT30')">Copy Code</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="header d-flex flex-column">
    <h6>Products</h6>
    <h2 style="font-weight: bold;">Sandals</h2>
    <h4>Featured</h4>
  </div>

  <div class="products">
    <div class="row">
      <div class="col-md-4">
        <div class="product-box" data-name="SolarisSlide Sandals" data-color="Black" data-image="sandals1.jpg"
          data-price="112">
          <div class="image-container">
            <img src="sandals1.jpg" alt="Image1" class="img-fluid" />
          </div>
          <div class="product-details">
            <div class="d-flex justify-content-between align-items-center"
              style="display:flex;justify-content:space-between;align-items:center;">
              <div>
                <h6>SolarisSlide Sandals</h6>
                <p class="text-muted">Black</p>
              </div>
              <h6>$112</h6>
            </div>
            <div class="button-group mt-3">
              <button class="btn btn-add-to-cart btn-sm w-100 mb-2">Add to Cart</button>
              <button class="btn btn-buy-now btn-sm w-100">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-box" data-name="DuneWander Sandals" data-color="Brown" data-image="sandals2.jpg"
          data-price="125">
          <div class="image-container">
            <img src="sandals2.jpg" alt="Image2" class="img-fluid" />
          </div>
          <div class="product-details">
            <div class="d-flex justify-content-between align-items-center"
              style="display:flex;justify-content:space-between;align-items:center;">
              <div>
                <h6>DuneWander Sandals</h6>
                <p class="text-muted">Brown</p>
              </div>
              <h6>$125</h6>
            </div>
            <div class="button-group mt-3">
              <button class="btn btn-add-to-cart btn-sm w-100 mb-2">Add to Cart</button>
              <button class="btn btn-buy-now btn-sm w-100">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-box" data-name="AeroStrap Sandals" data-color="Black" data-image="sandals3.jpg"
          data-price="101">
          <div class="image-container">
            <img src="sandals3.jpg" alt="Image3" class="img-fluid" />
          </div>
          <div class="product-details">
            <div class="d-flex justify-content-between align-items-center"
              style="display:flex;justify-content:space-between;align-items:center;">
              <div>
                <h6>AeroStrap Sandals</h6>
                <p class="text-muted">Black</p>
              </div>
              <h6>$101</h6>
            </div>
            <div class="button-group mt-3">
              <button class="btn btn-add-to-cart btn-sm w-100 mb-2">Add to Cart</button>
              <button class="btn btn-buy-now btn-sm w-100">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Second row -->
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="product-box" data-name="ZenithGlide Slides" data-color="Black" data-image="sandals4.jpg"
          data-price="115">
          <div class="image-container">
            <img src="sandals4.jpg" alt="Image4" class="img-fluid" />
          </div>
          <div class="product-details">
            <div class="d-flex justify-content-between align-items-center"
              style="display:flex;justify-content:space-between;align-items:center;">
              <div>
                <h6>ZenithGlide Slides</h6>
                <p class="text-muted">Black</p>
              </div>
              <h6>$115</h6>
            </div>
            <div class="button-group mt-3">
              <button class="btn btn-add-to-cart btn-sm w-100 mb-2">Add to Cart</button>
              <button class="btn btn-buy-now btn-sm w-100">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-box" data-name="TidalFlex Sandals" data-color="Black" data-image="sandals5.jpg"
          data-price="120">
          <div class="image-container">
            <img src="sandals5.jpg" alt="Image5" class="img-fluid" />
          </div>
          <div class="product-details">
            <div class="d-flex justify-content-between align-items-center"
              style="display:flex;justify-content:space-between;align-items:center;">
              <div>
                <h6>TidalFlex Sandals</h6>
                <p class="text-muted">Black</p>
              </div>
              <h6>$120</h6>
            </div>
            <div class="button-group mt-3">
              <button class="btn btn-add-to-cart btn-sm w-100 mb-2">Add to Cart</button>
              <button class="btn btn-buy-now btn-sm w-100">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-box" data-name="NomadAir Sandals" data-color="Black" data-image="sandals6.jpg"
          data-price="111">
          <div class="image-container">
            <img src="sandals6.jpg" alt="Image6" class="img-fluid" />
          </div>
          <div class="product-details">
            <div class="d-flex justify-content-between align-items-center"
              style="display:flex;justify-content:space-between;align-items:center;">
              <div>
                <h6>NomadAir Sandals</h6>
                <p class="text-muted">Black</p>
              </div>
              <h6>$111</h6>
            </div>
            <div class="button-group mt-3">
              <button class="btn btn-add-to-cart btn-sm w-100 mb-2">Add to Cart</button>
              <button class="btn btn-buy-now btn-sm w-100">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
          <input type="text" id="cartCouponInput" class="form-control" placeholder="Enter coupon code" style="flex:1;">
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

<script>
  // ---- Cart State ----
  const cart = [];

  // ---- Coupon State ----
  let appliedCoupon = null;
  let couponDiscount = 0;
  const coupons = {
    "DISCOUNT10": 10,
    "DISCOUNT20": 20,
    "DISCOUNT30": 30
  };

  // ---- DOM Elements ----
  const cartIcon = document.getElementById('cartIcon');
  const cartModalOverlay = document.getElementById('cartModalOverlay');
  const cartModalClose = document.getElementById('cartModalClose');
  const cartItemsList = document.getElementById('cartItemsList');
  const cartCount = document.getElementById('cartCount');
  const cartSubtotalAmount = document.getElementById('cartSubtotalAmount');
  const cartSubtotalLabel = document.getElementById('cartSubtotalLabel');
  const checkoutBtn = document.querySelector('.cart-checkout-btn');

  // ---- Coupon DOM ----
  const couponInput = document.getElementById('cartCouponInput');
  const applyCouponBtn = document.getElementById('applyCouponBtn');
  const couponMsg = document.getElementById('cartCouponMsg');

  // ---- Modal Open/Close ----
  cartIcon?.addEventListener('click', function (e) {
    e.preventDefault();
    cartModalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  });
  function closeCartModal() {
    cartModalOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }
  cartModalClose?.addEventListener('click', closeCartModal);
  cartModalOverlay.addEventListener('click', function (e) {
    if (e.target === cartModalOverlay) closeCartModal();
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === "Escape") closeCartModal();
  });

  // ---- Add to Cart Logic ----
  document.body.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-add-to-cart');
    if (!btn) return;
    e.preventDefault();

    let productBox = btn.closest('.product-box');
    if (!productBox) return;

    let name = productBox.getAttribute('data-name');
    let color = productBox.getAttribute('data-color');
    let image = productBox.getAttribute('data-image');
    let price = productBox.getAttribute('data-price');

    if (!name) name = productBox.querySelector('h6')?.textContent.trim() || '';
    if (!color) color = productBox.querySelector('.text-muted')?.textContent.trim() || '';
    if (!image) image = productBox.querySelector('img')?.getAttribute('src') || '';
    if (!price) {
      let priceText = productBox.querySelector('.d-flex h6:last-child')?.textContent.replace(/[^0-9.]+/g, '');
      price = priceText || '0';
    }

    price = parseFloat(price);

    let item = cart.find(i => i.name === name && i.color === color);
    if (item) {
      item.qty++;
    } else {
      cart.push({
        name,
        color,
        image,
        price,
        qty: 1
      });
    }
    updateCartUI();
    cartModalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  });

  // ---- Buy Now Logic ----
  document.body.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-buy-now');
    if (!btn) return;
    e.preventDefault();

    let productBox = btn.closest('.product-box');
    if (!productBox) return;

    let name = productBox.getAttribute('data-name');
    let color = productBox.getAttribute('data-color');
    let image = productBox.getAttribute('data-image');
    let price = productBox.getAttribute('data-price');

    if (!name) name = productBox.querySelector('h6')?.textContent.trim() || '';
    if (!color) color = productBox.querySelector('.text-muted')?.textContent.trim() || '';
    if (!image) image = productBox.querySelector('img')?.getAttribute('src') || '';
    if (!price) {
      let priceText = productBox.querySelector('.d-flex h6:last-child')?.textContent.replace(/[^0-9.]+/g, '');
      price = priceText || '0';
    }

    price = parseFloat(price);

    // Create a single-item cart for the Buy Now action
    const buyNowItem = {
      name,
      color,
      image,
      price,
      qty: 1
    };

    // Show confirmation dialog
    if (confirm(`Buy ${name} (${color}) for $${price} now?`)) {
      // Prepare data for the transaction
      const transactionData = {
        cart: [buyNowItem],
        coupon_applied: '',
        total_price: price
      };

      // Send data to server
      fetch('save_transaction.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(transactionData)
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.text();
        })
        .then(data => {
          alert('Purchase successful! Your order has been placed.');
          console.log('Transaction saved:', data);
        })
        .catch(error => {
          console.error('Error saving transaction:', error);
          alert('There was an error processing your purchase. Please try again.');
        });
    }
  });

  // ---- Cart UI Update ----
  function updateCartUI() {
    cartItemsList.innerHTML = '';
    let subtotal = 0, qtyTotal = 0;
    cart.forEach((item, idx) => {
      const lineTotal = item.price * item.qty;
      subtotal += lineTotal;
      qtyTotal += item.qty;
      const div = document.createElement('div');
      div.className = 'cart-item';
      div.innerHTML = `
        <img class="cart-item-img" src="${item.image}" alt="${item.name}" />
        <div class="cart-item-details">
          <div class="cart-item-title">${item.name}</div>
          <div class="cart-item-meta">${item.color ? item.color : ''}</div>
          <div class="cart-item-pricing">
            <span class="cart-item-linetotal">$${(item.price * item.qty).toFixed(2)}</span>
          </div>
          <div class="cart-item-actions">
            <button class="cart-qty-btn" aria-label="Decrease quantity" data-idx="${idx}" data-action="decrease">-</button>
            <span class="cart-qty-value">${item.qty}</span>
            <button class="cart-qty-btn" aria-label="Increase quantity" data-idx="${idx}" data-action="increase">+</button>
            <button class="cart-item-remove" aria-label="Remove item" data-idx="${idx}">
              <svg height="16" width="16" viewBox="0 0 16 16" fill="none">
                <path d="M6.5 6.5L9.5 9.5M9.5 6.5L6.5 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <rect x="3.5" y="3.5" width="9" height="9" rx="2" stroke="currentColor" stroke-width="1.2"/>
              </svg>
            </button>
          </div>
        </div>
      `;
      cartItemsList.appendChild(div);
    });

    let discount = 0;
    if (couponDiscount > 0) {
      discount = subtotal * couponDiscount / 100;
    }
    const total = subtotal - discount;

    cartSubtotalAmount.textContent = '$' + total.toFixed(2);
    if (couponDiscount > 0) {
      cartSubtotalAmount.textContent += ` (Saved $${discount.toFixed(2)})`;
    }
    cartSubtotalLabel.textContent = `Subtotal (${qtyTotal} item${qtyTotal !== 1 ? 's' : ''})`;
    cartCount.textContent = qtyTotal;

    if (cart.length === 0) {
      cartItemsList.innerHTML = '<div style="padding:32px 0 12px 0;text-align:center;color:#888;">Your cart is empty.</div>';
      cartSubtotalAmount.textContent = '$0';
      cartSubtotalLabel.textContent = 'Subtotal (0 items)';
      cartCount.textContent = '0';
    }
  }

  // ---- Coupon Apply ----
  if (applyCouponBtn) {
    applyCouponBtn.addEventListener('click', function () {
      const code = couponInput.value.trim().toUpperCase();
      if (!code) {
        couponMsg.textContent = "Please enter a coupon code.";
        couponMsg.style.color = "#a94442";
        return;
      }
      if (coupons[code]) {
        appliedCoupon = code;
        couponDiscount = coupons[code];
        couponMsg.textContent = `Coupon "${code}" applied! You get ${couponDiscount}% off.`;
        couponMsg.style.color = "#2d7a2d";
        updateCartUI();
      } else {
        appliedCoupon = null;
        couponDiscount = 0;
        couponMsg.textContent = "Invalid coupon code.";
        couponMsg.style.color = "#a94442";
        updateCartUI();
      }
    });
  }

  // ---- Cart Item Actions (Qty/Remove) ----
  cartItemsList.addEventListener('click', function (e) {
    const btn = e.target.closest('button');
    if (!btn) return;
    const idx = parseInt(btn.getAttribute('data-idx'));
    if (btn.classList.contains('cart-qty-btn')) {
      const action = btn.getAttribute('data-action');
      if (action === 'increase') {
        cart[idx].qty++;
      } else if (action === 'decrease') {
        cart[idx].qty--;
        if (cart[idx].qty <= 0) cart.splice(idx, 1);
      }
      updateCartUI();
    }
    if (btn.classList.contains('cart-item-remove')) {
      cart.splice(idx, 1);
      updateCartUI();
    }
  });

  // ---- Checkout Button Event (with confirmation, clears coupon) ----
  checkoutBtn.addEventListener('click', function () {
    if (cart.length === 0) {
      alert("Your cart is already empty.");
      return;
    }

    if (!window.confirm("Are you sure you want to checkout?")) {
      return;
    }

    // Calculate total price (with coupon)
    let subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
    let discount = couponDiscount > 0 ? (subtotal * couponDiscount) / 100 : 0;
    let total = subtotal - discount;

    fetch('save_transaction.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        cart: cart.map(item => ({
          name: item.name,
          color: item.color,
          qty: item.qty
        })),
        coupon_applied: appliedCoupon || '',
        total_price: total.toFixed(2)
      })
    })
      .then(res => {
        if (!res.ok) throw new Error("Server responded with an error");
        return res.text();
      })
      .then(msg => {
        alert(msg);
        // Clear cart and UI after saving
        cart.length = 0;
        appliedCoupon = null;
        couponDiscount = 0;
        if (couponInput) couponInput.value = "";
        if (couponMsg) couponMsg.textContent = "";
        updateCartUI();
        closeCartModal();
      })

  });

  // ---- Initial UI ----
  updateCartUI();

  function copyToClipboard(code) {
    navigator.clipboard.writeText(code).then(function () {
      alert(`Code "${code}" copied to clipboard!`);
    }, function (err) {
      console.error('Could not copy text: ', err);
    });
  }


</script>

</body>

</html>