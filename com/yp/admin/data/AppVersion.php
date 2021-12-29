<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class AppVersion extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'app_versions';
    
    public function __construct(string $pAppId = null, int $pVersion = null, int $pIdx = null) {
        parent::__construct ();
        
        $this->className = 'AppVersion';
        
        $this->primary_keys = array (
            'app_id' => new Element( $this->get ( 'app_id' ) ),
            'version' => new Element( $this->get ( 'version' ) ),
            'idx' => new Element( $this->get ( 'idx' ) )
        );
        if ($pAppId != null && $pVersion != null) {
            $this->state =  self::INSERTED;
            $this->set ( "app_id", $pAppId );
            $this->set ( "version", $pVersion );
            $this->set ( "idx", $pIdx );
        }
    }
    
    public function getAppId(){
        return $this->get("app_id");
    }
    
    public function getVersion(){
        return $this->get("version");
    }
    
    public function getLabel(){
        return $this->get("label");
    }
    
    public function getDescription(){
        return $this->get("description");
    }
    
    public function setDescription($name) {
        $this->set("description", $name);
    }
    
    public function getPublishDate(){
        return $this->get("publish_date");
    }
}

