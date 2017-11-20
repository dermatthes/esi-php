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
use Esi\Template\DefaultOutputBuffer;
use Esi\Template\RenderEnv;
use Esi\Template\TemplateEnv;
use Esi\Template\VarScope;


require __DIR__."/../../../vendor/autoload.php";



\Tester\Environment::setup();


$esiContext = new EsiContext(new LocalFileAccessor(__DIR__));

$doc = $esiContext->buildTemplate(TemplateEnv::Build("page.md"));
print_r($doc);

$renderEnvironment = new RenderEnv($esiContext, new VarScope());

$doc->renderDocument($renderEnvironment);

echo $renderEnvironment->getOutputBuffer()->getContents();