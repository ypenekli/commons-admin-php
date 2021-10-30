<?php
namespace com\yp\admin\model;

include_once CORE_PACKAGE_ROOT . '/core/FnParam.php';
include_once CORE_PACKAGE_ROOT . '/db/DbHandler.php';
include_once CORE_PACKAGE_ROOT . '/db/Result.php';

use com\yp\db\DbHandler;
use com\yp\tools\Configuration;
use com\yp\core\FnParam;
use com\yp\admin\data\Group;
use com\yp\db\Pager;
use com\yp\tools\ClientIP;
use com\yp\db\Result;
use com\yp\admin\data\GroupUser;
use com\yp\admin\data\GroupUsersHistory;

class GroupModel extends DbHandler
{

    public function __construct()
    {
        parent::__construct();
        $filename = SITE_ROOT . '/Queries.properties';
        $this->queries = Configuration::getConfig($filename);
    }
    
    public function findUserGroupList(string $queryName, array $params)
    {
        $queryName1 = 'Q_GROUPS1';
        return $this->findBy($queryName1, $params);
    }

    public function findAppGroupList(string $queryName, array $params)
    {
        $queryName1 = 'Q_GROUPS5';
        return $this->findBy($queryName1, $params);
    }
    
    public function findGroupId(){
        $queryName1 = 'Q_GROUPS2';
        $findParams = array(
            new FnParam('type', Group::class),
            new FnParam('pager', new Pager())
        );
        $group =  $this->findOne($queryName1, $findParams);
        $id = null;
        if($group != null){
            $id = $group->get("id");
        }
        if($id != null && $id > -1){
            $id += 1;
        }
        return $id;
    }
    
    public function saveGroup(string $pFnName, Array $params)
    {
        $group = $params[0]->value;
        $user = $params[1]->value;
        $remaddress = ClientIP::get_ip_address();
        
        $result = $this->validateFields($group);
        if ($result->isSuccess()) {
            $groupUser = null;
            $history = null;
            $group->setLastClientInfo($user->getEmail(), $remaddress);
            if ($group->isNew()) {
                $groupModel = new GroupModel();
                $groupId = $groupModel->findGroupId();
                $group->setId($groupId);
                $group->setHierarchy($groupId);
                $group->setGroupType(Group::$GROUP_TYPE_USER);
                
                $groupUser = new GroupUser($groupId, $user->getId());
                $groupUser->setLastClient($group);
                
                $history = new GroupUsersHistory($groupUser, - 1);
                $history->setUpdateUser($user, GroupUsersHistory::$UPDATE_MODE_ADD);                
            }
            
            $saveParams = array(
                new FnParam("data", $group),
                new FnParam("data", $groupUser),
                new FnParam("data", $history)
            );
            $result = $this->saveAtomic('saveAtomic', $saveParams);
        }
        return $result;
    }
    
    private function validateFields(Group $pGroup): Result
    {
        $res = new Result(true);
        $id = $pGroup->getAppId();
        if ($id == null || strlen($id) < 3) {
            $res->setSuccess(false);
            $res->setMessage("app id hata");
        }
        $name = $pGroup->getName();
        if ($name == null || strlen($name) < 3) {
            $res->setSuccess(false);
            $res->setMessage("name hata");
        }
        return $res;
    }
}

