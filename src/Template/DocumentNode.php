<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:20 PM
 */

namespace Esi\Template;


class DocumentNode extends TagNode
{

    private $templateEnv;

    public function __construct(TemplateEnv $templateEnv)
    {
        $this->templateEnv = $templateEnv;
        parent::__construct(null);
    }

    public function getTemplateEnv () : TemplateEnv
    {
        return $this->templateEnv;
    }


    protected function _renderNode(RenderEnv $env)
    {
        throw new \Exception("Calling _renderNode() on Document.");
    }

    public function renderDocument (RenderEnv $env)
    {
        $renderEnv = $env->cloneFor($this);

        foreach ($this->getChildren() as $curChild) {
            if ($curChild instanceof TextNode) {
                $renderEnv->getOutputBuffer()->append($curChild->getText());
                continue;
            }
            if ($curChild instanceof TagNode) {
                $curChild->_renderNode($renderEnv);
            }
        }
    }

}