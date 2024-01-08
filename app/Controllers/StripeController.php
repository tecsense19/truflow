<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class StripeController extends Controller
{
    public function index()
    {
        return view('front/stripe_view');
    }

    public function charge()
{
    \Stripe\Stripe::setApiKey("sk_test_5TC5lQ25W45SpAwUN9O6llq4009KocqXGo");


    try {
        $token = $_POST['stripeToken'];

        // Retrieve customer information from the form
        $customerName = "test";
        $customerAddress = "etest123";

        // Create a charge with customer information
        $charge = \Stripe\Charge::create([
            'amount' => 2000,
            'currency' => 'usd',
            'source' => $token,
            'description' => 'Software development services'
        ]);

        // Handle the success of the charge
        echo 'Payment successful!';
    } catch (\Stripe\Exception\CardException $e) {
        // Card was declined
        echo 'Payment failed. Card declined.';
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle the exception, e.g., log the error
        echo 'Invalid request: ' . $e->getMessage();
    }
}
}
