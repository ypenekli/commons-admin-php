<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class User extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'users';
    
    public function __construct(int $pId = null) {
        parent::__construct ();
        
        $this->className = 'User';
        
        $this->primary_keys = array (
            'id' => new Element( $this->get ( 'id' ) )
        );
        if ($pId != null) {
            $this->state =  self::INSERTED;
            $this->set ( "id", $pId );
        }
    }
    
    
    
    public function activate(bool $pStatus) {
        //A:acitiv, P:passive
        $this->set("status", $pStatus ? "A" : "P", true);
        if($pStatus){
            $this->set("login_error_count", 0, true);
        }
    }
}

