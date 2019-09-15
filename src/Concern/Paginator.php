<?php

namespace Happysir\Respository\Concern;

use Swoft\Stdlib\Collection;

/**
 * Class Paginate
 */
class Paginator
{
    /**
     * 总记录数
     *
     * @var int
     */
    protected $total = 0;
    
    /**
     * 每页数量
     *
     * @var int
     */
    protected $pageSize = 50;
    
    /**
     * 当前页
     *
     * @var int
     */
    protected $currentPage = 1;
    
    /**
     * 总页数
     *
     * @var int
     */
    protected $totalPage = 0;
    
    /**
     * 当前页分页数据
     *
     * @var Collection
     */
    protected $items;
    
    /**
     * Paginator constructor.
     *
     * @param int                            $total
     * @param int                            $pageSize
     * @param int                            $currentPage
     * @param int                            $totalPage
     * @param \Swoft\Stdlib\Collection|array $items
     */
    public function __construct(
        int $total,
        int $pageSize,
        int $currentPage,
        int $totalPage,
        $items
    ) {
        $this->total       = $total;
        $this->pageSize    = $pageSize;
        $this->currentPage = $currentPage;
        $this->totalPage   = $totalPage;
        
        if (is_array($items)) {
            $items = Collection::make($items);
        }
        $this->items       = $items;
    }
    
    /**
     * getTotal
     *
     * @return int
     */
    public function getTotal() : int
    {
        return $this->total;
    }
    
    /**
     * @param int $total
     */
    public function setTotal(int $total) : void
    {
        $this->total = $total;
    }
    
    /**
     * getPageSize
     *
     * @return int
     */
    public function getPageSize() : int
    {
        return $this->pageSize;
    }
    
    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize) : void
    {
        $this->pageSize = $pageSize;
    }
    
    /**
     * getCurrentPage
     *
     * @return int
     */
    public function getCurrentPage() : int
    {
        return $this->currentPage;
    }
    
    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage) : void
    {
        $this->currentPage = $currentPage;
    }
    
    /**
     * getTotalPage
     *
     * @return int
     */
    public function getTotalPage() : int
    {
        return $this->totalPage;
    }
    
    /**
     * @param int $totalPage
     */
    public function setTotalPage(int $totalPage) : void
    {
        $this->totalPage = $totalPage;
    }
    
    /**
     * getItems
     *
     * @return \Swoft\Stdlib\Collection
     */
    public function getItems() : Collection
    {
        return $this->items;
    }
    
    /**
     * @param \Swoft\Stdlib\Collection $items
     */
    public function setItems(Collection $items) : void
    {
        $this->items = $items;
    }
}
