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
    
    public function setUpdateUser(User $user){
        $this->set ( "update_user_id", $user->getId() );
        $this->set ( "update_datetime", (new \DateTime())->format('YmdHisv') );
        $this->set ( "update_user_name", $user->getFullName() );
        $this->set ( "update_user_title", $user->getTitle() );
    }
}

