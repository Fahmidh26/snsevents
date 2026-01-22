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
            <h2>New Custom Package Request</h2>
        </div>
        <div class="content">
            <p>You have received a new custom package request:</p>
            
            <div class="field">
                <span class="label">Event Type:</span> {{ ucfirst($request->event_type) }}
            </div>
            
            <div class="field">
                <span class="label">Customer Name:</span> {{ $request->name }}
            </div>
            
            <div class="field">
                <span class="label">Email:</span> {{ $request->email }}
            </div>
            
            <div class="field">
                <span class="label">Phone:</span> {{ $request->phone }}
            </div>
            
            <div class="field">
                <span class="label">Event Date:</span> {{ $request->event_date ? $request->event_date->format('Y-m-d') : 'Not specified' }}
            </div>

            <div class="field">
                <span class="label">Guest Count:</span> {{ $request->guest_count ?? 'Not specified' }}
            </div>

            <div class="field">
                <span class="label">Budget:</span> {{ $request->budget ? '$'.number_format($request->budget, 2) : 'Not specified' }}
            </div>

            <div class="field">
                <span class="label">Venue:</span> {{ $request->venue ?? 'Not specified' }}
            </div>
            
            @if($request->requirements)
            <div class="field">
                <span class="label">Requirements/Vision:</span><br>
                {{ $request->requirements }}
            </div>
            @endif
            
            <p>Please login to the admin panel to manage this request.</p>
        </div>
        <div class="footer">
            <p>This email was sent from your website.</p>
        </div>
    </div>
</body>
</html>
