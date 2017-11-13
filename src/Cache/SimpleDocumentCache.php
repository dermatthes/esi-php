<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 17:35
 */

namespace Esi\Cache;


use Esi\Template\DocumentNode;

class SimpleDocumentCache implements DocumentCache
{

    private $documents = [];

    public function hasDocument($uri): bool
    {
        return isset ($this->documents[$uri]);
    }

    public function setDocument($uri, DocumentNode $document)
    {
        $this->documents[$uri] = $document;
    }

    public function getDocument($uri): DocumentNode
    {
        return $this->documents[$uri];
    }
}