# SNS Events - Administrator Guide

Welcome to the SNS Events Administrator Guide. This comprehensive manual will help you manage every aspect of your website through the admin dashboard.

---

## Table of Contents

1. [Getting Started](#getting-started)
2. [Dashboard Overview](#dashboard-overview)
3. [Company Settings](#company-settings)
4. [Hero Section Management](#hero-section-management)
5. [Event Types Management](#event-types-management)
6. [Pricing Tiers Management](#pricing-tiers-management)
7. [Gallery Management](#gallery-management)
8. [Service Areas Management](#service-areas-management)
9. [Testimonials Management](#testimonials-management)
10. [FAQs Management](#faqs-management)
11. [Counseling/Coaching Management](#counselingcoaching-management)
12. [Management Session](#management-session)
13. [Inquiries & Custom Requests](#inquiries--custom-requests)
14. [Navigation Bar Management](#navigation-bar-management)
15. [Homepage Sections Management](#homepage-sections-management)
16. [SEO Management](#seo-management)
17. [Settings & Customization](#settings--customization)
18. [Legal Pages Management](#legal-pages-management)
19. [Contact Information](#contact-information)
20. [About Us Management](#about-us-management)

---

## Getting Started

### Accessing the Admin Panel

1. Navigate to your website URL and add `/login` to the end (e.g., `https://yourwebsite.com/login`)
2. Enter your administrator email and password
3. Click "Login" to access the admin dashboard

### Admin Dashboard Layout

Once logged in, you'll see a sidebar navigation menu with all available modules. The main content area displays the selected module's interface.

---

## Dashboard Overview

The dashboard is your central hub for managing the website. It displays:
- Quick statistics and metrics
- Recent activity
- Quick access links to commonly used features

---

## Company Settings

### Company Profile Management

The Company Profile contains CEO/founder information displayed on your website.

#### How to Edit Company Profile

1. Click **"Company Profile"** from the sidebar menu
2. Click the **"Edit"** button
3. Fill in the following fields:
   - **CEO Name**: Name of the company CEO or founder
   - **CEO Title**: Position/title (e.g., "Founder & CEO")
   - **CEO Bio**: Brief biography or message from the CEO
   - **CEO Image**: Upload a professional photo of the CEO
     - Click **"Choose File"** to select an image from your computer
     - Recommended size: 500x500 pixels, JPG or PNG format
4. Click **"Update"** to save changes

> [!TIP]
> Use a high-quality, professional headshot for the CEO image. This builds trust with potential clients.

---

## Hero Section Management

The Hero Section is the first thing visitors see on your homepage. You can create multiple slides that rotate automatically.

### Viewing Hero Slides

1. Click **"Hero Section"** from the sidebar menu
2. View all existing hero slides in a list
3. See which slides are active and their sort order

### Creating a New Hero Slide

1. Click **"Hero Section"** > **"Add New Slide"**
2. Fill in the following information:

   **Content Fields:**
   - **Heading**: Main headline (e.g., "Transform Your Events Into Magical Moments")
   - **Subheading**: Supporting text or description
   - **Button Text**: Text for the call-to-action button
   - **Button Link**: URL where the button should redirect users

   **Media Options:**
   - **Background Type**: Choose between:
     - **Image**: Upload a static background image
     - **Video**: Upload a background video for more dynamic effect
     - **Cloudinary Video**: Use a video hosted on Cloudinary (enter the Cloudinary URL)
   
   **Image/Video Upload:**
   - Click **"Choose File"** for image or video
   - Recommended image size: 1920x1080 pixels (Full HD)
   - Recommended video format: MP4, maximum 10MB for best performance

   **Settings:**
   - **Sort Order**: Number to control the order slides appear (1, 2, 3, etc.)
   - **Active**: Check this box to make the slide visible on the website

3. Click **"Save"** to create the slide

### Editing a Hero Slide

1. Go to **"Hero Section"** from the sidebar
2. Find the slide you want to edit
3. Click the **"Edit"** button (pencil icon)
4. Modify the fields you want to change
5. Click **"Update"** to save changes

### Deleting a Hero Slide

1. Go to **"Hero Section"**
2. Find the slide you want to remove
3. Click the **"Delete"** button (trash icon)
4. Confirm the deletion when prompted

> [!WARNING]
> Deleting a hero slide is permanent and cannot be undone. Make sure you really want to remove it.

### Managing Cover Images

You can also remove the cover image from existing slides:
1. Edit the slide
2. Check the **"Remove Cover Image"** checkbox
3. Click **"Update"**

---

## Event Types Management

Event Types are the services you offer (e.g., Birthday Parties, Weddings, Corporate Events).

### Viewing All Event Types

1. Click **"Event Types"** from the admin sidebar
2. Browse through the list using the DataTable interface
3. Use the search bar to find specific event types
4. Sort by clicking column headers

### Creating a New Event Type

1. Click **"Event Types"** > **"Create New Event Type"**
2. Fill in the following details:

   **Basic Information:**
   - **Name**: The name of the service (e.g., "Birthday Party Decoration")
   - **Slug**: URL-friendly version (auto-generated, but editable)
   - **Description**: Detailed description of this event type
   - **Short Description**: Brief summary (used in preview cards)

   **Visual Content:**
   - **Featured Image**: Main image representing this service
     - Click **"Choose File"** to upload
     - Recommended: 800x600 pixels, high-quality JPG or PNG
   
   **Categories:**
   - **Refined Event Category**: Select the broad category this belongs to
     - Social Events
     - Corporate Events
     - Special Occasions
     - etc.

   **Display Settings:**
   - **Display Order**: Number to control where this appears in lists
   - **Status**: Toggle active/inactive
   - **Featured**: Check to highlight this service
   - **Show on Homepage**: Check to display on the main page

3. Click **"Create"** to save the new event type

### Editing an Event Type

1. Go to **"Event Types"**
2. Click **"Edit"** (pencil icon) on the event type you want to modify
3. Update any fields as needed
4. Click **"Update"** to save changes

### Deleting an Event Type

1. Go to **"Event Types"**
2. Click **"Delete"** (trash icon) on the event type you want to remove
3. Confirm deletion

> [!CAUTION]
> Deleting an event type will also remove all associated pricing tiers and gallery images. This action cannot be undone.

---

## Pricing Tiers Management

Pricing tiers are the different package options you offer for each event type (e.g., Basic, Standard, Premium).

### Viewing Pricing Tiers

1. Click **"Pricing Tiers"** from the sidebar
2. View all pricing packages organized by event type

### Creating a New Pricing Tier

1. Go to **"Pricing Tiers"** > **"Create New Tier"**
2. Fill in the required information:

   **Package Details:**
   - **Event Type**: Select which service this pricing belongs to
   - **Tier Name**: Name of the package (e.g., "Basic Package", "Premium Package")
   - **Price**: Cost of this package (enter numbers only, e.g., 500)
   - **Description**: What's included in this package

   **Features:**
   - **Features**: List of included items (one per line or comma-separated)
     ```
     Setup and takedown
     Custom color scheme
     Balloon arch
     Table centerpieces
     ```

   **Display:**
   - **Display Order**: Number to control the order (1, 2, 3...)
   - **Status**: Active/Inactive toggle
   - **Highlight as Popular**: Check to add a "Most Popular" badge

3. Click **"Save"** to create the pricing tier

### Editing a Pricing Tier

1. Go to **"Pricing Tiers"**
2. Find the tier and click **"Edit"**
3. Modify the fields
4. Click **"Update"**

### Deleting a Pricing Tier

1. Go to **"Pricing Tiers"**
2. Click **"Delete"** on the tier you want to remove
3. Confirm deletion

---

## Gallery Management

Upload and manage photos of your past events to showcase your work.

### Viewing Gallery Images

1. Click **"Gallery"** from the sidebar
2. Browse all uploaded images
3. Filter by event type or category

### Adding New Gallery Images

1. Go to **"Gallery"** > **"Upload New Images"**
2. Fill in the details:

   **Image Information:**
   - **Event Type**: Which service category this image belongs to
   - **Refined Event Category**: Broader categorization (e.g., Social Events, Corporate)
   - **Image**: Upload the photo
     - Click **"Choose File"**
     - Recommended: High-resolution JPG or PNG, at least 1200x800 pixels
   - **Caption/Title**: Brief description of the image
   - **Alt Text**: Description for accessibility and SEO

   **Settings:**
   - **Display Order**: Control the order images appear
   - **Featured**: Mark as a featured image to highlight it

3. Click **"Upload"** to add the image

### Editing Gallery Images

1. Go to **"Gallery"**
2. Click **"Edit"** on the image
3. Update caption, category, or display order
4. Click **"Update"**

### Deleting Gallery Images

1. Go to **"Gallery"**
2. Click **"Delete"** on the image
3. Confirm deletion

> [!TIP]
> Organize your gallery images with clear categories and good alt text for better SEO performance.

---

## Service Areas Management

Manage the geographic locations where you provide services.

### Viewing Service Areas

1. Click **"Service Areas"** from the sidebar
2. View all locations you serve

### Page Settings

Before adding individual areas, configure the Service Areas page:

1. Go to **"Service Areas"** > **"Page Settings"**
2. Configure:
   - **Page Heading**: Main title (e.g., "Areas We Serve")
   - **Subheading**: Supporting text
   - **Hero Image**: Background image for the page header
   - **SEO Title**: Page title for search engines
   - **SEO Description**: Meta description
   - **SEO Keywords**: Relevant keywords (comma-separated)
3. Click **"Save Settings"**

### Adding a New Service Area

1. Go to **"Service Areas"** > **"Create New Area"**
2. Fill in the information:

   **Location Details:**
   - **Area Name**: City or region name (e.g., "Dallas", "Fort Worth")
   - **State**: State abbreviation (e.g., "TX")
   - **Description**: Information about services in this area
   - **Coverage Radius**: Optional - how far from this location you serve

   **Display:**
   - **Display Order**: Control listing order
   - **Active**: Make visible on the website

3. Click **"Save"**

### Editing a Service Area

1. Go to **"Service Areas"**
2. Click **"Edit"** on the area
3. Update information
4. Click **"Update"**

### Deleting a Service Area

1. Go to **"Service Areas"**
2. Click **"Delete"**
3. Confirm deletion

---

## Testimonials Management

Manage customer reviews and testimonials displayed on your website.

### Viewing Testimonials

1. Click **"Testimonials"** from the sidebar
2. View all customer testimonials

### Adding a New Testimonial

1. Go to **"Testimonials"** > **"Create New Testimonial"**
2. Fill in the details:

   **Customer Information:**
   - **Client Name**: Full name of the customer
   - **Client Title/Role**: Optional (e.g., "Bride", "Event Coordinator")
   - **Client Photo**: Optional profile picture
   - **Company**: Optional company name

   **Testimonial Content:**
   - **Testimonial Text**: The actual review/feedback from the customer
   - **Rating**: Star rating (1-5 stars)
   - **Event Type**: Which service they used

   **Display Settings:**
   - **Display Order**: Control order of appearance
   - **Active**: Toggle visibility
   - **Featured**: Highlight important testimonials

3. Click **"Save"**

### Editing a Testimonial

1. Go to **"Testimonials"**
2. Click **"Edit"** on the testimonial
3. Modify content
4. Click **"Update"**

### Deleting a Testimonial

1. Go to **"Testimonials"**
2. Click **"Delete"**
3. Confirm deletion

> [!TIP]
> Always get permission from customers before publishing their testimonials and photos.

---

## FAQs Management

Manage Frequently Asked Questions displayed on your website.

### Viewing FAQs

1. Click **"FAQs"** from the sidebar
2. View all questions and answers

### Adding a New FAQ

1. Go to **"FAQs"** > **"Create New FAQ"**
2. Fill in:

   **Content:**
   - **Question**: The frequently asked question
   - **Answer**: Detailed answer or explanation
   - **Category**: Optional grouping (e.g., "Pricing", "Services", "Booking")

   **Display:**
   - **Display Order**: Control the order FAQs appear
   - **Active**: Toggle visibility

3. Click **"Save"**

### Editing an FAQ

1. Go to **"FAQs"**
2. Click **"Edit"** on the FAQ
3. Update question or answer
4. Click **"Update"**

### Deleting an FAQ

1. Go to **"FAQs"**
2. Click **"Delete"**
3. Confirm deletion

---

## Counseling/Coaching Management

Manage counseling or coaching session bookings and availability.

### Settings Configuration

1. Go to **"Counseling"** > **"Settings"**
2. Configure:
   - **Service Name**: Display name (e.g., "Event Planning Consultation")
   - **Description**: What the counseling session includes
   - **Default Duration**: Standard session length (30, 45, 60, 75, or 90 minutes, or custom)
   - **Price per Session**: Cost
   - **Booking Instructions**: Information for customers
   - **Terms and Conditions**: Session-specific terms
3. Click **"Save Settings"**

### Managing Available Time Slots

#### Viewing Time Slots

1. Go to **"Counseling"** > **"Time Slots"**
2. View all available appointment times

#### Creating a New Time Slot

1. Click **"Create New Slot"**
2. Fill in:
   - **Date**: Which day this slot is available
   - **Start Time**: When the session starts
   - **Duration**: Length of the session (choose from preset options or enter custom minutes)
   - **Maximum Bookings**: How many people can book this slot (usually 1)
   - **Notes**: Internal notes (not visible to customers)
3. Click **"Save"**

#### Editing a Time Slot

1. Go to **"Time Slots"**
2. Click **"Edit"** on the slot
3. Modify details
4. Click **"Update"**

#### Deleting a Time Slot

1. Go to **"Time Slots"**
2. Click **"Delete"**
3. Confirm deletion

> [!WARNING]
> Deleting a time slot that has existing bookings may cause issues. Check bookings first.

### Managing Bookings

#### Viewing Bookings

1. Go to **"Counseling"** > **"Bookings"**
2. See all appointment bookings with:
   - Customer name and contact info
   - Booking date and time
   - Status (Pending, Confirmed, Completed, Cancelled)

#### Updating Booking Status

1. Go to **"Bookings"**
2. Find the booking
3. Click **"Change Status"**
4. Select new status:
   - **Pending**: Awaiting confirmation
   - **Confirmed**: Approved and scheduled
   - **Completed**: Session has occurred
   - **Cancelled**: Booking cancelled
5. Click **"Update"**

#### Deleting a Booking

1. Go to **"Bookings"**
2. Click **"Delete"** on the booking
3. Confirm deletion

---

## Management Session

Management sessions work similarly to counseling sessions but are for business/event management consultations.

### Settings Configuration

1. Go to **"Management Session"** > **"Settings"**
2. Configure the same fields as Counseling Settings:
   - Service name
   - Description
   - Duration options
   - Pricing
   - Instructions
3. Click **"Save Settings"**

### Managing Slots and Bookings

Follow the same procedures as the Counseling module:
- **Time Slots**: Create, edit, and delete available appointment times
- **Bookings**: View and manage customer bookings

---

## Inquiries & Custom Requests

Manage customer inquiries and custom package requests.

### Package Inquiries

#### Viewing Inquiries

1. Click **"Inquiries"** from the sidebar
2. View all package inquiries with:
   - Customer name and contact
   - Event type they're interested in
   - Selected pricing tier
   - Event date and details
   - Status

#### Managing Inquiry Status

1. Find the inquiry
2. Click **"Update Status"**
3. Select:
   - **New**: Just received
   - **In Progress**: Currently being handled
   - **Contacted**: Customer has been reached
   - **Converted**: Booking confirmed
   - **Closed**: Completed or declined
4. Click **"Save"**

#### Deleting an Inquiry

1. Find the inquiry
2. Click **"Delete"**
3. Confirm deletion

### Custom Package Requests

#### Viewing Custom Requests

1. Click **"Custom Requests"** from the sidebar
2. View all custom package requests with:
   - Customer details
   - Event description
   - Special requirements
   - Budget range
   - Status

#### Managing Custom Request Status

1. Find the request
2. Click **"Update Status"**
3. Select appropriate status
4. Click **"Save"**

#### Deleting a Custom Request

1. Find the request
2. Click **"Delete"**
3. Confirm deletion

> [!IMPORTANT]
> Always respond to inquiries and custom requests promptly to maintain good customer relationships.

---

## Navigation Bar Management

Control what appears in your website's navigation menu.

### Viewing Navigation Items

1. Click **"Navigation"** or **"Navbar Items"** from the sidebar
2. View all menu items and their sub-items

### Creating a New Navigation Item

1. Go to **"Navbar Items"** > **"Create New Item"**
2. Fill in:

   **Menu Item Details:**
   - **Label**: Text displayed in the menu (e.g., "Services", "About Us")
   - **URL**: Where this menu item links to
     - Internal pages: `/about-us`, `/services`
     - External links: `https://example.com`
     - Dropdown parent: `#` (for items with sub-menus)
   
   **Parent Item:**
   - **Parent**: Leave empty for top-level menu items
   - Select a parent to create a dropdown sub-item

   **Settings:**
   - **Order**: Control the menu order (1, 2, 3...)
   - **Active**: Toggle visibility
   - **Open in New Tab**: Check for external links

3. Click **"Save"**

### Creating Dropdown Menus

1. First, create a parent menu item:
   - Label: "Services"
   - URL: `#`
   - Order: 3
   - Active: Yes

2. Then create sub-items:
   - Label: "Birthday Parties"
   - URL: `/events/birthday-parties`
   - Parent: Select "Services"
   - Order: 1
   - Active: Yes

3. Repeat for all sub-items

### Editing a Navigation Item

1. Go to **"Navbar Items"**
2. Click **"Edit"** on the item
3. Modify fields
4. Click **"Update"**

### Deleting a Navigation Item

1. Go to **"Navbar Items"**
2. Click **"Delete"**
3. Confirm deletion

> [!WARNING]
> Deleting a parent menu item will also remove all its sub-items.

---

## Homepage Sections Management

Control which sections appear on your homepage and their order.

### Viewing Homepage Sections

1. Click **"Homepage Sections"** from the sidebar
2. See all available sections:
   - Hero Section
   - About Us
   - Services
   - Process
   - Mission & Vision
   - Service Areas
   - Testimonials
   - FAQs
   - Contact

### Reordering Sections

1. Go to **"Homepage Sections"**
2. Use the **drag handle** icon to reorder sections
3. Drag sections up or down
4. Changes save automatically

### Toggling Section Visibility

1. Find the section you want to show/hide
2. Click the **"Visibility"** toggle switch
3. Green = Visible, Gray = Hidden
4. Changes save automatically

> [!TIP]
> Hide sections you're not ready to publish yet while keeping the content saved in the system.

---

## SEO Management

Optimize your website pages for search engines.

### Viewing SEO Pages

1. Click **"SEO"** from the sidebar
2. View all pages with SEO settings:
   - Homepage
   - About Us
   - Events/Services
   - Contact
   - Service Areas

### Editing SEO for a Page

1. Go to **"SEO"**
2. Click **"Edit"** on the page you want to optimize
3. Fill in:

   **Basic SEO:**
   - **Meta Title**: Page title for search engines (60 characters max)
   - **Meta Description**: Brief description (155 characters max)
   - **Meta Keywords**: Relevant keywords (comma-separated)

   **Open Graph (Social Media):**
   - **OG Title**: Title when shared on social media
   - **OG Description**: Description for social sharing
   - **OG Image**: Image displayed when shared
   - **OG Type**: Type of content (website, article, etc.)

   **Twitter Card:**
   - **Twitter Card Type**: Summary, summary_large_image, etc.
   - **Twitter Title**: Title for Twitter shares
   - **Twitter Description**: Description for Twitter
   - **Twitter Image**: Twitter-specific image

   **Advanced:**
   - **Canonical URL**: Preferred URL for this page
   - **Robots**: Control search engine indexing (index/noindex, follow/nofollow)
   - **Schema Markup**: Structured data (JSON-LD format)

4. Click **"Update"** to save

> [!TIP]
> Good SEO practices:
> - Use unique titles and descriptions for each page
> - Include relevant keywords naturally
> - Keep titles under 60 characters
> - Keep descriptions under 155 characters
> - Use high-quality images for social sharing

---

## Settings & Customization

### General Settings

1. Go to **"Settings"** from the sidebar
2. Configure global website settings:

   **Site Information:**
   - **Site Name**: Your company name
   - **Site Tagline**: Brief description
   - **Site Logo**: Upload your logo
   - **Favicon**: Small icon for browser tabs

   **Theme Colors:**
   - **Primary Color**: Main brand color
   - **Secondary Color**: Accent color
   - **Background Color**: Page background
   - **Text Color**: Default text color
   - **Link Color**: Hyperlink color

   **Contact:**
   - **Default Email**: Where inquiries are sent
   - **Support Email**: Customer support address
   - **Phone Number**: Contact phone

   **Social Media:**
   - **Facebook URL**
   - **Instagram URL**
   - **Twitter URL**
   - **LinkedIn URL**
   - **YouTube URL**

   **Features:**
   - **Enable Bookings**: Turn booking system on/off
   - **Maintenance Mode**: Show maintenance page
   - **Google Analytics ID**: For tracking

3. Click **"Update Settings"**

> [!IMPORTANT]
> Changes to theme colors will affect the entire website. Preview changes before publishing.

---

## Legal Pages Management

Manage your website's legal documents.

### Privacy Policy

1. Go to **"Privacy Policy"** from the sidebar
2. Click **"Edit"**
3. Enter or update the privacy policy content:
   - Use the rich text editor
   - Format text with headings, lists, bold, italic
   - Add links where needed
4. Click **"Update"**

### Terms and Conditions

1. Go to **"Terms and Conditions"** from the sidebar
2. Click **"Edit"**
3. Enter or update the terms content
4. Click **"Update"**

### Counseling Terms

Separate terms specifically for counseling/coaching sessions:

1. Go to **"Counseling Terms"** from the sidebar
2. Click **"Edit"**
3. Enter counseling-specific terms:
   - Cancellation policy
   - Refund policy
   - Session conduct rules
4. Click **"Update"**

> [!CAUTION]
> Legal pages are important for compliance. Consider consulting with a legal professional before publishing.

---

## Contact Information

Manage the contact details displayed on your website.

### Editing Contact Information

1. Click **"Contact Info"** from the sidebar
2. Click **"Edit"**
3. Update the following:

   **Business Address:**
   - **Street Address**
   - **City**
   - **State**
   - **ZIP Code**
   - **Country**

   **Contact Details:**
   - **Primary Phone**: Main contact number
   - **Secondary Phone**: Alternative number
   - **Email Address**: Primary email
   - **Support Email**: Customer support email

   **Business Hours:**
   - **Monday - Friday**: Operating hours
   - **Saturday**: Weekend hours
   - **Sunday**: Weekend hours
   - **Special Hours**: Holiday or special event hours

   **Map:**
   - **Embed Code**: Google Maps embed code for location
   - **Latitude/Longitude**: For map pin

   **Social Media:**
   - Links to all social profiles

4. Click **"Update"**

### Getting Google Maps Embed Code

1. Go to [Google Maps](https://maps.google.com)
2. Search for your business address
3. Click **"Share"**
4. Click **"Embed a map"**
5. Select size and copy the embed code
6. Paste it into the Embed Code field

---

## About Us Management

Manage your company's About Us page content.

### Editing About Us Content

1. Click **"About Us"** from the sidebar
2. Click **"Edit"**
3. Update the following sections:

   **Main Content:**
   - **Title**: Main heading (e.g., "About SNS Events")
   - **Subtitle**: Supporting tagline
   - **Main Description**: Detailed company description
   - **About Image**: Company photo or team photo
     - Click **"Choose File"** to upload
     - Recommended: 1200x800 pixels

   **Mission Statement:**
   - **Mission Title**: Heading (e.g., "Our Mission")
   - **Mission Description**: Your company's mission

   **Vision Statement:**
   - **Vision Title**: Heading (e.g., "Our Vision")
   - **Vision Description**: Your company's vision for the future

   **Values:**
   - **Values**: Company core values (list format)

   **Team Section:**
   - **Team Title**: Heading (e.g., "Meet Our Team")
   - **Team Description**: Information about your team
   - **Team Image**: Group photo or collage

   **History:**
   - **Year Founded**: When the company started
   - **Company Story**: Your company's journey and growth

4. Click **"Update"** to save

> [!TIP]
> Use authentic photos and genuine storytelling to connect with visitors and build trust.

---

## Best Practices & Tips

### General Admin Tips

1. **Regular Updates**: Keep your content fresh by regularly updating:
   - Gallery with new event photos
   - Testimonials from recent clients
   - Service offerings as they evolve

2. **Image Optimization**:
   - Compress images before uploading to improve page speed
   - Use descriptive file names (e.g., `birthday-party-dallas.jpg`)
   - Always add alt text for SEO and accessibility

3. **Content Quality**:
   - Use clear, professional language
   - Check for spelling and grammar errors
   - Keep descriptions concise but informative

4. **SEO Maintenance**:
   - Update meta descriptions regularly
   - Use relevant keywords naturally
   - Monitor search performance

5. **Mobile Responsiveness**:
   - Preview changes on mobile devices
   - Ensure images don't slow down mobile loading
   - Test navigation on smartphones

### Security Best Practices

1. **Password Security**:
   - Use strong, unique passwords
   - Change your password regularly
   - Never share admin credentials

2. **Regular Backups**:
   - Ensure your website is backed up regularly
   - Keep backups in a secure location
   - Test backup restoration periodically

3. **User Management**:
   - Remove inactive admin users
   - Use appropriate permission levels
   - Monitor user activity logs

### Content Management Workflow

1. **Before Publishing**:
   - Review content for accuracy
   - Check all links work correctly
   - Preview on multiple devices
   - Proofread for errors

2. **After Publishing**:
   - Test all new features
   - Verify images load correctly
   - Check SEO tags are showing properly
   - Monitor for any errors

3. **Regular Maintenance**:
   - Weekly: Check and respond to inquiries
   - Monthly: Update gallery and testimonials
   - Quarterly: Review and update SEO
   - Annually: Audit all content for relevance

---

## Troubleshooting Common Issues

### Images Not Displaying

**Problem**: Uploaded images don't show on the website

**Solutions**:
1. Check file format (use JPG or PNG)
2. Ensure file size is under 5MB
3. Verify image uploaded successfully
4. Clear browser cache and refresh

### Changes Not Showing

**Problem**: Updates made in admin don't appear on the website

**Solutions**:
1. Clear your browser cache (Ctrl+Shift+Delete)
2. Do a hard refresh (Ctrl+F5)
3. Check if the item is set to "Active"
4. Verify save was successful

### Cannot Delete Item

**Problem**: Unable to delete an event type, pricing tier, etc.

**Solutions**:
1. Check if item has dependencies (e.g., pricing tiers linked to it)
2. Remove dependencies first
3. Ensure you have proper permissions

### Editor Not Working

**Problem**: Rich text editor isn't loading

**Solutions**:
1. Try a different browser
2. Disable browser extensions temporarily
3. Clear browser cache
4. Check internet connection

### Login Issues

**Problem**: Cannot access admin panel

**Solutions**:
1. Verify correct email and password
2. Use password reset if forgotten
3. Check if account is active
4. Contact system administrator

---

## Getting Help

If you encounter issues not covered in this guide:

1. **Check Error Messages**: Read error messages carefully for clues
2. **Contact Support**: Reach out to your web developer or technical support team
3. **Document the Issue**: Take screenshots and note what you were doing when the problem occurred

---

## Glossary

**Active/Inactive**: Controls whether content is visible on the live website

**Slug**: URL-friendly version of a name (e.g., "birthday-party" from "Birthday Party")

**Display Order**: Number that controls the sequence items appear (lower numbers appear first)

**Featured**: Highlights important content to make it more prominent

**SEO**: Search Engine Optimization - making your website more visible in search engines

**Meta Tags**: HTML tags that provide information about your webpage to search engines

**OG Tags**: Open Graph tags for controlling how your content appears when shared on social media

**Schema Markup**: Structured data that helps search engines understand your content better

**Responsive**: Design that adapts to different screen sizes (desktop, tablet, mobile)

**Alt Text**: Descriptive text for images, used for accessibility and SEO

**CTA**: Call To Action - buttons or links encouraging users to take an action

---

## Conclusion

This guide covers all aspects of managing your SNS Events website through the admin dashboard. By following these instructions, you can:

- Keep your content fresh and engaging
- Manage customer inquiries efficiently
- Optimize your website for search engines
- Showcase your best work through galleries
- Update services and pricing as your business grows

Remember to make regular backups and always preview changes before publishing to the live website.

**Happy managing! 🎉**

---

*Last Updated: February 2026*
*Version: 1.0*
