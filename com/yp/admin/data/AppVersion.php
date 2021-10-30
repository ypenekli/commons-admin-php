<?php
namespace com\yp\admin\data;
require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class AppVersion extends DataEntity
{
    const SCHEMA_NAME = common;
    const TABLE_NAME = 'app_versions';
    
    public function __construct(string $pAppId = null, int $pIdx = null) {
        parent::__construct ();
        
        $this->className = 'AppVersion';
        
        $this->primary_keys = array (
            'app_id' => new Element( $this->get ( 'app_id' ) ),
            'version_idx' => new Element( $this->get ( 'version_idx' ) )
        );
        if ($pAppId != null && $pIdx != null) {
            $this->state =  self::INSERTED;
            $this->set ( "app_id", $pAppId );
            $this->set ( "version_idx", $pIdx );
        }
    }    
}

