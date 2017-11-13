<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 17:07
 */

namespace Esi\Template;


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