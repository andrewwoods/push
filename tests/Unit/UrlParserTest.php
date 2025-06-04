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

    public function testGetUrlHasParametersWithoutBlacklistParams()
    {
        $content = 'https://www.youtube.com/watch?v=pn3ysZTdN7o&utm_source=mastodon&utm_campaign=unit-testing';

        $parser = new UrlParser($content);
        var_dump($parser->query);
        $this->assertEquals(1, count($parser->query));
        $this->assertTrue(isset($parser->query['v']), 'the v parameter is found');
        $this->assertFalse(isset($parser->query['utm_source']), 'the utm_should parameter should not be found');
        $this->assertFalse(isset($parser->query['utm_campaign']), 'the utm_campaign parameter should not be found');
        $this->assertEquals('pn3ysZTdN7o', $parser->query['v'], 'the v value matches');
    }


    public function testFromAssocClearQueryParams(): void
    {
        $url = 'https://www.linkedin.com/comm/jobs/view/4182363088/?trackingId=d%2FhzbTS2JqiVU9PNPW5gbQ%3D%3D&refId=ByteString%28length%3D16%2Cbytes%3D6f38e9ae...0c20a1c1%29&lipi=urn%3Ali%3Apage%3Aemail_email_job_alert_digest_01%3B71CnBP5GQC%2BrGKzWkTzMzw%3D%3D&midToken=AQG0n6XpxKw3Nw&midSig=1rX2aVyPU6-bE1&trk=eml-email_job_alert_digest_01-job_card-0-jobcard_body&trkEmail=eml-email_job_alert_digest_01-job_card-0-jobcard_body-null-2lo68~m86l946j~bf-null-null&eid=2lo68-m86l946j-bf&otpToken=MTYwNjE5ZTAxMTJkY2ZjZWI1MjkwMWViNGUxY2UzYjc4NmNlZDE0NDk4YTQ4NzZhNzdjMzA2Njc0ZjVjNWJmNWZjYWZkMjkxNGNmNGNmZGY0MDAyOTEyODc4YmQ5M2ZlYmM0MjNlNDM0OTAwZDkyNDliLDEsMQ%3D%3D';
        $expected = 'https://www.linkedin.com/comm/jobs/view/4182363088/';
        $parser = new UrlParser($url);
        $result = $parser->str();

        $this->assertEquals($expected, $result);
    }

    public function testFromAssocLatLongParams(): void
    {
        // NYC: lat 40.71427, long -74.00597
        $url = 'https://map.example/geolocation/nyc/?lat=40.71427&long=-74.00597';
        $expected = 'https://map.example/geolocation/nyc/?lat=40.71427&long=-74.00597';

        $parser = new UrlParser($url);
        $result = $parser->str();

        $this->assertEquals($expected, $result);
    }
}
