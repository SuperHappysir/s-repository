<?php declare(strict_types = 1);

namespace Happysir\Respository\Concern;

use Happysir\Lib\Concern\Fluent;

/**
 * Class Searcher
 */
class Searcher extends Fluent
{
    /**
     * 分页数量
     *
     * @var int
     */
    protected $pageSize = 50;
    
    /**
     * 当前页
     *
     * @var int
     */
    protected $page = 1;
    
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
     * getPage
     *
     * @return int
     */
    public function getPage() : int
    {
        return $this->page;
    }
    
    /**
     * @param int $page
     */
    public function setPage(int $page) : void
    {
        $this->page = $page;
    }
}
