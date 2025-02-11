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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
  <!-- Navbar Section -->
  <header class="bg-gray-800 text-white">
    <div class="container mx-auto px-6 py-4">
      <nav class="flex justify-between items-center">
        <!-- Logo Section -->
        <a class="text-2xl font-bold" href="/">Taste Wave Restaurant</a>
        <!-- Navigation Links -->
        <ul class="hidden md:flex space-x-6 text-white">
          <li><a class="hover:text-yellow-400" href="/">Home</a></li>
          <li><a class="hover:text-yellow-400" href="/menu">Menu</a></li>
          <li><a class="hover:text-yellow-400" href="/about">About</a></li>
          <li><a class="hover:text-yellow-400" href="/book">Book Table</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="container mx-auto my-6">
    <h2 class="text-3xl font-bold text-center mb-6">Your Orders</h2>
    @if($orders->isEmpty())
      <p class="text-center text-xl text-gray-600">No orders found.</p>
    @else
      <!-- Table Section -->
      <div class="overflow-x-auto">
  <table class="min-w-full table-auto bg-white border-separate border-spacing-0 rounded-lg shadow-lg">
    <thead class="bg-gray-100 text-left">
      <tr>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Order ID</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Name</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Email</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Contact</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Total Price</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Status</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Order Items</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Order Placed</th>
        <th class="px-6 py-3 text-sm font-medium text-gray-700 border-b border-gray-200">Order Updated</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      @foreach($orders as $order)
        <tr class="hover:bg-gray-50 transition duration-300 ease-in-out">
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">{{ $order->id }}</td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">{{ $order->user_name }}</td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">{{ $order->user_email }}</td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">{{ $order->phone_number }}</td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">LKR {{ number_format($order->total_price, 2) }}</td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">
            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
              {{ $order->is_completed ? 'bg-green-200 text-green-600' : 'bg-yellow-200 text-yellow-600' }}">
              {{ $order->is_completed ? 'Completed' : 'Pending' }}
            </span>
          </td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">
            <ul class="list-disc pl-5">
              @foreach(json_decode($order->order_items, true) as $item)
                <li>{{ $item['product'] }} (x{{ $item['quantity'] }})</li>
              @endforeach
            </ul>
          </td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
          <td class="px-6 py-4 text-sm text-gray-800 border-b border-gray-200">{{ $order->updated_at->format('Y-m-d H:i:s') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
    
    @endif
  </div>

  <script>
    // Wait for the DOM to load
    document.addEventListener("DOMContentLoaded", function() {
      // Get the table rows and sort them by order date (created_at)
      const rows = Array.from(document.querySelectorAll("tbody tr"));
      
      rows.sort((a, b) => {
        const aDate = new Date(a.cells[7].textContent); // Order Placed column
        const bDate = new Date(b.cells[7].textContent);
        return bDate - aDate; // Sort descending
      });
      
      const tbody = document.querySelector("tbody");
      rows.forEach(row => tbody.appendChild(row)); // Re-append sorted rows
    });
  </script>
</body>

</html>
