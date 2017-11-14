<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:28 PM
 */

namespace Esi\Template;


use Esi\Logic\DeferredSlot;

class VarScope
{

    const DEFAULT_SLOT = "__SLOT_MAIN";

    private $slots = [];
    private $params = [];
    private $local = [];

    public function getSlot(string $name=self::DEFAULT_SLOT) : DeferredSlot
    {
        if ( ! isset ($this->slots[$name]))
            return null;
        return $this->slots[$name];
    }

    public function setSlot(string $name=self::DEFAULT_SLOT, DeferredSlot $value)
    {
        $this->slots[$name] = $value;
    }

    public function unsetSlot (string $name=self::DEFAULT_SLOT)
    {
        unset ($this->slots[$name]);
    }


}