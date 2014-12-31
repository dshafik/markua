<?php

/*
 * This file is part of the league/markua package.
 *
 * (c) Davey Shafik <me@daveyshafik.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmarkjs)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Markua\Block\Element;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;

class IconBlock extends Aside
{
    protected $type;

    /**
     * @param string $type Icon Block type (e.g. I for Info)
     */
    public function __construct($type)
    {
        parent::__construct();
        $this->type = $type;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getTypeName()
    {
        $types = array_flip(static::getIconBlockTypes());
        return $types[$this->type];
    }
    
    public function matchesNextLine(Cursor $cursor)
    {
        if ($cursor->getIndent() <= 3 && in_array($cursor->getFirstNonSpaceCharacter(), static::getIconBlockTypes())) {
            $cursor->advanceToFirstNonSpace();
            $cursor->advance();
            if ($cursor->getCharacter() === '>') {
                $cursor->advance();
                if ($cursor->getCharacter() === ' ') {
                    $cursor->advance();
                }
            }

            return true;
        }

        return false;
    }

    public static function getIconBlockTypes() {
        return array(
            'discussion' => 'D',
            'error' => 'E',
            'info' => 'I',
            'question' => 'Q',
            'tip' => 'T',
            'warning' => 'W',
            'exercise' => 'X'
        );
    }
}
