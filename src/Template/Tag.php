<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 15:53
 */

namespace Esi\Template;


class Tag
{

    private $fileName;
    private $name;
    private $attributes;
    private $isEmpty;
    private $ns;
    private $lineNo;

    public function __construct (string $name, array $attributes, $isEmpty, $ns = null, int $lineNo, string $fileName=null)
    {
        $this->fileName = $fileName;
        $this->name = $name;
        $this->attributes = $attributes;
        $this->isEmpty = $isEmpty;
        $this->ns = $ns;
        $this->lineNo = $lineNo;
    }

    public function __toString()
    {
        return "<{$this->ns}:{$this->name} ...>[Line:{$this->lineNo}]";
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getisEmpty()
    {
        return $this->isEmpty;
    }

    /**
     * @return mixed
     */
    public function getNs()
    {
        return $this->ns;
    }

    /**
     * @return mixed
     */
    public function getLineNo()
    {
        return $this->lineNo;
    }
}