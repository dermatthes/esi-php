<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 10:06
 */

namespace Esi\Logic;


use Esi\Parser\EsiContext;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\DefaultOutputBuffer;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\VarScope;

interface EsiLogic
{

    public function getResponsibleName() : string;

    public function onBeginBuild (Tag $tag, Node $parentNode, DocumentNode $documentNode);



    public function runLogic (
        TagNode $myTagNode,
        RenderEnv $renderEnv
    );



}