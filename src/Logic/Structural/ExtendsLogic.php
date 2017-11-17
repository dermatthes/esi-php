<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 18:37
 */

namespace Esi\Logic\Structural;


use Esi\Logic\EsiLogic;
use Esi\Parser\EsiContext;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Node;
use Esi\Template\DefaultOutputBuffer;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\VarScope;


/**
 * Class ExtendsLogic
 *
 * Extends another template and renders the own data
 * inside the other template.
 *
 * @package Esi\Logic
 */
class ExtendsLogic implements EsiLogic
{

    public function getResponsibleName(): string
    {
        return "extends";
    }

    public $src;

    public function build(
        Tag $tag,
        Node $parentNode,
        DocumentNode $documentNode
    ) {
        $this->src = $tag->getAttributes()["src"];

        $documentNode->setLogic(new ExtendsLogicDocumentLogic());
    }


    public function runLogic(
        TagNode $myTagNode,
        RenderEnv $renderEnv
    ) {
        $extendedDocumentTemplateEnv = $renderEnv->getDocumentNode()->getTemplateEnv()->newEnv($this->src);
        $extendedDocument = $renderEnv->getEsiContext()->buildTemplate($extendedDocumentTemplateEnv);

        $contentLogicNode = $extendedDocument->findLogicNode(ContentLogic::class);
        if ($contentLogicNode === null) {
            throw new \Exception("No ESI-Content <esi:content/> defined in {$extendedDocumentTemplateEnv->_DOC_URI} (Extended by {$renderEnv->getDocumentNode()->getTemplateEnv()->_DOC_URI}");
        }
        $contentLogic = $contentLogicNode->getLogic();
        if ( ! $contentLogic instanceof ContentLogic)
            throw new \Exception("Internal error: Wrong node selected");

        // Generate a new Document without body
        $pushDocument = new DocumentNode($renderEnv->getDocumentNode()->getTemplateEnv());
        foreach ($myTagNode->getChildren() as $child)
            $pushDocument->append($child);

        // Set this generated Document as callback
        $contentLogic->setExtendedDocument($pushDocument, $renderEnv);

        // Render the parent Document
        $extendedDocument->renderDocument($renderEnv);
    }
}