<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 18:37
 */

namespace Esi\Logic;


use Esi\Parser\EsiContext;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Node;
use Esi\Template\OutputBuffer;
use Esi\Template\Tag;
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
        DocumentNode $documentNode,
        Node $parentNode
    ) {
        $this->src = $tag->getAttributes()["src"];
    }

    public function runLogic(
        VarScope $scope,
        OutputBuffer $ob,
        EsiNode $myNode,
        EsiNode $parentNode,
        DocumentNode $document,
        EsiContext $esiContext
    ) {
        $scope->setSlot(null, new DeferredSlot(function () use ($ob, $myNode) {
            foreach ($curNode as $) {

            }
        }));
    }
}