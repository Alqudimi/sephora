<?php

namespace Tests\Unit;

use App\Support\Media;
use Tests\TestCase;

class MediaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Media::flushCache();
    }

    public function test_empty_path_returns_fallback_asset(): void
    {
        $url = Media::url('');
        $this->assertStringContainsString('images/placeholder.webp', $url);

        $nullUrl = Media::url(null);
        $this->assertStringContainsString('images/placeholder.webp', $nullUrl);
    }

    public function test_data_and_blob_urls_pass_through(): void
    {
        $dataUri = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=';
        $this->assertSame($dataUri, Media::url($dataUri));

        $blobUri = 'blob:http://localhost:8000/1234-5678';
        $this->assertSame($blobUri, Media::url($blobUri));
    }

    public function test_remote_cdn_url_with_local_file_serves_local_asset(): void
    {
        // 800791_swatch.jpg exists in public/images/products/
        $cdnUrl = 'https://bkwk-prd.my.commercecloud.salesforce.com/dw2f78e696/images/hi-res-AE/SKU/SKU_7993/800791_swatch.jpg?sw=1248';
        $resolved = Media::url($cdnUrl);

        $this->assertStringContainsString('images/products/800791_swatch.jpg', $resolved);
        $this->assertStringNotContainsString('commercecloud.salesforce.com', $resolved);
    }

    public function test_remote_cdn_url_without_local_file_passes_through(): void
    {
        $remoteUrl = 'https://cdn.example.com/unique_product_xyz.jpg';
        $this->assertSame($remoteUrl, Media::url($remoteUrl));
    }

    public function test_existing_local_path_resolves_to_asset(): void
    {
        $url = Media::url('images/placeholder.webp');
        $this->assertStringContainsString('images/placeholder.webp', $url);
    }

    public function test_missing_local_path_falls_back_to_placeholder(): void
    {
        $url = Media::url('images/does_not_exist_xyz.webp');
        $this->assertStringContainsString('images/placeholder.webp', $url);
    }

    public function test_generic_banner_url_is_never_resolved_to_local_product_image(): void
    {
        $remoteBanner = 'https://img-content.sephora.me/m3aon8mn8vtz/6rcewr4pj1QM0agLQenGjj/05e2acc67ecdcee28a7f5e5fbf0137ee/Fenty_Beauty_-_Brand_Highlights_-_1744x992.jpg?fm=webp&q=85&w=1320';
        $resolved = Media::url($remoteBanner);

        // Should return the remote URL unchanged, not the local product asset
        $this->assertSame($remoteBanner, $resolved);
    }
}

