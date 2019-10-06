<?php

namespace Happysir\Respository\Annotation\Mapping;

use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class DistributedLock
 *
 * @Annotation
 * @Target("PROPERTY")
 * @Attributes({
 *     @Attribute("condition", type="string", required=true),
 *     @Attribute("dbField", type="string", required=true),
 *     @Attribute("mode", type="string"),
 * })
 */
class SearchField
{
    /**
     * when the condition is notnull
     */
    public const NOT_NULL = 'NOT_NULL';
    
    /**
     * condition
     *
     * @var string
     */
    protected $condition = self::NOT_NULL;
    
    /**
     * @var string
     */
    protected $mode = 'where';
    
    /**
     * @var string
     */
    protected $dbField = 'dbField';
    
    /**
     * DistributedLock constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        if (isset($values['value'])) {
            $this->condition = $values['condition'] = $values['value'];
            
            unset($values['value']);
        }
        
        if (isset($values['condition'])) {
            $this->condition = $values['condition'];
        }
        
        if (isset($values['mode'])) {
            $this->mode = $values['mode'];
        }
        
        if (isset($values['dbField'])) {
            $this->dbField = $values['dbField'];
        }
    }
    
    /**
     * getCondition
     *
     * @return string
     */
    public function getCondition() : string
    {
        return $this->condition;
    }
    
    /**
     * @param string $condition
     */
    public function setCondition(string $condition) : void
    {
        $this->condition = $condition;
    }
    
    /**
     * getMode
     *
     * @return string
     */
    public function getMode() : string
    {
        return $this->mode;
    }
    
    /**
     * @param string $mode
     */
    public function setMode(string $mode) : void
    {
        $this->mode = $mode;
    }
    
    /**
     * getDbField
     *
     * @return string
     */
    public function getDbField() : string
    {
        return $this->dbField;
    }
    
    /**
     * @param string $dbField
     */
    public function setDbField(string $dbField) : void
    {
        $this->dbField = $dbField;
    }
}
