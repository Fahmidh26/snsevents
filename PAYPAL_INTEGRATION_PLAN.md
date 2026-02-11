# PayPal Integration Developer Guide

This guide outlines the steps to integrate PayPal payments into the SNS Events application for Counseling and Management Session bookings.

## 1. Prerequisites

We will use the `srmklive/paypal` package for Laravel, which makes working with the PayPal REST API easy.

### Install the Package
Run the following command in your terminal:
```bash
composer require srmklive/paypal "~3.0"
```

### Publish Configuration
Publish the package configuration file:
```bash
php artisan vendor:publish --provider "Srmklive\PayPal\Providers\PayPalServiceProvider"
```

## 2. Configuration

### `.env` Setup
Add your PayPal credentials to the `.env` file. You obtained these from the `PAYPAL_SETUP_GUIDE.md`.

```env
# PayPal Configuration
PAYPAL_MODE=live
PAYPAL_SANDBOX_CLIENT_ID=your_sandbox_client_id
PAYPAL_SANDBOX_CLIENT_SECRET=your_sandbox_client_secret
PAYPAL_LIVE_CLIENT_ID=your_live_client_id
PAYPAL_LIVE_CLIENT_SECRET=your_live_client_secret
PAYPAL_CURRENCY=USD
```
*Note: Set `PAYPAL_MODE=sandbox` for testing, and `live` for production.*

### `config/paypal.php`
Ensure the configuration file uses these environment variables. The default published config usually works, but verify the `live` and `sandbox` arrays map to your env variables.

## 3. Database Updates

We need to store payment details in your booking tables. Create a new migration:

```bash
php artisan make:migration add_payment_fields_to_bookings_tables
```

**Migration Content:**
```php
public function up()
{
    $tables = ['counseling_bookings', 'management_session_bookings'];

    foreach ($tables as $table) {
        Schema::table($table, function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('status'); // PayPal Order ID
            $table->string('payment_status')->default('unpaid')->after('transaction_id');
            $table->decimal('amount_paid', 10, 2)->default(0.00)->after('payment_status');
        });
    }
}

public function down()
{
    $tables = ['counseling_bookings', 'management_session_bookings'];

    foreach ($tables as $table) {
        Schema::table($table, function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'payment_status', 'amount_paid']);
        });
    }
}
```

Run the migration:
```bash
php artisan migrate
```

## 4. Backend Implementation

### A. Create `PaymentController`
Create a controller to handle PayPal redirects and callbacks.

```bash
php artisan make:controller PaymentController
```

**Controller Logic:**
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\CounselingBooking;
use App\Models\ManagementSessionBooking;
use App\Models\CounselingSlot;
use App\Models\ManagementSessionSlot;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.success'),
                "cancel_url" => route('payment.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ],
                    "reference_id" => $request->booking_id . '_' . $request->type // e.g., 12_counseling
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // Redirect to approve URI
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
        }

        return redirect()->back()->with('error', 'Something went wrong with PayPal.');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Payment Successful
            $referenceId = $response['purchase_units'][0]['reference_id'];
            [$bookingId, $type] = explode('_', $referenceId);
            
            $transactionId = $response['id'];
            $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

            if ($type == 'counseling') {
                $booking = CounselingBooking::find($bookingId);
                $redirectRoute = 'counseling.confirmation';
            } else {
                $booking = ManagementSessionBooking::find($bookingId);
                $redirectRoute = 'management-session.confirmation';
            }

            if ($booking) {
                $booking->update([
                    'status' => 'confirmed', // Mark as confirmed/paid
                    'payment_status' => 'paid',
                    'transaction_id' => $transactionId,
                    'amount_paid' => $amount
                ]);
                
                // You might want to trigger the email here instead of at initial booking
                
                return redirect()->route($redirectRoute, ['code' => $booking->confirmation_code])
                    ->with('success', 'Payment successful! Your booking is confirmed.');
            }
        }

        return redirect()->route('home')->with('error', 'Payment failed or was cancelled.');
    }

    public function paymentCancel(Request $request)
    {
        // Handle cancellation
        // You might want to cancel the booking explicitly here if it was created in pending state
        return redirect()->route('home')->with('info', 'Payment cancelled.');
    }
}
```

### B. Update Booking Controllers

Modify `CounselingController` and `ManagementSessionController`.

**In `book` method:**
Instead of redirecting directly to confirmation, check if price > 0.

```php
// ... inside book method after creating booking ...

$booking = CounselingBooking::create([
    // ... data ...
    'status' => 'pending', // Initial status
    'payment_status' => 'unpaid'
]);

// Prepare for Payment
$slot = CounselingSlot::find($validated['slot_id']);

if ($slot->price > 0) {
    $provider = new \Srmklive\PayPal\Services\PayPal as PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();

    $response = $provider->createOrder([
        "intent" => "CAPTURE",
        "application_context" => [
            "return_url" => route('payment.success'),
            "cancel_url" => route('payment.cancel'),
        ],
        "purchase_units" => [
            0 => [
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $slot->price
                ],
                "reference_id" => $booking->id . '_counseling' // Pass ID and Type
            ]
        ]
    ]);

    if (isset($response['id']) && $response['id'] != null) {
        // Update booking with preliminary order ID if needed
        foreach ($response['links'] as $links) {
            if ($links['rel'] == 'approve') {
                return redirect()->away($links['href']);
            }
        }
    }
    
    return redirect()->back()->with('error', 'Could not initiate PayPal payment.');
}

// If free, proceed as before
// ... send email ...
return redirect()->route('counseling.confirmation', ['code' => $booking->confirmation_code]);
```

## 5. Web Routes

Add the new routes in `routes/web.php`:

```php
use App\Http\Controllers\PaymentController;

// Payment Routes
Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
```

## 6. Email Handling Note

Currently, emails are sent immediately when `create` is called in the controller.
*   **Recommendation:** Move the email sending logic to the `paymentSuccess` method in `PaymentController`. You don't want to confirm a booking via email if they haven't paid yet.
*   For free slots, keep the email logic in the original controller.

## 7. Model Updates
Ensure your models (`CounselingBooking`, etc.) allow mass assignment for the new fields:
```php
protected $fillable = [
    // ... existing ...
    'transaction_id',
    'payment_status',
    'amount_paid'
];
```

---
This implementation ensures that users are redirected to PayPal immediately after filling out the booking form. Their booking is confirmed only after a successful payment.
