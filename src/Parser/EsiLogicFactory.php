<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 15:10
 */

namespace Esi\Parser;


use Esi\Logic\Access\IncludeLogic;
use Esi\Logic\Asset\AssetEsiLogic;
use Esi\Logic\EsiBuildLogic;
use Esi\Logic\EsiLogic;
use Esi\Logic\Markdown\MarkdownLogic;
use Esi\Logic\Structural\ContentLogic;
use Esi\Logic\Structural\ExtendsLogic;
use Esi\Logic\Yaml\YamlLogic;
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
        $this->register(new AssetEsiLogic());
        $this->register(new MarkdownLogic());
        $this->register(new YamlLogic());
    }

    public function register (EsiLogic $logic)
    {
        $this->logicMap[$logic->getResponsibleName()] = $logic;
    }

    /**
     * @param Tag          $tag
     * @param EsiNode      $parent
     * @param DocumentNode $document
     *
     * @return EsiLogic | EsiBuildLogic
     * @throws \Exception
     */
    public function buildLogic (Tag $tag, EsiNode $parent, DocumentNode $document) : EsiLogic
    {
        if ( ! isset ($this->logicMap[$tag->getName()]))
            throw new \Exception("Unknown Tag: $tag");
        $newLogic = new $this->logicMap[$tag->getName()];
        if ( ! $newLogic instanceof EsiLogic)
            throw new \Exception("This is not EsiLogic");
        $newLogic->onBeginBuild($tag, $parent, $document);
        return $newLogic;

    }

}