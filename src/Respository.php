<?php

namespace Happysir\Respository;

use Happysir\Respository\Concern\Paginator;
use Happysir\Respository\Concern\Searcher;
use Happysir\Respository\Concern\TableTraitHelper;
use Happysir\Respository\Contract\RespositoryInterface;
use Happysir\Respository\Exception\NotFoundException;
use Happysir\Respository\Exception\RespositoryBaseException;
use Swoft\Db\Eloquent\Builder;
use Swoft\Db\Eloquent\Builder as EloquentBuilder;
use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Eloquent\Model;
use Swoft\Db\Schema\Builder as SchemaBuilder;

/**
 * Class Respository
 */
abstract class Respository implements RespositoryInterface
{
    use TableTraitHelper;
    
    /**
     * @return \Swoft\Db\Eloquent\Builder
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function eloquentBuilder() : Builder
    {
        /** @var Model $class */
        $class = $this->model();
        
        return $class::query();
    }
    
    /**
     * @param int   $id
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Model|null
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function find(int $id, array $columns = ['*']) : ?Model
    {
        return $this->eloquentBuilder()->find($id, $columns);
    }
    
    /**
     * 获取账户，账户不存在时抛出异常
     *
     * @param int   $id
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Model
     * @throws \Happysir\Respository\Exception\NotFoundException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function findOrFail(int $id, array $columns = ['*']) : Model
    {
        /** @var Model $entity */
        $entity =  $this->find($id, $columns);
        if ($entity === null) {
            throw new NotFoundException('账户不存在');
        }
        
        return $entity;
    }
    
    /**
     * @param array $ids
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function findMany(array $ids, array $columns = ['*']) : Collection
    {
        return $this->eloquentBuilder()->find($ids, $columns);
    }
    
    /**
     * @param string $field
     * @param mixed  $value
     * @param array  $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getByField(
        string $field,
        $value,
        $columns = ['*']
    ) : Collection {
        return $this->eloquentBuilder()->where($field, $value)->get($columns);
    }
    
    /**
     * @param array $where
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getWhere(array $where, $columns = ['*']) : Collection
    {
        $builder = $this->eloquentBuilder();
        
        foreach ($where as $item) {
            $builder->where(...$item);
        }
        
        return $builder->get($columns);
    }
    
    /**
     * @param       $field
     * @param array $values
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getWhereIn(
        $field,
        array $values,
        $columns = ['*']
    ) : Collection {
        return $this->eloquentBuilder()
                    ->whereIn($field, $values)
                    ->get($columns);
    }
    
    /**
     * @param       $field
     * @param array $values
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getWhereNotIn(
        $field,
        array $values,
        $columns = ['*']
    ) : Collection {
        return $this->eloquentBuilder()
                    ->whereNotIn($field, $values)
                    ->get($columns);
    }
    
    /**
     * @param array $columns
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function all(array $columns = ['*']) : Collection
    {
        return $this->eloquentBuilder()->get($columns);
    }
    
    /**
     * @param string $column
     * @param null   $key
     * @return \Swoft\Db\Eloquent\Collection
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function allPluck(string $column, $key = null) : Collection
    {
        $columns = array_filter(
            [
                $column,
                $key
            ]
        );
        /** @var Collection $collection */
        $collection = $this->eloquentBuilder()
                           ->get($columns)
                           ->pluck($column, $key);
        
        return $collection;
    }
    
    /**
     * @param array $attributes
     * @return \Swoft\Db\Eloquent\Model
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function create(array $attributes) : Model
    {
        return $this->eloquentBuilder()->create($attributes);
    }
    
    /**
     * @param       $id
     * @param array $attributes
     * @return int
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function update(int $id, array $attributes) : int
    {
        return $this->eloquentBuilder()->whereKey($id)->update($attributes);
    }
    
    /**
     * @param array $where
     * @param array $columns
     * @return int
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function updateWhere(array $where, array $columns) : int
    {
        $builder = $this->eloquentBuilder();
        
        foreach ($where as $item) {
            $builder->where(...$item);
        }
        
        return $builder->update($columns);
    }
    
    /**
     * @param int $id
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function delete(int $id) : bool
    {
        return $this->eloquentBuilder()->whereKey($id)->update(
            [
                'is_deleted',
                1
            ]
        );
    }
    
    /**
     * @param array $values
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function batchInsert(array $values) : bool
    {
        return $this->eloquentBuilder()->insert($values);
    }
    
    /**
     * @param \Swoft\Db\Eloquent\Model $entity
     * @return \Swoft\Db\Eloquent\Model
     * @throws \Happysir\Respository\Exception\RespositoryBaseException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function createBy(Model $entity) : Model
    {
        if ($entity->swoftExists) {
            throw new RespositoryBaseException('实体已存在,不能再次创建');
        }
        $entity->save();
        
        return $entity;
    }
    
    /**
     * @param \Swoft\Db\Eloquent\Model $entity
     * @return \Swoft\Db\Eloquent\Model
     * @throws \Happysir\Respository\Exception\RespositoryBaseException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function save(Model $entity) : Model
    {
        if (!$entity->swoftExists) {
            throw new RespositoryBaseException('实体不存在,不能执行保存操作');
        }
        $entity->save();
        
        return $entity;
    }
    
    /**
     * @param array $attributes
     * @return \Swoft\Db\Eloquent\Model
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function firstOrNew(array $attributes = []) : Model
    {
        return $this->eloquentBuilder()->firstOrNew($attributes);
    }
    
    /**
     * @param array $attributes
     * @return \Swoft\Db\Eloquent\Model
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function firstOrCreate(array $attributes = []) : Model
    {
        return $this->eloquentBuilder()->firstOrCreate($attributes);
    }
    
    /**
     * @param \Swoft\Db\Query\Builder|EloquentBuilder|SchemaBuilder $queryBuilder
     * @param \Happysir\Respository\Concern\Searcher                $searcher
     * @param array                                                 $columns
     * @return Paginator
     */
    protected function getPaginator(
        $queryBuilder,
        Searcher $searcher,
        array $columns = ['*']
    ) : Paginator {
        $paginator = $queryBuilder->paginate(
            $searcher->getPage(),
            $searcher->getPageSize(),
            $columns
        );
        
        return new Paginator(
            $paginator['count'],
            $searcher->getPageSize(),
            $searcher->getPage(),
            $paginator['pageCount'],
            $paginator['list']
        );
    }
}
