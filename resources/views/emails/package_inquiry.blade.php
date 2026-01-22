<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; border-bottom: 2px solid #e9ecef; }
        .content { padding: 20px 0; }
        .field { margin-bottom: 10px; }
        .label { font-weight: bold; }
        .footer { margin-top: 30px; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Package Inquiry</h2>
        </div>
        <div class="content">
            <p>You have received a new inquiry from the website:</p>
            
            <div class="field">
                <span class="label">Event Type:</span> {{ ucfirst($inquiry->event_type) }}
            </div>
            
            @if($inquiry->pricingTier)
            <div class="field">
                <span class="label">Package:</span> {{ $inquiry->pricingTier->tier_name }} Package
            </div>
            @endif
            
            <div class="field">
                <span class="label">Customer Name:</span> {{ $inquiry->name }}
            </div>
            
            <div class="field">
                <span class="label">Email:</span> {{ $inquiry->email }}
            </div>
            
            <div class="field">
                <span class="label">Phone:</span> {{ $inquiry->phone }}
            </div>
            
            <div class="field">
                <span class="label">Event Date:</span> {{ $inquiry->event_date }}
            </div>
            
            @if($inquiry->message)
            <div class="field">
                <span class="label">Message:</span><br>
                {{ $inquiry->message }}
            </div>
            @endif
            
            <p>Please login to the admin panel to manage this inquiry.</p>
        </div>
        <div class="footer">
            <p>This email was sent from your website.</p>
        </div>
    </div>
</body>
</html>
