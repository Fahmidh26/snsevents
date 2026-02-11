# Granting Developer Access (Safe Method)

Since you (the client) are the business owner, the payment accounts **must** be created under your name and business details to comply with banking regulations. However, you do not need to share your passwords!

Instead, you should **invite your developer** as a "Team Member". This allows them to set up the API and testing without seeing your sensitive banking info or needing your login.

---

## Option 1: Braintree (Recommended)

### How to Invite a Developer
1.  Log in to your **Braintree Control Panel**.
2.  Click the **Gear icon** (Settings) > **Team**.
3.  Click **New User**.
4.  Enter the Developer's Email: `[Developer's Email Here]`
5.  **Important:** Under "API Access", check the box **API Access**.
6.  Under "Role", select **Account Admin** or **Developer**.
7.  Click **Create User**.

**What happens next?**
The developer will receive an email to create their own login. They can then log in and generate the API keys themselves.

---

## Option 2: Stripe (Alternative)

If you choose to use Stripe instead of Braintree:

### How to Invite a Developer
1.  Log in to your **Stripe Dashboard**.
2.  Go to **Settings** (Gear icon) > **Team**.
3.  Click **+ New Member**.
4.  Enter the Developer's Email: `[Developer's Email Here]`
5.  Select the role **Developer**.
    *   *Note: This gives them access to API keys and test data but hides your bank account details.*
6.  Click **Invite**.

---

## Summary for the Client
*   **Do not** share your main password.
*   **Do** use the "Team" or "Users" feature to invite us.
*   This ensures you remain the legal owner of the account while we handle the technical setup.
