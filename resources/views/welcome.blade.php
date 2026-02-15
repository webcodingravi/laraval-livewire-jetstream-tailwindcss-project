<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-white font-sans antialiased">
    <!-- Header -->
    <header class="bg-white shadow-sm py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800">ShopName</div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Home</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Shop</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Categories</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Contact</a></li>
                </ul>
            </nav>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13-3.4 8M4 5h16l-1.5 7H4.5M4 5l-.7 2H2"></path></svg></a>
                <a href="#" class="text-gray-600 hover:text-gray-900"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Banner -->
        <section class="relative bg-gray-100 py-20">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
                    <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-4">Discover Our New Collection</h1>
                    <p class="text-lg text-gray-700 mb-8">Elevate your style with our exclusive range of products. Shop now and experience premium quality.</p>
                    <a href="#" class="bg-indigo-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-indigo-700 shadow-lg transition duration-300">Shop Now</a>
                </div>
                <div class="md:w-1/2">
                    <img src="public/assets/img/banner.jpg" alt="Product Image" class="rounded-lg shadow-xl mx-auto md:ml-auto w-full max-w-md">
                </div>
            </div>
        </section>

        <!-- Category Cards -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-gray-800 text-center mb-12">Shop by Category</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden product-card">
                        <img src="https://via.placeholder.com/400x250" alt="Category 1" class="w-full h-48 object-cover">
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Electronics</h3>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">View Collection</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden product-card">
                        <img src="https://via.placeholder.com/400x250" alt="Category 2" class="w-full h-48 object-cover">
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Apparel</h3>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">View Collection</a>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden product-card">
                        <img src="https://via.placeholder.com/400x250" alt="Category 3" class="w-full h-48 object-cover">
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Home Goods</h3>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">View Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Products Grid -->
        <section class="bg-gray-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-gray-800 text-center mb-12">Featured Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Product Card 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden product-card">
                        <img src="https://via.placeholder.com/300x200" alt="Product 1" class="w-full h-48 object-cover">
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Product Name 1</h3>
                            <p class="text-gray-600 text-sm mb-3">Brand Name</p>
                            <p class="text-xl font-bold text-indigo-600">$99.99</p>
                            <button class="mt-4 bg-indigo-500 text-white px-5 py-2 rounded-full text-sm hover:bg-indigo-600 transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                    <!-- Product Card 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden product-card">
                        <img src="https://via.placeholder.com/300x200" alt="Product 2" class="w-full h-48 object-cover">
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Product Name 2</h3>
                            <p class="text-gray-600 text-sm mb-3">Brand Name</p>
                            <p class="text-xl font-bold text-indigo-600">$129.00</p>
                            <button class="mt-4 bg-indigo-500 text-white px-5 py-2 rounded-full text-sm hover:bg-indigo-600 transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                    <!-- Product Card 3 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden product-card">
                        <img src="https://via.placeholder.com/300x200" alt="Product 3" class="w-full h-48 object-cover">
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Product Name 3</h3>
                            <p class="text-gray-600 text-sm mb-3">Brand Name</p>
                            <p class="text-xl font-bold text-indigo-600">$75.50</p>
                            <button class="mt-4 bg-indigo-500 text-white px-5 py-2 rounded-full text-sm hover:bg-indigo-600 transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                    <!-- Product Card 4 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden product-card">
                        <img src="https://via.placeholder.com/300x200" alt="Product 4" class="w-full h-48 object-cover">
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Product Name 4</h3>
                            <p class="text-gray-600 text-sm mb-3">Brand Name</p>
                            <p class="text-xl font-bold text-indigo-600">$249.00</p>
                            <button class="mt-4 bg-indigo-500 text-white px-5 py-2 rounded-full text-sm hover:bg-indigo-600 transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 ShopName. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
