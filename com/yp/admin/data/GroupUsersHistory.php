<?php
namespace com\yp\admin\data;

require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class GroupUsersHistory extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'group_users_history';
    
    public static $UPDATE_MODE_ADD = "A";
    public static $UPDATE_MODE_DELETE = "D";
        
    
    public function __construct(GroupUser $groupUser, int $pIdx = null) {
        parent::__construct();
        
        $this->className = 'GroupUsersHistory';
        
        $this->primary_keys = array (
            'idx' => new Element( $this->get ( 'idx' ) )
        );        
        
        if ($pIdx != null) {
            $this->state =  self::INSERTED;
            $this->set ( "idx", $pIdx );
        }
        
        $this->setGroupUser($groupUser);
    } 
    
    public function setGroupUser(GroupUser $groupUser) {
        $this->set("group_id", $groupUser->get("group_id"));
        $this->set("user_id", $groupUser->get("user_id"));
        $this->setClient($groupUser);
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

