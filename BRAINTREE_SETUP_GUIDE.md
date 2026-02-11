# Braintree Setup Guide for Clients

This document provides a step-by-step guide on how to set up a Braintree account and obtain the necessary API keys to integrate payments into your website.

---

## 1. What is Braintree?

Braintree is a PayPal service that allows you to accept credit cards, PayPal, Apple Pay, and Google Pay on your website securely. It handles all the complex security requirements (PCI compliance) so you don't have to.

**Why use Braintree?**
*   **Unified Payments:** Accept cards and PayPal with one account.
*   **Security:** Industry-standard security and fraud protection.
*   **Modern Experience:** Allows for a seamless checkout experience directly on your site.

---

## 2. Setting Up Your Account

If you do not have a Braintree account yet, follow these steps:

1.  Go to the [Braintree Sign Up page](https://www.braintreepayments.com/).
2.  Click **Sign Up**.
    *   *Tip:* You can sign up using your existing **PayPal Business** account. This is recommended for faster approval and easier management.
3.  Complete the application form with your business details.
4.  Wait for approval. This can be instant or take 1-2 business days.

---

## 3. Obtaining Your API Keys

Once your account is approved and you can log in, we need **three** specific pieces of information to connect your website to Braintree:

1.  **Merchant ID**
2.  **Public Key**
3.  **Private Key**

### Step-by-Step Instructions:

1.  **Log In:**
    Log in to your [Braintree Control Panel](https://www.braintreegateway.com/login).

2.  **Navigate to API Keys:**
    *   Look for the **Gear icon** (Settings) in the top right corner.
    *   Select **API** from the dropdown menu.

3.  **Generate Keys (if needed):**
    *   If you see a section called "API Keys" with no keys listed, click the **Generate New API Key** button.
    *   If you already see keys listed, you can use the existing ones.

4.  **View Private Key:**
    *   In the "API Keys" list, locate the column named **Private Key**.
    *   Click the **View** link in that column. This will verify your identity (you may need to re-enter your password) and then show all three keys together.

5.  **Copy Credentials:**
    *   You will now see a box labeled **Client Library Keys** or just **API Keys**.
    *   Copy the **Merchant ID**, **Public Key**, and **Private Key**.

---

## 4. Merchant Account ID (Optional)

*Note: You likely only have one default Merchant Account ID, which is fine. However, if you accept multiple currencies (e.g., USD, GBP, EUR), you will have a specific "Merchant Account ID" for each currency.*

To find this:
1.  Go to **Settings** (Gear icon) > **Business**.
2.  Scroll down to the **Merchant Accounts** section.
3.  Copy the **Merchant Account ID** for the currency you want to use on the website (e.g., `yourbusinessname_USD`).

---

## 5. Security Warning

**Important:** Your **Private Key** is like a password. 
*   **Do not** post it publicly.
*   **Do not** send it in a group chat or insecure channel if avoidable.
*   **Secure Delivery:** preferably send these keys via a secure method (e.g., One-Time Secret, encrypted zip, or directly to your developer).

---

## Summary of What to Send Us:

Please provide the following:

1.  **Merchant ID**
2.  **Public Key**
3.  **Private Key**
4.  *(Optional)* **Merchant Account ID** (if different from default)
