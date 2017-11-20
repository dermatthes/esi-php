<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 20.11.17
 * Time: 10:19
 */

namespace Esi\Parser;


use Esi\FileAccess\FileAccessor;
use Esi\Template\DocumentNode;
use Esi\Template\TemplateEnv;

interface DocumentFactory
{

    public function buildDocument(TemplateEnv $templateEnv, EsiContext $esiContext) : DocumentNode;
}