<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 20.11.17
 * Time: 10:44
 */

namespace Esi\Parser;


use Esi\Template\DocumentNode;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TemplateEnv;
use Esi\Template\TextNode;
use Symfony\Component\Yaml\Yaml;

class MarkdownDocumentFactory implements DocumentFactory
{

    private function extractHeaderBody (string $input)
    {
        $input = str_replace("\n\r", "\n", $input);

        $header = [];
        $body = [];
        $lines = explode("\n", $input);
        $onHeader = true;
        for ($i=1; $i<count ($lines); $i++) {
            if ( ! $onHeader) {
                $body[] = $lines[$i];
                continue;
            }
            if (rtrim($lines[$i]) === "---") {
                $onHeader = false;
                continue;
            }
            $header[] = $lines[$i];
        }

        return [
            implode("\n", $header),
            implode("\n", $body)
        ];
    }


    public function buildDocument(
        TemplateEnv $templateEnv,
        EsiContext $esiContext
    ): DocumentNode {
        $data = $esiContext->fileAccessor->getContents($templateEnv->_DOC_URI);

        $headerData = [];

        if (substr($data, 0, 4) == "---\n") {
            list ($header, $body) = $this->extractHeaderBody($data);
            $headerData = Yaml::parse($header);
        } else {
            $body = $data;
        }


        $curNode = $docNode = new DocumentNode($templateEnv);
        if (isset ($headerData["extends"])) {
            $docNode->append(
                $curNode = $extendsNode = new TagNode(
                    $tag = new Tag("extends", ["src" => $headerData["extends"]], false, "esi", 0)
                )
            );
            $extendsNode->setLogic($esiContext->logicFactory->buildLogic($tag, $docNode, $docNode));
        }

        $curNode->append(
            $mdNode = new TagNode($tag = new Tag("markdown", [], false, "esi", 0))
        );
        $mdNode->append($tn = new TextNode());
        $tn->addText($body);

        $mdNode->setLogic($esiContext->logicFactory->buildLogic($tag, $curNode, $docNode));

        return $docNode;
    }
}