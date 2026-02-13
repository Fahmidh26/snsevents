@if(isset($siteSettings) && isset($companyProfile))
@php
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "name" => "SNS Events", // Ideally from siteSettings if available, but hardcoded fallback is fine
        "image" => $siteSettings->logo_path ? asset('storage/'.$siteSettings->logo_path) : '',
        "description" => $companyProfile->mission ?? 'Premium event decoration services in Texas.',
        "address" => [
            "@type" => "PostalAddress",
            "addressRegion" => "Texas",
            "addressCountry" => "US"
        ],
        "url" => url('/'),
    ];

    if(isset($serviceAreas) && $serviceAreas->count() > 0) {
        $schema['areaServed'] = $serviceAreas->map(function($area) {
            return [
                '@type' => 'City',
                'name' => $area->name,
                'sameAs' => $area->map_url ?? ''
            ];
        }); // map returns a collection, json_encode handles it fine
    }
@endphp
<script type="application/ld+json">
{!! json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
