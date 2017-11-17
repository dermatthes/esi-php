<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 14.11.17
 * Time: 15:57
 */

namespace Esi\Template;


use Esi\Parser\EsiContext;

class RenderEnv
{

    /**
     * @var OutputBuffer
     */
    private $outputBuffer;

    /**
     * @var DocumentNode
     */
    private $documentNode;

    /**
     * @var VarScope
     */
    private $varScope;

    /**
     * @var EsiContext
     */
    private $esiContext;

    public function __construct(EsiContext $esiContext, VarScope $varScope)
    {
        $this->outputBuffer = new DefaultOutputBuffer();
        $this->esiContext = $esiContext;
        $this->varScope = $varScope;
    }

    public function cloneFor (DocumentNode $documentNode) : self
    {
        $new = clone $this;
        $new->outputBuffer = $this->outputBuffer->getOriginal();
        $new->documentNode = $documentNode;
        $new->varScope = $this->varScope; // CLONE!
        return $new;
    }

    /**
     * @return OutputBuffer
     */
    public function getOutputBuffer(): OutputBuffer
    {
        return $this->outputBuffer;
    }

    /**
     * @param OutputBuffer $outputBuffer
     */
    public function setOutputBuffer(OutputBuffer $outputBuffer)
    {
        $this->outputBuffer = $outputBuffer;
    }

    /**
     * @return DocumentNode
     */
    public function getDocumentNode() : DocumentNode
    {
        return $this->documentNode;
    }

    /**
     * @return VarScope
     */
    public function getVarScope(): VarScope
    {
        return $this->varScope;
    }

    /**
     * @return EsiContext
     */
    public function getEsiContext(): EsiContext
    {
        return $this->esiContext;
    }


}