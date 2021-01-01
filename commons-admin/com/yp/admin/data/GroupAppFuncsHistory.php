<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class GroupAppFuncsHistory extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'group_app_funcs_history';
    
    public function __construct(int $pIdx = null) {
        parent::__construct ();
        
        $this->className = 'GroupAppFuncsHistory';
        
        $this->primary_keys = array (
            'idx' => new Element( $this->get ( 'idx' ) )
        );
        if ($pIdx != null) {
            $this->state =  self::INSERTED;
            $this->set ( "idx", $pIdx );
        }
    }    
}

