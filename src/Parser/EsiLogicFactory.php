<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 15:10
 */

namespace Esi\Parser;


use Esi\Logic\EsiLogic;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Tag;

class EsiLogicFactory
{

    private $logicMap = [];

    public function __construct()
    {
        $this->register();
    }

    public function register (EsiLogic $logic)
    {
        $this->logicMap[$logic->getResponsibleName()] = $logic;
    }

    public function build (Tag $tag, EsiNode $parent=null, DocumentNode $document) : EsiLogic
    {
        if ( ! isset ($this->logicMap[$tag->getName()]))
            throw new \Exception("Unknown Tag: $tag");
        return clone $this->logicMap[$tag->getName()];

    }

}