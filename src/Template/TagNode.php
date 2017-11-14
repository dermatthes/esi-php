<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:22 PM
 */

namespace Esi\Template;


use Esi\Logic\EsiLogic;

class TagNode implements EsiNode
{

    /**
     * @var Tag
     */
    private $tag;

    /**
     * @var EsiLogic
     */
    private $logic;

    /**
     * @var Node[]
     */
    private $children = [];


    public function __construct(Tag $tag=null)
    {
        $this->tag = $tag;
    }

    public function getTag () : Tag
    {
        return $this->tag;
    }


    public function setLogic (EsiLogic $logic)
    {
        $this->logic = $logic;
    }

    /**
     * @return Node[]
     */
    public function getChildren () : array
    {
        return $this->children;
    }

    public function append (Node $node) {
        $this->children[] = $node;
    }

    public function render(VarScope $scope, OutputBuffer $ob = null)
    {
        // TODO: Implement render() method.
    }

}