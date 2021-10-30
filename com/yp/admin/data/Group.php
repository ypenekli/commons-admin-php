<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class Group extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'groups';
    
    
    
    public static $GROUP_TYPE_USER = "U";
    public static $GROUP_TYPE_ADMIN = "A";
    
    public function __construct(int $pId = null) {
        parent::__construct ();        
        $this->className = 'Group';        
        $this->primary_keys = array (
            'id' => new Element( $this->get ( 'id' ) )
        );
        if ($pId != null) {
            $this->state =  self::INSERTED;
            $this->setId($pId);
        }
    }
    
    public function getId(){
        return $this->get("id");
    }
    
    public function setId(int $pId){
        $this->set( "id", $pId );
    }
    
    public function getName(){
        return $this->get("name");
    }
    
    public function setName($name) {
        $this->set("name", $name);
    }
    
    public function getAppId(){
        return $this->get("app_id");
    }
    
    public function setAppId($appId) {
        $this->set("app_id", $appId);
    }
    
    public function setGroupType($groupType) {
        $this->set("group_type", $groupType);
    }
    
    public function setHierarchy($hierarchy) {
        $this->set("hierarchy", $hierarchy . "");
    }
}

