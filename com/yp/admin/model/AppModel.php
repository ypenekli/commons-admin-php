<?php
namespace com\yp\admin\model;

include_once CORE_PACKAGE_ROOT . '/core/FnParam.php';
include_once CORE_PACKAGE_ROOT . '/db/DbHandler.php';
include_once CORE_PACKAGE_ROOT . '/db/Result.php';

use com\yp\db\DbHandler;
use com\yp\tools\Configuration;
use com\yp\admin\data\App;
use com\yp\db\Result;
use com\yp\admin\data\Group;
use com\yp\admin\data\GroupUser;
use com\yp\admin\data\GroupUsersHistory;
use com\yp\core\FnParam;
use com\yp\tools\ClientIP;

class AppModel extends DbHandler
{

    public function __construct()
    {
        parent::__construct();
        $filename = SITE_ROOT . '/Queries.properties';
        $this->queries = Configuration::getConfig($filename);
    }
    
    public function findApps(string $queryName, array $params)
    {
        $queryName1 = 'Q_APPS6';
        return $this->findBy($queryName1, $params);
    }
    
    public function saveApp(string $pFnName, Array $params){
        $app = $params[0]->value;
        $user = $params[1]->value;
        $remaddress = ClientIP::get_ip_address();
        
        $result = $this->validateFields($app);       
        if($result->isSuccess()){            
            $group = null;
            $groupUser = null;
            $history = null;            
            $app->setLastClientInfo($user->getEmail(), $remaddress);   
            if($app->isNew()){
                $groupModel = new GroupModel();
                $groupId = $groupModel->findGroupId();
                $group = new Group($groupId);
                $group->setAppId($app->getId());
                $group->setName(sprintf("%s->%s", $app->getName(), "ADMIN"));
                $group->setHierarchy($groupId);
                $group->setGroupType(Group::$GROUP_TYPE_ADMIN);
                $group->setLastClient($app);
                
                $groupUser = new GroupUser($groupId, $user->getId());
                $groupUser->setLastClient($app);                
                $history = new GroupUsersHistory($groupUser, -1);                
            }
            
            $saveParams = array(
                new FnParam("data", $app),
                new FnParam("data", $group),
                new FnParam("data", $groupUser),
                new FnParam("data", $history)
            );            
            $result = $this->saveAtomic('saveAtomic', $saveParams);  
        }
        return $result;
    }
    
    private function validateFields(App $pApp):Result{
        $res = new Result(true);
        $id = $pApp->getId();
        if($id == null || strlen($id) < 3){
            $res->setSuccess(false);
            $res->setMessage("id hata");
        }
        $name = $pApp->getName();
        if($name == null || strlen($name) < 3){
            $res->setSuccess(false);
            $res->setMessage("name hata");
        }
        return $res;
    }
}

