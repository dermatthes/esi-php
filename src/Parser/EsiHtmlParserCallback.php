<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:46 PM
 */

namespace Esi\Parser;



use Esi\Template\DocumentNode;
use Esi\Template\TagNode;
use Esi\Template\EsiNode;
use Esi\Template\Tag;
use Esi\Template\TextNode;
use HTML5\Tokenizer\HtmlCallback;

class EsiHtmlParserCallback implements HtmlCallback
{

    /**
     * @var DocumentNode
     */
    private $documentNode;

    /**
     * @var EsiNode
     */
    private $currentNode;

    /**
     * @var EsiNode[]
     */
    private $parentNodes = [];

    /**
     * @var TextNode
     */
    private $curTextNode;

    /**
     * @var EsiLogicFactory
     */
    private $logicFactory;

    public function __construct(EsiLogicFactory $logicFactory)
    {
        $this->logicFactory = $logicFactory;
        $this->documentNode = new DocumentNode();
        $this->currentNode = $this->documentNode;
        $this->parentNodes[] = $this->documentNode;
        $this->curTextNode = new TextNode();
    }


    public function onWhitespace(string $ws, int $lineNo)
    {
        $this->curTextNode->addText($ws);
    }

    public function onTagOpen(string $name, array $attributes, $isEmpty, $ns = null, int $lineNo)
    {
        $this->currentNode->append($this->curTextNode);
        $this->curTextNode = new TextNode();


        $tag = new Tag($name, $attributes, $isEmpty, $ns, $lineNo);
        if ($isEmpty) {
            $node = new TagNode($tag);
        } else {
            $parentNode = $this->currentNode;
            $this->parentNodes[]
                = $this->currentNode = $node = new TagNode($tag);
        }
        $node->setLogic($this->logicFactory->build($tag, $parentNode, $this->documentNode));
        $parentNode->append($node);
    }

    public function onText(string $text, int $lineNo)
    {
        $this->curTextNode->addText($text);
    }

    public function onTagClose(string $name, $ns = null, int $lineNo)
    {
        $this->no
    }

    public function onProcessingInstruction(string $data, int $lineNo)
    {
        $this->curTextNode->addText($data);
    }

    public function onComment(string $data, int $lineNo)
    {
        $this->curTextNode->addText($data);
    }
}