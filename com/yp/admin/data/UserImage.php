<?php
namespace com\yp\admin\data;

require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class UserImage extends DataEntity
{

    const SCHEMA_NAME = common;

    const TABLE_NAME = 'user_image';

    public function __construct(int $pUserId = null, int $pIdx = null)
    {
        parent::__construct();

        $this->className = 'UserImage';

        $this->primary_keys = array(
            'user_id' => new Element($this->get('user_id')),
            'idx' => new Element($this->get('idx'))
        );
        if ($pUserId != null && $pIdx != null) {
            $this->state = self::INSERTED;
            $this->set("user_id", $pUserId);
            $this->set("idx", $pIdx);
        }
    }
}

