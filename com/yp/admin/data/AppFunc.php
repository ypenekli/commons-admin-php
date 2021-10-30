<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class AppFunc extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'app_funcs';
    
    public function __construct(string $pId = null) {
        parent::__construct ();
        
        $this->className = 'AppFunc';
        
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
    
    public function getParentName(){
        return $this->get("parent_name");
    }
    
    public function isLeaf() {
        return $this->get('leaf') == 'T';
    }
    
    public function setLeaf(bool $leaf) {
        $this->set("leaf", $leaf ? 'T' : 'F');
        $this->setName($this->getName());
    }
    
    public function setName(string $name) {
        if($this->isLeaf()){
            $name = ucfirst($name);
        }else{
            $name = strtoupper($name);
        }
        $this->set("name", $name);
    }
    
    public function getParentId(){
        return $this->get("parent_id");
    }
    
    public function getAppId(){
        return $this->get("app_id");
    }
    
    public function isRoot() {
        return  $this->getAppId() == $this->getParentId();
    }
}

