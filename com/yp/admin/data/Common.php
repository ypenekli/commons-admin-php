<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class Common extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'commons';
    
    public function __construct(int $pId = null) {
        parent::__construct ();
        
        $this->className = 'Common';
        
        $this->primary_keys = array (
            'id' => new Element( $this->get ( 'id' ) )
        );
        if ($pId != null) {
            $this->state =  self::INSERTED;
            $this->set ( "id", $pId );
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
    
    public function getAbrv(){
        return $this->get("abrv");
    }
    
    public function setAbrv($name) {
        $this->set("abrv", $name);
    }
    
    public function getDescription(){
        return $this->get("description");
    }
    
    public function setDescription($name) {
        $this->set("description", $name);
    }
    
    public function getAppId(){
        return $this->get("app_id");
    }
    
    public function setAppId($appId) {
        $this->set("app_id", $appId);
    }
}

