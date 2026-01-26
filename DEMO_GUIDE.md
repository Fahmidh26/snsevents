# Client Demo Instructions (Free Tunnel)

Follow these steps to show your website to your client for free.

### Step 1: Start the Website (Terminal 1)
Open a terminal in your project folder and run:
```bash
php artisan serve
```
*Keep this terminal OPEN.*

### Step 2: Start the Live Link (Terminal 2)
Open a **new** terminal window (keep the first one running) and run:
```bash
npx localtunnel --port 8000
```
It will give you a link like: `https://something-random.loca.lt`

### Step 3: Share with Client
1.  Send the **Link** to your client.
2.  **Important:** They will need a **Tunnel Password**.
3.  To get the password, open this link in your browser:
    *   [https://loca.lt/mytunnelpassword](https://loca.lt/mytunnelpassword)
4.  Copy the IP address shown there and send it to your client (or enter it yourself if you are showing them).

### Summary
1. `php artisan serve`
2. `npx localtunnel --port 8000`
3. Get Password from `loca.lt/mytunnelpassword`
