<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Routes with appropriate priorities --}}
    @php
        $staticMeta = [
            '/'                    => ['priority' => '1.0', 'changefreq' => 'weekly'],
            '/services'            => ['priority' => '0.9', 'changefreq' => 'weekly'],
            '/service-areas'       => ['priority' => '0.9', 'changefreq' => 'monthly'],
            '/about-us'            => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/counseling'          => ['priority' => '0.8', 'changefreq' => 'weekly'],
            '/management-session'  => ['priority' => '0.7', 'changefreq' => 'weekly'],
            '/custom-package'      => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/privacy-policy'      => ['priority' => '0.3', 'changefreq' => 'yearly'],
            '/terms-and-conditions'=> ['priority' => '0.3', 'changefreq' => 'yearly'],
            '/counseling-terms'    => ['priority' => '0.3', 'changefreq' => 'yearly'],
        ];
    @endphp
    @foreach ($routes as $route)
        @php $meta = $staticMeta[$route] ?? ['priority' => '0.6', 'changefreq' => 'monthly']; @endphp
        <url>
            <loc>{{ url($route) }}</loc>
            <changefreq>{{ $meta['changefreq'] }}</changefreq>
            <priority>{{ $meta['priority'] }}</priority>
        </url>
    @endforeach

    {{-- Dynamic Service/Event Pages --}}
    @foreach ($events as $event)
        <url>
            <loc>{{ route('services.show', $event->slug) }}</loc>
            <lastmod>{{ $event->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>

