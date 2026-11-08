<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Setting;
use App\Models\Store;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        if (\DB::getDriverName() === 'mysql') {
            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        \DB::table('product_images')->truncate();
        \DB::table('product_shades')->truncate();
        \DB::table('category_product')->truncate();
        \DB::table('products')->truncate();
        \DB::table('brands')->truncate();
        \DB::table('categories')->truncate();
        \DB::table('faqs')->truncate();
        \DB::table('stores')->truncate();
        \DB::table('offers')->truncate();
        if (\DB::getDriverName() === 'mysql') {
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // ── Categories ──
        $cats = [];
        $c = Category::updateOrCreate(['slug' => 'makeup'], [
            'name' => 'Makeup', 'hero_title' => 'Makeup',
            'hero_subtitle' => 'Artistry-grade cosmetics for every look', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 1,
        ]);
        $cats['makeup'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'skincare'], [
            'name' => 'Skincare', 'hero_title' => 'Skincare',
            'hero_subtitle' => 'Science-backed skincare rituals', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 2,
        ]);
        $cats['skincare'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'fragrance'], [
            'name' => 'Fragrance', 'hero_title' => 'Fragrance',
            'hero_subtitle' => 'Signature scents & layering', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 3,
        ]);
        $cats['fragrance'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'bath-body'], [
            'name' => 'Bath & Body', 'hero_title' => 'Bath & Body',
            'hero_subtitle' => 'Body care, hand & cleansing', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 4,
        ]);
        $cats['bath-body'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'hair'], [
            'name' => 'Hair', 'hero_title' => 'Hair',
            'hero_subtitle' => 'Professional haircare & styling', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 5,
        ]);
        $cats['hair'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'face'], [
            'name' => 'Face', 'hero_title' => 'Face Makeup',
            'hero_subtitle' => 'Foundation, concealer, blush & powder', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 10,
        ]);
        $cats['face'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'lips'], [
            'name' => 'Lips', 'hero_title' => 'Lips',
            'hero_subtitle' => 'Lipstick, gloss & liners', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 11,
        ]);
        $cats['lips'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'makeup-palettes'], [
            'name' => 'Makeup Palettes', 'hero_title' => 'Makeup Palettes',
            'hero_subtitle' => 'Curated multi-use palettes', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 12,
        ]);
        $cats['makeup-palettes'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'bestsellers'], [
            'name' => 'Best Sellers', 'hero_title' => 'Best Sellers',
            'hero_subtitle' => 'Most-loved products in UAE', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 20,
        ]);
        $cats['bestsellers'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'new'], [
            'name' => 'New', 'hero_title' => 'View All Newness',
            'hero_subtitle' => 'The latest beauty drops', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 21,
        ]);
        $cats['new'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'gifts'], [
            'name' => 'Gifts', 'hero_title' => 'View All Gifts',
            'hero_subtitle' => 'Curated gifts & sets', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 22,
        ]);
        $cats['gifts'] = $c->id;
        $c = Category::updateOrCreate(['slug' => 'minis-more'], [
            'name' => 'Minis & More', 'hero_title' => 'Minis & More',
            'hero_subtitle' => 'Travel sizes & minis', 'parent_id' => null,
            'show_in_nav' => true, 'sort_order' => 23,
        ]);
        $cats['minis-more'] = $c->id;
        foreach ($cats as $s => $id) {
            if (in_array($s, ['face', 'lips', 'makeup-palettes'])) {
                $parentSlug = $s === 'makeup-palettes' ? 'makeup' : 'makeup';
                Category::where('slug', $s)->update(['parent_id' => $cats[$parentSlug]]);
            }
            if ($s === 'minis-more') {
                Category::where('slug', 'minis-more')->update(['parent_id' => $cats['gifts']]);
            }
        }

        // ── Brands ──
        $brands = [];
        $brands['rituals'] = Brand::updateOrCreate(['slug' => 'rituals'], ['name' => 'RITUALS', 'is_featured' => true, 'sort_order' => 5])->id;
        $brands['anastasia-beverly-hills'] = Brand::updateOrCreate(['slug' => 'anastasia-beverly-hills'], [
            'name' => 'ANASTASIA BEVERLY HILLS', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 5,
        ])->id;
        $brands['benefit-cosmetics'] = Brand::updateOrCreate(['slug' => 'benefit-cosmetics'], [
            'name' => 'BENEFIT COSMETICS', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 7,
        ])->id;
        $brands['bobbi-brown'] = Brand::updateOrCreate(['slug' => 'bobbi-brown'], [
            'name' => 'BOBBI BROWN', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 8,
        ])->id;
        $brands['briogeo'] = Brand::updateOrCreate(['slug' => 'briogeo'], [
            'name' => 'BRIOGEO', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 9,
        ])->id;
        $brands['carolina-herrera'] = Brand::updateOrCreate(['slug' => 'carolina-herrera'], [
            'name' => 'CAROLINA HERRERA', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 11,
        ])->id;
        $brands['caudalie'] = Brand::updateOrCreate(['slug' => 'caudalie'], [
            'name' => 'CAUDALIE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 12,
        ])->id;
        $brands['color-wow'] = Brand::updateOrCreate(['slug' => 'color-wow'], [
            'name' => 'COLOR WOW', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 13,
        ])->id;
        $brands['dior'] = Brand::updateOrCreate(['slug' => 'dior'], [
            'name' => 'DIOR', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 14,
        ])->id;
        $brands['dolce-gabbana'] = Brand::updateOrCreate(['slug' => 'dolce-gabbana'], [
            'name' => 'DOLCE & GABBANA', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 15,
        ])->id;
        $brands['drunk-elephant'] = Brand::updateOrCreate(['slug' => 'drunk-elephant'], [
            'name' => 'DRUNK ELEPHANT', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 16,
        ])->id;
        $brands['dyson'] = Brand::updateOrCreate(['slug' => 'dyson'], [
            'name' => 'DYSON', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 17,
        ])->id;
        $brands['e-l-f-cosmetics'] = Brand::updateOrCreate(['slug' => 'e-l-f-cosmetics'], [
            'name' => 'E.L.F. COSMETICS', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 18,
        ])->id;
        $brands['estrid'] = Brand::updateOrCreate(['slug' => 'estrid'], [
            'name' => 'ESTRID', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 19,
        ])->id;
        $brands['fable-mane'] = Brand::updateOrCreate(['slug' => 'fable-mane'], [
            'name' => 'FABLE & MANE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 20,
        ])->id;
        $brands['fenty-beauty'] = Brand::updateOrCreate(['slug' => 'fenty-beauty'], [
            'name' => 'FENTY BEAUTY', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 21,
        ])->id;
        $brands['giorgio-armani'] = Brand::updateOrCreate(['slug' => 'giorgio-armani'], [
            'name' => 'GIORGIO ARMANI', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 22,
        ])->id;
        $brands['gisou'] = Brand::updateOrCreate(['slug' => 'gisou'], [
            'name' => 'GISOU', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 23,
        ])->id;
        $brands['glossier'] = Brand::updateOrCreate(['slug' => 'glossier'], [
            'name' => 'GLOSSIER', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 24,
        ])->id;
        $brands['glow-recipe'] = Brand::updateOrCreate(['slug' => 'glow-recipe'], [
            'name' => 'GLOW RECIPE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 25,
        ])->id;
        $brands['haus-labs-by-lady-gaga'] = Brand::updateOrCreate(['slug' => 'haus-labs-by-lady-gaga'], [
            'name' => 'HAUS LABS BY LADY GAGA', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 26,
        ])->id;
        $brands['huda-beauty'] = Brand::updateOrCreate(['slug' => 'huda-beauty'], [
            'name' => 'HUDA BEAUTY', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 27,
        ])->id;
        $brands['ilia'] = Brand::updateOrCreate(['slug' => 'ilia'], [
            'name' => 'ILIA', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 28,
        ])->id;
        $brands['jean-paul-gaultier'] = Brand::updateOrCreate(['slug' => 'jean-paul-gaultier'], [
            'name' => 'JEAN PAUL GAULTIER', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 29,
        ])->id;
        $brands['juliette-has-a-gun'] = Brand::updateOrCreate(['slug' => 'juliette-has-a-gun'], [
            'name' => 'JULIETTE HAS A GUN', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 30,
        ])->id;
        $brands['k18'] = Brand::updateOrCreate(['slug' => 'k18'], [
            'name' => 'K18', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 31,
        ])->id;
        $brands['kayali'] = Brand::updateOrCreate(['slug' => 'kayali'], [
            'name' => 'KAYALI', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 32,
        ])->id;
        $brands['kiehl-s-since-1851'] = Brand::updateOrCreate(['slug' => 'kiehl-s-since-1851'], [
            'name' => 'KIEHL\'S SINCE 1851', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 33,
        ])->id;
        $brands['kosas'] = Brand::updateOrCreate(['slug' => 'kosas'], [
            'name' => 'KOSAS', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 34,
        ])->id;
        $brands['k-rastase'] = Brand::updateOrCreate(['slug' => 'k-rastase'], [
            'name' => 'KÉRASTASE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 35,
        ])->id;
        $brands['laneige'] = Brand::updateOrCreate(['slug' => 'laneige'], [
            'name' => 'LANEIGE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 36,
        ])->id;
        $brands['maison-francis-kurkdjian'] = Brand::updateOrCreate(['slug' => 'maison-francis-kurkdjian'], [
            'name' => 'MAISON FRANCIS KURKDJIAN', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 37,
        ])->id;
        $brands['make-up-for-ever'] = Brand::updateOrCreate(['slug' => 'make-up-for-ever'], [
            'name' => 'MAKE UP FOR EVER', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 38,
        ])->id;
        $brands['makeup-by-mario'] = Brand::updateOrCreate(['slug' => 'makeup-by-mario'], [
            'name' => 'MAKEUP BY MARIO', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 39,
        ])->id;
        $brands['moonglaze'] = Brand::updateOrCreate(['slug' => 'moonglaze'], [
            'name' => 'MOONGLAZE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 40,
        ])->id;
        $brands['nars'] = Brand::updateOrCreate(['slug' => 'nars'], [
            'name' => 'NARS', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 41,
        ])->id;
        $brands['natasha-denona'] = Brand::updateOrCreate(['slug' => 'natasha-denona'], [
            'name' => 'NATASHA DENONA', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 42,
        ])->id;
        $brands['nudestix'] = Brand::updateOrCreate(['slug' => 'nudestix'], [
            'name' => 'NUDESTIX', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 43,
        ])->id;
        $brands['olaplex'] = Brand::updateOrCreate(['slug' => 'olaplex'], [
            'name' => 'OLAPLEX', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 44,
        ])->id;
        $brands['one-size'] = Brand::updateOrCreate(['slug' => 'one-size'], [
            'name' => 'ONE/SIZE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 45,
        ])->id;
        $brands['ouai'] = Brand::updateOrCreate(['slug' => 'ouai'], [
            'name' => 'OUAI', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 46,
        ])->id;
        $brands['parfums-de-marly'] = Brand::updateOrCreate(['slug' => 'parfums-de-marly'], [
            'name' => 'PARFUMS DE MARLY', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 47,
        ])->id;
        $brands['patrick-ta'] = Brand::updateOrCreate(['slug' => 'patrick-ta'], [
            'name' => 'PATRICK TA', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 48,
        ])->id;
        $brands['paula-s-choice'] = Brand::updateOrCreate(['slug' => 'paula-s-choice'], [
            'name' => 'PAULA\'S CHOICE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 49,
        ])->id;
        $brands['peace-out-skincare'] = Brand::updateOrCreate(['slug' => 'peace-out-skincare'], [
            'name' => 'PEACE OUT SKINCARE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 50,
        ])->id;
        $brands['rabanne'] = Brand::updateOrCreate(['slug' => 'rabanne'], [
            'name' => 'RABANNE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 51,
        ])->id;
        $brands['saie'] = Brand::updateOrCreate(['slug' => 'saie'], [
            'name' => 'SAIE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 52,
        ])->id;
        $brands['sephora-collection'] = Brand::updateOrCreate(['slug' => 'sephora-collection'], [
            'name' => 'SEPHORA COLLECTION', 'is_featured' => true,
            'is_sephora_collection' => true, 'sort_order' => 53,
        ])->id;
        $brands['sol-de-janeiro'] = Brand::updateOrCreate(['slug' => 'sol-de-janeiro'], [
            'name' => 'SOL DE JANEIRO', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 54,
        ])->id;
        $brands['starface'] = Brand::updateOrCreate(['slug' => 'starface'], [
            'name' => 'STARFACE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 55,
        ])->id;
        $brands['summer-fridays'] = Brand::updateOrCreate(['slug' => 'summer-fridays'], [
            'name' => 'SUMMER FRIDAYS', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 56,
        ])->id;
        $brands['tarte'] = Brand::updateOrCreate(['slug' => 'tarte'], [
            'name' => 'TARTE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 58,
        ])->id;
        $brands['tatcha'] = Brand::updateOrCreate(['slug' => 'tatcha'], [
            'name' => 'TATCHA', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 59,
        ])->id;
        $brands['the-ordinary'] = Brand::updateOrCreate(['slug' => 'the-ordinary'], [
            'name' => 'THE ORDINARY', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 60,
        ])->id;
        $brands['tom-ford'] = Brand::updateOrCreate(['slug' => 'tom-ford'], [
            'name' => 'TOM FORD', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 61,
        ])->id;
        $brands['too-faced'] = Brand::updateOrCreate(['slug' => 'too-faced'], [
            'name' => 'TOO FACED', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 62,
        ])->id;
        $brands['tower-28'] = Brand::updateOrCreate(['slug' => 'tower-28'], [
            'name' => 'TOWER 28', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 63,
        ])->id;
        $brands['urban-decay'] = Brand::updateOrCreate(['slug' => 'urban-decay'], [
            'name' => 'URBAN DECAY', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 64,
        ])->id;
        $brands['valentino'] = Brand::updateOrCreate(['slug' => 'valentino'], [
            'name' => 'VALENTINO', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 65,
        ])->id;
        $brands['youth-to-the-people'] = Brand::updateOrCreate(['slug' => 'youth-to-the-people'], [
            'name' => 'YOUTH TO THE PEOPLE', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 66,
        ])->id;
        $brands['yves-saint-laurent'] = Brand::updateOrCreate(['slug' => 'yves-saint-laurent'], [
            'name' => 'YVES SAINT LAURENT', 'is_featured' => true,
            'is_sephora_collection' => false, 'sort_order' => 67,
        ])->id;
        $brands['amika'] = Brand::updateOrCreate(['slug' => 'amika'], [
            'name' => 'AMIKA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 68,
        ])->id;
        $brands['anua'] = Brand::updateOrCreate(['slug' => 'anua'], [
            'name' => 'ANUA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 69,
        ])->id;
        $brands['armani'] = Brand::updateOrCreate(['slug' => 'armani'], [
            'name' => 'ARMANI', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 70,
        ])->id;
        $brands['augustinus-bader'] = Brand::updateOrCreate(['slug' => 'augustinus-bader'], [
            'name' => 'AUGUSTINUS BADER', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 71,
        ])->id;
        $brands['aveda'] = Brand::updateOrCreate(['slug' => 'aveda'], [
            'name' => 'AVEDA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 72,
        ])->id;
        $brands['bareminerals'] = Brand::updateOrCreate(['slug' => 'bareminerals'], [
            'name' => 'BAREMINERALS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 73,
        ])->id;
        $brands['bbb-london'] = Brand::updateOrCreate(['slug' => 'bbb-london'], [
            'name' => 'BBB LONDON', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 74,
        ])->id;
        $brands['beautyblender'] = Brand::updateOrCreate(['slug' => 'beautyblender'], [
            'name' => 'BEAUTYBLENDER', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 75,
        ])->id;
        $brands['beautyworks'] = Brand::updateOrCreate(['slug' => 'beautyworks'], [
            'name' => 'BEAUTYWORKS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 76,
        ])->id;
        $brands['biodance'] = Brand::updateOrCreate(['slug' => 'biodance'], [
            'name' => 'BIODANCE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 77,
        ])->id;
        $brands['biotherm'] = Brand::updateOrCreate(['slug' => 'biotherm'], [
            'name' => 'BIOTHERM', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 78,
        ])->id;
        $brands['borntostandout'] = Brand::updateOrCreate(['slug' => 'borntostandout'], [
            'name' => 'BORNTOSTANDOUT', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 79,
        ])->id;
        $brands['bubble'] = Brand::updateOrCreate(['slug' => 'bubble'], [
            'name' => 'BUBBLE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 80,
        ])->id;
        $brands['burberry'] = Brand::updateOrCreate(['slug' => 'burberry'], [
            'name' => 'BURBERRY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 81,
        ])->id;
        $brands['bvlgari'] = Brand::updateOrCreate(['slug' => 'bvlgari'], [
            'name' => 'BVLGARI', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 82,
        ])->id;
        $brands['byoma'] = Brand::updateOrCreate(['slug' => 'byoma'], [
            'name' => 'BYOMA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 83,
        ])->id;
        $brands['cartier'] = Brand::updateOrCreate(['slug' => 'cartier'], [
            'name' => 'CARTIER', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 84,
        ])->id;
        $brands['chanel'] = Brand::updateOrCreate(['slug' => 'chanel'], [
            'name' => 'CHANEL', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 85,
        ])->id;
        $brands['chloe'] = Brand::updateOrCreate(['slug' => 'chloe'], [
            'name' => 'CHLOE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 86,
        ])->id;
        $brands['clarins'] = Brand::updateOrCreate(['slug' => 'clarins'], [
            'name' => 'CLARINS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 87,
        ])->id;
        $brands['cle-de-peau-beaute'] = Brand::updateOrCreate(['slug' => 'cle-de-peau-beaute'], [
            'name' => 'CLE DE PEAU BEAUTE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 88,
        ])->id;
        $brands['clear-start-by-dermalogica'] = Brand::updateOrCreate(['slug' => 'clear-start-by-dermalogica'], [
            'name' => 'CLEAR START BY DERMALOGICA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 89,
        ])->id;
        $brands['clinique'] = Brand::updateOrCreate(['slug' => 'clinique'], [
            'name' => 'CLINIQUE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 90,
        ])->id;
        $brands['creed'] = Brand::updateOrCreate(['slug' => 'creed'], [
            'name' => 'CREED', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 91,
        ])->id;
        $brands['dermalogica'] = Brand::updateOrCreate(['slug' => 'dermalogica'], [
            'name' => 'DERMALOGICA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 92,
        ])->id;
        $brands['dior-backstage'] = Brand::updateOrCreate(['slug' => 'dior-backstage'], [
            'name' => 'DIOR BACKSTAGE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 93,
        ])->id;
        $brands['dr-dennis-gross'] = Brand::updateOrCreate(['slug' => 'dr-dennis-gross'], [
            'name' => 'DR DENNIS GROSS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 94,
        ])->id;
        $brands['drybar'] = Brand::updateOrCreate(['slug' => 'drybar'], [
            'name' => 'DRYBAR', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 95,
        ])->id;
        $brands['elemis'] = Brand::updateOrCreate(['slug' => 'elemis'], [
            'name' => 'ELEMIS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 96,
        ])->id;
        $brands['elizabeth-arden'] = Brand::updateOrCreate(['slug' => 'elizabeth-arden'], [
            'name' => 'ELIZABETH ARDEN', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 97,
        ])->id;
        $brands['erborian'] = Brand::updateOrCreate(['slug' => 'erborian'], [
            'name' => 'ERBORIAN', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 98,
        ])->id;
        $brands['fenty-hair'] = Brand::updateOrCreate(['slug' => 'fenty-hair'], [
            'name' => 'FENTY HAIR', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 99,
        ])->id;
        $brands['fenty-skin'] = Brand::updateOrCreate(['slug' => 'fenty-skin'], [
            'name' => 'FENTY SKIN', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 100,
        ])->id;
        $brands['first-aid-beauty'] = Brand::updateOrCreate(['slug' => 'first-aid-beauty'], [
            'name' => 'FIRST AID BEAUTY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 101,
        ])->id;
        $brands['fugazzi-fragrances'] = Brand::updateOrCreate(['slug' => 'fugazzi-fragrances'], [
            'name' => 'FUGAZZI FRAGRANCES', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 102,
        ])->id;
        $brands['ghd'] = Brand::updateOrCreate(['slug' => 'ghd'], [
            'name' => 'GHD', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 103,
        ])->id;
        $brands['givenchy'] = Brand::updateOrCreate(['slug' => 'givenchy'], [
            'name' => 'GIVENCHY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 104,
        ])->id;
        $brands['grande-cosmetics'] = Brand::updateOrCreate(['slug' => 'grande-cosmetics'], [
            'name' => 'GRANDE COSMETICS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 105,
        ])->id;
        $brands['gucci'] = Brand::updateOrCreate(['slug' => 'gucci'], [
            'name' => 'GUCCI', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 106,
        ])->id;
        $brands['guerlain'] = Brand::updateOrCreate(['slug' => 'guerlain'], [
            'name' => 'GUERLAIN', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 107,
        ])->id;
        $brands['hello-sunday'] = Brand::updateOrCreate(['slug' => 'hello-sunday'], [
            'name' => 'HELLO SUNDAY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 108,
        ])->id;
        $brands['hermes'] = Brand::updateOrCreate(['slug' => 'hermes'], [
            'name' => 'HERMES', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 109,
        ])->id;
        $brands['hourglass'] = Brand::updateOrCreate(['slug' => 'hourglass'], [
            'name' => 'HOURGLASS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 110,
        ])->id;
        $brands['hugo-boss'] = Brand::updateOrCreate(['slug' => 'hugo-boss'], [
            'name' => 'HUGO BOSS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 111,
        ])->id;
        $brands['invisibobble'] = Brand::updateOrCreate(['slug' => 'invisibobble'], [
            'name' => 'INVISIBOBBLE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 112,
        ])->id;
        $brands['it-cosmetics'] = Brand::updateOrCreate(['slug' => 'it-cosmetics'], [
            'name' => 'IT COSMETICS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 113,
        ])->id;
        $brands['jo-malone-london'] = Brand::updateOrCreate(['slug' => 'jo-malone-london'], [
            'name' => 'JO MALONE LONDON', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 114,
        ])->id;
        $brands['kilian-paris'] = Brand::updateOrCreate(['slug' => 'kilian-paris'], [
            'name' => 'KILIAN PARIS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 115,
        ])->id;
        $brands['kitsch'] = Brand::updateOrCreate(['slug' => 'kitsch'], [
            'name' => 'KITSCH', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 116,
        ])->id;
        $brands['l-occitane'] = Brand::updateOrCreate(['slug' => 'l-occitane'], [
            'name' => 'L\'OCCITANE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 117,
        ])->id;
        $brands['la-mer'] = Brand::updateOrCreate(['slug' => 'la-mer'], [
            'name' => 'LA MER', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 118,
        ])->id;
        $brands['la-prairie'] = Brand::updateOrCreate(['slug' => 'la-prairie'], [
            'name' => 'LA PRAIRIE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 119,
        ])->id;
        $brands['lancaster'] = Brand::updateOrCreate(['slug' => 'lancaster'], [
            'name' => 'LANCASTER', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 120,
        ])->id;
        $brands['lanolips'] = Brand::updateOrCreate(['slug' => 'lanolips'], [
            'name' => 'LANOLIPS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 121,
        ])->id;
        $brands['laura-mercier'] = Brand::updateOrCreate(['slug' => 'laura-mercier'], [
            'name' => 'LAURA MERCIER', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 122,
        ])->id;
        $brands['le-mini-macaron'] = Brand::updateOrCreate(['slug' => 'le-mini-macaron'], [
            'name' => 'LE MINI MACARON', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 123,
        ])->id;
        $brands['loewe'] = Brand::updateOrCreate(['slug' => 'loewe'], [
            'name' => 'LOEWE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 124,
        ])->id;
        $brands['luna-daily'] = Brand::updateOrCreate(['slug' => 'luna-daily'], [
            'name' => 'LUNA DAILY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 125,
        ])->id;
        $brands['m-a-c'] = Brand::updateOrCreate(['slug' => 'm-a-c'], [
            'name' => 'M.A.C', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 126,
        ])->id;
        $brands['maison-margiela'] = Brand::updateOrCreate(['slug' => 'maison-margiela'], [
            'name' => 'MAISON MARGIELA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 127,
        ])->id;
        $brands['matiere-premiere'] = Brand::updateOrCreate(['slug' => 'matiere-premiere'], [
            'name' => 'MATIERE PREMIERE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 128,
        ])->id;
        $brands['mediheal'] = Brand::updateOrCreate(['slug' => 'mediheal'], [
            'name' => 'MEDIHEAL', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 129,
        ])->id;
        $brands['memo-paris'] = Brand::updateOrCreate(['slug' => 'memo-paris'], [
            'name' => 'MEMO PARIS', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 130,
        ])->id;
        $brands['milk-makeup'] = Brand::updateOrCreate(['slug' => 'milk-makeup'], [
            'name' => 'MILK MAKEUP', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 131,
        ])->id;
        $brands['miu-miu'] = Brand::updateOrCreate(['slug' => 'miu-miu'], [
            'name' => 'MIU MIU', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 132,
        ])->id;
        $brands['narciso-rodriguez'] = Brand::updateOrCreate(['slug' => 'narciso-rodriguez'], [
            'name' => 'NARCISO RODRIGUEZ', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 133,
        ])->id;
        $brands['nuxe'] = Brand::updateOrCreate(['slug' => 'nuxe'], [
            'name' => 'NUXE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 134,
        ])->id;
        $brands['olehenriksen'] = Brand::updateOrCreate(['slug' => 'olehenriksen'], [
            'name' => 'OLEHENRIKSEN', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 135,
        ])->id;
        $brands['onesize'] = Brand::updateOrCreate(['slug' => 'onesize'], [
            'name' => 'ONESIZE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 136,
        ])->id;
        $brands['oribe'] = Brand::updateOrCreate(['slug' => 'oribe'], [
            'name' => 'ORIBE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 137,
        ])->id;
        $brands['parfum-bdk'] = Brand::updateOrCreate(['slug' => 'parfum-bdk'], [
            'name' => 'PARFUM BDK', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 138,
        ])->id;
        $brands['penhaligon-s'] = Brand::updateOrCreate(['slug' => 'penhaligon-s'], [
            'name' => 'PENHALIGON\'S', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 139,
        ])->id;
        $brands['phlur'] = Brand::updateOrCreate(['slug' => 'phlur'], [
            'name' => 'PHLUR', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 140,
        ])->id;
        $brands['pixi'] = Brand::updateOrCreate(['slug' => 'pixi'], [
            'name' => 'PIXI', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 141,
        ])->id;
        $brands['prada'] = Brand::updateOrCreate(['slug' => 'prada'], [
            'name' => 'PRADA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 142,
        ])->id;
        $brands['rabanne-fragrances'] = Brand::updateOrCreate(['slug' => 'rabanne-fragrances'], [
            'name' => 'RABANNE FRAGRANCES', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 143,
        ])->id;
        $brands['rare-beauty'] = Brand::updateOrCreate(['slug' => 'rare-beauty'], [
            'name' => 'RARE BEAUTY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 144,
        ])->id;
        $brands['redken'] = Brand::updateOrCreate(['slug' => 'redken'], [
            'name' => 'REDKEN', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 145,
        ])->id;
        $brands['refy'] = Brand::updateOrCreate(['slug' => 'refy'], [
            'name' => 'REFY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 146,
        ])->id;
        $brands['roberto-cavalli'] = Brand::updateOrCreate(['slug' => 'roberto-cavalli'], [
            'name' => 'ROBERTO CAVALLI', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 147,
        ])->id;
        $brands['salt-and-stone'] = Brand::updateOrCreate(['slug' => 'salt-and-stone'], [
            'name' => 'SALT AND STONE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 148,
        ])->id;
        $brands['sephora-favorites'] = Brand::updateOrCreate(['slug' => 'sephora-favorites'], [
            'name' => 'SEPHORA FAVORITES', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 149,
        ])->id;
        $brands['shark'] = Brand::updateOrCreate(['slug' => 'shark'], [
            'name' => 'SHARK', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 150,
        ])->id;
        $brands['shiseido'] = Brand::updateOrCreate(['slug' => 'shiseido'], [
            'name' => 'SHISEIDO', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 151,
        ])->id;
        $brands['simihaze-beauty'] = Brand::updateOrCreate(['slug' => 'simihaze-beauty'], [
            'name' => 'SIMIHAZE BEAUTY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 152,
        ])->id;
        $brands['slickhair'] = Brand::updateOrCreate(['slug' => 'slickhair'], [
            'name' => 'SLICKHAIR', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 153,
        ])->id;
        $brands['slip'] = Brand::updateOrCreate(['slug' => 'slip'], [
            'name' => 'SLIP', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 154,
        ])->id;
        $brands['steampod'] = Brand::updateOrCreate(['slug' => 'steampod'], [
            'name' => 'STEAMPOD', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 155,
        ])->id;
        $brands['sunday-riley'] = Brand::updateOrCreate(['slug' => 'sunday-riley'], [
            'name' => 'SUNDAY RILEY', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 156,
        ])->id;
        $brands['the-inkey-list'] = Brand::updateOrCreate(['slug' => 'the-inkey-list'], [
            'name' => 'THE INKEY LIST', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 157,
        ])->id;
        $brands['thomas-kosmala'] = Brand::updateOrCreate(['slug' => 'thomas-kosmala'], [
            'name' => 'THOMAS KOSMALA', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 158,
        ])->id;
        $brands['touchland'] = Brand::updateOrCreate(['slug' => 'touchland'], [
            'name' => 'TOUCHLAND', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 159,
        ])->id;
        $brands['tweezerman'] = Brand::updateOrCreate(['slug' => 'tweezerman'], [
            'name' => 'TWEEZERMAN', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 160,
        ])->id;
        $brands['vegamour'] = Brand::updateOrCreate(['slug' => 'vegamour'], [
            'name' => 'VEGAMOUR', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 161,
        ])->id;
        $brands['versace'] = Brand::updateOrCreate(['slug' => 'versace'], [
            'name' => 'VERSACE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 162,
        ])->id;
        $brands['virtue'] = Brand::updateOrCreate(['slug' => 'virtue'], [
            'name' => 'VIRTUE', 'is_featured' => false,
            'is_sephora_collection' => false, 'sort_order' => 163,
        ])->id;

        // ── Products ──
        $products = [];
        $p0 = Product::updateOrCreate(['slug' => 'sol-de-janeiro-brazilian-bum-bum-cream-vibrant-yellow-jar-container-luxury-studio-beauty-c'], [
            'brand_id' => $brands['sol-de-janeiro'], 'name' => 'Brazilian Bum Bum Cream', 'size' => '240ml',
            'price' => 195.0, 'rating' => 5, 'reviews_count' => 3200,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 0,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p0->id, 'path' => 'images/products/product_002.webp'], [
            'alt' => 'Sol de Janeiro Brazilian Bum Bum Cream vibrant yellow jar container, luxury studio beauty cosmetics packaging photography on clean seamless warm cream background, high-contrast Sephora UAE catalog style.', 'sort_order' => 0,
        ]);
        $p0->categories()->sync([$cats['bath-body']]);
        $products[] = $p0->id;
        $p1 = Product::updateOrCreate(['slug' => 'ouai-st-barts-body-cleanser-frosted-clear-pump-dispenser-bottle-filled-with-radiant-golden'], [
            'brand_id' => $brands['ouai'], 'name' => 'St. Barts Body Cleanser', 'size' => '473ml',
            'price' => 135.0, 'rating' => 5, 'reviews_count' => 890,
            'badge' => 'CLEAN', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 1,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p1->id, 'path' => 'images/products/product_003.webp'], [
            'alt' => 'Ouai St. Barts Body Cleanser frosted clear pump dispenser bottle filled with radiant golden luxury body wash, crisp studio lighting on immaculate white background, prestige e-commerce cosmetics catalog.', 'sort_order' => 0,
        ]);
        $p1->categories()->sync([$cats['bath-body']]);
        $products[] = $p1->id;
        $p2 = Product::updateOrCreate(['slug' => 'l-occitane-shea-butter-ultra-rich-body-cream-aluminum-screw-top-cream-tub-authentic-french'], [
            'brand_id' => $brands['l-occitane'], 'name' => 'Shea Butter Ultra Rich Body Cream', 'size' => null,
            'price' => 210.0, 'rating' => 5, 'reviews_count' => 1450,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 2,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p2->id, 'path' => 'images/products/product_004.webp'], [
            'alt' => 'L\'Occitane Shea Butter Ultra Rich Body Cream aluminum screw top cream tub, authentic French skincare heritage studio still life on solid off-white studio counter, Sephora Middle East store catalog.', 'sort_order' => 0,
        ]);
        $p2->categories()->sync([$cats['bath-body']]);
        $products[] = $p2->id;
        $p3 = Product::updateOrCreate(['slug' => 'rituals-the-ritual-of-sakura-foaming-shower-gel-aerosol-bottle-with-cherry-blossom-floral-'], [
            'brand_id' => $brands['rituals'], 'name' => 'The Ritual of Sakura Foaming Shower Gel', 'size' => null,
            'price' => 55.0, 'rating' => 5, 'reviews_count' => 920,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 3,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p3->id, 'path' => 'images/products/product_005.webp'], [
            'alt' => 'Rituals The Ritual of Sakura Foaming Shower Gel aerosol bottle with cherry blossom floral motifs, delicate luxury packaging shot in museum-grade light on clean neutral background, Sephora UAE catalog style.', 'sort_order' => 0,
        ]);
        $p3->categories()->sync([$cats['bath-body']]);
        $products[] = $p3->id;
        $p4 = Product::updateOrCreate(['slug' => 'ouai-scalp-and-body-scrub-st-barts-edition-luxury-container-on-minimalist-gallery-podium-b'], [
            'brand_id' => $brands['ouai'], 'name' => 'Scalp and Body Scrub St. Barts Edition', 'size' => null,
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 430,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 4,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p4->id, 'path' => 'images/products/product_006.webp'], [
            'alt' => 'Ouai Scalp and Body Scrub St. Barts edition luxury container on minimalist gallery podium, bright pristine lighting with subtle shadows, Sephora beauty catalog luxury style.', 'sort_order' => 0,
        ]);
        $p4->categories()->sync([$cats['bath-body']]);
        $products[] = $p4->id;
        $p5 = Product::updateOrCreate(['slug' => 'l-occitane-almond-shower-oil-elegant-curved-bottle-with-amber-cleansing-oil-studio-beauty-'], [
            'brand_id' => $brands['l-occitane'], 'name' => 'Almond Shower Oil', 'size' => '250ml',
            'price' => 125.0, 'rating' => 5, 'reviews_count' => 3400,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 5,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p5->id, 'path' => 'images/products/product_007.webp'], [
            'alt' => 'L\'Occitane Almond Shower Oil elegant curved bottle with amber cleansing oil, studio beauty packaging photography illuminated on flawless bright surface, Sephora editorial beauty catalogue.', 'sort_order' => 0,
        ]);
        $p5->categories()->sync([$cats['bath-body']]);
        $products[] = $p5->id;
        $p6 = Product::updateOrCreate(['slug' => 'rituals-the-ritual-of-karma-sun-protection-milky-spray-spf-30-sleek-spray-bottle-high-end-'], [
            'brand_id' => $brands['rituals'], 'name' => 'The Ritual of Karma Sun Protection Milky Spray SPF 30', 'size' => null,
            'price' => 95.0, 'rating' => 5, 'reviews_count' => 310,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 6,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p6->id, 'path' => 'images/products/product_008.webp'], [
            'alt' => 'Rituals The Ritual of Karma Sun Protection Milky Spray SPF 30 sleek spray bottle, high-end cosmetics catalog packshot with crisp architectural lighting on solid pale pedestal.', 'sort_order' => 0,
        ]);
        $p6->categories()->sync([$cats['bath-body']]);
        $products[] = $p6->id;
        $p7 = Product::updateOrCreate(['slug' => 'sol-de-janeiro-bom-dia-bright-body-cream-vibrant-coral-jar-with-white-cap-professional-cos'], [
            'brand_id' => $brands['sol-de-janeiro'], 'name' => 'Bom Dia Bright Body Cream', 'size' => null,
            'price' => 195.0, 'rating' => 5, 'reviews_count' => 1290,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 7,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p7->id, 'path' => 'images/products/product_009.webp'], [
            'alt' => 'Sol de Janeiro Bom Dia Bright Body Cream vibrant coral jar with white cap, professional cosmetics commercial packshot photography on stark studio light backdrop, Sephora luxury store aesthetic.', 'sort_order' => 0,
        ]);
        $p7->categories()->sync([$cats['bath-body']]);
        $products[] = $p7->id;
        $p8 = Product::updateOrCreate(['slug' => 'multi-peptide-concentrated-serum-for-hair-density'], [
            'brand_id' => $brands['the-ordinary'], 'name' => 'Multi-Peptide Concentrated Serum for Hair Density',
            'price' => 85.0, 'rating' => 5, 'reviews_count' => 1420,
            'badge' => 'Award Winner', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 8,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p8->id, 'path' => 'images/products/product_013.webp'], [
            'alt' => 'Multi-Peptide Concentrated Serum for Hair Density', 'sort_order' => 0,
        ]);
        $p8->categories()->sync([$cats['bestsellers'], $cats['new']]);
        $products[] = $p8->id;
        $p9 = Product::updateOrCreate(['slug' => 'major-headlines-double-take-cr-me-powder-blush'], [
            'brand_id' => $brands['patrick-ta'], 'name' => 'Major Headlines Double-Take Crème & Powder Blush',
            'price' => 185.0, 'rating' => 5, 'reviews_count' => 842,
            'badge' => 'Exclusive', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 9,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p9->id, 'path' => 'images/products/product_002.webp'], [
            'alt' => 'Major Headlines Double-Take Crème & Powder Blush', 'sort_order' => 0,
        ]);
        $p9->categories()->sync([$cats['bestsellers'], $cats['makeup'], $cats['makeup-palettes'], $cats['new']]);
        $products[] = $p9->id;
        $p10 = Product::updateOrCreate(['slug' => 'lip-glowy-hydrating-balm-opening-toast-edition'], [
            'brand_id' => $brands['laneige'], 'name' => 'Lip Glowy Hydrating Balm - Opening Toast Edition',
            'price' => 95.0, 'rating' => 5, 'reviews_count' => 950,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 10,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p10->id, 'path' => 'images/products/product_003.webp'], [
            'alt' => 'Lip Glowy Hydrating Balm - Opening Toast Edition', 'sort_order' => 0,
        ]);
        $p10->categories()->sync([$cats['bestsellers'], $cats['new']]);
        $products[] = $p10->id;
        $p11 = Product::updateOrCreate(['slug' => 'devotion-radiant-luminous-powder-foundation'], [
            'brand_id' => $brands['dolce-gabbana'], 'name' => 'Devotion Radiant Luminous Powder Foundation',
            'price' => 248.0, 'rating' => 5, 'reviews_count' => 324,
            'badge' => 'Luxury', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 11,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p11->id, 'path' => 'images/products/product_004.webp'], [
            'alt' => 'Devotion Radiant Luminous Powder Foundation', 'sort_order' => 0,
        ]);
        $p11->categories()->sync([$cats['bestsellers'], $cats['new']]);
        $products[] = $p11->id;
        $p12 = Product::updateOrCreate(['slug' => 'matte-glow-bronze-filter-4-pan-palette'], [
            'brand_id' => $brands['huda-beauty'], 'name' => 'Matte & Glow Bronze Filter 4-Pan Palette',
            'price' => 145.0, 'rating' => 5, 'reviews_count' => 560,
            'badge' => 'Exclusive', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 12,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p12->id, 'path' => 'images/products/product_005.webp'], [
            'alt' => 'Matte & Glow Bronze Filter 4-Pan Palette', 'sort_order' => 0,
        ]);
        $p12->categories()->sync([$cats['bestsellers'], $cats['makeup'], $cats['makeup-palettes']]);
        $products[] = $p12->id;
        $p13 = Product::updateOrCreate(['slug' => 'retinol-collagen-peptide-plant-protein-balm'], [
            'brand_id' => $brands['youth-to-the-people'], 'name' => 'Retinol + Collagen Peptide Plant Protein Balm',
            'price' => 245.0, 'rating' => 5, 'reviews_count' => 312,
            'badge' => 'Clean', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 13,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p13->id, 'path' => 'images/products/product_006.webp'], [
            'alt' => 'Retinol + Collagen Peptide Plant Protein Balm', 'sort_order' => 0,
        ]);
        $p13->categories()->sync([$cats['bestsellers']]);
        $products[] = $p13->id;
        $p14 = Product::updateOrCreate(['slug' => 'on-til-dawn-mattifying-waterproof-setting-spray'], [
            'brand_id' => $brands['one-size'], 'name' => 'On \'Til Dawn Mattifying Waterproof Setting Spray',
            'price' => 140.0, 'rating' => 5, 'reviews_count' => 1890,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 14,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p14->id, 'path' => 'images/products/product_007.webp'], [
            'alt' => 'On \'Til Dawn Mattifying Waterproof Setting Spray', 'sort_order' => 0,
        ]);
        $p14->categories()->sync([$cats['bestsellers']]);
        $products[] = $p14->id;
        $p15 = Product::updateOrCreate(['slug' => 'watch-that-glow-complexion-filter'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Watch That Glow Complexion Filter',
            'price' => 95.0, 'rating' => 5, 'reviews_count' => 418,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 15,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p15->id, 'path' => 'images/products/product_008.webp'], [
            'alt' => 'Watch That Glow Complexion Filter', 'sort_order' => 0,
        ]);
        $p15->categories()->sync([$cats['bestsellers'], $cats['new']]);
        $products[] = $p15->id;
        $p16 = Product::updateOrCreate(['slug' => 'purple-trouble-eau-de-parfum-100ml'], [
            'brand_id' => $brands['juliette-has-a-gun'], 'name' => 'Purple Trouble Eau De Parfum 100ml',
            'price' => 620.0, 'rating' => 5, 'reviews_count' => 210,
            'badge' => 'Exclusive', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 16,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p16->id, 'path' => 'images/products/product_009.webp'], [
            'alt' => 'Purple Trouble Eau De Parfum 100ml', 'sort_order' => 0,
        ]);
        $p16->categories()->sync([$cats['bestsellers']]);
        $products[] = $p16->id;
        $p17 = Product::updateOrCreate(['slug' => 'major-sculpt-precision-dual-ended-shading-pen'], [
            'brand_id' => $brands['patrick-ta'], 'name' => 'Major Sculpt Precision Dual-Ended Shading Pen',
            'price' => 135.0, 'rating' => 5, 'reviews_count' => 380,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 17,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p17->id, 'path' => 'images/products/product_010.webp'], [
            'alt' => 'Major Sculpt Precision Dual-Ended Shading Pen', 'sort_order' => 0,
        ]);
        $p17->categories()->sync([$cats['bestsellers'], $cats['new']]);
        $products[] = $p17->id;
        $p18 = Product::updateOrCreate(['slug' => 'swipe-all-day-hydrating-serum-concealer'], [
            'brand_id' => $brands['tower-28'], 'name' => 'Swipe All-Day Hydrating Serum Concealer',
            'price' => 110.0, 'rating' => 5, 'reviews_count' => 650,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 18,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p18->id, 'path' => 'images/products/product_011.webp'], [
            'alt' => 'Swipe All-Day Hydrating Serum Concealer', 'sort_order' => 0,
        ]);
        $p18->categories()->sync([$cats['bestsellers']]);
        $products[] = $p18->id;
        $p19 = Product::updateOrCreate(['slug' => 'velvet-setting-powder-puff-trio'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Velvet Setting Powder Puff Trio',
            'price' => 45.0, 'rating' => 5, 'reviews_count' => 1120,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 19,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p19->id, 'path' => 'images/products/product_012.webp'], [
            'alt' => 'Velvet Setting Powder Puff Trio', 'sort_order' => 0,
        ]);
        $p19->categories()->sync([$cats['bestsellers']]);
        $products[] = $p19->id;
        $p20 = Product::updateOrCreate(['slug' => 'matte-and-glow-bronze-filter-4-pan-palette'], [
            'brand_id' => $brands['huda-beauty'], 'name' => 'Matte and Glow Bronze Filter 4-Pan Palette',
            'price' => 145.0, 'rating' => 5, 'reviews_count' => 560,
            'badge' => 'NEW', 'is_bestseller' => true, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 20,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p20->id, 'path' => 'images/products/product_013.webp'], [
            'alt' => 'Matte and Glow Bronze Filter 4-Pan Palette', 'sort_order' => 0,
        ]);
        $p20->categories()->sync([$cats['face']]);
        $products[] = $p20->id;
        $p21 = Product::updateOrCreate(['slug' => 'revealer-super-creamy-concealer'], [
            'brand_id' => $brands['kosas'], 'name' => 'Revealer Super Creamy Concealer',
            'price' => 130.0, 'rating' => 5, 'reviews_count' => 1840,
            'badge' => 'CLEAN', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 21,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p21->id, 'path' => 'images/products/product_014.webp'], [
            'alt' => 'Revealer Super Creamy Concealer', 'sort_order' => 0,
        ]);
        $p21->categories()->sync([$cats['face']]);
        $products[] = $p21->id;
        $p22 = Product::updateOrCreate(['slug' => 'cr-me-and-powder-blush-duo'], [
            'brand_id' => $brands['patrick-ta'], 'name' => 'Crème and Powder Blush Duo',
            'price' => 185.0, 'rating' => 5, 'reviews_count' => 980,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 22,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p22->id, 'path' => 'images/products/product_015.webp'], [
            'alt' => 'Crème and Powder Blush Duo', 'sort_order' => 0,
        ]);
        $p22->categories()->sync([$cats['face']]);
        $products[] = $p22->id;
        $p23 = Product::updateOrCreate(['slug' => 'major-dimension-dual-velvet-powder-blush'], [
            'brand_id' => $brands['patrick-ta'], 'name' => 'Major Dimension Dual Velvet Powder Blush',
            'price' => 180.0, 'rating' => 5, 'reviews_count' => 640,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 23,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p23->id, 'path' => 'images/products/product_016.webp'], [
            'alt' => 'Major Dimension Dual Velvet Powder Blush', 'sort_order' => 0,
        ]);
        $p23->categories()->sync([$cats['face'], $cats['makeup-palettes']]);
        $products[] = $p23->id;
        $p24 = Product::updateOrCreate(['slug' => 'shape-tape-duo'], [
            'brand_id' => $brands['tarte'], 'name' => 'Shape Tape Duo',
            'price' => 175.0, 'rating' => 5, 'reviews_count' => 3450,
            'badge' => 'VALUE SET', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 24,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p24->id, 'path' => 'images/products/product_017.webp'], [
            'alt' => 'Shape Tape Duo', 'sort_order' => 0,
        ]);
        $p24->categories()->sync([$cats['face']]);
        $products[] = $p24->id;
        $p25 = Product::updateOrCreate(['slug' => 'setting-spray-duo'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Setting Spray Duo',
            'price' => 95.0, 'rating' => 5, 'reviews_count' => 890,
            'badge' => 'ONLY AT SEPHORA', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 25,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p25->id, 'path' => 'images/products/product_018.webp'], [
            'alt' => 'Setting Spray Duo', 'sort_order' => 0,
        ]);
        $p25->categories()->sync([$cats['face']]);
        $products[] = $p25->id;
        $p26 = Product::updateOrCreate(['slug' => 'hoola-willa-amp-cookie-palette'], [
            'brand_id' => $brands['benefit-cosmetics'], 'name' => 'Hoola, Willa &amp; Cookie Palette',
            'price' => 195.0, 'rating' => 5, 'reviews_count' => 1120,
            'badge' => 'LIMITED EDITION', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 26,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p26->id, 'path' => 'images/products/product_019.webp'], [
            'alt' => 'Hoola, Willa &amp; Cookie Palette', 'sort_order' => 0,
        ]);
        $p26->categories()->sync([$cats['face'], $cats['makeup-palettes']]);
        $products[] = $p26->id;
        $p27 = Product::updateOrCreate(['slug' => 'color-fuse-blush'], [
            'brand_id' => $brands['haus-labs-by-lady-gaga'], 'name' => 'Color Fuse Blush',
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 820,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 27,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p27->id, 'path' => 'images/products/product_020.webp'], [
            'alt' => 'Color Fuse Blush', 'sort_order' => 0,
        ]);
        $p27->categories()->sync([$cats['face']]);
        $products[] = $p27->id;
        $p28 = Product::updateOrCreate(['slug' => 'major-headlines-liquid-silk-glow-blush'], [
            'brand_id' => $brands['patrick-ta'], 'name' => 'Major Headlines Liquid Silk Glow Blush',
            'price' => 155.0, 'rating' => 5, 'reviews_count' => 430,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 28,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p28->id, 'path' => 'images/products/product_021.webp'], [
            'alt' => 'Major Headlines Liquid Silk Glow Blush', 'sort_order' => 0,
        ]);
        $p28->categories()->sync([$cats['face']]);
        $products[] = $p28->id;
        $p29 = Product::updateOrCreate(['slug' => 'born-this-way-concealer'], [
            'brand_id' => $brands['too-faced'], 'name' => 'Born This Way Concealer',
            'price' => 160.0, 'rating' => 5, 'reviews_count' => 4120,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 29,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p29->id, 'path' => 'images/products/product_022.webp'], [
            'alt' => 'Born This Way Concealer', 'sort_order' => 0,
        ]);
        $p29->categories()->sync([$cats['face'], $cats['makeup']]);
        $products[] = $p29->id;
        $p30 = Product::updateOrCreate(['slug' => 'set-it-bright-powder'], [
            'brand_id' => $brands['e-l-f-cosmetics'], 'name' => 'Set It Bright Powder',
            'price' => 45.0, 'rating' => 5, 'reviews_count' => 610,
            'badge' => 'VALUE', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 30,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p30->id, 'path' => 'images/products/product_023.webp'], [
            'alt' => 'Set It Bright Powder', 'sort_order' => 0,
        ]);
        $p30->categories()->sync([$cats['face'], $cats['makeup-palettes']]);
        $products[] = $p30->id;
        $p31 = Product::updateOrCreate(['slug' => 'primer-and-setting-spray-duo'], [
            'brand_id' => $brands['benefit-cosmetics'], 'name' => 'Primer and Setting Spray Duo',
            'price' => 115.0, 'rating' => 5, 'reviews_count' => 1540,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 31,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p31->id, 'path' => 'images/products/product_024.webp'], [
            'alt' => 'Primer and Setting Spray Duo', 'sort_order' => 0,
        ]);
        $p31->categories()->sync([$cats['face']]);
        $products[] = $p31->id;
        $p32 = Product::updateOrCreate(['slug' => 'the-multiple-sticks'], [
            'brand_id' => $brands['nars'], 'name' => 'The Multiple Sticks',
            'price' => 210.0, 'rating' => 5, 'reviews_count' => 1390,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 32,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p32->id, 'path' => 'images/products/product_025.webp'], [
            'alt' => 'The Multiple Sticks', 'sort_order' => 0,
        ]);
        $p32->categories()->sync([$cats['face']]);
        $products[] = $p32->id;
        $p33 = Product::updateOrCreate(['slug' => 'e-l-f-power-grip-ros-setting-spray'], [
            'brand_id' => $brands['e-l-f-cosmetics'], 'name' => 'e.l.f. Power Grip Rosé Setting Spray',
            'price' => 55.0, 'rating' => 5, 'reviews_count' => 920,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 33,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p33->id, 'path' => 'images/products/product_026.webp'], [
            'alt' => 'e.l.f. Power Grip Rosé Setting Spray', 'sort_order' => 0,
        ]);
        $p33->categories()->sync([$cats['face']]);
        $products[] = $p33->id;
        $p34 = Product::updateOrCreate(['slug' => 'celestial-glow-skin-glaze-balm-stick'], [
            'brand_id' => $brands['moonglaze'], 'name' => 'Celestial Glow Skin Glaze Balm Stick',
            'price' => 120.0, 'rating' => 5, 'reviews_count' => 310,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 34,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p34->id, 'path' => 'images/products/product_027.webp'], [
            'alt' => 'Celestial Glow Skin Glaze Balm Stick', 'sort_order' => 0,
        ]);
        $p34->categories()->sync([$cats['face']]);
        $products[] = $p34->id;
        $p35 = Product::updateOrCreate(['slug' => 'backstage-glow-face-palette'], [
            'brand_id' => $brands['dior'], 'name' => 'Backstage Glow Face Palette',
            'price' => 245.0, 'rating' => 5, 'reviews_count' => 2980,
            'badge' => 'LUXURY', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 35,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p35->id, 'path' => 'images/products/product_028.webp'], [
            'alt' => 'Backstage Glow Face Palette', 'sort_order' => 0,
        ]);
        $p35->categories()->sync([$cats['face'], $cats['makeup-palettes']]);
        $products[] = $p35->id;
        $p36 = Product::updateOrCreate(['slug' => 'baccarat-rouge-540-eau-de-parfum'], [
            'brand_id' => $brands['maison-francis-kurkdjian'], 'name' => 'Baccarat Rouge 540 Eau de Parfum',
            'price' => 1295.0, 'rating' => 5, 'reviews_count' => 1240,
            'badge' => 'LUXURY', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 36,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p36->id, 'path' => 'images/hero/maison_francis_kurkdjian_baccarat_rouge_540_eau_de_parfum_bottle_iconic_red.webp'], [
            'alt' => 'Baccarat Rouge 540 Eau de Parfum', 'sort_order' => 0,
        ]);
        $p36->categories()->sync([$cats['fragrance']]);
        $products[] = $p36->id;
        $p37 = Product::updateOrCreate(['slug' => 'yum-pistachio-gelato-33-eau-de-parfum-intense'], [
            'brand_id' => $brands['kayali'], 'name' => 'Yum Pistachio Gelato | 33 Eau de Parfum Intense',
            'price' => 495.0, 'rating' => 5, 'reviews_count' => 860,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 37,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p37->id, 'path' => 'images/products/product_029.webp'], [
            'alt' => 'Yum Pistachio Gelato | 33 Eau de Parfum Intense', 'sort_order' => 0,
        ]);
        $p37->categories()->sync([$cats['fragrance']]);
        $products[] = $p37->id;
        $p38 = Product::updateOrCreate(['slug' => 'libre-eau-de-parfum'], [
            'brand_id' => $brands['yves-saint-laurent'], 'name' => 'Libre Eau de Parfum',
            'price' => 585.0, 'rating' => 5, 'reviews_count' => 2410,
            'badge' => 'AWARD WINNER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 38,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p38->id, 'path' => 'images/products/product_010.webp'], [
            'alt' => 'Libre Eau de Parfum', 'sort_order' => 0,
        ]);
        $p38->categories()->sync([$cats['fragrance']]);
        $products[] = $p38->id;
        $p39 = Product::updateOrCreate(['slug' => 'sauvage-eau-de-parfum'], [
            'brand_id' => $brands['dior'], 'name' => 'Sauvage Eau de Parfum',
            'price' => 570.0, 'rating' => 5, 'reviews_count' => 3150,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 39,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p39->id, 'path' => 'images/hero/dior_sauvage_eau_de_parfum_bottle_luxury_studio_product_photography_on_solid.webp'], [
            'alt' => 'Sauvage Eau de Parfum', 'sort_order' => 0,
        ]);
        $p39->categories()->sync([$cats['fragrance']]);
        $products[] = $p39->id;
        $p40 = Product::updateOrCreate(['slug' => 'good-girl-blush-eau-de-parfum'], [
            'brand_id' => $brands['carolina-herrera'], 'name' => 'Good Girl Blush Eau de Parfum',
            'price' => 615.0, 'rating' => 5, 'reviews_count' => 720,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 40,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p40->id, 'path' => 'images/products/product_030.webp'], [
            'alt' => 'Good Girl Blush Eau de Parfum', 'sort_order' => 0,
        ]);
        $p40->categories()->sync([$cats['fragrance']]);
        $products[] = $p40->id;
        $p41 = Product::updateOrCreate(['slug' => 'lost-cherry-eau-de-parfum'], [
            'brand_id' => $brands['tom-ford'], 'name' => 'Lost Cherry Eau de Parfum',
            'price' => 1450.0, 'rating' => 5, 'reviews_count' => 490,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 41,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p41->id, 'path' => 'images/products/product_031.webp'], [
            'alt' => 'Lost Cherry Eau de Parfum', 'sort_order' => 0,
        ]);
        $p41->categories()->sync([$cats['fragrance']]);
        $products[] = $p41->id;
        $p42 = Product::updateOrCreate(['slug' => 'la-belle-le-parfum-eau-de-parfum-intense'], [
            'brand_id' => $brands['jean-paul-gaultier'], 'name' => 'La Belle Le Parfum Eau de Parfum Intense',
            'price' => 540.0, 'rating' => 5, 'reviews_count' => 340,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 42,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p42->id, 'path' => 'images/products/product_032.webp'], [
            'alt' => 'La Belle Le Parfum Eau de Parfum Intense', 'sort_order' => 0,
        ]);
        $p42->categories()->sync([$cats['fragrance']]);
        $products[] = $p42->id;
        $p43 = Product::updateOrCreate(['slug' => 'million-gold-eau-de-parfum-intense'], [
            'brand_id' => $brands['rabanne'], 'name' => 'Million Gold Eau de Parfum Intense',
            'price' => 520.0, 'rating' => 5, 'reviews_count' => 210,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 43,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p43->id, 'path' => 'images/products/product_033.webp'], [
            'alt' => 'Million Gold Eau de Parfum Intense', 'sort_order' => 0,
        ]);
        $p43->categories()->sync([$cats['fragrance']]);
        $products[] = $p43->id;
        $p44 = Product::updateOrCreate(['slug' => 's-eau-de-parfum-intense'], [
            'brand_id' => $brands['giorgio-armani'], 'name' => 'Sì Eau de Parfum Intense',
            'price' => 630.0, 'rating' => 5, 'reviews_count' => 650,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 44,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p44->id, 'path' => 'images/products/product_034.webp'], [
            'alt' => 'Sì Eau de Parfum Intense', 'sort_order' => 0,
        ]);
        $p44->categories()->sync([$cats['fragrance']]);
        $products[] = $p44->id;
        $p45 = Product::updateOrCreate(['slug' => 'born-in-roma-donna-eau-de-parfum'], [
            'brand_id' => $brands['valentino'], 'name' => 'Born In Roma Donna Eau de Parfum',
            'price' => 555.0, 'rating' => 5, 'reviews_count' => 1100,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 45,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p45->id, 'path' => 'images/products/product_035.webp'], [
            'alt' => 'Born In Roma Donna Eau de Parfum', 'sort_order' => 0,
        ]);
        $p45->categories()->sync([$cats['fragrance']]);
        $products[] = $p45->id;
        $p46 = Product::updateOrCreate(['slug' => 'delina-eau-de-parfum'], [
            'brand_id' => $brands['parfums-de-marly'], 'name' => 'Delina Eau de Parfum',
            'price' => 1320.0, 'rating' => 5, 'reviews_count' => 890,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 46,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p46->id, 'path' => 'images/products/product_036.webp'], [
            'alt' => 'Delina Eau de Parfum', 'sort_order' => 0,
        ]);
        $p46->categories()->sync([$cats['fragrance']]);
        $products[] = $p46->id;
        $p47 = Product::updateOrCreate(['slug' => 'cheirosa-68-beija-flor-perfume-mist-240ml'], [
            'brand_id' => $brands['sol-de-janeiro'], 'name' => 'Cheirosa 68 Beija Flor Perfume Mist (240ml)',
            'price' => 155.0, 'rating' => 5, 'reviews_count' => 1850,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 47,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p47->id, 'path' => 'images/products/product_037.webp'], [
            'alt' => 'Cheirosa 68 Beija Flor Perfume Mist (240ml)', 'sort_order' => 0,
        ]);
        $p47->categories()->sync([$cats['fragrance']]);
        $products[] = $p47->id;
        $p48 = Product::updateOrCreate(['slug' => 'honey-infused-hair-oil-100ml'], [
            'brand_id' => $brands['gisou'], 'name' => 'Honey Infused Hair Oil (100ml)',
            'price' => 340.0, 'rating' => 5, 'reviews_count' => 3120,
            'badge' => 'CLEAN', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 48,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p48->id, 'path' => 'images/products/product_011.webp'], [
            'alt' => 'Honey Infused Hair Oil (100ml)', 'sort_order' => 0,
        ]);
        $p48->categories()->sync([$cats['hair']]);
        $products[] = $p48->id;
        $p49 = Product::updateOrCreate(['slug' => 'no-3-hair-perfector-100ml'], [
            'brand_id' => $brands['olaplex'], 'name' => 'No. 3 Hair Perfector (100ml)',
            'price' => 140.0, 'rating' => 4.5, 'reviews_count' => 5450,
            'badge' => 'AWARD WINNER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 49,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p49->id, 'path' => 'images/products/product_012.webp'], [
            'alt' => 'No. 3 Hair Perfector (100ml)', 'sort_order' => 0,
        ]);
        $p49->categories()->sync([$cats['hair']]);
        $products[] = $p49->id;
        $p50 = Product::updateOrCreate(['slug' => 'leave-in-molecular-repair-hair-mask-50ml'], [
            'brand_id' => $brands['k18'], 'name' => 'Leave-In Molecular Repair Hair Mask (50ml)',
            'price' => 315.0, 'rating' => 5, 'reviews_count' => 4210,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 50,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p50->id, 'path' => 'images/products/product_014.webp'], [
            'alt' => 'Leave-In Molecular Repair Hair Mask (50ml)', 'sort_order' => 0,
        ]);
        $p50->categories()->sync([$cats['hair']]);
        $products[] = $p50->id;
        $p51 = Product::updateOrCreate(['slug' => 'dream-coat-supernatural-spray-200ml'], [
            'brand_id' => $brands['color-wow'], 'name' => 'Dream Coat Supernatural Spray (200ml)',
            'price' => 135.0, 'rating' => 5, 'reviews_count' => 2890,
            'badge' => 'CLEAN', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 51,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p51->id, 'path' => 'images/hero/color_wow_dream_coat_supernatural_spray_sleek_silver_metallic_spray_bottle.webp'], [
            'alt' => 'Dream Coat Supernatural Spray (200ml)', 'sort_order' => 0,
        ]);
        $p51->categories()->sync([$cats['hair']]);
        $products[] = $p51->id;
        $p52 = Product::updateOrCreate(['slug' => 'scalp-body-scrub-st-barts-250g'], [
            'brand_id' => $brands['ouai'], 'name' => 'Scalp & Body Scrub St. Barts (250g)',
            'price' => 165.0, 'rating' => 4.5, 'reviews_count' => 910,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 52,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p52->id, 'path' => 'images/products/product_015.webp'], [
            'alt' => 'Scalp & Body Scrub St. Barts (250g)', 'sort_order' => 0,
        ]);
        $p52->categories()->sync([$cats['hair']]);
        $products[] = $p52->id;
        $p53 = Product::updateOrCreate(['slug' => 'airwrap-multi-styler-complete-long'], [
            'brand_id' => $brands['dyson'], 'name' => 'Airwrap™ multi-styler Complete Long',
            'price' => 2699.0, 'rating' => 5, 'reviews_count' => 1840,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 53,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p53->id, 'path' => 'images/products/product_038.webp'], [
            'alt' => 'Airwrap™ multi-styler Complete Long', 'sort_order' => 0,
        ]);
        $p53->categories()->sync([$cats['hair']]);
        $products[] = $p53->id;
        $p54 = Product::updateOrCreate(['slug' => 'elixir-ultime-l-huile-originale-hair-oil-100ml'], [
            'brand_id' => $brands['k-rastase'], 'name' => 'Elixir Ultime L\'Huile Originale Hair Oil (100ml)',
            'price' => 230.0, 'rating' => 5, 'reviews_count' => 1430,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 54,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p54->id, 'path' => 'images/products/product_039.webp'], [
            'alt' => 'Elixir Ultime L\'Huile Originale Hair Oil (100ml)', 'sort_order' => 0,
        ]);
        $p54->categories()->sync([$cats['hair']]);
        $products[] = $p54->id;
        $p55 = Product::updateOrCreate(['slug' => 'holiroots-hair-treatment-oil-55ml'], [
            'brand_id' => $brands['fable-mane'], 'name' => 'HoliRoots™ Hair Treatment Oil (55ml)',
            'price' => 160.0, 'rating' => 4.5, 'reviews_count' => 760,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 55,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p55->id, 'path' => 'images/products/product_040.webp'], [
            'alt' => 'HoliRoots™ Hair Treatment Oil (55ml)', 'sort_order' => 0,
        ]);
        $p55->categories()->sync([$cats['hair']]);
        $products[] = $p55->id;
        $p56 = Product::updateOrCreate(['slug' => 'no-4-bond-maintenance-shampoo-250ml'], [
            'brand_id' => $brands['olaplex'], 'name' => 'No. 4 Bond Maintenance Shampoo (250ml)',
            'price' => 140.0, 'rating' => 4.5, 'reviews_count' => 3200,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 56,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p56->id, 'path' => 'images/products/product_016.webp'], [
            'alt' => 'No. 4 Bond Maintenance Shampoo (250ml)', 'sort_order' => 0,
        ]);
        $p56->categories()->sync([$cats['hair']]);
        $products[] = $p56->id;
        $p57 = Product::updateOrCreate(['slug' => 'don-t-despair-repair-deep-conditioning-mask-236ml'], [
            'brand_id' => $brands['briogeo'], 'name' => 'Don\'t Despair, Repair! Deep Conditioning Mask (236ml)',
            'price' => 180.0, 'rating' => 4.5, 'reviews_count' => 2150,
            'badge' => 'CLEAN', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 57,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p57->id, 'path' => 'images/products/product_041.webp'], [
            'alt' => 'Don\'t Despair, Repair! Deep Conditioning Mask (236ml)', 'sort_order' => 0,
        ]);
        $p57->categories()->sync([$cats['hair']]);
        $products[] = $p57->id;
        $p58 = Product::updateOrCreate(['slug' => 'honey-infused-leave-in-conditioner-150ml'], [
            'brand_id' => $brands['gisou'], 'name' => 'Honey Infused Leave-In Conditioner (150ml)',
            'price' => 155.0, 'rating' => 4.5, 'reviews_count' => 890,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 58,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p58->id, 'path' => 'images/products/product_017.webp'], [
            'alt' => 'Honey Infused Leave-In Conditioner (150ml)', 'sort_order' => 0,
        ]);
        $p58->categories()->sync([$cats['hair']]);
        $products[] = $p58->id;
        $p59 = Product::updateOrCreate(['slug' => 'peptide-prep-detox-shampoo-250ml'], [
            'brand_id' => $brands['k18'], 'name' => 'Peptide Prep™ Detox Shampoo (250ml)',
            'price' => 175.0, 'rating' => 5, 'reviews_count' => 1120,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 59,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p59->id, 'path' => 'images/products/product_018.webp'], [
            'alt' => 'Peptide Prep™ Detox Shampoo (250ml)', 'sort_order' => 0,
        ]);
        $p59->categories()->sync([$cats['hair']]);
        $products[] = $p59->id;
        $p60 = Product::updateOrCreate(['slug' => 'retinol-plant-protein-longevity-firming-balm'], [
            'brand_id' => $brands['youth-to-the-people'], 'name' => 'Retinol + Plant Protein Longevity Firming Balm',
            'price' => 245.0, 'rating' => 5, 'reviews_count' => 62,
            'badge' => 'Clean', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 60,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p60->id, 'path' => 'images/products/product_042.webp'], [
            'alt' => 'Retinol + Plant Protein Longevity Firming Balm', 'sort_order' => 0,
        ]);
        $products[] = $p60->id;
        $p61 = Product::updateOrCreate(['slug' => 'glossy-posse-ix-4-piece-lip-set'], [
            'brand_id' => $brands['fenty-beauty'], 'name' => 'Glossy Posse IX 4-Piece Lip Set',
            'price' => 210.0, 'rating' => 5, 'reviews_count' => 1240,
            'badge' => 'VALUE SET', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 61,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p61->id, 'path' => 'images/products/product_043.webp'], [
            'alt' => 'Glossy Posse IX 4-Piece Lip Set', 'sort_order' => 0,
        ]);
        $p61->categories()->sync([$cats['lips']]);
        $products[] = $p61->id;
        $p62 = Product::updateOrCreate(['slug' => 'cream-lip-stain-liquid-lipstick'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Cream Lip Stain Liquid Lipstick',
            'price' => 75.0, 'rating' => 5, 'reviews_count' => 5410,
            'badge' => 'ONLY AT SEPHORA', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 62,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p62->id, 'path' => 'images/products/product_044.webp'], [
            'alt' => 'Cream Lip Stain Liquid Lipstick', 'sort_order' => 0,
        ]);
        $p62->categories()->sync([$cats['lips']]);
        $products[] = $p62->id;
        $p63 = Product::updateOrCreate(['slug' => 'lip-butter-balm-set'], [
            'brand_id' => $brands['summer-fridays'], 'name' => 'Lip Butter Balm Set',
            'price' => 225.0, 'rating' => 5, 'reviews_count' => 2890,
            'badge' => 'AWARD WINNER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 63,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p63->id, 'path' => 'images/products/product_045.webp'], [
            'alt' => 'Lip Butter Balm Set', 'sort_order' => 0,
        ]);
        $p63->categories()->sync([$cats['lips']]);
        $products[] = $p63->id;
        $p64 = Product::updateOrCreate(['slug' => '3-minis-artist-color-pencil-set'], [
            'brand_id' => $brands['make-up-for-ever'], 'name' => '3 Minis Artist Color Pencil Set',
            'price' => 140.0, 'rating' => 5, 'reviews_count' => 650,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 64,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p64->id, 'path' => 'images/products/product_046.webp'], [
            'alt' => '3 Minis Artist Color Pencil Set', 'sort_order' => 0,
        ]);
        $p64->categories()->sync([$cats['lips']]);
        $products[] = $p64->id;
        $p65 = Product::updateOrCreate(['slug' => 'the-stain-edit-lip-tint-felt-liner-trio'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'The Stain Edit Lip Tint Felt Liner Trio',
            'price' => 95.0, 'rating' => 5, 'reviews_count' => 380,
            'badge' => 'ONLY AT SEPHORA', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 65,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p65->id, 'path' => 'images/products/product_047.webp'], [
            'alt' => 'The Stain Edit Lip Tint Felt Liner Trio', 'sort_order' => 0,
        ]);
        $p65->categories()->sync([$cats['lips']]);
        $products[] = $p65->id;
        $p66 = Product::updateOrCreate(['slug' => 'mini-lip-liner-trio'], [
            'brand_id' => $brands['makeup-by-mario'], 'name' => 'Mini Lip Liner Trio',
            'price' => 120.0, 'rating' => 5, 'reviews_count' => 1150,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 66,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p66->id, 'path' => 'images/products/product_048.webp'], [
            'alt' => 'Mini Lip Liner Trio', 'sort_order' => 0,
        ]);
        $p66->categories()->sync([$cats['lips']]);
        $products[] = $p66->id;
        $p67 = Product::updateOrCreate(['slug' => 'lip-liner-101-precision-pencil'], [
            'brand_id' => $brands['saie'], 'name' => 'Lip Liner 101 Precision Pencil',
            'price' => 85.0, 'rating' => 5, 'reviews_count' => 420,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 67,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p67->id, 'path' => 'images/products/product_049.webp'], [
            'alt' => 'Lip Liner 101 Precision Pencil', 'sort_order' => 0,
        ]);
        $p67->categories()->sync([$cats['lips']]);
        $products[] = $p67->id;
        $p68 = Product::updateOrCreate(['slug' => 'lip-toy-stained-glossing-oil'], [
            'brand_id' => $brands['urban-decay'], 'name' => 'Lip Toy Stained Glossing Oil',
            'price' => 95.0, 'rating' => 5, 'reviews_count' => 310,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 68,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p68->id, 'path' => 'images/products/product_050.webp'], [
            'alt' => 'Lip Toy Stained Glossing Oil', 'sort_order' => 0,
        ]);
        $p68->categories()->sync([$cats['lips']]);
        $products[] = $p68->id;
        $p69 = Product::updateOrCreate(['slug' => 'gloss-balm-trio-festive-cracker'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Gloss Balm Trio Festive Cracker',
            'price' => 85.0, 'rating' => 5, 'reviews_count' => 520,
            'badge' => 'ONLY AT SEPHORA', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 69,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p69->id, 'path' => 'images/products/product_051.webp'], [
            'alt' => 'Gloss Balm Trio Festive Cracker', 'sort_order' => 0,
        ]);
        $p69->categories()->sync([$cats['lips']]);
        $products[] = $p69->id;
        $p70 = Product::updateOrCreate(['slug' => 'mini-lip-pulse-glassy-plumper-trio'], [
            'brand_id' => $brands['kosas'], 'name' => 'Mini Lip Pulse Glassy Plumper Trio',
            'price' => 130.0, 'rating' => 5, 'reviews_count' => 890,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 70,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p70->id, 'path' => 'images/products/product_052.webp'], [
            'alt' => 'Mini Lip Pulse Glassy Plumper Trio', 'sort_order' => 0,
        ]);
        $p70->categories()->sync([$cats['lips']]);
        $products[] = $p70->id;
        $p71 = Product::updateOrCreate(['slug' => 'super-boost-lip-gloss-mini-pencil-set'], [
            'brand_id' => $brands['make-up-for-ever'], 'name' => 'Super Boost Lip Gloss + Mini Pencil Set',
            'price' => 115.0, 'rating' => 5, 'reviews_count' => 240,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 71,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p71->id, 'path' => 'images/products/product_053.webp'], [
            'alt' => 'Super Boost Lip Gloss + Mini Pencil Set', 'sort_order' => 0,
        ]);
        $p71->categories()->sync([$cats['lips']]);
        $products[] = $p71->id;
        $p72 = Product::updateOrCreate(['slug' => 'cream-lip-stain-set-5-full-size'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Cream Lip Stain Set 5 Full Size',
            'price' => 195.0, 'rating' => 5, 'reviews_count' => 3420,
            'badge' => 'ONLY AT SEPHORA', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 72,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p72->id, 'path' => 'images/products/product_054.webp'], [
            'alt' => 'Cream Lip Stain Set 5 Full Size', 'sort_order' => 0,
        ]);
        $p72->categories()->sync([$cats['lips']]);
        $products[] = $p72->id;
        $p73 = Product::updateOrCreate(['slug' => 'don-t-kiss-tell-maracuja-juicy-lip-trio'], [
            'brand_id' => $brands['tarte'], 'name' => 'Don\'t Kiss & Tell Maracuja Juicy Lip Trio',
            'price' => 185.0, 'rating' => 5, 'reviews_count' => 1450,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 73,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p73->id, 'path' => 'images/products/product_055.webp'], [
            'alt' => 'Don\'t Kiss & Tell Maracuja Juicy Lip Trio', 'sort_order' => 0,
        ]);
        $p73->categories()->sync([$cats['lips']]);
        $products[] = $p73->id;
        $p74 = Product::updateOrCreate(['slug' => 'artist-color-rouge-lipstick'], [
            'brand_id' => $brands['make-up-for-ever'], 'name' => 'Artist Color Rouge Lipstick',
            'price' => 125.0, 'rating' => 5, 'reviews_count' => 680,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 74,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p74->id, 'path' => 'images/products/product_056.webp'], [
            'alt' => 'Artist Color Rouge Lipstick', 'sort_order' => 0,
        ]);
        $p74->categories()->sync([$cats['lips']]);
        $products[] = $p74->id;
        $p75 = Product::updateOrCreate(['slug' => 'rouge-dior-forever-liquid-transfer-proof'], [
            'brand_id' => $brands['dior'], 'name' => 'Rouge Dior Forever Liquid Transfer-Proof',
            'price' => 215.0, 'rating' => 5, 'reviews_count' => 2910,
            'badge' => 'LUXURY', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 75,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p75->id, 'path' => 'images/products/product_057.webp'], [
            'alt' => 'Rouge Dior Forever Liquid Transfer-Proof', 'sort_order' => 0,
        ]);
        $p75->categories()->sync([$cats['lips']]);
        $products[] = $p75->id;
        $p76 = Product::updateOrCreate(['slug' => 'gloss-bomb-universal-lip-luminizer'], [
            'brand_id' => $brands['fenty-beauty'], 'name' => 'Gloss Bomb Universal Lip Luminizer',
            'price' => 115.0, 'rating' => 5, 'reviews_count' => 4820,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 76,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p76->id, 'path' => 'images/products/product_058.webp'], [
            'alt' => 'Gloss Bomb Universal Lip Luminizer', 'sort_order' => 0,
        ]);
        $p76->categories()->sync([$cats['lips']]);
        $products[] = $p76->id;
        $p77 = Product::updateOrCreate(['slug' => 'devotion-radiant-heart-palette'], [
            'brand_id' => $brands['dolce-gabbana'], 'name' => 'Devotion Radiant Heart Palette',
            'price' => 295.0, 'rating' => 4.7, 'reviews_count' => 310,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 77,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p77->id, 'path' => 'images/products/product_059.webp'], [
            'alt' => 'Devotion Radiant Heart Palette', 'sort_order' => 0,
        ]);
        $p77->categories()->sync([$cats['makeup']]);
        $products[] = $p77->id;
        $p78 = Product::updateOrCreate(['slug' => 'rose-metals-eyeshadow-palette'], [
            'brand_id' => $brands['anastasia-beverly-hills'], 'name' => 'Rose Metals Eyeshadow Palette',
            'price' => 235.0, 'rating' => 4.8, 'reviews_count' => 1150,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 78,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p78->id, 'path' => 'images/products/product_019.webp'], [
            'alt' => 'Rose Metals Eyeshadow Palette', 'sort_order' => 0,
        ]);
        $p78->categories()->sync([$cats['makeup']]);
        $products[] = $p78->id;
        $p79 = Product::updateOrCreate(['slug' => 'lash-clash-mascara-mini-loveshine-set'], [
            'brand_id' => $brands['yves-saint-laurent'], 'name' => 'Lash Clash Mascara & Mini Loveshine Set',
            'price' => 215.0, 'rating' => 4.7, 'reviews_count' => 424,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 79,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p79->id, 'path' => 'images/products/product_020.webp'], [
            'alt' => 'Lash Clash Mascara & Mini Loveshine Set', 'sort_order' => 0,
        ]);
        $p79->categories()->sync([$cats['makeup']]);
        $products[] = $p79->id;
        $p80 = Product::updateOrCreate(['slug' => 'vitamin-enriched-face-base-duo-set'], [
            'brand_id' => $brands['bobbi-brown'], 'name' => 'Vitamin Enriched Face Base Duo Set',
            'price' => 340.0, 'rating' => 4.9, 'reviews_count' => 980,
            'badge' => 'VALUE SET', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 80,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p80->id, 'path' => 'images/products/product_060.webp'], [
            'alt' => 'Vitamin Enriched Face Base Duo Set', 'sort_order' => 0,
        ]);
        $p80->categories()->sync([$cats['makeup'], $cats['skincare']]);
        $products[] = $p80->id;
        $p81 = Product::updateOrCreate(['slug' => 'addict-lip-glow-color-reviving-balm'], [
            'brand_id' => $brands['dior'], 'name' => 'Addict Lip Glow Color-Reviving Balm',
            'price' => 195.0, 'rating' => 4.8, 'reviews_count' => 2410,
            'badge' => 'LUXURY', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 81,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p81->id, 'path' => 'images/products/product_061.webp'], [
            'alt' => 'Addict Lip Glow Color-Reviving Balm', 'sort_order' => 0,
        ]);
        $p81->categories()->sync([$cats['makeup']]);
        $products[] = $p81->id;
        $p82 = Product::updateOrCreate(['slug' => 'addict-lip-maximizer-plumping-gloss'], [
            'brand_id' => $brands['dior'], 'name' => 'Addict Lip Maximizer Plumping Gloss',
            'price' => 195.0, 'rating' => 4.9, 'reviews_count' => 1850,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 82,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p82->id, 'path' => 'images/products/product_062.webp'], [
            'alt' => 'Addict Lip Maximizer Plumping Gloss', 'sort_order' => 0,
        ]);
        $p82->categories()->sync([$cats['makeup']]);
        $products[] = $p82->id;
        $p83 = Product::updateOrCreate(['slug' => 'glowy-super-gel-lightweight-dewy-illuminator-duo'], [
            'brand_id' => $brands['saie'], 'name' => 'Glowy Super Gel Lightweight Dewy Illuminator Duo',
            'price' => 165.0, 'rating' => 4.7, 'reviews_count' => 620,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 83,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p83->id, 'path' => 'images/products/product_063.webp'], [
            'alt' => 'Glowy Super Gel Lightweight Dewy Illuminator Duo', 'sort_order' => 0,
        ]);
        $p83->categories()->sync([$cats['makeup']]);
        $products[] = $p83->id;
        $p84 = Product::updateOrCreate(['slug' => 'soft-matte-complete-full-coverage-concealer'], [
            'brand_id' => $brands['nars'], 'name' => 'Soft Matte Complete Full Coverage Concealer',
            'price' => 155.0, 'rating' => 4.8, 'reviews_count' => 3120,
            'badge' => 'AWARD WINNER', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 84,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p84->id, 'path' => 'images/products/product_064.webp'], [
            'alt' => 'Soft Matte Complete Full Coverage Concealer', 'sort_order' => 0,
        ]);
        $p84->categories()->sync([$cats['makeup']]);
        $products[] = $p84->id;
        $p85 = Product::updateOrCreate(['slug' => 'face-sculpt-bronze-dual-ended-precision-brush'], [
            'brand_id' => $brands['huda-beauty'], 'name' => 'Face Sculpt & Bronze Dual-Ended Precision Brush',
            'price' => 125.0, 'rating' => 4.9, 'reviews_count' => 210,
            'badge' => 'NEW', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 85,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p85->id, 'path' => 'images/products/product_065.webp'], [
            'alt' => 'Face Sculpt & Bronze Dual-Ended Precision Brush', 'sort_order' => 0,
        ]);
        $p85->categories()->sync([$cats['makeup']]);
        $products[] = $p85->id;
        $p86 = Product::updateOrCreate(['slug' => 'balm-dotcom-universal-nourishing-salve'], [
            'brand_id' => $brands['glossier'], 'name' => 'Balm Dotcom Universal Nourishing Salve',
            'price' => 75.0, 'rating' => 4.6, 'reviews_count' => 890,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 86,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p86->id, 'path' => 'images/products/product_066.webp'], [
            'alt' => 'Balm Dotcom Universal Nourishing Salve', 'sort_order' => 0,
        ]);
        $p86->categories()->sync([$cats['makeup']]);
        $products[] = $p86->id;
        $p87 = Product::updateOrCreate(['slug' => 'radiant-creamy-concealer-longwear'], [
            'brand_id' => $brands['nars'], 'name' => 'Radiant Creamy Concealer Longwear',
            'price' => 165.0, 'rating' => 4.9, 'reviews_count' => 4520,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 87,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p87->id, 'path' => 'images/products/product_067.webp'], [
            'alt' => 'Radiant Creamy Concealer Longwear', 'sort_order' => 0,
        ]);
        $p87->categories()->sync([$cats['makeup']]);
        $products[] = $p87->id;
        $p88 = Product::updateOrCreate(['slug' => 'on-til-dawn-mattifying-waterproof-setting-spray-duo'], [
            'brand_id' => $brands['one-size'], 'name' => 'On \'Til Dawn Mattifying Waterproof Setting Spray Duo',
            'price' => 180.0, 'rating' => 4.9, 'reviews_count' => 1890,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 88,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p88->id, 'path' => 'images/products/product_068.webp'], [
            'alt' => 'On \'Til Dawn Mattifying Waterproof Setting Spray Duo', 'sort_order' => 0,
        ]);
        $p88->categories()->sync([$cats['makeup']]);
        $products[] = $p88->id;
        $p89 = Product::updateOrCreate(['slug' => 'nudescreen-dewy-illuminating-mineral-glow-spf-30'], [
            'brand_id' => $brands['nudestix'], 'name' => 'Nudescreen Dewy Illuminating Mineral Glow SPF 30',
            'price' => 140.0, 'rating' => 4.5, 'reviews_count' => 340,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 89,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p89->id, 'path' => 'images/products/product_069.webp'], [
            'alt' => 'Nudescreen Dewy Illuminating Mineral Glow SPF 30', 'sort_order' => 0,
        ]);
        $p89->categories()->sync([$cats['makeup']]);
        $products[] = $p89->id;
        $p90 = Product::updateOrCreate(['slug' => 'lette-in-bloom-clay-eyeshadow-palette'], [
            'brand_id' => $brands['tarte'], 'name' => 'lette™ In Bloom Clay Eyeshadow Palette',
            'price' => 210.0, 'rating' => 5, 'reviews_count' => 3410,
            'badge' => 'AWARD WINNER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 90,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p90->id, 'path' => 'images/hero/tartelette_in_bloom_clay_eyeshadow_palette_open_with_mirror_showing_12_neutral.webp'], [
            'alt' => 'lette™ In Bloom Clay Eyeshadow Palette', 'sort_order' => 0,
        ]);
        $p90->categories()->sync([$cats['makeup-palettes']]);
        $products[] = $p90->id;
        $p91 = Product::updateOrCreate(['slug' => 'glam-eyeshadow-palette-15-shimmery-matte-shades'], [
            'brand_id' => $brands['natasha-denona'], 'name' => 'Glam Eyeshadow Palette 15 Shimmery & Matte Shades',
            'price' => 295.0, 'rating' => 5, 'reviews_count' => 1150,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 91,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p91->id, 'path' => 'images/hero/natasha_denona_glam_or_bronze_eyeshadow_palette_open_showing_shimmering.webp'], [
            'alt' => 'Glam Eyeshadow Palette 15 Shimmery & Matte Shades', 'sort_order' => 0,
        ]);
        $p91->categories()->sync([$cats['makeup-palettes']]);
        $products[] = $p91->id;
        $p92 = Product::updateOrCreate(['slug' => 'modern-renaissance-eye-shadow-palette'], [
            'brand_id' => $brands['anastasia-beverly-hills'], 'name' => 'Modern Renaissance Eye Shadow Palette',
            'price' => 220.0, 'rating' => 5, 'reviews_count' => 4230,
            'badge' => 'ICONIC', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 92,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p92->id, 'path' => 'images/products/product_021.webp'], [
            'alt' => 'Modern Renaissance Eye Shadow Palette', 'sort_order' => 0,
        ]);
        $p92->categories()->sync([$cats['makeup-palettes']]);
        $products[] = $p92->id;
        $p93 = Product::updateOrCreate(['slug' => 'color-fuse-talc-free-powder-blush-palette'], [
            'brand_id' => $brands['haus-labs-by-lady-gaga'], 'name' => 'Color Fuse Talc-Free Powder Blush Palette',
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 820,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 93,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p93->id, 'path' => 'images/products/product_070.webp'], [
            'alt' => 'Color Fuse Talc-Free Powder Blush Palette', 'sort_order' => 0,
        ]);
        $p93->categories()->sync([$cats['makeup-palettes']]);
        $products[] = $p93->id;
        $p94 = Product::updateOrCreate(['slug' => 'bio-radiant-gel-powder-highlighter-palette'], [
            'brand_id' => $brands['haus-labs-by-lady-gaga'], 'name' => 'Bio-Radiant Gel-Powder Highlighter Palette',
            'price' => 175.0, 'rating' => 5, 'reviews_count' => 490,
            'badge' => 'EXCLUSIVE', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 94,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p94->id, 'path' => 'images/products/product_071.webp'], [
            'alt' => 'Bio-Radiant Gel-Powder Highlighter Palette', 'sort_order' => 0,
        ]);
        $p94->categories()->sync([$cats['makeup-palettes']]);
        $products[] = $p94->id;
        $p95 = Product::updateOrCreate(['slug' => 'lil-softies-lip-cheek-tinted-multi-palette-set'], [
            'brand_id' => $brands['tower-28'], 'name' => 'Lil\' Softies Lip & Cheek Tinted Multi Palette Set',
            'price' => 125.0, 'rating' => 5, 'reviews_count' => 380,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 95,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p95->id, 'path' => 'images/products/product_072.webp'], [
            'alt' => 'Lil\' Softies Lip & Cheek Tinted Multi Palette Set', 'sort_order' => 0,
        ]);
        $p95->categories()->sync([$cats['makeup-palettes']]);
        $products[] = $p95->id;
        $p96 = Product::updateOrCreate(['slug' => 'star-strips'], [
            'brand_id' => $brands['starface'], 'name' => 'Star Strips',
            'price' => 65.0, 'rating' => 4.3, 'reviews_count' => 195,
            'badge' => null, 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 96,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p96->id, 'path' => 'images/products/product_073.webp'], [
            'alt' => 'Star Strips', 'sort_order' => 0,
        ]);
        $p96->categories()->sync([$cats['minis-more']]);
        $products[] = $p96->id;
        $p97 = Product::updateOrCreate(['slug' => 'starter-kit-bloom'], [
            'brand_id' => $brands['estrid'], 'name' => 'Starter Kit Bloom',
            'price' => 55.0, 'rating' => 3.7, 'reviews_count' => 475,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 97,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p97->id, 'path' => 'images/products/product_074.webp'], [
            'alt' => 'Starter Kit Bloom', 'sort_order' => 0,
        ]);
        $p97->categories()->sync([$cats['minis-more']]);
        $products[] = $p97->id;
        $p98 = Product::updateOrCreate(['slug' => 'overnight-bio-collagen-recovery-sheet-mask-with-peptides'], [
            'brand_id' => $brands['peace-out-skincare'], 'name' => 'Overnight Bio-Collagen Recovery Sheet Mask - with Peptides',
            'price' => 80.0, 'rating' => 4.8, 'reviews_count' => 85,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 98,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p98->id, 'path' => 'images/products/product_075.webp'], [
            'alt' => 'Overnight Bio-Collagen Recovery Sheet Mask - with Peptides', 'sort_order' => 0,
        ]);
        $p98->categories()->sync([$cats['minis-more']]);
        $products[] = $p98->id;
        $p99 = Product::updateOrCreate(['slug' => 'brazilian-crush-cheirosa-68-beija-flor-perfume-mist-mini-90ml'], [
            'brand_id' => $brands['sol-de-janeiro'], 'name' => 'Brazilian Crush Cheirosa 68 Beija Flor Perfume Mist (Mini 90ml)',
            'price' => 105.0, 'rating' => 4.8, 'reviews_count' => 1240,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 99,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p99->id, 'path' => 'images/products/product_022.webp'], [
            'alt' => 'Brazilian Crush Cheirosa 68 Beija Flor Perfume Mist (Mini 90ml)', 'sort_order' => 0,
        ]);
        $p99->categories()->sync([$cats['minis-more']]);
        $products[] = $p99->id;
        $p100 = Product::updateOrCreate(['slug' => 'lip-glowy-balm-mini-berry-tinted'], [
            'brand_id' => $brands['laneige'], 'name' => 'Lip Glowy Balm Mini - Berry Tinted',
            'price' => 45.0, 'rating' => 4.8, 'reviews_count' => 950,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 100,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p100->id, 'path' => 'images/products/product_076.webp'], [
            'alt' => 'Lip Glowy Balm Mini - Berry Tinted', 'sort_order' => 0,
        ]);
        $p100->categories()->sync([$cats['minis-more']]);
        $products[] = $p100->id;
        $p101 = Product::updateOrCreate(['slug' => 'sos-daily-rescue-facial-spray-travel-size'], [
            'brand_id' => $brands['tower-28'], 'name' => 'SOS Daily Rescue Facial Spray - Travel Size',
            'price' => 60.0, 'rating' => 4.6, 'reviews_count' => 380,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 101,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p101->id, 'path' => 'images/products/product_077.webp'], [
            'alt' => 'SOS Daily Rescue Facial Spray - Travel Size', 'sort_order' => 0,
        ]);
        $p101->categories()->sync([$cats['minis-more']]);
        $products[] = $p101->id;
        $p102 = Product::updateOrCreate(['slug' => 'mini-pocket-eye-palette-brush-set'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Mini Pocket Eye Palette & Brush Set',
            'price' => 55.0, 'rating' => 4.4, 'reviews_count' => 210,
            'badge' => 'Online Only', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 102,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p102->id, 'path' => 'images/products/product_078.webp'], [
            'alt' => 'Mini Pocket Eye Palette & Brush Set', 'sort_order' => 0,
        ]);
        $p102->categories()->sync([$cats['minis-more']]);
        $products[] = $p102->id;
        $p103 = Product::updateOrCreate(['slug' => 'mini-honey-infused-hair-oil-20ml'], [
            'brand_id' => $brands['gisou'], 'name' => 'Mini Honey Infused Hair Oil 20ml',
            'price' => 110.0, 'rating' => 4.9, 'reviews_count' => 530,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 103,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p103->id, 'path' => 'images/products/product_023.webp'], [
            'alt' => 'Mini Honey Infused Hair Oil 20ml', 'sort_order' => 0,
        ]);
        $p103->categories()->sync([$cats['minis-more']]);
        $products[] = $p103->id;
        $p104 = Product::updateOrCreate(['slug' => 'cream-lip-stain-set-5-matte-liquid-lipsticks'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Cream Lip Stain Set 5 Matte Liquid Lipsticks',
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 340,
            'badge' => 'New', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 104,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p104->id, 'path' => 'images/products/product_079.webp'], [
            'alt' => 'Cream Lip Stain Set 5 Matte Liquid Lipsticks', 'sort_order' => 0,
        ]);
        $products[] = $p104->id;
        $p105 = Product::updateOrCreate(['slug' => 'advent-calendar-24-makeup-skincare-and-bath-surprises'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Advent Calendar 24 Makeup, Skincare, and Bath Surprises',
            'price' => 299.0, 'rating' => 5, 'reviews_count' => 420,
            'badge' => 'New', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 105,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p105->id, 'path' => 'images/products/product_080.webp'], [
            'alt' => 'Advent Calendar 24 Makeup, Skincare, and Bath Surprises', 'sort_order' => 0,
        ]);
        $products[] = $p105->id;
        $p106 = Product::updateOrCreate(['slug' => 'size-up-mascara-waterproof-volume-mascara'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Size Up Mascara - Waterproof Volume Mascara',
            'price' => 75.0, 'rating' => 5, 'reviews_count' => 1250,
            'badge' => 'Best Seller', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 106,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p106->id, 'path' => 'images/products/product_081.webp'], [
            'alt' => 'Size Up Mascara - Waterproof Volume Mascara', 'sort_order' => 0,
        ]);
        $products[] = $p106->id;
        $p107 = Product::updateOrCreate(['slug' => 'glow-peel-pads-60-pads-with-natural-glycolic-acid'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'Glow Peel Pads - 60 Pads with Natural Glycolic Acid',
            'price' => 85.0, 'rating' => 5, 'reviews_count' => 520,
            'badge' => 'Clean', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 107,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p107->id, 'path' => 'images/products/product_024.webp'], [
            'alt' => 'Glow Peel Pads - 60 Pads with Natural Glycolic Acid', 'sort_order' => 0,
        ]);
        $p107->categories()->sync([$cats['skincare']]);
        $products[] = $p107->id;
        $p108 = Product::updateOrCreate(['slug' => 'watermelon-glow-niacinamide-dew-drops'], [
            'brand_id' => $brands['glow-recipe'], 'name' => 'Watermelon Glow Niacinamide Dew Drops',
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 2410,
            'badge' => 'CLEAN', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 108,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p108->id, 'path' => 'images/hero/glow_recipe_watermelon_glow_niacinamide_dew_drops_pink_glass_serum_bottle.webp'], [
            'alt' => 'Watermelon Glow Niacinamide Dew Drops', 'sort_order' => 0,
        ]);
        $p108->categories()->sync([$cats['skincare']]);
        $products[] = $p108->id;
        $p109 = Product::updateOrCreate(['slug' => 'niacinamide-10-zinc-1-high-strength-serum'], [
            'brand_id' => $brands['the-ordinary'], 'name' => 'Niacinamide 10% + Zinc 1% High-Strength Serum',
            'price' => 35.0, 'rating' => 5, 'reviews_count' => 4820,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 109,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p109->id, 'path' => 'images/products/product_025.webp'], [
            'alt' => 'Niacinamide 10% + Zinc 1% High-Strength Serum', 'sort_order' => 0,
        ]);
        $p109->categories()->sync([$cats['skincare']]);
        $products[] = $p109->id;
        $p110 = Product::updateOrCreate(['slug' => 'lip-sleeping-mask-intense-hydration-berry'], [
            'brand_id' => $brands['laneige'], 'name' => 'Lip Sleeping Mask Intense Hydration - Berry',
            'price' => 95.0, 'rating' => 5, 'reviews_count' => 3650,
            'badge' => 'AWARD WINNER', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 110,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p110->id, 'path' => 'images/hero/laneige_lip_sleeping_mask_berry_pink_jar_container_with_lid_luxury_studio.webp'], [
            'alt' => 'Lip Sleeping Mask Intense Hydration - Berry', 'sort_order' => 0,
        ]);
        $p110->categories()->sync([$cats['skincare']]);
        $products[] = $p110->id;
        $p111 = Product::updateOrCreate(['slug' => 'protini-polypeptide-cream-peptide-moisturizer'], [
            'brand_id' => $brands['drunk-elephant'], 'name' => 'Protini™ Polypeptide Cream Peptide Moisturizer',
            'price' => 310.0, 'rating' => 5, 'reviews_count' => 1920,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 111,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p111->id, 'path' => 'images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp'], [
            'alt' => 'Protini™ Polypeptide Cream Peptide Moisturizer', 'sort_order' => 0,
        ]);
        $p111->categories()->sync([$cats['skincare']]);
        $products[] = $p111->id;
        $p112 = Product::updateOrCreate(['slug' => 'the-dewy-skin-cream-plumping-moisturizer'], [
            'brand_id' => $brands['tatcha'], 'name' => 'The Dewy Skin Cream Plumping Moisturizer',
            'price' => 320.0, 'rating' => 5, 'reviews_count' => 1450,
            'badge' => 'LUXURY', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 112,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p112->id, 'path' => 'images/products/product_026.webp'], [
            'alt' => 'The Dewy Skin Cream Plumping Moisturizer', 'sort_order' => 0,
        ]);
        $p112->categories()->sync([$cats['skincare']]);
        $products[] = $p112->id;
        $p113 = Product::updateOrCreate(['slug' => 'superfood-antioxidant-cleanser-237ml'], [
            'brand_id' => $brands['youth-to-the-people'], 'name' => 'Superfood Antioxidant Cleanser 237ml',
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 1850,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => true, 'sort_order' => 113,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p113->id, 'path' => 'images/products/product_027.webp'], [
            'alt' => 'Superfood Antioxidant Cleanser 237ml', 'sort_order' => 0,
        ]);
        $p113->categories()->sync([$cats['skincare']]);
        $products[] = $p113->id;
        $p114 = Product::updateOrCreate(['slug' => 'vinoperfect-radiance-dark-spot-serum'], [
            'brand_id' => $brands['caudalie'], 'name' => 'Vinoperfect Radiance Dark Spot Serum',
            'price' => 295.0, 'rating' => 5, 'reviews_count' => 2120,
            'badge' => 'CLEAN', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 114,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p114->id, 'path' => 'images/products/product_028.webp'], [
            'alt' => 'Vinoperfect Radiance Dark Spot Serum', 'sort_order' => 0,
        ]);
        $p114->categories()->sync([$cats['skincare']]);
        $products[] = $p114->id;
        $p115 = Product::updateOrCreate(['slug' => 'brazilian-bum-bum-cream-firming-body-cream'], [
            'brand_id' => $brands['sol-de-janeiro'], 'name' => 'Brazilian Bum Bum Cream Firming Body Cream',
            'price' => 195.0, 'rating' => 5, 'reviews_count' => 3200,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 115,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p115->id, 'path' => 'images/products/product_029.webp'], [
            'alt' => 'Brazilian Bum Bum Cream Firming Body Cream', 'sort_order' => 0,
        ]);
        $p115->categories()->sync([$cats['skincare']]);
        $products[] = $p115->id;
        $p116 = Product::updateOrCreate(['slug' => 'skin-perfecting-2-bha-liquid-exfoliant'], [
            'brand_id' => $brands['paula-s-choice'], 'name' => 'Skin Perfecting 2% BHA Liquid Exfoliant',
            'price' => 160.0, 'rating' => 5, 'reviews_count' => 2750,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 116,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p116->id, 'path' => 'images/products/product_030.webp'], [
            'alt' => 'Skin Perfecting 2% BHA Liquid Exfoliant', 'sort_order' => 0,
        ]);
        $p116->categories()->sync([$cats['skincare']]);
        $products[] = $p116->id;
        $p117 = Product::updateOrCreate(['slug' => 'ultra-facial-cream-24-hour-hydration'], [
            'brand_id' => $brands['kiehl-s-since-1851'], 'name' => 'Ultra Facial Cream 24-Hour Hydration',
            'price' => 175.0, 'rating' => 5, 'reviews_count' => 1680,
            'badge' => 'BEST SELLER', 'is_bestseller' => true, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 117,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p117->id, 'path' => 'images/products/product_031.webp'], [
            'alt' => 'Ultra Facial Cream 24-Hour Hydration', 'sort_order' => 0,
        ]);
        $p117->categories()->sync([$cats['skincare']]);
        $products[] = $p117->id;
        $p118 = Product::updateOrCreate(['slug' => '62-mist-71-mist-40-mist-68-mist-sol-de-janeiro-spritz-shine-cheirosa-perfume-mist-set'], [
            'brand_id' => $brands['sol-de-janeiro'], 'name' => '62 MIST 71 MIST 40 MIST 68 MIST SOL DE JANEIRO Spritz & Shine Cheirosa Perfume Mist Set',
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 412,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 118,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p118->id, 'path' => 'images/products/product_032.webp'], [
            'alt' => '62 MIST 71 MIST 40 MIST 68 MIST SOL DE JANEIRO Spritz & Shine Cheirosa Perfume Mist Set', 'sort_order' => 0,
        ]);
        $p118->categories()->sync([$cats['gifts']]);
        $products[] = $p118->id;
        $p119 = Product::updateOrCreate(['slug' => 'born-this-way-too-faced-super-coverage-trio-multi-use-complexion-kit'], [
            'brand_id' => $brands['too-faced'], 'name' => 'Born This Way TOO FACED Super Coverage Trio: Multi-Use Complexion Kit',
            'price' => 195.0, 'rating' => 5, 'reviews_count' => 128,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 119,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p119->id, 'path' => 'images/products/product_033.webp'], [
            'alt' => 'Born This Way TOO FACED Super Coverage Trio: Multi-Use Complexion Kit', 'sort_order' => 0,
        ]);
        $p119->categories()->sync([$cats['gifts']]);
        $products[] = $p119->id;
        $p120 = Product::updateOrCreate(['slug' => 'ilia-the-beauty-of-clean-makeup-set'], [
            'brand_id' => $brands['ilia'], 'name' => 'ILIA The Beauty of Clean Makeup Set',
            'price' => 230.0, 'rating' => 5, 'reviews_count' => 85,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 120,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p120->id, 'path' => 'images/products/product_034.webp'], [
            'alt' => 'ILIA The Beauty of Clean Makeup Set', 'sort_order' => 0,
        ]);
        $p120->categories()->sync([$cats['gifts']]);
        $products[] = $p120->id;
        $p121 = Product::updateOrCreate(['slug' => 'blush-glow-sephora-collection-blush-blush-glow-holiday-set'], [
            'brand_id' => $brands['sephora-collection'], 'name' => 'BLUSH GLOW SEPHORA COLLECTION Blush Blush Glow Holiday Set',
            'price' => 175.0, 'rating' => 5, 'reviews_count' => 95,
            'badge' => 'Online Only', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 121,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p121->id, 'path' => 'images/products/product_035.webp'], [
            'alt' => 'BLUSH GLOW SEPHORA COLLECTION Blush Blush Glow Holiday Set', 'sort_order' => 0,
        ]);
        $p121->categories()->sync([$cats['gifts']]);
        $products[] = $p121->id;
        $p122 = Product::updateOrCreate(['slug' => 'oil-gisou-style-shine-spritz-hair-trio'], [
            'brand_id' => $brands['gisou'], 'name' => 'OIL GISOU Style, Shine & Spritz Hair Trio',
            'price' => 270.0, 'rating' => 5, 'reviews_count' => 210,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 122,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p122->id, 'path' => 'images/products/product_036.webp'], [
            'alt' => 'OIL GISOU Style, Shine & Spritz Hair Trio', 'sort_order' => 0,
        ]);
        $p122->categories()->sync([$cats['gifts']]);
        $products[] = $p122->id;
        $p123 = Product::updateOrCreate(['slug' => 'good-girl-carolina-herrera-good-girl-blush-eau-de-parfum-gift-set'], [
            'brand_id' => $brands['carolina-herrera'], 'name' => 'Good Girl CAROLINA HERRERA Good Girl Blush Eau de Parfum Gift Set',
            'price' => 700.0, 'rating' => 5, 'reviews_count' => 168,
            'badge' => 'New', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 123,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p123->id, 'path' => 'images/products/product_037.webp'], [
            'alt' => 'Good Girl CAROLINA HERRERA Good Girl Blush Eau de Parfum Gift Set', 'sort_order' => 0,
        ]);
        $p123->categories()->sync([$cats['gifts']]);
        $products[] = $p123->id;
        $p124 = Product::updateOrCreate(['slug' => 'deluxe-mini-coffret-perfume-set'], [
            'brand_id' => $brands['juliette-has-a-gun'], 'name' => 'Deluxe Mini Coffret Perfume Set',
            'price' => 400.0, 'rating' => 5, 'reviews_count' => 54,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 124,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p124->id, 'path' => 'images/products/product_038.webp'], [
            'alt' => 'Deluxe Mini Coffret Perfume Set', 'sort_order' => 0,
        ]);
        $p124->categories()->sync([$cats['gifts']]);
        $products[] = $p124->id;
        $p125 = Product::updateOrCreate(['slug' => 'dewy-skin-glossy-lips-holiday-duo'], [
            'brand_id' => $brands['tatcha'], 'name' => 'Dewy Skin & Glossy Lips Holiday Duo',
            'price' => 409.0, 'rating' => 5, 'reviews_count' => 315,
            'badge' => 'Exclusive', 'is_bestseller' => false, 'is_new' => false,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 125,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p125->id, 'path' => 'images/products/product_039.webp'], [
            'alt' => 'Dewy Skin & Glossy Lips Holiday Duo', 'sort_order' => 0,
        ]);
        $p125->categories()->sync([$cats['gifts']]);
        $products[] = $p125->id;
        $p126 = Product::updateOrCreate(['slug' => 'matte-glow-bronze-filter-4-pan-face-palette'], [
            'brand_id' => $brands['huda-beauty'], 'name' => 'Matte & Glow Bronze Filter 4-Pan Face Palette',
            'price' => 165.0, 'rating' => 5, 'reviews_count' => 142,
            'badge' => 'New', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => true, 'sort_order' => 126,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p126->id, 'path' => 'images/products/product_040.webp'], [
            'alt' => 'Matte & Glow Bronze Filter 4-Pan Face Palette', 'sort_order' => 0,
        ]);
        $p126->categories()->sync([$cats['new']]);
        $products[] = $p126->id;
        $p127 = Product::updateOrCreate(['slug' => 'purple-trouble-eau-de-parfum'], [
            'brand_id' => $brands['juliette-has-a-gun'], 'name' => 'Purple Trouble Eau De Parfum',
            'price' => 630.0, 'rating' => 5, 'reviews_count' => 41,
            'badge' => 'New', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => false, 'is_exclusive' => false, 'sort_order' => 127,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p127->id, 'path' => 'images/products/product_041.webp'], [
            'alt' => 'Purple Trouble Eau De Parfum', 'sort_order' => 0,
        ]);
        $p127->categories()->sync([$cats['new']]);
        $products[] = $p127->id;
        $p128 = Product::updateOrCreate(['slug' => 'retinol-collagen-peptide-plant-protein-longevity-balm'], [
            'brand_id' => $brands['youth-to-the-people'], 'name' => 'Retinol + Collagen Peptide Plant Protein Longevity Balm',
            'price' => 260.0, 'rating' => 5, 'reviews_count' => 67,
            'badge' => 'New', 'is_bestseller' => false, 'is_new' => true,
            'is_clean' => true, 'is_exclusive' => false, 'sort_order' => 128,
        ]);
        ProductImage::updateOrCreate(['product_id' => $p128->id, 'path' => 'images/products/product_042.webp'], [
            'alt' => 'Retinol + Collagen Peptide Plant Protein Longevity Balm', 'sort_order' => 0,
        ]);
        $p128->categories()->sync([$cats['new']]);
        $products[] = $p128->id;

        // ── Offers ──
        Offer::updateOrCreate(['title' => 'Summer Pouch', 'brand_name' => 'NUXE'], [
            'description' => 'On purchase of any 2 products from Nuxe',
            'image_path' => 'images/products/product_001.webp',
            'category' => 'gift', 'sort_order' => 0, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Get a Star Brush Free', 'brand_name' => 'TARTE'], [
            'description' => 'A little Star Brush for your beauty bag when you purchase any 2 full-size products',
            'image_path' => 'images/products/product_002.webp',
            'category' => 'gift', 'sort_order' => 1, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Patchouli Musc Eau de Parfum Intense 10ml', 'brand_name' => 'NARCISO RODRIGUEZ'], [
            'description' => 'Buy any Narciso Rodriguez fragrance and enjoy an exclusive gift',
            'image_path' => 'images/products/product_003.webp',
            'category' => 'gift', 'sort_order' => 2, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'YTTP Glass Water Bottle', 'brand_name' => 'YOUTH TO THE PEOPLE'], [
            'description' => 'On purchase of YTTP Superfood Protein Balm',
            'image_path' => 'images/products/product_004.webp',
            'category' => 'gift', 'sort_order' => 3, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Million Gold Eau de Parfum Intense 5ml Miniature', 'brand_name' => 'RABANNE'], [
            'description' => 'Buy any Rabanne fragrance and enjoy an exclusive gift',
            'image_path' => 'images/products/product_005.webp',
            'category' => 'gift', 'sort_order' => 4, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Deluxe Prada Wisteria Balm', 'brand_name' => 'PRADA'], [
            'description' => 'Enjoy the lip balm on purchase of any Prada makeup!',
            'image_path' => 'images/products/product_006.webp',
            'category' => 'gift', 'sort_order' => 5, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Nars Powermatte Lip Pencil Duos', 'brand_name' => 'NARS'], [
            'description' => 'Purchase of any 2 Nars products to avail the gift.',
            'image_path' => 'images/products/product_007.webp',
            'category' => 'gift', 'sort_order' => 6, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Donut Keychain Cap', 'brand_name' => 'LANEIGE'], [
            'description' => 'On purchase of any 2 full size products from Laneige',
            'image_path' => 'images/products/product_008.webp',
            'category' => 'gift', 'sort_order' => 7, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Dynamic Resurfacing Facial Wash 30ml', 'brand_name' => 'ELEMIS'], [
            'description' => 'On any purchase from Elemis',
            'image_path' => 'images/products/product_009.webp',
            'category' => 'gift', 'sort_order' => 8, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Dream Coat Supernatural Spray 50ml', 'brand_name' => 'COLOR WOW'], [
            'description' => 'On purchase of any 2 products from Color Wow',
            'image_path' => 'images/products/product_010.webp',
            'category' => 'gift', 'sort_order' => 9, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Brightening Serum 5ml', 'brand_name' => 'TATCHA'], [
            'description' => 'On purchase of any full size product from Tatcha',
            'image_path' => 'images/products/product_011.webp',
            'category' => 'gift', 'sort_order' => 10, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Milk Makeup Concealer Brush', 'brand_name' => 'MILK MAKEUP'], [
            'description' => 'Avail the above gift on purchase of any 2 products from Milk Makeup',
            'image_path' => 'images/products/product_012.webp',
            'category' => 'gift', 'sort_order' => 11, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Serum Sample Trio', 'brand_name' => 'BIODANCE'], [
            'description' => 'On purchase of any 2 products from Biodance',
            'image_path' => 'images/products/product_013.webp',
            'category' => 'gift', 'sort_order' => 12, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'The Chic Mirror Sleeve', 'brand_name' => 'BBB LONDON'], [
            'description' => 'Avail the above gift on purchase of any BBB London Products.',
            'image_path' => 'images/products/product_014.webp',
            'category' => 'gift', 'sort_order' => 13, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Pouch with Minis', 'brand_name' => 'CLARINS'], [
            'description' => 'On purchase of 3 products from Clarins',
            'image_path' => 'images/products/product_015.webp',
            'category' => 'gift', 'sort_order' => 14, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Your Beauty Essentials, Beautifully Stored', 'brand_name' => 'HOURGLASS'], [
            'description' => 'Get a makeup bag when you purchase any 2 full-size Hourglass products.',
            'image_path' => 'images/products/product_016.webp',
            'category' => 'gift', 'sort_order' => 15, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'A Floral Treat, Just for You', 'brand_name' => 'GUCCI'], [
            'description' => 'Enjoy a complimentary Gucci Flora mirror & eye mask with every 100ml fragrance purchase from the Gucci Flora collection.',
            'image_path' => 'images/products/product_017.webp',
            'category' => 'gift', 'sort_order' => 16, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Good Girl Jasmine Absolute 7ml Miniature', 'brand_name' => 'CAROLINA HERRERA'], [
            'description' => 'Enjoy a complimentary gift with the purchase of any 100ml fragrance from the brand.',
            'image_path' => 'images/products/product_018.webp',
            'category' => 'gift', 'sort_order' => 17, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Get your Huda Beauty Gift', 'brand_name' => 'HUDA BEAUTY'], [
            'description' => 'Avail the above gift on purchase of any Bronze Filter Pallette',
            'image_path' => 'images/products/product_019.webp',
            'category' => 'gift', 'sort_order' => 18, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Porefessional Sponge Applicator', 'brand_name' => 'BENEFIT'], [
            'description' => 'Get a free Sponge Applicator- Upon purchase of 1 POREfessional Concealer and any Benefit full-size product',
            'image_path' => 'images/products/product_020.webp',
            'category' => 'gift', 'sort_order' => 19, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Urban Decay pouch & mini bestsellers', 'brand_name' => 'URBAN DECAY'], [
            'description' => 'Purchase any 2 Urban decay products and receive an Urban Decay Pouch + 2 Mini bestsellers',
            'image_path' => 'images/products/product_021.webp',
            'category' => 'gift', 'sort_order' => 20, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Idôle Set Miniature', 'brand_name' => 'LANCÔME'], [
            'description' => 'Avail the above gift on purchase of any 2 products from Lancôme.',
            'image_path' => 'images/products/product_022.webp',
            'category' => 'gift', 'sort_order' => 21, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Maison Margiela Replica Totebag', 'brand_name' => 'MAISON MARGIELA'], [
            'description' => 'With any purchase from Maison Margiela.',
            'image_path' => 'images/products/product_023.webp',
            'category' => 'gift', 'sort_order' => 22, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Get a free Disco Ball Keychain', 'brand_name' => 'MOONGLAZE'], [
            'description' => 'Avail the above gift from Moonglaze with every Moonglow Highlighter purchase!',
            'image_path' => 'images/products/product_024.webp',
            'category' => 'gift', 'sort_order' => 23, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Fugazzi Canvas Totebag XL', 'brand_name' => 'FUGAZZI'], [
            'description' => 'Upon the purchase of any 50ml or 100ml fragrance',
            'image_path' => 'images/products/product_025.webp',
            'category' => 'gift', 'sort_order' => 24, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Slip Single Scrunchie – Black', 'brand_name' => 'SLIP'], [
            'description' => 'Receive a multi-award winning Slip skinny scrunchie when you spend 500 AED on Slip products',
            'image_path' => 'images/products/product_026.webp',
            'category' => 'gift', 'sort_order' => 25, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Free Soft Pinch Liquid Blush Deluxe', 'brand_name' => 'RARE BEAUTY'], [
            'description' => 'Upon the purchase of any 2 products from Rare Beauty.',
            'image_path' => 'images/products/product_027.webp',
            'category' => 'gift', 'sort_order' => 26, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Unlock the exclusive gift!', 'brand_name' => 'BURBERRY'], [
            'description' => 'On purchases above AED 600 from the brand.',
            'image_path' => 'images/products/product_028.webp',
            'category' => 'gift', 'sort_order' => 27, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'La Belle Rosea Eau de Parfum 6ml', 'brand_name' => 'JEAN PAUL GAULTIER'], [
            'description' => 'Purchase any Jean Paul Gaultier fragrance to avail this gift.',
            'image_path' => 'images/products/product_029.webp',
            'category' => 'gift', 'sort_order' => 28, 'is_active' => true,
        ]);
        Offer::updateOrCreate(['title' => 'Baccarat Rouge 540 EDP 5ml', 'brand_name' => 'MAISON FRANCIS KURKDJIAN'], [
            'description' => 'Enjoy a complimentary gift with every purchase of an 70ml fragrance.',
            'image_path' => 'images/products/product_030.webp',
            'category' => 'gift', 'sort_order' => 29, 'is_active' => true,
        ]);

        // ── FAQs ──
        Faq::updateOrCreate(['question' => 'I think points may be missing on my account. What should I do?'], [
            'category' => 'general', 'answer' => 'Points from in-store purchases typically update within 24 to 48 hours, while online purchase points are credited immediately upon dispatch of your parcel. If your points have not reflected after this timeframe, please verify that your Beauty Pass card number is accurately linked to your online profile under Account Settings. Email us at: customercare@sephora.ae',
            'sort_order' => 0,
        ]);
        Faq::updateOrCreate(['question' => 'How do I track my order delivery in UAE?'], [
            'category' => 'general', 'answer' => 'Once your order departs our Dubai fulfillment hub, you will receive an automated SMS and email containing your carrier tracking code (via Aramex or Fetchr). Deliveries within Dubai and Abu Dhabi arrive within 1-2 business days. You can also monitor real-time tracking by visiting your Online Account > Order History .',
            'sort_order' => 1,
        ]);
        Faq::updateOrCreate(['question' => 'Can I return an item purchased online at a Sephora store in UAE?'], [
            'category' => 'general', 'answer' => 'Yes! Any item purchased online at sephora.me can be returned within 14 calendar days of receipt at any official Sephora boutique in the United Arab Emirates (including The Dubai Mall, Mall of the Emirates, Yas Mall, and Galleria Al Maryah). Items must be in their original packaging, unopened, unused, and accompanied by the digital e-invoice or printed delivery note.',
            'sort_order' => 2,
        ]);
        Faq::updateOrCreate(['question' => 'How does Tabby and Tamara split in 4 work at checkout?'], [
            'category' => 'general', 'answer' => 'Both Tabby and Tamara allow you to split your purchase amount into 4 equal interest-free monthly installments. At checkout, select either Tabby or Tamara as your payment provider. You will pay 25% today upon checkout confirmation, and the remaining 3 installments will be charged automatically every 30 days. No hidden fees or interest apply if paid on schedule. Valid for UAE residents with a valid Emirates ID.',
            'sort_order' => 3,
        ]);
        Faq::updateOrCreate(['question' => 'How do I book an in-store beauty or brow service?'], [
            'category' => 'general', 'answer' => 'You can book an appointment at the Benefit BrowBar, receive a customized 45-minute Full Glam Makeover, or book a Complimentary 15-minute Skin Consultation via the Stores & Services tab in our header menu, or by contacting your preferred Sephora boutique directly via phone. Beauty Pass Gold members receive complimentary priority bookings.',
            'sort_order' => 4,
        ]);
        Faq::updateOrCreate(['question' => 'What should I do if my promo code or free gift is not applying?'], [
            'category' => 'general', 'answer' => 'Ensure that your basket meets the qualifying spend threshold (typically minimum 250 AED or higher for deluxe gifts with purchase). Check for brand exclusions: some prestige houses and already discounted holiday sets are exempt from sitewide percentage promo codes. Remember that promotional codes are case-sensitive and only one code may be applied per transaction.',
            'sort_order' => 5,
        ]);
        Faq::updateOrCreate(['question' => 'How do I check my Sephora Gift Card balance and validity?'], [
            'category' => 'general', 'answer' => 'Sephora UAE gift cards remain valid for 1 full calendar year from the date of issue. You can verify your live balance at any Sephora cash register in the UAE or directly online by entering your 16-digit card number and security PIN in the Gift Card module under Checkout > Payment Methods.',
            'sort_order' => 6,
        ]);
        Faq::updateOrCreate(['question' => 'Can I choose a delivery time slot?'], [
            'category' => 'delivery', 'answer' => 'Our dedicated courier service will reach out to you via SMS and WhatsApp on the morning of delivery with a live tracking link. Through this notification, you can confirm your preferred delivery window (Morning: 9am–2pm or Evening: 2pm–8pm) or provide alternate gate security instructions. Note: Standard orders are scheduled Monday through Saturday across Dubai, Abu Dhabi, Sharjah, Ajman, Fujairah, Ras Al Khaimah, and Umm Al Quwain.',
            'sort_order' => 7,
        ]);
        Faq::updateOrCreate(['question' => 'What do I do if I missed the delivery of my order?'], [
            'category' => 'delivery', 'answer' => 'If you miss our courier dispatch, there is no need to worry. The driver will attempt a secondary delivery on the following business day at no additional charge. You will receive an SMS containing a direct dispatch link allowing you to reschedule the delivery date or update the drop-off address within the same Emirate.',
            'sort_order' => 8,
        ]);
        Faq::updateOrCreate(['question' => 'What should I do if my order has not arrived?'], [
            'category' => 'delivery', 'answer' => 'If your package has exceeded the stated 1–2 business day timeline, please verify the courier status link provided in your Sephora dispatch email. Alternatively, reach out directly to our Client Support Concierge at 800 7374672 or email customercare@sephora.ae with your order number. Our team resolves dispatch escalations within 1–2 business days.',
            'sort_order' => 9,
        ]);
        Faq::updateOrCreate(['question' => 'How can I track my order?'], [
            'category' => 'delivery', 'answer' => 'Once your order has been packed and handed over to our courier partners from our central UAE fulfillment hub, you will receive an automated dispatch notification containing your airway tracking reference number. You can also view live status updates anytime under My Sephora → Order History .',
            'sort_order' => 10,
        ]);
        Faq::updateOrCreate(['question' => 'Can I pay with foreign currency for Cash on Delivery?'], [
            'category' => 'delivery', 'answer' => 'No. For orders placed under Cash on Delivery (COD) within the United Arab Emirates, couriers strictly accept United Arab Emirates Dirhams (AED) in exact or change amounts. Foreign currencies, traveler cheques, or international checks are not accepted upon doorstep arrival.',
            'sort_order' => 11,
        ]);
        Faq::updateOrCreate(['question' => 'What are the delivery costs and timelines?'], [
            'category' => 'delivery', 'answer' => 'Orders of 250 AED and above: Complimentary Standard Delivery across all seven Emirates (1–2 business days). Orders below 250 AED: A standard delivery fee of 20 AED is applied at final checkout. Gold & Black Beauty Pass members enjoy free delivery on all qualifying transactions.',
            'sort_order' => 12,
        ]);
        Faq::updateOrCreate(['question' => 'How are Cash on Delivery orders refunded?'], [
            'category' => 'delivery', 'answer' => 'For returned items paid via Cash on Delivery, your refund is instantly credited as a Sephora Online Store Credit Voucher valid for 12 months. If you return the item directly to any of our 32 Sephora UAE stores, you may also opt for an immediate in-store gift card or instant exchange upon presenting your valid order invoice.',
            'sort_order' => 13,
        ]);
        Faq::updateOrCreate(['question' => 'What happens if I am not home when my order is delivered?'], [
            'category' => 'delivery', 'answer' => 'Our courier representative will telephone or message your registered UAE mobile number. If unreachable, a doorstep card is logged and the courier will schedule a retry. After three consecutive unsuccessful attempts, the parcel is securely returned to our warehouse and a refund is processed to your original payment method.',
            'sort_order' => 14,
        ]);
        Faq::updateOrCreate(['question' => 'What is Click & Collect?'], [
            'category' => 'delivery', 'answer' => 'Click & Collect is our complimentary omni-channel service that allows you to shop your favorite beauty selections online at sephora.me and collect your packaged order directly from your chosen Sephora store in as little as 2 hours.',
            'sort_order' => 15,
        ]);
        Faq::updateOrCreate(['question' => 'Where do I go in the store to collect my order?'], [
            'category' => 'delivery', 'answer' => 'Head directly to the dedicated Beauty Concierge Cash Desk or inform any Beauty Advisor upon arrival. Simply present your collection confirmation email or SMS containing your Order Ready code alongside a valid Emirates ID or Passport.',
            'sort_order' => 16,
        ]);
        Faq::updateOrCreate(['question' => 'Which stores offer Click & Collect?'], [
            'category' => 'delivery', 'answer' => 'Click & Collect is available across all 32 Sephora UAE retail boutiques, including The Dubai Mall Flagship, Mall of the Emirates, Dubai Hills Mall, Yas Mall Abu Dhabi, Galleria Al Maryah Island, City Centre Mirdif, and Al Zahia Sharjah.',
            'sort_order' => 17,
        ]);
        Faq::updateOrCreate(['question' => 'When should I place my order so that I can collect it on the same day?'], [
            'category' => 'delivery', 'answer' => 'Please place your Click & Collect order at least 3 hours prior to store closing. Orders submitted after 7:30 PM will be processed and prepared for collection the following morning at store opening (10:00 AM).',
            'sort_order' => 18,
        ]);
        Faq::updateOrCreate(['question' => 'How long will the store hold my Click & Collect order?'], [
            'category' => 'delivery', 'answer' => 'Stores will securely retain your order for 7 consecutive days starting from the moment you receive your "Ready for Pickup" notification. If you do not collect your order within this period, the items will be returned to stock and a full refund will be automatically issued.',
            'sort_order' => 19,
        ]);
        Faq::updateOrCreate(['question' => 'Can I pay for my Click & Collect order in cash at the store?'], [
            'category' => 'delivery', 'answer' => 'No. Click & Collect orders must be fully prepaid online during checkout via Credit/Debit card, Apple Pay, Tabby, Tamara, or Sephora Online Gift Cards. Cash payment at the store counter is not permitted for web-reserved packages.',
            'sort_order' => 20,
        ]);
        Faq::updateOrCreate(['question' => 'Can I use my promo code or gift card for Click & Collect?'], [
            'category' => 'delivery', 'answer' => 'Yes. All valid Sephora UAE promotional vouchers, Beauty Pass coupon codes, and e-gift cards can be applied at digital checkout before selecting Click & Collect pickup.',
            'sort_order' => 21,
        ]);
        Faq::updateOrCreate(['question' => 'Will I get free samples and gift with purchase with Click & Collect?'], [
            'category' => 'delivery', 'answer' => 'Yes! Every Click & Collect order is carefully packed with complimentary prestige beauty samples matching your basket selection, including any eligible tier-based Deluxe Gifts with Purchase.',
            'sort_order' => 22,
        ]);
        Faq::updateOrCreate(['question' => 'How do I return my Click & Collect order?'], [
            'category' => 'delivery', 'answer' => 'Returns can be handled instantly in any Sephora store within 14 days of pickup. Simply bring the unused items in their original luxury packaging alongside your digital purchase invoice for an immediate exchange or refund.',
            'sort_order' => 23,
        ]);
        Faq::updateOrCreate(['question' => 'Express delivery options and immediate dispatch policies'], [
            'category' => 'delivery', 'answer' => 'Express dispatch guarantees priority warehouse picking and immediate fulfillment via dedicated private courier. Available on designated weekdays for orders within prime metropolitan zones of Dubai and Abu Dhabi.',
            'sort_order' => 24,
        ]);
        Faq::updateOrCreate(['question' => 'What happens if I don\'t pick up my Click & Collect order?'], [
            'category' => 'cancellation_refund', 'answer' => 'Your Click & Collect parcel will be held at your chosen Sephora UAE boutique for exactly 7 consecutive days starting from the moment you receive your collection notification email or SMS. If the order is not collected within this 7-day period, the store team will automatically return the merchandise to stock and initiate an order cancellation. Any payment charged will be automatically refunded through your original payment method. For card payments, bank clearing typically completes within 3–7 business days depending on your financial institution.',
            'sort_order' => 25,
        ]);
        Faq::updateOrCreate(['question' => 'How do I cancel or modify an appointment?'], [
            'category' => 'cancellation_refund', 'answer' => 'Beauty Bar appointments, fragrance layer consultations, and Brow Bar bookings can be modified or cancelled seamlessly up to 2 hours prior to the scheduled time: There are no penalties or fees for rescheduled appointments.',
            'sort_order' => 26,
        ]);
        Faq::updateOrCreate(['question' => 'What happens to my points when my order is cancelled or returned?'], [
            'category' => 'cancellation_refund', 'answer' => 'Your Beauty Pass tier balance adjusts in real-time in alignment with your final net spend:',
            'sort_order' => 27,
        ]);
        Faq::updateOrCreate(['question' => 'What is your return policy?'], [
            'category' => 'cancellation_refund', 'answer' => 'We offer a comprehensive 14-day return and exchange policy from the date of physical receipt or store purchase across the United Arab Emirates. To be eligible for a full refund or exchange: Note: For hygienic reasons, makeup applicators and unsealed skincare jars cannot be returned unless verified as defective.',
            'sort_order' => 28,
        ]);
        Faq::updateOrCreate(['question' => 'My order has been cancelled due to the unavailability of a product. Have I been charged?'], [
            'category' => 'cancellation_refund', 'answer' => 'No. When you place an online order with Sephora UAE, your card is not immediately captured; an authorization hold is placed temporarily. If an item is flagged out of stock during parcel assembly, your card is charged solely for the fulfilled items. The authorization hold for the unavailable item will be released immediately. In accordance with UAE banking cycles, the balance hold disappears from pending transactions within 24 to 48 business hours.',
            'sort_order' => 29,
        ]);
        Faq::updateOrCreate(['question' => 'What do I do if I receive the wrong item, a damaged/defective item or have a problem with an item ordered?'], [
            'category' => 'cancellation_refund', 'answer' => 'Please notify our Client Concierge team within 48 hours of receiving the shipment. You may contact us at customercare@sephora.ae or via toll-free phone at 800 7374672 . Please include: We will arrange a complimentary white-glove collection and ship an immediate replacement or issue a 100% refund, including delivery charges.',
            'sort_order' => 30,
        ]);
        Faq::updateOrCreate(['question' => 'How can I return a product in store?'], [
            'category' => 'cancellation_refund', 'answer' => 'You can return products bought online or at any branch directly to any of the 32 Sephora stores across Dubai, Abu Dhabi, Sharjah, Al Ain, Ajman, and Ras Al Khaimah.',
            'sort_order' => 31,
        ]);
        Faq::updateOrCreate(['question' => 'How will I be refunded for items purchased via gift card?'], [
            'category' => 'cancellation_refund', 'answer' => 'If you paid using a physical Sephora Gift Card or digital e-Gift Card, refunds are credited back to an electronic voucher or newly loaded digital Gift Card with the equivalent balance. If you split payment between a Gift Card and a credit card, the amount paid by card is returned to the card, and the remainder is credited back to a Gift Card.',
            'sort_order' => 32,
        ]);
        Faq::updateOrCreate(['question' => 'Are delivery charges refundable?'], [
            'category' => 'cancellation_refund', 'answer' => 'Standard delivery fees (AED 20 for orders under AED 250) and Cash on Delivery service fees are non-refundable for voluntary change-of-mind returns. However, if the return is a result of a Sephora fulfillment error, package defect, or transit damage , all shipping fees will be reimbursed in full.',
            'sort_order' => 33,
        ]);
        Faq::updateOrCreate(['question' => 'What should I do if have lost my invoice/receipt?'], [
            'category' => 'cancellation_refund', 'answer' => 'If you have misplaced your physical receipt, simply sign in to your online Sephora account and navigate to My Account > Order History to view and download your original Tax Invoice. If you made the purchase in-store as a Beauty Pass member, store advisors can instantly look up your transaction history using your mobile phone number.',
            'sort_order' => 34,
        ]);
        Faq::updateOrCreate(['question' => 'Can engraved products be returned?'], [
            'category' => 'cancellation_refund', 'answer' => 'Due to their bespoke and tailored nature, customized and personalized items—such as laser-engraved fragrance flacons and monogrammed lipstick casings—cannot be returned or exchanged , unless there is an evident manufacturing defect or typing error produced by Sephora.',
            'sort_order' => 35,
        ]);
        Faq::updateOrCreate(['question' => 'How do I return a product delivered to Kuwait, Qatar, Bahrain, or Oman?'], [
            'category' => 'cancellation_refund', 'answer' => 'For cross-border regional orders fulfilled across the GCC, customers must arrange returns through our dedicated regional concierge team within 14 days of delivery. Reach out to your territory support desk (phone contacts detailed in the concierge section below). Our logistics team will issue an international prepaid airway bill (AWB) and schedule courier pickup from your location. Note: Cross-border shipments cannot be returned directly at regional retail stores of a different country.',
            'sort_order' => 36,
        ]);

        // ── Stores ──
        Store::updateOrCreate(['name' => 'Sephora - Dubai Mall'], [
            'city' => 'Dubai', 'emirate' => 'Dubai', 'address' => 'Fashion Avenue, Level 2',
            'has_brow_bar' => true, 'has_beauty_bar' => true,
            'sort_order' => 0,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Mall of the Emirates'], [
            'city' => 'Dubai', 'emirate' => 'Dubai', 'address' => 'Level 1, Near Ski Dubai',
            'has_brow_bar' => false, 'has_beauty_bar' => false,
            'sort_order' => 1,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Yas Mall'], [
            'city' => 'Abu Dhabi', 'emirate' => 'Abu Dhabi', 'address' => 'Central Plaza',
            'has_brow_bar' => true, 'has_beauty_bar' => false,
            'sort_order' => 2,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Marina Mall'], [
            'city' => 'Abu Dhabi', 'emirate' => 'Abu Dhabi', 'address' => 'Level 1',
            'has_brow_bar' => false, 'has_beauty_bar' => true,
            'sort_order' => 3,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - City Centre Mirdif'], [
            'city' => 'Dubai', 'emirate' => 'Dubai', 'address' => 'Ground Level',
            'has_brow_bar' => true, 'has_beauty_bar' => false,
            'sort_order' => 4,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Ibn Battuta Mall'], [
            'city' => 'Dubai', 'emirate' => 'Dubai', 'address' => 'India Court',
            'has_brow_bar' => false, 'has_beauty_bar' => false,
            'sort_order' => 5,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Dubai Festival City'], [
            'city' => 'Dubai', 'emirate' => 'Dubai', 'address' => 'Ground Level, Festival Square',
            'has_brow_bar' => true, 'has_beauty_bar' => true,
            'sort_order' => 6,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - The Galleria Al Maryah Island'], [
            'city' => 'Abu Dhabi', 'emirate' => 'Abu Dhabi', 'address' => 'Level 2',
            'has_brow_bar' => false, 'has_beauty_bar' => false,
            'sort_order' => 7,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - City Centre Deira'], [
            'city' => 'Dubai', 'emirate' => 'Dubai', 'address' => 'Level 1',
            'has_brow_bar' => true, 'has_beauty_bar' => false,
            'sort_order' => 8,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Sharjah City Centre'], [
            'city' => 'Sharjah', 'emirate' => 'Sharjah', 'address' => 'Ground Level',
            'has_brow_bar' => false, 'has_beauty_bar' => true,
            'sort_order' => 9,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Al Wahda Mall'], [
            'city' => 'Abu Dhabi', 'emirate' => 'Abu Dhabi', 'address' => 'Level 1',
            'has_brow_bar' => true, 'has_beauty_bar' => false,
            'sort_order' => 10,
        ]);
        Store::updateOrCreate(['name' => 'Sephora - Nakheel Mall'], [
            'city' => 'Dubai', 'emirate' => 'Dubai', 'address' => 'Level 1, Palm Jumeirah',
            'has_brow_bar' => false, 'has_beauty_bar' => false,
            'sort_order' => 11,
        ]);

        // ── Settings ──
        Setting::set('free_shipping_threshold', '250');
        Setting::set('shipping_fee', '25');
        Setting::set('free_shipping_message', 'Free Delivery on orders over 250 AED');
    }
}
