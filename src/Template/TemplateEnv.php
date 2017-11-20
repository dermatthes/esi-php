<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 17:07
 */

namespace Esi\Template;


use Phore\File\Path;

class TemplateEnv
{

    public $_SELF;

    public $_ORIG_REQ_URL;
    public $_ORIG_REQ_URI;
    public $_ORIG_REQ_PATH;

    public $_ORIG_DOC_BASENAME;
    public $_ORIG_DOC_EXTENSION;
    public $_ORIG_DOC_URI;
    public $_ORIG_DOC_DIRNAME;

    public $_DOC_BASENAME;
    public $_DOC_EXTENSION;
    public $_DOC_URI;
    public $_DOC_DIRNAME;

    public $_DOC_ASSET_PATH;


    public function newEnv (string $newPath) : self
    {
        $newEnv = clone $this;
        $newEnv->_DOC_BASENAME =  Path::Use($newEnv->_DOC_DIRNAME . "/" . $newPath)->resolve();
        $newEnv->_DOC_DIRNAME = Path::Use($newEnv->_DOC_DIRNAME . "/" . dirname($newPath))->resolve();
        $newEnv->_DOC_URI = dirname($newEnv->_DOC_URI) . "/" . $newPath;
        $newEnv->_DOC_EXTENSION = pathinfo($newPath)["extension"];

        return $newEnv;
    }


    public function getPath (string $subPath, bool $makeAbsolute=true) : string
    {
        if (substr($subPath, 0 , 1) === "/" || preg_match ("|^https?://|", $subPath)) {
            return $subPath; // Ignore absolute paths
        }
        if ($makeAbsolute) {
            $prefix = Path::Use($this->_ORIG_REQ_PATH . "/" . $this->_DOC_DIRNAME)->resolve()->toAbsolute();
            return Path::Use($prefix  . "/" . $subPath)->resolve()->toAbsolute();
        } else {
            $prefix = Path::Use($this->_DOC_DIRNAME)->resolve()->toRelative();
            return Path::Use($prefix  . "/" . $subPath)->resolve()->toRelative();
        }
    }


    public static function Build ($reqUri, $docUri) : self
    {
        $n = new self();
        $n->_SELF = $_SERVER["PHP_SELF"];

        $reqPathInfo = pathinfo($reqUri);
        $docPathInfo = pathinfo($docUri);

        $n->_ORIG_DOC_URI = $n->_DOC_URI = $reqUri;
        $n->_ORIG_REQ_PATH = $reqUri["dirname"];

        $n->_ORIG_DOC_DIRNAME = $n->_DOC_DIRNAME = $docPathInfo["dirname"];
        $n->_ORIG_DOC_BASENAME = $n->_DOC_BASENAME = $docPathInfo["basename"];
        $n->_ORIG_DOC_EXTENSION = $n->_DOC_EXTENSION = $docPathInfo["extension"];
        return $n;
    }


}