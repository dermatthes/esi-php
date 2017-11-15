<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 15:10
 */

namespace Esi\Parser;


use Esi\Logic\Access\IncludeLogic;
use Esi\Logic\EsiLogic;
use Esi\Logic\Structural\ContentLogic;
use Esi\Logic\Structural\ExtendsLogic;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Tag;

class EsiLogicFactory
{

    private $logicMap = [];

    public function __construct()
    {
        $this->register(new IncludeLogic());
        $this->register(new ExtendsLogic());
        $this->register(new ContentLogic());
    }

    public function register (EsiLogic $logic)
    {
        $this->logicMap[$logic->getResponsibleName()] = $logic;
    }

    public function buildLogic (Tag $tag, EsiNode $parent, DocumentNode $document) : EsiLogic
    {
        if ( ! isset ($this->logicMap[$tag->getName()]))
            throw new \Exception("Unknown Tag: $tag");
        $newLogic = new $this->logicMap[$tag->getName()];
        if ( ! $newLogic instanceof EsiLogic)
            throw new \Exception("This is not EsiLogic");
        $newLogic->build($tag, $parent, $document);
        return $newLogic;

    }

}