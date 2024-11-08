<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all(); // Récupère tous les paiements
        return view('payments.index', compact('payments')); // Affiche la liste des paiements
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payments.create'); // Affiche le formulaire de création
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        // Crée le paiement dans la base de données
        Payment::create($request->all());

        // Redirection avec un message de succès
        return redirect()->route('payments.index')->with('success', 'Paiement créé avec succès.');
    }

    public function checkout(Request $request)
    {
        $stripePriceId = 'price_1QJ0ejPj6FyTJ61p7z5ycO8Q'; // Remplace par ton ID de prix Stripe.
        $quantity = 10; // Ajuste la quantité selon les besoins.

        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('checkout-success'),
            'cancel_url' => route('checkout-cancel'),
        ]);
    }
    
    public function success()
    {
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Trouve le paiement ou renvoie une erreur 404
        $payment = Payment::findOrFail($id);
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Trouve le paiement ou renvoie une erreur 404
        $payment = Payment::findOrFail($id);
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        // Trouve le paiement ou renvoie une erreur 404
        $payment = Payment::findOrFail($id);

        // Met à jour le paiement dans la base de données
        $payment->update($request->all());

        // Redirection avec un message de succès
        return redirect()->route('payments.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouve le paiement ou renvoie une erreur 404
        $payment = Payment::findOrFail($id);

        // Supprime le paiement
        $payment->delete();

        // Redirection avec un message de succès
        return redirect()->route('payments.index')->with('success', 'Paiement supprimé avec succès.');
    }
}
