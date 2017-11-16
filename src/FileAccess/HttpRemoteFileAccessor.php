<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 15.11.17
 * Time: 18:13
 */

namespace Esi\FileAccess;


class HttpRemoteFileAccessor implements FileAccessor
{

    private $rootUrl;

    private $headers = [];

    /**
     * @var \Requests_Response
     */
    private $lastResponse;

    public function __construct(string $rootUrl)
    {
        $this->rootUrl = $rootUrl;
    }


    public function setHeader ($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * @return \Requests_Response
     */
    public function getLastResponse ()
    {
        return $this->lastResponse;
    }


    public function getContents(string $url) : string
    {
        if ( !  (strpos($url, "http://") === 0 || strpos($url, "https://") === 0)) {
            $url = $this->rootUrl . $url;
        }

        $response = \Requests::get($url, $this->headers);
        $this->lastResponse = $response;
        $response->throw_for_status();
        return $response->body;
    }

}