<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class Group extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'groups';
    
    public function __construct(int $pId = null) {
        parent::__construct ();
        
        $this->className = 'Group';
        
        $this->primary_keys = array (
            'id' => new Element( $this->get ( 'id' ) )
        );
        if ($pId != null) {
            $this->state =  self::INSERTED;
            $this->set ( "id", $pId );
        }
    }    
}

