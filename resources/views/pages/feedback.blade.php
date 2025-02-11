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

  @if(session('status'))
    <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
  <!-- Page Content -->
   <section class="bg-gray-50 flex justify-center items-center">
   <div class="w-full max-w-2xl p-8 bg-white  shadow-lg rounded-lg m-10">
        <!-- Icon and Title -->
        <div class="flex justify-center items-center mb-6">
            <i class="fa fa-comment-dots text-4xl text-yellow-500 mr-2"></i>
            <h2 class="text-3xl font-semibold text-center text-gray-800">We Value Your Feedback</h2>
        </div>

        <!-- Feedback Form -->
        <form action="{{url('Add-feedback')}}" method="POST">
            @csrf
            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">Full Name</label>
                <input type="text" id="name" name="name" class="mt-2 w-full px-4 py-2 border rounded-md bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" class="mt-2 w-full px-4 py-2 border rounded-md bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone" class="block text-lg font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="mt-2 w-full px-4 py-2 border rounded-md bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <!-- Feedback -->
            <div class="mb-4">
                <label for="feedback" class="block text-lg font-medium text-gray-700">Your Feedback</label>
                <textarea id="feedback" name="feedback" rows="4" class="mt-2 w-full px-4 py-2 border rounded-md bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Tell us about your experience..." required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="w-full py-3 bg-yellow-500 text-white rounded-md shadow-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-600">Submit Feedback</button>
            </div>
        </form>
    </div>
   </section>
  <!-- footer section -->
  <footer class="bg-gray-800 text-white py-10 mt-auto">
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
