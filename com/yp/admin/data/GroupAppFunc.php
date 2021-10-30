<?php
namespace com\yp\admin\data;

require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class GroupAppFunc extends DataEntity
{

    const SCHEMA_NAME = common;

    const TABLE_NAME = 'group_app_funcs';

    public function __construct(int $pGroupId = null, string $pAppFuncId = null)
    {
        parent::__construct();

        $this->className = 'GroupAppFunc';

        $this->primary_keys = array(
            'group_id' => new Element($this->get('group_id')),
            'app_func_id' => new Element($this->get('app_func_id'))
        );
        if ($pGroupId != null && $pAppFuncId != null) {
            $this->state = self::INSERTED;
            $this->set("group_id", $pGroupId);
            $this->set("app_func_id", $pAppFuncId);
        }
    }
}

