<?php
namespace com\yp\admin\model;

include_once CORE_PACKAGE_ROOT . '/core/FnParam.php';
include_once CORE_PACKAGE_ROOT . '/db/DbHandler.php';
include_once CORE_PACKAGE_ROOT . '/db/Result.php';

use com\yp\db\DbHandler;
use com\yp\tools\Configuration;
use com\yp\admin\data\Common;
use com\yp\db\Result;
use com\yp\tools\ClientIP;

class CommonModel extends DbHandler
{

    public function __construct()
    {
        parent::__construct();
        $filename = SITE_ROOT . '/Queries.properties';
        $this->queries = Configuration::getConfig($filename);
    }
    
    public function findByParent(string $queryName, array $params)
    {
        $queryName1 = 'Q_COMMONS_PARENT_ID1';
        return $this->findBy($queryName1, $params);
    }
    
    public function saveCommon(string $pFnName, Array $params)
    {
        $common = $params[0]->value;
        $user = $params[1]->value;
        $remaddress = ClientIP::get_ip_address();
        
        $result = $this->validateFields($common);
        if ($result->isSuccess()) {
            $common->setLastClientInfo($user->getEmail(), $remaddress);            
            $result = $this->save('save', $common);
        }
        return $result;
    }
    
    private function validateFields(Common $pCommon): Result
    {
        $res = new Result(true);
        
        $id = $pCommon->getId();
        if ($id == null) {
            $res->setSuccess(false);
            $res->setMessage("id hata");
        }
        $name = $pCommon->getName();
        if ($name == null || strlen($name) < 3) {
            $res->setSuccess(false);
            $res->setMessage("name hata");
        }
        $name = $pCommon->getAbrv();
        if ($name == null || strlen($name) < 3) {
            $res->setSuccess(false);
            $res->setMessage("short name hata");
        }
        $name = $pCommon->getDescription();
        if ($name == null || strlen($name) < 3) {
            $res->setSuccess(false);
            $res->setMessage("description hata");
        }
        return $res;
    }
}

