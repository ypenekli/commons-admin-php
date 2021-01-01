<?php
namespace com\yp\admin\data;

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class PwdHistory extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'pwd_history';
    
    public function __construct(int $pIdx = null) {
        parent::__construct ();
        
        $this->className = 'PwdHistory';
        
        $this->primary_keys = array (
            'idx' => new Element( $this->get ( 'idx' ) )
        );
        if ($pIdx != null) {
            $this->state =  self::INSERTED;
            $this->set ( "idx", $pIdx );
        }
        
    }
}

