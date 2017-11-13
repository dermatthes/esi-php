<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 10:06
 */

namespace Esi\Logic;


use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\OutputBuffer;
use Esi\Template\Node;
use Esi\Template\Tag;
use Esi\Template\VarScope;

interface EsiLogic
{

    public function getResponsibleName() : string;

    public function build (Tag $tag, DocumentNode $documentNode, Node $parentNode);

    public function runLogic (VarScope $scope, OutputBuffer $ob, EsiNode $myNode, EsiNode $parentNode, DocumentNode $document);

}