<?php declare(strict_types = 1);

namespace Happysir\Respostitory\Annotation\Parser;

use Happysir\Respostitory\Annotation\Mapping\SearchField;
use Swoft\Annotation\Annotation\Mapping\AnnotationParser;
use Swoft\Annotation\Annotation\Parser\Parser;

/**
 * Class SearchFieldParser
 *
 * @since 2.0
 *
 * @AnnotationParser(SearchField::class)
 */
class SearchFieldParser extends Parser
{
    /**
     * @param int         $type
     * @param SearchField $annotationObject
     *
     * @return array
     */
    public function parse(int $type, $annotationObject) : array
    {
        if ($type !== self::TYPE_PROPERTY) {
            return [];
        }
        
        return [];
    }
}
