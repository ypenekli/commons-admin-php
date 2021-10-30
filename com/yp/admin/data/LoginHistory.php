<?php
namespace com\yp\admin\data;

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class LoginHistory extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'login_history';
    
    public function __construct(int $pIdx = null) {
        parent::__construct ();
        
        $this->className = 'LoginHistory';
        
        $this->primary_keys = array (
            'idx' => new Element( $this->get ( 'idx' ) )
        );
        if ($pIdx != null) {
            $this->state =  self::INSERTED;
            $this->set ( "idx", $pIdx );
        }
        
    }
}

