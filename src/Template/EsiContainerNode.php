<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:22 PM
 */

namespace Esi\Template;


class EsiContainerNode implements TemplateNode
{

    private $children = [];

    public function append (TemplateNode $node) {
        $this->nodes[] = $node;
    }

}