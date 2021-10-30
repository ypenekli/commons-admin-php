<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class GroupAppFuncsHistory extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'group_app_funcs_history';
    
    public static $UPDATE_MODE_ADD = "A";
    public static $UPDATE_MODE_DELETE = "D";
    
    public function __construct(GroupAppFunc $groupAppFunc, int $pIdx = null) {
        parent::__construct ();
        
        $this->className = 'GroupAppFuncsHistory';
        
        $this->primary_keys = array (
            'idx' => new Element( $this->get ( 'idx' ) )
        );
        if ($pIdx != null) {
            $this->state =  self::INSERTED;
            $this->set ( "idx", $pIdx );
        }
        $this->setGroupAppFunc($groupAppFunc);
    }     
    
    public function setGroupAppFunc(GroupAppFunc $groupAppFunc) {
        $this->set("group_id", $groupAppFunc->get("group_id"));
        $this->set("app_func_id", $groupAppFunc->get("app_func_id"));
        $this->setClient($groupAppFunc);
    }
    
    public function setUpdateUser(User $user, string $updateMode) {
        if($user != null){
            $this->set("update_user_id", $user->getId());
            $this->set("update_user_name", $user->getFullName());
            $this->set("update_user_title", $user->getTitle());
        }else{            
            $this->set("update_user_id", 0);
            $this->set("update_user_name", 'Admin');
            $this->set("update_user_title", 'Admin');
        }
        $updateDateTime = (new \DateTime())->format('YmdHisv');
        $this->set("update_mode", $updateMode);
        $this->set("update_datetime", $updateDateTime);
    }
}

