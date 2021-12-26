<?php
namespace com\yp\admin\model;

include_once CORE_PACKAGE_ROOT . '/core/FnParam.php';
include_once CORE_PACKAGE_ROOT . '/db/DbHandler.php';
include_once CORE_PACKAGE_ROOT . '/db/Result.php';

use com\yp\db\DbHandler;
use com\yp\tools\Configuration;
use com\yp\tools\ClientIP;
use com\yp\db\Result;
use com\yp\admin\data\AppFunc;
use com\yp\admin\data\GroupAppFunc;
use com\yp\core\FnParam;
use com\yp\admin\data\GroupAppFuncsHistory;

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
        $appFunc = $params[0]->value;
        $groupId = $params[1]->value;
        $user = $params[2]->value;
        $remaddress = ClientIP::get_ip_address();

        $result = $this->validateFields($appFunc);
        if ($result->isSuccess()) {

            $parent = null;
            $groupFunc = null;
            $history = null;
            $appFunc->setLastClientInfo($user->getEmail(), $remaddress);
            if ($appFunc->isNew()) {

                $groupFunc = new GroupAppFunc($groupId, $appFunc->getId());
                $groupFunc->setLastClient($appFunc);

                $history = new GroupAppFuncsHistory($groupFunc, - 1);
                $history->setUpdateUser($user, GroupAppFuncsHistory::$UPDATE_MODE_ADD);
                if (! $appFunc->isRoot()) {
                    $appModel = new AppModel();
                    $parent = $appModel->find('find', new AppFunc($appFunc->getParentId()));                    
                    //$parent = new AppFunc($appFunc->getParentId());
                    //$parent->accept();
                   // $parent->setName($appFunc->getParentName());
                    $parent->setLeaf(false);
                    $parent->setLastClient($appFunc);
                }
            }

            $saveParams = array(
                new FnParam("data", $appFunc),
                new FnParam("data", $groupFunc),
                new FnParam("data", $history),
                new FnParam("data", $parent)
            );
            $result = $this->saveAtomic('saveAtomic', $saveParams);
        }
        return $result;
    }

    private function validateFields(AppFunc $pFunc): Result
    {
        $res = new Result(true);
        $id = $pFunc->getId();
        if ($id == null || strlen($id) < 3) {
            $res->setSuccess(false);
            $res->setMessage("id hata");
        }
        $name = $pFunc->getName();
        if ($name == null || strlen($name) < 3) {
            $res->setSuccess(false);
            $res->setMessage("name hata");
        }
        return $res;
    }
}

