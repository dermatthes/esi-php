<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:20 PM
 */

namespace Esi\Template;


use Esi\Logic\Asset\RelativePathOutputFilter;
use Esi\Logic\Content\DefaultDocumentLogic;
use Esi\Logic\EsiLogic;

class DocumentNode extends TagNode
{

    private $templateEnv;



    public function __construct(TemplateEnv $templateEnv)
    {
        $this->templateEnv = $templateEnv;
        $this->setLogic(new DefaultDocumentLogic());
        parent::__construct(null);
    }

    public function getTemplateEnv () : TemplateEnv
    {
        return $this->templateEnv;
    }


    public function _renderNode(RenderEnv $env)
    {
        throw new \Exception("Calling _renderNode() on Document.");
    }

    public function renderDocument (RenderEnv $env)
    {
        $renderEnv = $env->cloneFor($this);

        // Make Paths absolute
        $renderEnv->setOutputBuffer(
            new RelativePathOutputFilter(
                $renderEnv->getOutputBuffer()->getOriginal(),
                $this->templateEnv,
                true
            )
        );
        $this->logic->runLogic($this, $renderEnv);
    }

}