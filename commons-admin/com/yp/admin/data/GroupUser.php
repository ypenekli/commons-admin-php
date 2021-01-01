<?php
namespace com\yp\admin\data;

require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class GroupUser extends DataEntity
{

    const SCHEMA_NAME = common;

    const TABLE_NAME = 'group_users';

    public function __construct(int $pGroupId = null, int $pUserId = null)
    {
        parent::__construct();

        $this->className = 'GroupUser';

        $this->primary_keys = array(
            'group_id' => new Element($this->get('group_id')),
            'user_id' => new Element($this->get('user_id'))
        );
        if ($pGroupId != null && $pUserId != null) {
            $this->state = self::INSERTED;
            $this->set("group_id", $pGroupId);
            $this->set("user_id", $pUserId);
        }
    }
}

