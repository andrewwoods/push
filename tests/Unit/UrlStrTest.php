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
}
