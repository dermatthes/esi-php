<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 15.11.17
 * Time: 18:13
 */

namespace Esi\FileAccess;


class HttpRemoteFileAccessor
{

    private $rootUrl;

    private $headers = [];

    public function __construct(string $rootUrl)
    {
        $this->rootUrl = $rootUrl;
    }


    public function setHeader ($name, $value)
    {
        $this->headers[$name] = $value;
    }


    public function getContents($path)
    {
        if ( !  (strpos($path, "http://") === 0 || strpos($path, "https://") === 0)) {
            $path = $this->rootUrl . $path;
        }

        $response = \Requests::get($path, $this->headers);
        $response->throw_for_status();
        return $response->body;
    }

}