<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 17.11.17
 * Time: 14:26
 */

namespace Esi\Logic\Yaml;


use Esi\Template\DocumentNode;
use Esi\Template\TemplateEnv;

/**
 * Class MarkdownDocument
 *
 * @package Esi\Logic\Markdown
 * @deprecated
 */
class YamlDocument extends DocumentNode
{

    public function __construct(TemplateEnv $templateEnv)
    {
        parent::__construct($templateEnv);
    }

}