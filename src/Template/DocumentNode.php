<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:20 PM
 */

namespace Esi\Template;


class DocumentNode
{




    public function __construct($uri)
    {
    }


    public function render (VarScope $scope, OutputBuffer $ob = null)
    {
        if ($ob === null) {
            $ob = new OutputBuffer();
        }

    }

}