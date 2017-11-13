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
        $this->uri = $templateEnv;
        parent::__construct(null);
    }

    public function getTemplateEnv () : TemplateEnv
    {
        return $this->templateEnv;
    }


    public function render (VarScope $scope, OutputBuffer $ob = null)
    {
        if ($ob === null) {
            $ob = new OutputBuffer();
        }
        foreach ($this->getChildren() as $curChild) {
            if ($curChild instanceof TextNode) {
                $ob->append($curChild->getText());
                continue;
            }
            if ($curChild instanceof TagNode) {
                $curChild->render($scope, $ob);
            }
        }
    }

}