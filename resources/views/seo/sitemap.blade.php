@php echo '<' . '?xml version="1.0" encoding="UTF-8"?' . '>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://www.sabahteachersunion.com/</loc>
        <lastmod>{{ date("Y-m-d") }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/mengenai-stu</loc>
        <lastmod>2026-04-22</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/aktiviti-kami</loc>
        <lastmod>{{ date("Y-m-d") }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/bukti-tuntutan</loc>
        <lastmod>{{ date("Y-m-d") }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/borang/muat-turun</loc>
        <lastmod>2026-04-22</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/hubungi</loc>
        <lastmod>2026-04-22</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/kerjaya</loc>
        <lastmod>2026-04-22</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/berita</loc>
        <lastmod>{{ date("Y-m-d") }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/keahlian</loc>
        <lastmod>2026-04-22</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://www.sabahteachersunion.com/ahli-tertinggi-exco</loc>
        <lastmod>2026-04-22</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    @foreach($news as $post)
    <url>
        <loc>https://www.sabahteachersunion.com/berita/{{ trim($post->slug, '/') }}</loc>
        <lastmod>{{ $post->published_at ? $post->published_at->format('Y-m-d') : $post->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    @foreach($jobs as $job)
    <url>
        <loc>https://www.sabahteachersunion.com/kerjaya/{{ trim($job->slug, '/') }}</loc>
        <lastmod>{{ $job->updated_at->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @endforeach
</urlset>
