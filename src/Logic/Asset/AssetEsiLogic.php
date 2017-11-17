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
        $content = "";
        foreach ($myTagNode->getChildren() as $child) {
            if ( ! $child instanceof TextNode)
                continue;
            $content .= $child->getText();
        }
        $templateEnv = $renderEnv->getDocumentNode()->getTemplateEnv();

        if ($this->absolute) {
            $prefix = Path::Use($templateEnv->_ORIG_REQ_PATH . "/" . $templateEnv->_DOC_PATH)->resolve()->toAbsolute();
        } else {
            $prefix = Path::Use($templateEnv->_DOC_PATH)->resolve()->toRelative();
        }

        $content = preg_replace_callback(
            '/(src|href)=(\"|\')(.*?)\2/im',
            function ($matches) use ($prefix) {
                $src = $matches[3];

                if (substr($src, 0 , 1) !== "/")
                    $src = Path::Use($prefix  . "/" . $src)->resolve();
                    if ($this->absolute) {
                        $src = $src->toAbsolute();
                    } else {
                        $src = $src->toRelative();
                    }

                return $matches[1] . "=" . $matches[2] . $src . $matches[2];
            },
            $content
        );
        $renderEnv->getOutputBuffer()->append($content);
    }
}