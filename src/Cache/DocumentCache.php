<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 17:33
 */

namespace Esi\Cache;

use Esi\Template\DocumentNode;

interface DocumentCache
{

    public function hasDocument ($uri) : bool;

    public function setDocument ($uri, DocumentNode $document);

    public function getDocument ($uri) : DocumentNode;


}