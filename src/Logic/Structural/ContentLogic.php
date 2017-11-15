<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 15.11.17
 * Time: 12:57
 */

namespace Esi\Logic\Structural;


use Esi\Logic\EsiLogic;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TextNode;

class ContentLogic implements EsiLogic
{

    /**
     * @var DocumentNode|null
     */
    private $extendedDocument = null;
    private $extendedRenderEvn = null;

    public function getResponsibleName(): string
    {
        return "content";
    }

    public function setExtendedDocument (DocumentNode $extendedDocument, RenderEnv $env)
    {
        if ($this->extendedDocument !== null)
            throw new \Exception("Possible recursion in {$extendedDocument->getTemplateEnv()->_DOC_URI}");
        $this->extendedDocument = $extendedDocument;
        $this->extendedRenderEvn = $env;
    }


    public function build(
        Tag $tag,
        Node $parentNode,
        DocumentNode $documentNode
    ) {
    }

    public function runLogic(
        TagNode $myTagNode,
        RenderEnv $renderEnv
    ) {
        if ($this->extendedDocument !== null) {
            $this->extendedDocument->renderDocument($this->extendedRenderEvn);
            return;
        }

        // Render the original content if document was not extended
        $myTagNode->renderNodeContent($renderEnv);
    }
}