<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Static marketing routes that belong in the sitemap. Transactional and
     * account pages (cart, checkout, sign-in, my-account) are excluded on
     * purpose so crawlers never index them.
     */
    private const STATIC_PATHS = [
        '/',
        '/shop/makeup',
        '/shop/skincare',
        '/shop/fragrance',
        '/shop/bath-body',
        '/shop/hair',
        '/shop/lips',
        '/shop/face',
        '/shop/makeup-palettes',
        '/shop/bestsellers',
        '/shop/new',
        '/shop/gifts',
        '/shop/gifts/minis-more',
        '/brands',
        '/brands/sephora-collection',
        '/beauty-offers',
        '/stores',
        '/gift-card-info',
        '/download-app',
        '/clean-at-sephora',
        '/faq',
        '/faq/delivery',
        '/faq/cancellation-and-refund',
        '/terms-and-conditions',
        '/contact-us',
    ];

    public function index(): Response
    {
        $xml = Cache::remember('sitemap.xml', now()->addHours(6), function (): string {
            // The freshest catalogue change is a truthful lastmod for the
            // marketing pages, which are rendered from the same content.
            $catalogueUpdatedAt = collect([
                Product::max('updated_at'),
                Category::max('updated_at'),
            ])->filter()->map(fn ($date) => Carbon::parse($date))->max();

            $urls = [];

            foreach (self::STATIC_PATHS as $path) {
                $urls[] = ['loc' => url($path), 'lastmod' => $catalogueUpdatedAt];
            }

            Product::query()
                ->where('is_active', true)
                ->select(['slug', 'updated_at'])
                ->orderBy('id')
                ->each(function (Product $product) use (&$urls): void {
                    $urls[] = [
                        'loc' => url('/p/'.$product->slug),
                        'lastmod' => $product->updated_at,
                    ];
                });

            Category::query()
                ->where('is_active', true)
                ->select(['slug', 'updated_at'])
                ->orderBy('id')
                ->each(function (Category $category) use (&$urls): void {
                    $urls[] = [
                        'loc' => url('/shop/'.$category->slug),
                        'lastmod' => $category->updated_at,
                    ];
                });

            $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
                .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

            foreach ($urls as $url) {
                $xml .= '  <url><loc>'.htmlspecialchars($url['loc'], ENT_XML1).'</loc>';
                if ($url['lastmod']) {
                    $xml .= '<lastmod>'.$url['lastmod']->toAtomString().'</lastmod>';
                }
                $xml .= "</url>\n";
            }

            return $xml.'</urlset>';
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    /**
     * robots.txt is generated so the sitemap URL always matches APP_URL,
     * instead of shipping a placeholder domain in a static file.
     */
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            'Disallow: /cart',
            'Disallow: /checkout',
            'Disallow: /my-account',
            'Disallow: /verify-email',
            '',
            'Sitemap: '.url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines)."\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
