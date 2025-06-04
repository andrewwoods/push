<?php

namespace App;

class UrlParser
{
    public string $scheme = '';

    public string $host = '';

    public string $port = '';

    public string $user = '';

    public string $pass = '';

    public string $path = '';

    // after the question mark ?
    public array $query = [];

    // after the hashmark #
    public string $fragment = '';

    public string $initialUrl = '';

    public array $blackList = [];

    public array $whiteList = [];

    public function __construct(string $url)
    {
        $this->initialUrl = trim($url);

        $parsed = parse_url($this->initialUrl);
        $this->scheme = $parsed['scheme'];
        $this->host = $parsed['host'];

        if (isset($parsed['path'])) {
            $this->path = $parsed['path'];
        }

        if (isset($parsed['query'])) {
            $query = [];
            $params = [];

            parse_str($parsed['query'], $query);
            $blacklist = $this->getBlackList();
            $whitelist = $this->getWhiteList();
            foreach ($query as $key => $value) {
                if (in_array($key, $whitelist)) {
                    $params[$key] = $value;
                    continue;
                }
                // Skip over keys in the blacklist.
                if (in_array($key, $blacklist)) {
                    continue;
                }

                // @TODO: Let the user add their own processing here
                $params[$key] = $value;
            }

            $this->query = $params;
        }
    }

    public function __toString(): string
    {
        return $this->str();
    }


    /**
     * For the Blacklist.
     *
     * These UTM(Urchin Tracking Module) parameters provide too much tracking information. They
     * also clutter the URL.
     */
    public function getUtmParameters(): array
    {
        return [
            'utm_content',
            'utm_medium',
            'utm_source',
            'utm_campaign',
            'utm_term',
        ];
    }

    /**
     * For the Blacklist.
     *
     * These LinkedIn parameters provide too much tracking information. They
     * also clutter the URL.
     */
    public function getLinkedInParameters(): array
    {
        return [
            'eid',
            'trk',
            'trkEmail',
            'trackingId',
            'midSig',
            'midToken',
            'otpToken',
            'refId',
            'lipi',
        ];
    }

    /**
     * For the Whitelist.
     *
     * These parameters provide location information. They are needed for GIS
     * applications.
     */
    public function getGeoParameters(): array
    {
        return [
            'lat',
            'latitude',
            'long',
            'longitude',
        ];
    }

    public function getBlackList(): array
    {
        return [
            ...$this->getUtmParameters(),
            ...$this->getLinkedInParameters()
        ];
    }

    public function getWhiteList(): array
    {
        return $this->getGeoParameters();
    }

    public function str() : string
    {
        $paramString = '';
        if (http_build_query($this->query)) {
            $paramString = '?' . http_build_query($this->query);
        }

        return $this->scheme . '://' . $this->host . $this->path  . $paramString;
    }
}
