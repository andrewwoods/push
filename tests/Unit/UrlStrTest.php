<?php

namespace Tests\Unit;

use App\UrlStr;
use PHPUnit\Framework\TestCase;

class UrlStrTest extends TestCase
{
    // Ensure it's calling my class
    public function testUrlStrClassName(): void
    {
        $urlStr = new UrlStr();

        $this->assertTrue(str_contains($urlStr::class, 'UrlStr'));
    }

    public function testFromAssocNoDataPassed(): void
    {
        $urlStr = new UrlStr();
        $result = $urlStr->fromParseUrl();

        $this->assertEquals('', $result);
    }

    public function testFromAssocUrlWithSchemeAndHost(): void
    {
        $url = 'https://andrewwoods.net';
        $data = parse_url($url);

        $urlStr = new UrlStr();
        $result = $urlStr->fromParseUrl($data);

        $this->assertEquals($url, $result);
    }

}
