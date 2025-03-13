<?php

namespace App;

/**
 * Build a URL as a string easily.
 */
class UrlStr
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param mixed $data
     *   associate array that matches output of parse_url function.
     *
     */
    public static function fromParseUrl($data = []): string {
        // Assume the structure of the associative array
        // matches the output of the parse_url() function
        // that PHP provides.
        $output = '';
        if (isset($data['scheme'])) {
            $output .= $data['scheme'] . '://' ;
        }

        if (isset($data['host'])) {
            $output .= $data['host'];
        }

        return $output;
    }

    public function getBlacklist() {
        return [
            'utm_content',
            'utm_medium',
            'utm_source',
            'utm_campaign',
            'utm_term',
        ];
    }

    public function getWhitelist() {
        return [
            'lat',
            'latitude',
            'long',
            'longitude',
        ];
    }
}
