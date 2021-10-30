<?php
namespace com\yp\admin\model;

include_once CORE_PACKAGE_ROOT . '/core/FnParam.php';
include_once CORE_PACKAGE_ROOT . '/db/DbHandler.php';
include_once CORE_PACKAGE_ROOT . '/db/Result.php';

use com\yp\db\DbHandler;
use com\yp\tools\Configuration;

class ExportModel extends DbHandler
{

    public function __construct()
    {
        parent::__construct();
        $filename = SITE_ROOT . '/Queries.properties';
        $this->queries = Configuration::getConfig($filename);
    }
}

