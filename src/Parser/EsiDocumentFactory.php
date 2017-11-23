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
use HTML5\HTMLReader;

class EsiDocumentFactory implements DocumentFactory
{

    public function buildDocument(TemplateEnv $templateEnv, EsiContext $esiContext, string $content=null): DocumentNode
    {
        $documentNode = new DocumentNode($templateEnv);

        $data = $content;
        if ($content === null)
            $data = $esiContext->fileAccessor->getContents($templateEnv->_DOC_URI);

        $parser = new HTMLReader([
            "parseProcessingInstruction" => false,
            "parseComment" => false,
            "parseOverTags" => ["esi:comment", "esi:markdown"],
            "parseOnlyTagPrefix" => "esi:"
        ]);
        $parser->setHandler(new EsiHtmlParserCallback($esiContext->logicFactory, $documentNode));
        $parser->loadHtmlString($data);
        $parser->parse();
        return $documentNode;
    }
}