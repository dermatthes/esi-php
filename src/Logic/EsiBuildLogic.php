<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 09.01.18
 * Time: 12:22
 */

namespace Esi\Logic;


use Esi\Parser\EsiContext;
use Esi\Parser\EsiHtmlParserCallback;
use Esi\Template\DocumentNode;
use Esi\Template\Node;

interface EsiBuildLogic extends EsiLogic
{

    public function onEndBuild(Node $thisNode, Node $parentNode, EsiContext $esiContext, DocumentNode $documentNode);

}