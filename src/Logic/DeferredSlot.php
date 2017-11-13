<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 18:47
 */

namespace Esi\Logic;


use Esi\Template\OutputBuffer;

class DeferredSlot
{

    private $callback;

    public function __construct(callable $fn)
    {
        $this->callback = $fn;
    }

    public function resolve()
    {
        ($this->callback)();
    }

}