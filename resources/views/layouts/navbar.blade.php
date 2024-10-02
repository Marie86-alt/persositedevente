<!-- Navbar -->
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo et nom du site -->
            <div class="flex items-center space-x-2">
                <i class="fas fa-lemon text-yellow-500 text-2xl"></i>
                <a href="#" class="text-xl font-bold text-gray-800">MonSite</a>
            </div>

            <!-- Liens de navigation -->
            <div class="hidden md:flex space-x-4">
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-gray-800">Produits</a>
                <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-gray-800">Catégories</a>
                <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-gray-800">Commandes</a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-gray-800">Panier</a>
                <a href="{{ route('payments.index') }}" class="text-gray-700 hover:text-gray-800">Paiement</a>

                <!-- Menu déroulant -->
                <script>
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }
</script>
                <div class="relative">
                    <button class="text-gray-700 hover:text-gray-800 focus:outline-none">
                        Menu <i class="fas fa-chevron-down"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownMenu" class="absolute mt-2 bg-white border rounded-lg shadow-lg hidden group-hover:block">
                        <a href="{{ route('payment.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Payment</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('stock.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Stock</a>
                        <a href="{{ route('suppliers.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Suppliers</a>
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Users</a>
                    </div>
                </div>
            </div>

            <!-- Barre de recherche et bouton de connexion -->
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Recherche..." class="w-64 px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Se connecter</button>
            </div>
        </div>
    </div>
</nav>
