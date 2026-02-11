# Client Guide: Setting Up Payments (PayPal, Cards, Apple Pay) without Stripe

This guide explains how to enable **PayPal**, **Credit Cards**, and **Apple Pay** on your website using a single integrated solution called **Braintree** (a PayPal service).

## Why Braintree?
- **Owned by PayPal**: It is the official "advanced" way to accept payments.
- **Top-Tier Security**: Handles all PCI compliance for you.
- **Visuals**: We can design the credit card fields to look exactly like your website (no redirects).

---

## 1. Costs & Fees (Standard Pricing)
Braintree has no monthly fee and no hidden startup costs. You only pay when you make a sale.

| Payment Method | Transaction Fee | Notes |
| :--- | :--- | :--- |
| **Cards & Digital Wallets** | **2.59% + $0.49** | Includes Visa, Mastercard, Apple Pay, Google Pay, Venmo. |
| **PayPal** | **2.59% + $0.49** | Standard PayPal transaction rate. |
| **ACH Direct Debit** | **0.75%** | Max capped at $5.00 per transaction. |
| **Chargebacks** | **$15.00** | Only if a customer disputes a charge (refunded if you win). |

*Note: Rates are for US merchants. Non-profits sometimes get lower rates (check with Braintree).*

---

## 2. What We Need From You (The Checklist)
To connect your website to the payment system, we need **three specific keys** from your Braintree account.

### Step A: Create Account
1.  Go to [Braintree Payments](https://www.braintreepayments.com/) and click **Sign Up**.
2.  Login with your **PayPal Business** account (recommended) or create a new one.

### Step B: Get Production Keys
Once your account is approved (usually instant or 1-2 days):
1.  Log in to the **Braintree Control Panel**.
2.  Click the **Gear icon** (Settings) > **API**.
3.  Click **Generate New API Key**.
4.  In the "Private Key" column, click **View**.
5.  **Copy and send us these 3 items:**
    -   **Merchant ID**
    -   **Public Key**
    -   **Private Key**

---

## 3. Apple Pay (Special Requirement)
If you want the **Apple Pay** button to appear on iPhones/Macs:
1.  You must have an **Apple Developer Account** (Enrolled as an Organization).
2.  This costs **$99/year** paid to Apple.
3.  If you *do not* have this, users can still pay on their iPhone using the **PayPal button** or by typing in their card number.
4.  **Recommendation**: We can launch *without* the specific Apple Pay button first, and add it later if you decide to buy the Apple Developer account.
