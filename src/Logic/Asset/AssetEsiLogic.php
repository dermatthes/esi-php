<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 17.11.17
 * Time: 10:49
 */

namespace Esi\Logic\Asset;


use Esi\Logic\EsiLogic;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TextNode;
use Phore\File\Path;

class AssetEsiLogic implements EsiLogic
{

    private $absolute = false;

    public function getResponsibleName(): string
    {
        return "asset";
    }

    public function onBeginBuild(
        Tag $tag,
        Node $parentNode,
        DocumentNode $documentNode
    ) {
        if (isset ($tag->getAttributes()["absolute"]))
            if (strtoupper($tag->getAttributes()["absolute"]) == "YES")
                $this->absolute = true;
    }

    public function runLogic(
        TagNode $myTagNode,
        RenderEnv $renderEnv
    ) {


    }
}