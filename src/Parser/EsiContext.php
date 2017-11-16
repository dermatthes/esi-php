<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 08.11.17
 * Time: 18:43
 */

namespace Esi\Parser;


use Esi\Cache\SimpleDocumentCache;
use Esi\FileAccess\FileAccessor;
use Esi\FileAccess\LocalFileAccessor;
use Esi\Template\DocumentNode;
use Esi\Template\TemplateEnv;
use HTML5\HTMLReader;

class EsiContext
{

    public $logicFactory;
    public $fileAccessor;
    public $documentCache;


    public $htmlReader;

    public function __construct(FileAccessor $fileAccessor)
    {
        $this->logicFactory = new EsiLogicFactory();
        $this->fileAccessor = $fileAccessor;
        $this->documentCache = new SimpleDocumentCache();
        $this->htmlReader = new HTMLReader();

    }


    private function _buildDocument (TemplateEnv $env) : DocumentNode
    {
        $documentNode = new DocumentNode($env);
        $data = $this->fileAccessor->getContents($env->_DOC_URI);
        $parser = new HTMLReader([
            "parseProcessingInstruction" => false,
            "parseComment" => false,
            "parseOverTags" => ["esi:comment", "esi:markdown"],
            "parseOnlyTagPrefix" => "esi:"
        ]);
        $parser->setHandler(new EsiHtmlParserCallback($this->logicFactory, $documentNode));
        $parser->loadHtmlString($data);
        $parser->parse();
        return $documentNode;
    }


    public function buildTemplate (TemplateEnv $env) {
        if ( ! $this->documentCache->hasDocument($env->_DOC_URI))
            $this->documentCache->setDocument($env->_DOC_URI, $this->_buildDocument($env));
        return $this->documentCache->getDocument($env->_DOC_URI);
    }

}