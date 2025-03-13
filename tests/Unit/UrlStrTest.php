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

    public function testFromAssocClearQueryParams(): void {
        $url = 'https://www.linkedin.com/comm/jobs/view/4182363088/?trackingId=d%2FhzbTS2JqiVU9PNPW5gbQ%3D%3D&refId=ByteString%28length%3D16%2Cbytes%3D6f38e9ae...0c20a1c1%29&lipi=urn%3Ali%3Apage%3Aemail_email_job_alert_digest_01%3B71CnBP5GQC%2BrGKzWkTzMzw%3D%3D&midToken=AQG0n6XpxKw3Nw&midSig=1rX2aVyPU6-bE1&trk=eml-email_job_alert_digest_01-job_card-0-jobcard_body&trkEmail=eml-email_job_alert_digest_01-job_card-0-jobcard_body-null-2lo68~m86l946j~bf-null-null&eid=2lo68-m86l946j-bf&otpToken=MTYwNjE5ZTAxMTJkY2ZjZWI1MjkwMWViNGUxY2UzYjc4NmNlZDE0NDk4YTQ4NzZhNzdjMzA2Njc0ZjVjNWJmNWZjYWZkMjkxNGNmNGNmZGY0MDAyOTEyODc4YmQ5M2ZlYmM0MjNlNDM0OTAwZDkyNDliLDEsMQ%3D%3D';
        $expected = 'https://www.linkedin.com/comm/jobs/view/4182363088/';
        $data = parse_url($url);
        $urlStr = new UrlStr();
        $result = $urlStr->fromParseUrl($data);

        $this->assertEquals($expected, $result);
    }

    public function testFromAssocLatLongParams(): void {
        // NYC: lat 40.71427, long -74.00597
        $url = 'https://map.example/geolocation/nyc/?lat=40.71427&long=-74.00597';
        $expected = 'https://map.example/geolocation/nyc/?lat=40.71427&long=-74.00597';
        $data = parse_url($url);
        $urlStr = new UrlStr();
        $result = $urlStr->fromParseUrl($data);

        $this->assertEquals($expected, $result);
    }

}
