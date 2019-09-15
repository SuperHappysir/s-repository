<?php

namespace Happysir\Respository\Contract;

use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Eloquent\Model;

/**
 * interface RespositoryInterface
 */
interface RespositoryInterface
{
    /**
     * dao管理的默认实体
     *
     * @return string
     */
    public function model() : string;
    
    /**
     * @param int   $id
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Model|null
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function find(int $id, array $columns = ['*']) : ?Model;
    
    /**
     * 查找数据
     *
     * @param int[] $ids
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function findMany(array $ids, array $columns = ['*']) : Collection;
    
    /**
     * Find data by field and value
     *
     * @param string $field
     * @param mixed  $value
     * @param array  $columns
     *
     * @return \Swoft\Db\Eloquent\Collection
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getByField(
        string $field,
        $value,
        $columns = ['*']
    ) : Collection;
    
    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return \Swoft\Db\Eloquent\Collection
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getWhere(array $where, $columns = ['*']) : Collection;
    
    /**
     * Find data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return \Swoft\Db\Eloquent\Collection
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getWhereIn(
        $field,
        array $values,
        $columns = ['*']
    ) : Collection;
    
    /**
     * Find data by excluding multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return \Swoft\Db\Eloquent\Collection
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getWhereNotIn(
        $field,
        array $values,
        $columns = ['*']
    ) : Collection;
    
    /**
     * 获取所有
     *
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function all(array $columns = ['*']) : Collection;
    
    /**
     * @param string $column
     * @param null   $key
     * @return \Swoft\Db\Eloquent\Collection
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function allPluck(string $column, $key = null) : Collection;
    
    /**
     * 通过属性创建
     *
     * @param array $attributes
     * @return \Swoft\Db\Eloquent\Model
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function create(array $attributes) : Model;
    
    /**
     * 更新数据
     *
     * @param int   $id
     * @param array $attributes
     * @return int
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function update(int $id, array $attributes) : int;
    
    /**
     * 更新数据
     *
     * @param array $where
     * @param array $columns
     * @return int
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function updateWhere(array $where, array $columns) : int;
    
    /**
     * 删除数据
     *
     * @param int $id
     * @return bool
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function delete(int $id) : bool;
    
    /**
     * 批量插入数据
     *
     * @param array $values
     * @return bool
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function batchInsert(array $values) : bool;
    
    /**
     * 创建模型
     *
     * @param \Swoft\Db\Eloquent\Model $entity
     * @return \Swoft\Db\Eloquent\Model
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createBy(Model $entity) : Model;
    
    /**
     * 保存模型
     *
     * @param \Swoft\Db\Eloquent\Model $entity
     * @return \Swoft\Db\Eloquent\Model
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function save(Model $entity) : Model;
    
    /**
     * Retrieve first data of repository, or return new Entity
     *
     * @param array $attributes
     *
     * @return Model
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function firstOrNew(array $attributes = []) : Model;
    
    /**
     * Retrieve first data of repository, or create new Entity
     *
     * @param array $attributes
     *
     * @return Model
     *
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function firstOrCreate(array $attributes = []) : Model;
}
