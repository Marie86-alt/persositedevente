@extends('layouts.app')

@section('title', 'Ajouter un Paiement')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Ajouter un moyen de Paiement</h1>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

      

        <!-- Méthode de paiement (carte bancaire ou virement) -->
        <div class="mb-4">
            <label for="method" class="block text-gray-700 text-sm font-bold mb-2">Méthode de Paiement :</label>
            <select name="method" id="method" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline custom-select" required>
                <option value="carte">Carte bancaire</option>
                <option value="virement">Virement bancaire</option>
            </select>
        </div>

        <!-- Sélection du type de carte bancaire -->
        <div id="card-options" class="mb-4 hidden">
            <label for="card_type" class="block text-gray-700 text-sm font-bold mb-2">Type de carte :</label>
            <select name="card_type" id="card_type" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline custom-select">
                <option value="visa">Visa</option>
                <option value="mastercard">Mastercard</option>
                <option value="electron">Visa Electron</option>
                <option value="amex">American Express</option>
                <option value="paypal">PayPal</option>
                
            </select>
        </div>

        <!-- Nom du propriétaire de la carte -->
        <div id="card-owner" class="mb-4 hidden">
            <label for="card_owner" class="block text-gray-700 text-sm font-bold mb-2">Nom du propriétaire :</label>
            <input type="text" name="card_owner" id="card_owner" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Numéro de la carte bancaire -->
        <div id="card-number" class="mb-4 hidden">
            <label for="card_number" class="block text-gray-700 text-sm font-bold mb-2">Numéro de carte :</label>
            <input type="text" name="card_number" id="card_number" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Informations de virement bancaire -->
        <div id="bank-details" class="mb-4 hidden">
            <label for="iban" class="block text-gray-700 text-sm font-bold mb-2">IBAN :</label>
            <input type="text" name="iban" id="iban" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="FR76 1234 5678 9012 3456 7890 123" readonly>

            <label for="bic" class="block text-gray-700 text-sm font-bold mb-2 mt-4">BIC :</label>
            <input type="text" name="bic" id="bic" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="BANKFRPPXXX" readonly>
        </div>

          <!-- Montant -->
          <div class="mb-4">
            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Montant :</label>
            <input type="text" name="amount" id="amount" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <!-- Statut -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Statut :</label>
            <input type="text" name="status" id="status" class="shadow appearance-none border rounded w-1/2 py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between w-1/2 mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Ajouter
            </button>
            <a href="{{ route('payments.index') }}" class="inline-block font-bold text-m text-blue-500 hover:text-blue-800">
                Annuler
            </a>
        </div>
    </form>
</div>

<!-- Styles pour les flèches des menus déroulants -->
<style>
    /* Style personnalisé pour les flèches dans les menus déroulants */
    .custom-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10L12 15L17 10H7Z' fill='%23999999'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1.5em;
    }
</style>

<script>
    // Script pour afficher/masquer les options de carte bancaire et les informations de virement bancaire
    document.getElementById('method').addEventListener('change', function() {
        let cardOptions = document.getElementById('card-options');
        let cardOwner = document.getElementById('card-owner');
        let cardNumber = document.getElementById('card-number');
        let bankDetails = document.getElementById('bank-details');

        if (this.value === 'carte') {
            cardOptions.classList.remove('hidden');
            cardOwner.classList.remove('hidden');
            cardNumber.classList.remove('hidden');
            bankDetails.classList.add('hidden');
        } else if (this.value === 'virement') {
            bankDetails.classList.remove('hidden');
            cardOptions.classList.add('hidden');
            cardOwner.classList.add('hidden');
            cardNumber.classList.add('hidden');
        }
    });
</script>
@endsection
