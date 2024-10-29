<div id="cart">
    <h1>Mon Panier</h1>
    <div id="cart-items">
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                <div class="cart-item mb-4" data-id="{{ $id }}">
                    <p><strong>{{ $details['name'] }}</strong></p>
                    <p>Prix: {{ $details['price'] }} $</p>
                    <label for="quantity">Quantité :</label>
                    <input type="number" class="quantity" value="{{ $details['quantity'] }}" min="1">
                    <button class="update-cart btn btn-primary mt-2">Mettre à jour</button>
                    <button class="remove-cart btn btn-danger mt-2">Retirer</button>
                </div>
            @endforeach
        @else
            <p>Votre panier est vide.</p>
        @endif
    </div>
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
                }
            },
        });
    });
});
</script>
