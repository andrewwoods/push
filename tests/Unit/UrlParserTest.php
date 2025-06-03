<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\UrlParser;

class UrlParserTest extends TestCase
{
    /**
     * Test a simple URL with only a scheme and a hostname.
     */
    public function testSimpleHostnameUrl(): void
    {
        $content = 'https://example.com';
        $parser = new UrlParser($content);
        $result = (string) $parser;

        $this->assertEquals($content, $result);

        $this->assertEquals('example.com', $parser->host);
        $this->assertEquals('https', $parser->scheme);
    }

    /**
     * Typical blog article URL with no params or hash.
     */
    public function testBlogArticleUrl(): void
    {
        $content = 'https://example.com/2025/06/02/first-second-third';
        $parser = new UrlParser($content);
        $result = (string) $parser;

        $this->assertEquals($content, $result);
        $this->assertEquals('example.com', $parser->host);
        $this->assertEquals('https', $parser->scheme);
        $this->assertEquals('/2025/06/02/first-second-third', $parser->path);
    }

    /**
     * The UTM Parameters are commonly used by marketers, and I always want to
     *   remove them.
     */
    public function testGetUtmParameters()
    {
        $content = 'https://example.com';

        $parser = new UrlParser($content);
        $result = $parser->getUtmParameters();

        $this->assertEquals(5, count($result));
        $this->assertTrue(in_array('utm_campaign', $result), 'utm_campaign is found');
        $this->assertTrue(in_array('utm_content', $result), 'utm_content is found');
        $this->assertTrue(in_array('utm_medium', $result), 'utm_medium is found');
        $this->assertTrue(in_array('utm_source', $result), 'utm_source is found');
        $this->assertTrue(in_array('utm_term', $result), 'utm_term is found');
    }

    public function testGetUrlHasParameters()
    {
        $content = 'https://www.example.com/watch?v=IHW1bIW4UXw';

        $parser = new UrlParser($content);

        $this->assertEquals(1, count($parser->query));
        $this->assertTrue(isset($parser->query['v']), 'the v parameter is found');
        $this->assertEquals('IHW1bIW4UXw', $parser->query['v'], 'the v value matches');
    }
}
