<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/8/17
 * Time: 1:06 AM
 */

namespace Esi\Asset;


interface AssetResolver
{

    /**
     *
     *
     * @param string $path
     * @param string $revision
     * @return string
     */
    public function register (string $path, string $revision) : string;

    public function resolve (string $hash) : string;

}