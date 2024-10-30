@extends('layouts.app')

@section('title', 'Mon Panier')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Mon Panier</h1>

    @if (session()->has('cart') && count(session('cart')) > 0)
        <div id="cart-items" class="grid gap-4">
            @foreach (session('cart') as $key => $item)
                <div class="cart-item p-4 border rounded-lg shadow-sm bg-white" data-id="{{ $key }}">
                    <h2 class="text-lg font-semibold">{{ $item['name'] }}</h2>
                    <p>Prix: {{ $item['price'] }} €</p>
                    <label for="quantity">Quantité :</label>
                    <input type="number" class="quantity border rounded px-2 py-1" value="{{ $item['quantity'] }}" min="1">
                    <p>Total: {{ $item['price'] * $item['quantity'] }} €</p>
                    <button class="update-cart btn btn-primary mt-2">Mettre à jour</button>
                    <button class="remove-cart btn btn-danger text-red-500 mt-2">Retirer</button>
                    
                </div>

            @endforeach
            <button id="validate-cart" class="btn btn-success mt-4">Valider le Panier</button>
        </div>

        <!-- Total des achats -->
        <div class="mt-4">
            <h2 class="text-xl font-semibold">Total des Achats :</h2>
            <p id="total-price" class="text-lg font-bold">{{ array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, session('cart'))) }} €</p>
        </div>

        <!-- Application des coupons -->
        <div class="mt-4">
            <h2 class="text-xl font-semibold">Coupons de Réduction :</h2>
            <input type="text" id="coupon_code" class="border rounded px-3 py-2" placeholder="Entrez votre code">
            <button id="apply_coupon" class="btn btn-primary mt-2">Appliquer</button>
            <p id="coupon_message" class="text-green-500"></p>
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
            Aucun produit dans le panier
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Mettre à jour la quantité
    $(".update-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this).closest(".cart-item");
        var quantity = ele.find(".quantity").val();

        $.ajax({
            url: "{{ route('cart.update') }}",
            method: "post",
            data: {
                _token: "{{ csrf_token() }}",
                id: ele.attr("data-id"),
                quantity: quantity,
            },
            success: function (response) {
                if (response.success) {
                    $("#cart-items").load(location.href + " #cart-items"); // Recharger les éléments du panier
                    updateTotalPrice(); // Mettre à jour le total
                }
            },
        });
    });

    // Retirer un produit du panier
    $(".remove-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this).closest(".cart-item");

        $.ajax({
            url: "{{ route('cart.remove') }}",
            method: "post",
            data: {
                _token: "{{ csrf_token() }}",
                id: ele.attr("data-id"),
            },
            success: function (response) {
                if (response.success) {
                    $("#cart-items").load(location.href + " #cart-items"); // Recharger les éléments du panier
                    updateTotalPrice(); // Mettre à jour le total
                }
            },
        });
    });

    // Appliquer un coupon
    $("#apply_coupon").click(function (e) {
        e.preventDefault();

        var couponCode = $("#coupon_code").val();

        $.ajax({
            url: "{{ route('cart.applyCoupon') }}", // Remplacez par votre route
            method: "post",
            data: {
                _token: "{{ csrf_token() }}",
                coupon_code: couponCode,
            },
            success: function (response) {
                if (response.success) {
                    $("#coupon_message").text("Coupon appliqué avec succès !");
                    updateTotalPrice(); // Mettre à jour le total
                } else {
                    $("#coupon_message").text("Coupon invalide.");
                }
            },
        });
    });

    // Mettre à jour le total des achats
    function updateTotalPrice() {
        var total = 0;
        $(".cart-item").each(function() {
            var price = parseFloat($(this).find("p:eq(1)").text().replace(' €', ''));
            var quantity = parseInt($(this).find(".quantity").val());
            total += price * quantity;
        });
        $("#total-price").text(total + " €");
    }
});
</script>
@endsection
