<?php
namespace com\yp\admin\data;

require_once SITE_ROOT . "/db-catalogs.php";

use com\yp\entity\DataEntity;
use com\yp\entity\Element;

class Export extends DataEntity
{

    const SCHEMA_NAME = common;

    const TABLE_NAME = 'exports';

    public function __construct(string $pSourceSchema = null, string $pSourceTable = null, string $pTargetSchema = null, string $pTargetTable = null)
    {
        parent::__construct();

        $this->className = 'Export';

        $this->primary_keys = array(
            'source_schema' => new Element($this->get('source_schema')),
            'source_table' => new Element($this->get('source_table')),
            'target_schema' => new Element($this->get('target_schema')),
            'target_table' => new Element($this->get('target_table'))
        );
        if ($pSourceSchema != null && $pSourceTable != null && $pTargetSchema != null && $pTargetTable != null) {
            $this->state = self::INSERTED;
            $this->set("source_schema", $pSourceSchema);
            $this->set("source_table", $pSourceTable);
            $this->set("target_schema", $pTargetSchema);
            $this->set("target_table", $pTargetTable);
        }
    }
}

