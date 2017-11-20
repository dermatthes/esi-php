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


    /**
     * @var DocumentFactory[]
     */
    public $fileExtensionToDocumentFactory = [];
    /**
     * @var DocumentFactory[]
     */
    public $documentFactories = [];

    public function __construct(FileAccessor $fileAccessor)
    {
        $this->logicFactory = new EsiLogicFactory();
        $this->fileAccessor = $fileAccessor;
        $this->documentCache = new SimpleDocumentCache();
        $this->htmlReader = new HTMLReader();

        $this->addDocumentFactory(new EsiDocumentFactory(), ["html", "htm", "php"]);
        $this->addDocumentFactory(new MarkdownDocumentFactory(), ["md"]);
    }


    public function addDocumentFactory(DocumentFactory $documentFactory, array $extensions)
    {
        $this->documentFactories[get_class($documentFactory)] = $documentFactory;
        foreach ($extensions as $extension) {
            $this->fileExtensionToDocumentFactory[$extension] = $documentFactory;
        }
    }


    private function _buildDocument (TemplateEnv $env) : DocumentNode
    {
        return $this->fileExtensionToDocumentFactory[$env->_DOC_EXTENSION]->buildDocument($env, $this);
    }


    public function isAwareOf (string $extension) : bool
    {
        return isset ($this->fileExtensionToDocumentFactory[$extension]);
    }



    public function buildTemplate (TemplateEnv $env) {
        if ( ! $this->documentCache->hasDocument($env->_DOC_URI)) {
            $this->documentCache->setDocument($env->_DOC_URI, $this->_buildDocument($env));
        }

        return $this->documentCache->getDocument($env->_DOC_URI);
    }

}