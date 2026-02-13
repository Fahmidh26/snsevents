# SEO Quick Reference Checklist

## When Renaming Routes/URLs

- [ ] Add 301 redirects from old URLs to new URLs in `routes/web.php`
- [ ] Update internal links in views (search for hardcoded URLs)
- [ ] Update sitemap (should auto-update if using dynamic sitemap)
- [ ] Submit updated sitemap to Google Search Console
- [ ] Request indexing for important new URLs
- [ ] Monitor 404 errors in Search Console

**Example**:
```php
Route::get('/old-url/{slug}', function($slug) {
    return redirect('/new-url/' . $slug, 301);
});
```

---

## When Removing a Service

### Before Deleting:
- [ ] Note the service slug (e.g., `birthday-party-planning`)
- [ ] Check Google Analytics for traffic to this page
- [ ] Identify similar services for potential redirect

### Choose Strategy:
- **High traffic + has similar service** → Redirect to similar service (301)
- **Low traffic + no similar service** → Redirect to `/services` (301)
- **Permanently discontinued** → Return 410 Gone status

### Implementation:
- [ ] Add redirect/410 to `routes/web.php` in SEO Redirects section
- [ ] Delete the service from admin panel
- [ ] Submit updated sitemap to Google Search Console
- [ ] Validate fix in Search Console (Pages → Not found)
- [ ] Monitor for 2-4 weeks

**Examples**:
```php
// Option 1: Redirect to similar service
Route::get('/services/old-service', function() {
    return redirect('/services/similar-service', 301);
});

// Option 2: Redirect to services index
Route::get('/services/old-service', function() {
    return redirect('/services', 301);
});

// Option 3: Return 410 Gone
Route::get('/services/old-service', function() {
    abort(410, 'This service has been permanently discontinued.');
});
```

---

## When Adding a New Service

- [ ] Ensure service has unique slug
- [ ] Add SEO meta fields (title, description, keywords)
- [ ] Add canonical tag in service detail view
- [ ] Submit updated sitemap to Google Search Console
- [ ] Request indexing for the new service URL
- [ ] Add internal links from related pages

**SEO Meta Fields**:
- Meta Title: 50-60 characters
- Meta Description: 150-160 characters
- Meta Keywords: 5-10 relevant keywords
- OG Image: 1200x630px recommended

---

## When Consolidating Services

**Scenario**: Merging "Service A" and "Service B" into "Service C"

- [ ] Create new consolidated service (Service C)
- [ ] Add 301 redirects from old services to new service
- [ ] Update internal links
- [ ] Delete old services from admin
- [ ] Submit updated sitemap
- [ ] Monitor traffic and conversions

**Example**:
```php
Route::get('/services/service-a', function() {
    return redirect('/services/service-c', 301);
});
Route::get('/services/service-b', function() {
    return redirect('/services/service-c', 301);
});
```

---

## Regular SEO Maintenance

### Weekly:
- [ ] Check Google Search Console for new 404 errors
- [ ] Review crawl errors and coverage issues

### Monthly:
- [ ] Review top performing service pages
- [ ] Update meta descriptions for low CTR pages
- [ ] Check for broken internal links
- [ ] Review and update sitemap

### Quarterly:
- [ ] Audit all redirects (remove unused ones after 1 year)
- [ ] Review and update service descriptions
- [ ] Check for duplicate content issues
- [ ] Analyze and optimize underperforming pages

---

## Common SEO Issues & Fixes

### Issue: Duplicate Content
**Symptoms**: Multiple URLs showing same content
**Fix**: Add canonical tags, use 301 redirects
```blade
<link rel="canonical" href="{{ route('services.show', $event->slug) }}" />
```

### Issue: 404 Errors
**Symptoms**: Pages not found in Search Console
**Fix**: Add 301 redirects or return 410 Gone

### Issue: Slow Indexing
**Symptoms**: New pages not appearing in Google
**Fix**: Submit sitemap, request indexing, add internal links

### Issue: Redirect Chains
**Symptoms**: A → B → C redirect pattern
**Fix**: Redirect directly A → C

---

## Important Files

- **Routes**: `routes/web.php` (SEO Redirects section)
- **Sitemap Controller**: `app/Http/Controllers/SitemapController.php`
- **Sitemap View**: `resources/views/sitemap.blade.php`
- **Event Controller**: `app/Http/Controllers/EventController.php`
- **Full Guide**: `SEO_REDIRECT_GUIDE.md`

---

## Quick Commands

### Search for hardcoded URLs:
```bash
grep -r "href=\"/events/" resources/views/
grep -r "url('/events/" resources/views/
```

### Clear route cache (after adding redirects):
```bash
php artisan route:clear
php artisan cache:clear
```

### Test a redirect:
Visit the old URL in browser and check:
- Does it redirect to the correct new URL?
- Is the status code 301? (Check in browser DevTools → Network tab)

---

## Google Search Console Quick Links

- **Submit Sitemap**: Sitemaps → Add new sitemap
- **Request Indexing**: URL Inspection → Request Indexing
- **Check 404s**: Pages → Not found (404)
- **Check Coverage**: Pages → Coverage
- **Validate Fixes**: Click "Validate Fix" after implementing redirects

---

**Last Updated**: February 13, 2026
