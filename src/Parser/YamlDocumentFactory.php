<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 23.11.17
 * Time: 10:51
 */

namespace Esi\Parser;


use Esi\Template\DocumentNode;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TemplateEnv;
use EYAML\EYAML;
use Symfony\Component\Yaml\Yaml;

class YamlDocumentFactory implements DocumentFactory
{

    public function buildDocument(
        TemplateEnv $templateEnv,
        EsiContext $esiContext
    ): DocumentNode {
        $data = $esiContext->fileAccessor->getContents($templateEnv->_DOC_URI);

        $docFactory = new EsiDocumentFactory();
        $docNode = $docFactory->buildDocument($templateEnv, $esiContext, EYAML::Parse($data));

        return $docNode;
    }
}