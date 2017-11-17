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
    protected $logic;

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

    public function getLogic () : EsiLogic
    {
        return $this->logic;
    }

    /**
     * @param string $classname
     *
     * @return $this|null
     */
    public function findLogicNode (string $classname)
    {
        if ($this->logic instanceof $classname)
            return $this;
        foreach ($this->children as $child) {
            if ( ! $child instanceof TagNode)
                continue;
            $ret = $child->findLogicNode($classname);
            if ($ret !== null)
                return $ret;
        }
        return null;
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

    public function renderNodeContent (RenderEnv $renderEnv)
    {
        foreach ($this->children as $child) {
            if ($child instanceof TextNode) {
                $renderEnv->getOutputBuffer()->append($child->getText());
                continue;
            }
            if ($child instanceof TagNode) {
                $child->_renderNode($renderEnv);
                continue;
            }
        }
    }

    public function getTextContent() : string
    {
        $content = "";
        foreach ($this->getChildren() as $child)
            if ($child instanceof TextNode)
                $content .= $child->getText();
        return $content;
    }

    public function _renderNode(RenderEnv $renderEnv)
    {
        $this->logic->runLogic(
            $this,
            $renderEnv
        );
    }

}