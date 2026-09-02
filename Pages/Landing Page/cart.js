document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const cartSidebar = document.getElementById('cartSidebar');
    const cartOverlay = document.getElementById('cartOverlay');
    const closeCartBtn = document.getElementById('closeCart');
    const cartItemsContainer = document.getElementById('cartItems');
    const itemCountElement = document.getElementById('itemCount');
    const cartSubtotalElement = document.getElementById('cartSubtotal');
    const emptyCartMessage = document.querySelector('.empty-cart-message');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const addSuggestedBtn = document.querySelector('.add-suggested-btn');
  
    // Product data
    const products = {
      'organic-cotton': {
        id: 'organic-cotton',
        name: 'The Organic Cotton Long-Sleeve',
        variant: 'Medium | Black',
        price: 35.00,
        originalPrice: '$50.00',
        discount: 30,
        image: 'long-sleeve.png'
      },
      'shirt-jacket': {
        id: 'shirt-jacket',
        name: 'The RevVool® Over-sized Shirt Jacket',
        variant: 'Small | Black',
        price: 167.00,
        originalPrice: '$238.00',
        discount: 30,
        image: 'shirt-jacket.png'
      },
      'merino-beanie': {
        id: 'merino-beanie',
        name: 'The Good Merino Wool Beanie',
        variant: 'One Size (Chambray Blue)',
        price: 35.00,
        image: 'beanie.png'
      }
    };
  
    // Initialize cart from localStorage or empty array
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
    // Toggle cart visibility
    function toggleCart() {
      cartSidebar.classList.toggle('open');
      cartOverlay.classList.toggle('active');
      document.body.style.overflow = cartSidebar.classList.contains('open') ? 'hidden' : '';
    }
  
    // Close cart when clicking overlay or close button
    cartOverlay.addEventListener('click', toggleCart);
    closeCartBtn.addEventListener('click', toggleCart);
  
    // Update cart UI
    function updateCart() {
      cartItemsContainer.innerHTML = '';
      
      if (cart.length === 0) {
        emptyCartMessage.style.display = 'block';
        itemCountElement.textContent = '0';
        cartSubtotalElement.textContent = '$0.00';
        return;
      }
      
      emptyCartMessage.style.display = 'none';
      
      let subtotal = 0;
      let totalItems = 0;
      
      cart.forEach((item, index) => {
        const product = products[item.id];
        const itemTotal = product.price * item.quantity;
        subtotal += itemTotal;
        totalItems += item.quantity;
        
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
          <img src="${product.image}" alt="${product.name}">
          <div class="cart-item-details">
            <div class="cart-item-title">${product.name}</div>
            <div class="cart-item-variant">${product.variant}</div>
            <div class="cart-item-price">
              ${product.originalPrice ? `<span class="original-price">${product.originalPrice}</span>` : ''}
              <span class="discounted-price">$${itemTotal.toFixed(2)}</span>
              ${product.discount ? `<span class="discount-badge">${product.discount}% Off</span>` : ''}
            </div>
            <div class="quantity-controls">
              <button class="quantity-btn minus">-</button>
              <input type="number" class="quantity-input" value="${item.quantity}" min="1">
              <button class="quantity-btn plus">+</button>
            </div>
            <div class="remove-item">Remove</div>
          </div>
        `;
        
        cartItemsContainer.appendChild(itemElement);
        
        // Add event listeners for quantity controls
        const minusBtn = itemElement.querySelector('.minus');
        const plusBtn = itemElement.querySelector('.plus');
        const quantityInput = itemElement.querySelector('.quantity-input');
        const removeBtn = itemElement.querySelector('.remove-item');
        
        minusBtn.addEventListener('click', () => updateQuantity(index, item.quantity - 1));
        plusBtn.addEventListener('click', () => updateQuantity(index, item.quantity + 1));
        quantityInput.addEventListener('change', () => updateQuantity(index, parseInt(quantityInput.value)));
        removeBtn.addEventListener('click', () => removeItem(index));
      });
      
      itemCountElement.textContent = totalItems;
      cartSubtotalElement.textContent = `$${subtotal.toFixed(2)}`;
    }
  
    // Update item quantity
    function updateQuantity(index, newQuantity) {
      if (newQuantity < 1) return;
      
      cart[index].quantity = newQuantity;
      if (newQuantity === 0) {
        cart.splice(index, 1);
      }
      
      saveCart();
      updateCart();
    }
  
    // Remove item from cart
    function removeItem(index) {
      cart.splice(index, 1);
      saveCart();
      updateCart();
    }
  
    // Add item to cart
    function addToCart(productId, quantity = 1) {
      const existingItemIndex = cart.findIndex(item => item.id === productId);
      
      if (existingItemIndex >= 0) {
        cart[existingItemIndex].quantity += quantity;
      } else {
        cart.push({
          id: productId,
          quantity: quantity
        });
      }
      
      saveCart();
      updateCart();
      toggleCart(); // Open cart when adding an item
    }
  
    // Save cart to localStorage
    function saveCart() {
      localStorage.setItem('cart', JSON.stringify(cart));
    }
  
    // Checkout button handler
    checkoutBtn.addEventListener('click', function() {
      if (cart.length > 0) {
        alert(`Proceeding to checkout with ${itemCountElement.textContent} items. Total: ${cartSubtotalElement.textContent}`);
        // In a real implementation, you would redirect to a checkout page
      } else {
        alert('Your cart is empty!');
      }
    });
  
    // Add suggested item handler
    addSuggestedBtn.addEventListener('click', function() {
      addToCart('merino-beanie');
    });
  
    // Make all "Add to Cart" buttons work
    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', function() {
        const productId = this.dataset.productId;
        addToCart(productId);
      });
    });
  
    // Make cart icon in navbar open the sidebar
    document.querySelector('a[href="../Cart Page/cart.html"]').addEventListener('click', function(e) {
      e.preventDefault();
      toggleCart();
    });
  
    // Initialize cart
    updateCart();
  });