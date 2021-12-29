<?php
namespace com\yp\admin\model;

include_once CORE_PACKAGE_ROOT . '/core/FnParam.php';
include_once CORE_PACKAGE_ROOT . '/db/DbHandler.php';
include_once CORE_PACKAGE_ROOT . '/db/Result.php';

use com\yp\db\DbHandler;
use com\yp\tools\Configuration;
use com\yp\tools\ClientIP;
use com\yp\db\Result;
use com\yp\admin\data\AppVersion;

class AppVersionModel extends DbHandler
{

    public function __construct()
    {
        parent::__construct();
        $filename = SITE_ROOT . '/Queries.properties';
        $this->queries = Configuration::getConfig($filename);
    }

    public function findAppVersionKeys(string $queryName, array $params)
    {
        $queryName1 = 'Q_APPVERSIONS2';
        return $this->findBy($queryName1, $params);
    }

    public function findAppVersions(string $queryName, array $params)
    {
        $queryName1 = 'Q_APPVERSIONS3';
        return $this->findBy($queryName1, $params);
    }

    public function saveVersion(string $pFnName, Array $params)
    {
        $appVersion = $params[0]->value;
        $user = $params[1]->value;
        $remaddress = ClientIP::get_ip_address();

        $result = $this->validateFields($appVersion);
        if ($result->isSuccess()) {        
            $appVersion->setLastClientInfo($user->getEmail(), $remaddress);
            $result = $this->save('save', $appVersion);
        }
        return $result;
    }

    private function validateFields(AppVersion $pVersion): Result
    {
        $res = new Result(true);
        $id = $pVersion->getAppId();
        if ($id == null || strlen($id) < 3) {
            $res->setSuccess(false);
            $res->setMessage("app id hata");
        }
        
        $version = $pVersion->getVersion();
        if($version == null || $version < 100 || $version > 999){
            $res->setSuccess(false);
            $res->setMessage("version hata");            
        }
        
        $desc = $pVersion->getDescription();
        if ($desc == null || strlen($desc) < 3) {
            $res->setSuccess(false);
            $res->setMessage("description hata");
        }
        
        $pdate = $pVersion->getPublishDate();
        if($pdate == null || $pdate < 19000101 || $pdate > 99999999){
            $res->setSuccess(false);
            $res->setMessage("publish date hata");
        }
        
        return $res;
    }
}

