<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 17:10
 */

namespace Esi;
use Esi\FileAccess\LocalFileAccessor;
use Esi\Parser\EsiContext;
use Esi\Template\TemplateEnv;


require __DIR__ . "/../../vendor/autoload.php";



\Tester\Environment::setup();


$context = new EsiContext(new LocalFileAccessor(__DIR__ . "/"));

$doc = $context->render(TemplateEnv::Build("01_include/page.html"));
print_r($doc);