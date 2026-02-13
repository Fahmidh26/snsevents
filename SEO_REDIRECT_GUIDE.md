# SEO Redirect Guide: Fixing Old /events/* URLs

## Problem Summary
You renamed your routes from `/events/{slug}` to `/services/{slug}`, which caused:
1. **404 Errors**: Google has indexed old `/events/*` URLs that no longer exist
2. **Duplicate Content**: Google sees `services/anniversary-party-planning` as duplicate content
3. **Crawl Issues**: Old URLs appear in "Crawled - currently not indexed" and "Not found (404)"

## Solution Implemented

### 1. 301 Permanent Redirects Added
We've added 301 permanent redirects in `routes/web.php` that automatically redirect:
- `/events` → `/services` (301)
- `/events/{slug}` → `/services/{slug}` (301)

**Why 301?** A 301 redirect tells Google that the content has **permanently moved** to a new location. This:
- Transfers SEO value (link equity) from old URLs to new URLs
- Prevents 404 errors
- Resolves duplicate content issues
- Maintains user experience for anyone with old bookmarks/links

### 2. Sitemap Already Correct
Your sitemap (`/sitemap.xml`) is already generating the correct `/services/*` URLs, so no changes needed there.

## Next Steps in Google Search Console

### Step 1: Submit Updated Sitemap
1. Go to **Google Search Console**
2. Navigate to **Sitemaps** (left sidebar)
3. Submit your sitemap URL: `https://yourdomain.com/sitemap.xml`
4. Google will recrawl and see the new `/services/*` URLs

### Step 2: Request Indexing for New URLs
For important service pages:
1. Go to **URL Inspection** tool
2. Enter the new URL (e.g., `https://yourdomain.com/services/anniversary-party-planning`)
3. Click **Request Indexing**
4. Repeat for your top 5-10 most important service pages

### Step 3: Mark Old URLs as Fixed (Optional)
1. Go to **Pages** → **Not found (404)**
2. You'll see the old `/events/*` URLs listed
3. Click **Validate Fix** after the redirects are live
4. Google will recrawl and confirm the 301 redirects are working

### Step 4: Handle Duplicate Content Issue
For the duplicate canonical issue with `services/anniversary-party-planning`:
1. Check if there are multiple URLs pointing to the same content
2. Ensure your service detail pages have proper canonical tags

## Canonical Tags (Important!)

Make sure your service detail pages include a canonical tag. Check your service detail view file (likely `resources/views/services/show.blade.php` or similar) and ensure it has:

```blade
<head>
    <link rel="canonical" href="{{ route('services.show', $event->slug) }}" />
    <!-- other meta tags -->
</head>
```

This tells Google which URL is the "official" version of the page.

## Timeline for Google to Update

- **Immediate**: 301 redirects work instantly for users
- **1-2 weeks**: Google recrawls and recognizes the redirects
- **2-4 weeks**: Old URLs removed from search results
- **4-8 weeks**: Full SEO value transferred to new URLs

## Monitoring Progress

### What to Watch in Google Search Console:
1. **Coverage Report**: 404 errors should decrease over time
2. **Sitemaps**: New URLs should appear as "Discovered" then "Indexed"
3. **Performance**: Check that traffic shifts from old to new URLs
4. **URL Inspection**: Verify redirects are working (should show "Page is not indexed: Redirect")

### Testing Your Redirects
You can test the redirects are working:
1. Visit: `https://yourdomain.com/events/anniversary-party-planning`
2. You should be automatically redirected to: `https://yourdomain.com/services/anniversary-party-planning`
3. Check the HTTP status code (should be 301) using browser dev tools or online tools like:
   - https://httpstatus.io/
   - https://www.redirect-checker.org/

## Common Questions

### Q: Will I lose my search rankings?
**A:** No. 301 redirects preserve your SEO value. Google transfers the ranking signals from old URLs to new URLs.

### Q: How long should I keep the redirects?
**A:** Keep them permanently. There's no downside, and it ensures anyone with old links can still reach your content.

### Q: What about external links pointing to old URLs?
**A:** The 301 redirects handle this automatically. External links to `/events/*` will redirect to `/services/*` and pass SEO value.

### Q: Should I update old URLs manually in Google?
**A:** No need. Google will discover the redirects automatically when it recrawls. Just submit your updated sitemap.

## Verification Checklist

- [x] 301 redirects added in `routes/web.php`
- [ ] Test redirects are working (visit old URLs)
- [ ] Submit updated sitemap to Google Search Console
- [ ] Request indexing for top service pages
- [ ] Add/verify canonical tags in service detail pages
- [ ] Monitor Google Search Console for 2-4 weeks

## Additional Recommendations

### 1. Update Internal Links
While redirects work, it's best practice to update internal links:
- Search your codebase for any hardcoded `/events/` links
- Update them to `/services/` to avoid unnecessary redirects

### 2. Update External References
If you control these, update:
- Social media profiles
- Business listings
- Email signatures
- Marketing materials

### 3. Check for Hardcoded URLs
Run this search in your codebase:
```bash
grep -r "href=\"/events/" resources/views/
grep -r "url('/events/" resources/views/
```

## Handling Removed or Deleted Services

### The Problem
When you remove a service from your website (e.g., delete "Birthday Party Planning"), Google may still have that URL indexed, leading to:
- 404 errors in Search Console
- Lost SEO value
- Poor user experience for people clicking old search results

### Best Practices for Removed Services

#### Option 1: Redirect to a Similar Service (Recommended)
If you're removing a service but have a similar alternative, redirect to that:

**Example**: Removing "Birthday Party Planning" → Redirect to "Anniversary Party Planning"

Add to `routes/web.php` (in the SEO Redirects section):
```php
// Redirect removed services to similar alternatives
Route::get('/services/birthday-party-planning', function() {
    return redirect('/services/anniversary-party-planning', 301);
});
```

**When to use**: When you have a replacement or similar service.

#### Option 2: Redirect to Services Index Page
If there's no direct replacement, redirect to the main services page:

```php
// Redirect removed service to services index
Route::get('/services/old-service-slug', function() {
    return redirect('/services', 301);
});
```

**When to use**: When the service is discontinued with no direct replacement.

#### Option 3: Return 410 Gone Status (For Permanently Removed Services)
For services that are permanently discontinued and won't return:

```php
// Return 410 Gone for permanently discontinued services
Route::get('/services/discontinued-service', function() {
    abort(410, 'This service has been permanently discontinued.');
});
```

**When to use**: When you want Google to remove the page from search results faster than a 404.

**Note**: A 410 status tells Google "this content is gone forever and won't come back," which makes Google remove it from search results faster than a 404.

### Step-by-Step Process When Removing a Service

#### Step 1: Before Deleting
1. **Document the service slug** (e.g., `birthday-party-planning`)
2. **Check Google Analytics** to see if this page gets traffic
3. **Identify similar services** that could be alternatives

#### Step 2: Choose Your Strategy
- **High traffic page** → Redirect to similar service (Option 1)
- **Low traffic, has alternative** → Redirect to services index (Option 2)
- **Permanently discontinued** → Use 410 Gone (Option 3)

#### Step 3: Implement the Redirect
Add the appropriate redirect to `routes/web.php` in the SEO Redirects section:

```php
// SEO Redirects: Old /events/* URLs to new /services/* URLs (301 Permanent Redirect)
Route::get('/events', function() {
    return redirect('/services', 301);
});
Route::get('/events/{slug}', function($slug) {
    return redirect('/services/' . $slug, 301);
});

// Redirects for removed services
Route::get('/services/birthday-party-planning', function() {
    return redirect('/services/anniversary-party-planning', 301);
});
Route::get('/services/old-service-2', function() {
    return redirect('/services', 301);
});
```

#### Step 4: Delete the Service
Now you can safely delete the service from your admin panel.

#### Step 5: Update Google Search Console
1. Go to **Google Search Console**
2. Navigate to **Pages** → **Not found (404)**
3. Find the removed service URL
4. Click **Validate Fix** (if you added a redirect)
5. Google will recrawl and see the redirect

#### Step 6: Submit Updated Sitemap
Your sitemap automatically excludes deleted services (since it only includes `status = true`), but submit it again to speed up the process:
1. Go to **Sitemaps** in Search Console
2. Resubmit your sitemap URL

### Example Scenarios

#### Scenario 1: Consolidating Similar Services
**Situation**: You had "Kids Birthday Party" and "Adult Birthday Party" but want to combine them into just "Birthday Party Planning"

**Solution**:
```php
Route::get('/services/kids-birthday-party', function() {
    return redirect('/services/birthday-party-planning', 301);
});
Route::get('/services/adult-birthday-party', function() {
    return redirect('/services/birthday-party-planning', 301);
});
```

#### Scenario 2: Discontinuing a Service Category
**Situation**: You no longer offer "Virtual Events" at all

**Solution**:
```php
Route::get('/services/virtual-events', function() {
    return redirect('/services', 301);
    // OR use 410 if you want faster removal from Google:
    // abort(410, 'Virtual events are no longer offered.');
});
```

#### Scenario 3: Renaming a Service
**Situation**: You renamed "Wedding Decoration" to "Wedding Planning & Decoration"

**Solution**:
```php
Route::get('/services/wedding-decoration', function() {
    return redirect('/services/wedding-planning-decoration', 301);
});
```

### Managing Multiple Removed Services

If you're removing many services at once, create a mapping array for cleaner code:

```php
// Map of removed services to their redirects
$removedServices = [
    'old-service-1' => '/services/new-service-1',
    'old-service-2' => '/services/new-service-2',
    'old-service-3' => '/services', // No replacement, go to index
];

foreach ($removedServices as $old => $new) {
    Route::get("/services/{$old}", function() use ($new) {
        return redirect($new, 301);
    });
}
```

### Monitoring Removed Services

#### What to Watch:
1. **Search Console Coverage Report**: Ensure 404s decrease
2. **Redirect Chains**: Avoid redirecting to another redirect
3. **Traffic Patterns**: Monitor if redirected traffic converts on new pages

#### Red Flags:
- ❌ Redirect chains (A → B → C) - Redirect directly (A → C)
- ❌ Redirect loops (A → B → A)
- ❌ Too many redirects to homepage (looks spammy to Google)

### FAQ: Removed Services

**Q: Should I keep redirects forever?**
**A:** Yes, keep them for at least 1 year. After that, if there's no traffic, you can remove them. But there's no harm in keeping them permanently.

**Q: What if I want to bring back a removed service later?**
**A:** Remove the redirect and recreate the service. If you used 410 Gone, it may take longer for Google to re-index.

**Q: How long until Google removes the old URL from search results?**
**A:** 
- With 301 redirect: 2-4 weeks (URL replaced with new one)
- With 410 Gone: 1-2 weeks (URL removed completely)
- With 404: 4-8 weeks (URL eventually removed)

**Q: Can I redirect multiple old services to one new service?**
**A:** Yes! This is fine and common when consolidating services.

**Q: What about external links to removed services?**
**A:** Redirects handle this automatically. External links will redirect to your chosen destination.

## Support Resources

- [Google: 301 Redirects](https://developers.google.com/search/docs/crawling-indexing/301-redirects)
- [Google: 410 Gone Status](https://developers.google.com/search/docs/crawling-indexing/http-status-codes)
- [Google: Canonical URLs](https://developers.google.com/search/docs/crawling-indexing/consolidate-duplicate-urls)
- [Google Search Console Help](https://support.google.com/webmasters/)

---

**Last Updated**: February 13, 2026
**Status**: Redirects implemented and ready for testing
