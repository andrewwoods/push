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
    public string $query = '';

    // after the hashmark #
    public string $fragment = '';

    public string $initialUrl = '';

    public function __construct(string $url)
    {
        $this->initialUrl = trim($url);

        $parsed = parse_url($this->initialUrl);
        $this->scheme = $parsed['scheme'];
        $this->host = $parsed['host'];
        if (isset($parsed['path'])) {
            var_dump($parsed['path']);
            $this->path = $parsed['path'];
        }
    }

    public function __toString(): string
    {
        return $this->scheme . '://' . $this->host . $this->path  . $this->query;
    }

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
}
