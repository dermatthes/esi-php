<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 08.11.17
 * Time: 18:20
 */

namespace Esi\Template;


interface EsiNode extends Node
{

    /**
     * @return EsiNode[]|Node[]
     */
    public function getChildren () : array;

}