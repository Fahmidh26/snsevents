# PayPal Setup Guide for Clients

This document provides a detailed, step-by-step guide on how to set up a PayPal Business account and obtain the necessary API credentials (Client ID and Secret) to integrate payments into your website.

---

## Part 1: Setting Up a PayPal Business Account

If you already have a PayPal Business account, you can skip to **Part 2**.

1.  **Open PayPal:**
    -   Go to [www.paypal.com](https://www.paypal.com/).
    -   Click on the **Sign Up** button (usually in the top right corner).

2.  **Select Business Account:**
    -   PayPal will ask if you want a "Personal" or "Business" account.
    -   Select **Business Account** and click **Next**.

3.  **Enter Email Address:**
    -   Enter the email address you want to use for your business.
    -   Click **Continue**.

4.  **Create Login Credentials:**
    -   Create a password for your account.
    -   Enter your business contact information (Name, Business Name, Phone Number).
    -   Read and accept the User Agreement.
    -   Click **Agree and Create Account**.

5.  **Describe Your Business:**
    -   Select your business type (e.g., Sole Proprietorship, Corporation).
    -   Enter a Product or Service keyword (e.g., "Management Consulting", "Education").
    -   Enter your monthly sales estimation (optional).
    -   Click **Continue**.

6.  **Personal Information:**
    -   Enter the requested personal details (Date of Birth, Home Address).
    -   Click **Submit**.

7.  **Email Verification:**
    -   Go to your email inbox.
    -   Find the email from PayPal and click the link to **Verify your email address**.
    -   You may also need to link a bank account to fully activate the account for receiving money.

---

## Part 2: Obtaining API Credentials

This part connects your PayPal account to your website so you can receive payments automatically.

1.  **Log In to the Developer Dashboard:**
    -   Go to [developer.paypal.com](https://developer.paypal.com/).
    -   Click **Log In to Dashboard** in the top right corner.
    -   Use your PayPal Business email and password to log in.

2.  **Go to "Apps & Credentials":**
    -   Once logged in, look at the top menu bar. Click on **Apps & Credentials**.
    -   (If you don't see the top menu, look for a "Dashboard" link first).

3.  **Switch to "Live" Mode:**
    -   You will see a toggle switch that says **Sandbox** and **Live**.
    -   **Click the toggle to switch it to "Live".**
    -   *Note: "Sandbox" is for testing with fake money. "Live" is for real money.*

4.  **Create a New App:**
    -   Click the button that says **Create App**.
    -   **App Name:** Enter a name like "Website Payments" or your company name.
    -   **App Type:** If asked, select "Merchant".
    -   Click **Create App**.

5.  **Copy Your Credentials:**
    -   You will now see a screen with your "Live API Credentials".
    -   Look for **Client ID**: This is a long string of letters and numbers.
    -   Look for **Secret**: You will see a generic password field (dots). Click the word **Show** next to it to reveal the code.

---

## Part 3: What to Send to Your Developer

Please copy the **Client ID** and **Secret** and send them to your developer.

**Template to copy/paste:**

> Hi, here are my PayPal API credentials for the website:
>
> **Mode:** Live
> **Client ID:** [Paste Client ID here]
> **Secret:** [Paste Secret here]

**⚠️ Important Security Note:**
Your **Secret** key is sensitive like a password. Do not post it on public forums or social media. Send it directly to your developer via email or a secure document.

---

## Part 4: Fees Info

Just for your information, PayPal charges a fee for each transaction processed on your website.

-   **US Transactions:** Approximately **3.49% + $0.49** per transaction.
-   **International:** Fees are slightly higher (approx. +1.50%).
-   *Rates are subject to change by PayPal.*
