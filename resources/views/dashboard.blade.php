<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNSEvents</title>
</head>
<body>
    <h1>SNSEvents Admin Panel</h1>
    <p>Welcome, {{ auth()->user()->name }}</p>
    
    <div style="margin-top: 20px; margin-bottom: 20px;">
        <a href="{{ route('company-profile.edit') }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Manage Company Profile</a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>