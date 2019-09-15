<?php

namespace Happysir\Respostitory\Concern;

/**
 * Trait TableTraitHelper
 */
trait TableTraitHelper
{
    /**
     * 获取实体表名
     *
     * @return string
     * @throws \Swoft\Db\Exception\DbException
     */
    protected function tableName() : string
    {
        return table_name($this->model());
    }
}
