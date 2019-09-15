<?php

use Swoft\Db\EntityRegister;

if (!function_exists('table_name')) {
    /**
     * Get table name
     *
     * @param string $entityClassName
     * @return string
     * @throws \Swoft\Db\Exception\DbException
     */
    function table_name(string $entityClassName) : string
    {
        return EntityRegister::getTable($entityClassName);
    }
}
