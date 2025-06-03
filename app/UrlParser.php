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

        if (isset($parsed['query'])) {
            $query = [];
            $params = [];

            parse_str($parsed['query'], $query);
            $blacklist = $this->getBlackList();
            foreach ($query as $key => $value) {
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

    public function getBlackList(): array
    {
        return $this->getUtmParameters();
    }
}
