<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductDescriptionSanitizationTest extends TestCase
{
    private function sanitize(?string $value): ?string
    {
        $product = new Product();
        $product->description = $value;
        return $product->description;
    }

    // ── Script removal ────────────────────────────────────────────────────────

    public function test_script_tag_and_content_are_dropped(): void
    {
        $result = $this->sanitize('<script>alert(document.cookie)</script>');
        $this->assertStringNotContainsString('<script', $result ?? '');
        $this->assertStringNotContainsString('alert', $result ?? '');
    }

    public function test_script_with_surrounding_text_preserves_text(): void
    {
        $result = $this->sanitize('Before<script>evil()</script>After');
        $this->assertStringNotContainsString('<script', $result ?? '');
        $this->assertStringNotContainsString('evil()', $result ?? '');
        $this->assertStringContainsString('Before', $result ?? '');
        $this->assertStringContainsString('After', $result ?? '');
    }

    // ── Event-handler removal ─────────────────────────────────────────────────

    public function test_event_handler_on_disallowed_element_drops_element(): void
    {
        $result = $this->sanitize('<img src="x" onerror="alert(1)">');
        $this->assertStringNotContainsString('onerror', $result ?? '');
        $this->assertStringNotContainsString('<img', $result ?? '');
    }

    public function test_event_handler_on_allowed_element_is_stripped(): void
    {
        $result = $this->sanitize('<a href="https://example.com" onclick="evil()">Link</a>');
        $this->assertStringNotContainsString('onclick', $result ?? '');
        $this->assertStringContainsString('href="https://example.com"', $result ?? '');
        $this->assertStringContainsString('Link', $result ?? '');
    }

    // ── javascript: and data: URI removal ────────────────────────────────────

    public function test_javascript_uri_in_href_is_dropped(): void
    {
        $result = $this->sanitize('<a href="javascript:alert(document.cookie)">Click</a>');
        $this->assertStringNotContainsString('javascript:', $result ?? '');
        $this->assertStringContainsString('Click', $result ?? '');
    }

    public function test_data_uri_in_href_is_dropped(): void
    {
        $result = $this->sanitize('<a href="data:text/html,<h1>XSS</h1>">X</a>');
        $this->assertStringNotContainsString('data:', $result ?? '');
    }

    // ── Allowed formatting preservation ──────────────────────────────────────

    public function test_strong_is_preserved(): void
    {
        $result = $this->sanitize('<strong>bold text</strong>');
        $this->assertStringContainsString('<strong>bold text</strong>', $result ?? '');
    }

    public function test_em_is_preserved(): void
    {
        $result = $this->sanitize('<em>italic text</em>');
        $this->assertStringContainsString('<em>italic text</em>', $result ?? '');
    }

    public function test_underline_is_preserved(): void
    {
        $result = $this->sanitize('<u>underlined</u>');
        $this->assertStringContainsString('<u>underlined</u>', $result ?? '');
    }

    public function test_strikethrough_is_preserved(): void
    {
        $result = $this->sanitize('<s>strikethrough</s>');
        $this->assertStringContainsString('<s>strikethrough</s>', $result ?? '');
    }

    public function test_unordered_list_is_preserved(): void
    {
        $result = $this->sanitize('<ul><li>Item 1</li><li>Item 2</li></ul>');
        $this->assertStringContainsString('<ul>', $result ?? '');
        $this->assertStringContainsString('<li>Item 1</li>', $result ?? '');
        $this->assertStringContainsString('<li>Item 2</li>', $result ?? '');
    }

    public function test_ordered_list_is_preserved(): void
    {
        $result = $this->sanitize('<ol><li>First</li><li>Second</li></ol>');
        $this->assertStringContainsString('<ol>', $result ?? '');
        $this->assertStringContainsString('<li>First</li>', $result ?? '');
    }

    public function test_null_description_remains_null(): void
    {
        $product = new Product();
        $product->description = null;
        $this->assertNull($product->description);
    }

    // ── HTTPS link preservation ───────────────────────────────────────────────

    public function test_https_link_is_preserved(): void
    {
        $result = $this->sanitize('<a href="https://example.com">Visit</a>');
        $this->assertStringContainsString('href="https://example.com"', $result ?? '');
    }

    public function test_http_link_is_preserved(): void
    {
        $result = $this->sanitize('<a href="http://example.com">Visit</a>');
        $this->assertStringContainsString('href="http://example.com"', $result ?? '');
    }

    public function test_https_scheme_preserved_regardless_of_case(): void
    {
        $result = $this->sanitize('<a href="HTTPS://example.com">Visit</a>');
        // Scheme is normalized to lowercase before sanitizing; href must be kept
        $this->assertStringContainsString('href="https://example.com"', $result ?? '');
        $this->assertStringContainsString('Visit', $result ?? '');
    }

    // ── Explicitly blocked elements ───────────────────────────────────────────

    public function test_iframe_is_dropped(): void
    {
        $result = $this->sanitize('<iframe src="https://evil.com"></iframe>');
        $this->assertStringNotContainsString('<iframe', $result ?? '');
    }

    public function test_svg_with_event_handler_is_dropped(): void
    {
        $result = $this->sanitize('<svg onload="alert(1)">x</svg>');
        $this->assertStringNotContainsString('<svg', $result ?? '');
        $this->assertStringNotContainsString('onload', $result ?? '');
    }
}
