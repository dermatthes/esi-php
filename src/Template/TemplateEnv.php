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

    public $_ORIG_DOC_FILE;
    public $_ORIG_DOC_URI;
    public $_ORIG_DOC_PATH;

    public $_DOC_FILE;
    public $_DOC_URI;
    public $_DOC_PATH;

    public $_DOC_ASSET_PATH;


    public function newEnv (string $newPath) : self
    {
        $newEnv = clone $this;
        $newEnv->_DOC_FILE =  Path::Use($newEnv->_DOC_PATH . "/" . $newPath)->resolve();
        $newEnv->_DOC_PATH = Path::Use($newEnv->_DOC_PATH . "/" . dirname($newPath))->resolve();
        $newEnv->_DOC_URI = dirname($newEnv->_DOC_URI) . "/" . $newPath;
        return $newEnv;
    }


    public function getPath (string $subPath, bool $makeAbsolute=true) : string
    {
        if (substr($subPath, 0 , 1) === "/" || preg_match ("|^https?://|", $subPath)) {
            return $subPath; // Ignore absolute paths
        }
        if ($makeAbsolute) {
            $prefix = Path::Use($this->_ORIG_REQ_PATH . "/" . $this->_DOC_PATH)->resolve()->toAbsolute();
            return Path::Use($prefix  . "/" . $subPath)->resolve()->toAbsolute();
        } else {
            $prefix = Path::Use($this->_DOC_PATH)->resolve()->toRelative();
            return Path::Use($prefix  . "/" . $subPath)->resolve()->toRelative();
        }
    }


    public static function Build ($docUri) : self
    {
        $n = new self();
        $n->_SELF = $_SERVER["PHP_SELF"];
        $n->_ORIG_DOC_URI = $n->_DOC_URI = $docUri;
        $n->_ORIG_DOC_PATH = $n->_DOC_PATH = dirname($docUri);
        $n->_ORIG_DOC_FILE = $n->_DOC_FILE = basename($docUri);
        return $n;
    }


}