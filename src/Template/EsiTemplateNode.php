<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 08.11.17
 * Time: 18:20
 */

namespace Esi\Template;


interface EsiTemplateNode extends TemplateNode
{

    public function build(string $name, array $attributes, $isEmpty, $ns = null, int $lineNo, EsiTemplateNode $parentNode, DocumentNode $document);

    public function render(VarScope $scope, OutputBuffer $ob);

}