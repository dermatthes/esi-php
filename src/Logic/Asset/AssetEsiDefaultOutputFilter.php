<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 17.11.17
 * Time: 13:59
 */

namespace Esi\Logic\Asset;


use Esi\Template\DefaultOutputBuffer;
use Esi\Template\OutputBuffer;
use Esi\Template\TemplateEnv;

class AssetEsiDefaultOutputFilter implements OutputBuffer
{
    /**
     * @var OutputBuffer
     */
    private $parentBuffer;

    /**
     * @var TemplateEnv
     */
    private $templateEnv;

    private $makeAbsolute;

    public function __construct(OutputBuffer $buffer, TemplateEnv $templateEnv, bool $makeAbsolute)
    {
        $this->parentBuffer = $buffer;
        $this->templateEnv = $templateEnv;
        $this->makeAbsolute = $makeAbsolute;
    }

    public function append(string $text)
    {
        $text = preg_replace_callback(
            '/(src|href)=(\"|\')(.*?)\2/im',
            function ($matches) {
                $src = $matches[3];
                $src = $this->templateEnv->getPath($src, $this->makeAbsolute);
                return $matches[1] . "=" . $matches[2] . $src . $matches[2];
            },
            $text
        );

        $this->parentBuffer->append($text);
    }

    public function flush()
    {
        $this->parentBuffer->flush();
    }

    public function getContents(): string
    {
        return $this->parentBuffer->getContents();
    }

}