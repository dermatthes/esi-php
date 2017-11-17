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

    public function build(
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

        $oldOb = $renderEnv->getOutputBuffer();
        $newOb = new AssetEsiDefaultOutputFilter($renderEnv->getOutputBuffer(), $renderEnv->getDocumentNode()->getTemplateEnv(), $this->absolute);
        $renderEnv->setOutputBuffer($newOb);

        try {
            foreach ($myTagNode->getChildren() as $child) {
                if ($child instanceof TextNode) {
                    $newOb->append($child->getText());
                    continue;
                }
                if ($child instanceof TagNode) {
                    $child->_renderNode($renderEnv);
                    continue;
                }
            }
        } catch (\Exception $e) {
            $renderEnv->setOutputBuffer($oldOb);
            throw $e;
        }
        $renderEnv->setOutputBuffer($oldOb);
    }
}