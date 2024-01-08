<!-- app/Views/stripe_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Integration</title>
</head>
<body>
    <form action="<?= site_url('stripe/charge') ?>" method="post">
        <!-- Add your payment form fields here -->
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_CTo5L7fe5ufOYkpIblHELzND00d0OKb0ua"
            data-amount="20"
            data-name="Your Company Name"
            data-description="Widget"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="usd"
        >
        </script>
    </form>
</body>
</html>
