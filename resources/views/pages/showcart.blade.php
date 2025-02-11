<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="images/favicon.png" type="" />
  <title>Taste Wave Restaurant</title>

  <!-- Bootstrap & Tailwind -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
  <!-- Navbar Section -->
  <header class="bg-gray-800 text-white">
    <div class="container mx-auto px-6 py-4">
      <nav class="flex justify-between items-center">
        <!-- Logo Section -->
        <a class="text-3xl font-bold " style="font-family: 'Dancing Script', cursive;" href="/">Taste Wave Restaurant</a>
        <!-- Navigation Links -->
        <ul class="hidden md:flex space-x-6 text-white text-xl">
          <li><a class="hover:text-yellow-400" href="/">Home</a></li>
          <li><a class="hover:text-yellow-400" href="/menu">Menu</a></li>
          <li><a class="hover:text-yellow-400" href="/about">About</a></li>
          <li><a class="hover:text-yellow-400" href="/book">Book Table</a></li>
        </ul>
        <!-- User Section -->
        <div class="flex space-x-4 items-center">
          <div class="relative">
            <button class="text-white focus:outline-none">
              <i class="fa fa-user"></i>
            </button>
            <ul class="absolute bg-gray-700 rounded shadow-md hidden mt-2">
              @guest
          <li><a class="block px-4 py-2 hover:bg-gray-600" href="{{ route('login') }}">Login</a></li>
          <li><a class="block px-4 py-2 hover:bg-gray-600" href="{{ route('register') }}">Sign Up</a></li>
        @else
        <li><a class="block px-4 py-2 hover:bg-gray-600" href="{{ route('dashboard') }}">Dashboard</a></li>
        <li>
        <a class="block px-4 py-2 hover:bg-gray-600" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
      @endguest
            </ul>
          </div>

          @if(Auth::check())
        <a href="{{ url('#') }}" class="text-white">
        <i class="fa fa-shopping-cart"></i>
        </a>
      @endif

          <form class="flex">
            <button class="text-white focus:outline-none" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </form>
        </div>
      </nav>
    </div>
  </header>

  <!-- Page Content -->
  <main class="flex-grow">
    <div class="cart-table px-6 py-12">
      @csrf
      <table class="min-w-full table-auto bg-gray-800 text-white rounded-lg shadow-lg">
        <thead>
          <tr class="bg-gray-900 text-lg font-semibold">
            <th class="px-4 py-4 text-left">Select</th>
            <th class="px-6 py-4 text-left">Product Name</th>
            <th class="px-6 py-4 text-left">Quantity</th>
            <th class="px-6 py-4 text-left">Unit Price</th>
            <th class="px-6 py-4 text-left">Total</th>
            <th class="px-6 py-4 text-left">Remove</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart as $carts)
        <tr class="hover:bg-gray-700">
        <td class="px-4 py-4">
          <input type="checkbox" name="selected_items[]" value="{{ $carts->id }}" class="select-item"
          data-product="{{ $carts->product_title }}" data-quantity="{{ $carts->quantity }}"
          data-price="{{ $carts->price }}">
        </td>
        <td class="px-6 py-4">{{ $carts->product_title }}</td>
        <td class="px-6 py-4">{{ $carts->quantity }}</td>
        <td class="px-6 py-4">{{ $carts->unit_price }}</td>
        <td class="px-6 py-4">{{ $carts->price }}</td>
        <td class="px-6 py-4">
          <form action="{{ url('delete', $carts->id) }}" style="display:inline;">
          <button type="submit" class="text-red-500">
            <i class="fas fa-trash-alt"></i> <!-- Trash icon -->
          </button>
          </form>
        </td>
        </tr>
      @endforeach
        </tbody>
      </table>

      <!-- Delivery and Phone Fields -->
      <div class="mt-4">
        <label class="block text-lg font-bold">Select Delivery Method:</label>
        <select id="delivery-method" class="p-2 border rounded mt-2">
          <option value="pickup">Pickup</option>
          <option value="delivery">Delivery (LKR 300 Extra)</option>
        </select>
      </div>

      <div id="delivery-address-section" class="hidden mt-4">
        <label for="delivery-address" class="block text-lg font-bold">Delivery Address:</label>
        <input type="text" id="delivery-address" name="delivery_address" class="p-2 w-full border rounded mt-2">
      </div>

      <div class="mt-4">
        <label for="phone-number" class="block text-lg font-bold">Phone Number:</label>
        <input type="text" id="phone-number" name="phone_number" class="p-2 w-full border rounded mt-2"
          placeholder="Enter your phone number">
      </div>

      <div class="flex justify-center mt-4">
        <p class="text-lg font-bold text-black bg-white px-4 py-2 rounded shadow">
          Total Price: <span id="total-price">LKR 0.00</span>
        </p>
      </div>

      <!-- Checkout Button -->
      <div class="flex justify-center">
        <button type="button" id="checkout-button"
          class="mt-4 w-50 bg-gradient-to-r from-green-400 to-green-600 text-white font-bold py-3 rounded-lg shadow-md hover:from-green-500 hover:to-green-700 hover:shadow-lg transition-all duration-300">
          Checkout
        </button>
      </div>

      <!-- View My Orders Button -->
      @if(auth()->check())
      <div class="mt-6 flex justify-center">
      <a href="{{ url('myorders') }}"
        class="w-50 bg-gradient-to-r from-blue-400 to-blue-600 text-white font-bold py-3 rounded-lg text-center shadow-md hover:from-blue-500 hover:to-blue-700 hover:shadow-lg transition-all duration-300">
        View My Orders
      </a>
      </div>
    @endif
      <br>


      <!-- Digital Receipt Modal -->
      <div id="receipt-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-3/4 md:w-1/2">
          <h2 class="text-2xl font-bold mb-4">Digital Receipt</h2>
          <div id="receipt-content" class="text-lg"></div>
          <button id="close-receipt" class="mt-4 px-6 py-3 bg-red-500 text-white rounded">Close</button>
          <button id="confirm-order" class="mt-4 px-6 py-3 bg-green-500 text-white rounded">Confirm Order</button>
        </div>
      </div>
  </main>

  <!-- footer section -->
  <footer class="bg-gray-800 text-white py-10">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">

      <!-- Contact Us Section -->
      <div>
        <h3 class="text-xl font-semibold">Contact Us</h3>
        <ul class="space-y-2">
          <li class="flex items-center space-x-2">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span>Location</span>
          </li>
          <li class="flex items-center space-x-2">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <span>Call +01 1234567890</span>
          </li>
          <li class="flex items-center space-x-2">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>demo@gmail.com</span>
          </li>
        </ul>
      </div>

      <!-- Center Info Section -->
      <div>
        <h3 class="text-3xl font-cursive mb-3" style="font-family: 'Dancing Script', cursive;">Taste Wave Restaurant</h3>
        <p class="mb-4">Where Flavor Meets Innovation</p>
        <div class="flex justify-center space-x-3">
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fab fa-pinterest"></i>
          </a>
        </div>
      </div>

      <!-- Opening Hours Section -->
      <div>
        <h3 class="text-xl font-semibold mb-3">Opening Hours</h3>
        <p>Everyday</p>
        <p>10:00 AM - 10:00 PM</p>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="border-t border-gray-700 mt-8 pt-4">
      <p class="text-center text-sm">&copy; 2025 All Rights Reserved By Chiran_S</p>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const checkboxes = document.querySelectorAll('.select-item');
      const totalPriceElement = document.getElementById('total-price');
      const deliveryMethod = document.getElementById('delivery-method');
      const deliveryAddressSection = document.getElementById('delivery-address-section');
      const deliveryAddressInput = document.getElementById('delivery-address');
      const phoneNumberInput = document.getElementById('phone-number');
      const checkoutButton = document.getElementById('checkout-button');
      const receiptModal = document.getElementById('receipt-modal');
      const receiptContent = document.getElementById('receipt-content');
      const closeReceipt = document.getElementById('close-receipt');
      const confirmOrderButton = document.getElementById('confirm-order');

      let deliveryCharge = 0;

      const userName = "{{ Auth::user()->name }}";
      const userEmail = "{{ Auth::user()->email }}";

      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
      });

      deliveryMethod.addEventListener('change', () => {
        if (deliveryMethod.value === 'delivery') {
          deliveryCharge = 300;
          deliveryAddressSection.classList.remove('hidden');
        } else {
          deliveryCharge = 0;
          deliveryAddressSection.classList.add('hidden');
        }
        updateTotalPrice();
      });

      function updateTotalPrice() {
        let totalPrice = 0;
        checkboxes.forEach(checkbox => {
          if (checkbox.checked) {
            const price = parseFloat(checkbox.dataset.price) || 0;
            totalPrice += price;
          }
        });
        totalPrice += deliveryCharge;
        totalPriceElement.textContent = `LKR ${totalPrice.toFixed(2)}`;
      }

      checkoutButton.addEventListener('click', () => {
        const selectedItems = Array.from(checkboxes).filter(checkbox => checkbox.checked);
        const phoneNumber = phoneNumberInput.value.trim();
        const userDeliveryAddress = deliveryAddressInput.value.trim();
        const selectedDeliveryMethod = deliveryMethod.value;

        // Form validation checks
        if (selectedItems.length === 0) {
          alert('Please select at least one item.');
          return;
        }
        if (!phoneNumber) {
          alert('Please enter your phone number.');
          return;
        }
        if (selectedDeliveryMethod === 'delivery' && !userDeliveryAddress) {
          alert('Please enter your delivery address for delivery.');
          return;
        }

        // Generate receipt content
        let receiptHtml = `<p><strong>Name:</strong> ${userName}</p>`;
        receiptHtml += `<p><strong>Email:</strong> ${userEmail}</p>`;
        receiptHtml += '<ul>';
        selectedItems.forEach(item => {
          receiptHtml += `<li>${item.dataset.product} - Quantity: ${item.dataset.quantity}, Price: LKR ${item.dataset.price}</li>`;
        });
        receiptHtml += `</ul><p class="mt-2">Phone Number: ${phoneNumber}</p>`;
        receiptHtml += `<p>Delivery Method: ${selectedDeliveryMethod}</p>`;

        if (selectedDeliveryMethod === 'delivery') {
          receiptHtml += `<p>Delivery Address: ${userDeliveryAddress}</p>`;
        }

        receiptHtml += `<p class="mt-2 font-bold">Final Total: ${totalPriceElement.textContent}</p>`;

        receiptContent.innerHTML = receiptHtml;
        receiptModal.classList.remove('hidden');
      });

      confirmOrderButton.addEventListener('click', () => {
        const selectedItems = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => ({
          product: checkbox.dataset.product,
          quantity: checkbox.dataset.quantity,
          price: checkbox.dataset.price
        }));

        const payload = {
          user_name: userName,
          user_email: userEmail,
          total_price: parseFloat(totalPriceElement.textContent.replace('LKR ', '')),
          phone_number: phoneNumberInput.value.trim(),
          delivery_method: deliveryMethod.value,
          delivery_address: deliveryAddressInput.value.trim(),
          order_items: JSON.stringify(selectedItems)
        };

        fetch('/api/online-orders', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify(payload)
        })
          .then(response => response.json())
          .then(data => {
            alert(data.message);  // Show success message
            receiptModal.classList.add('hidden');

            // Auto-refresh the page after 2 seconds
            setTimeout(() => {
              location.reload();  // Refresh the page
            }, 500);
          })
          .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while placing the order.');
          });
      });

      closeReceipt.addEventListener('click', () => {
        receiptModal.classList.add('hidden');
      });
    });
  </script>
</body>

</html>