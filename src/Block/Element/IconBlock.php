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

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTypeName()
    {
        $types = array_flip(static::getIconBlockTypes());
        return $types[$this->getType()];
    }
    
    public function matchesNextLine(Cursor $cursor)
    {
        if ($cursor->getIndent() <= 3 && in_array($cursor->getFirstNonSpaceCharacter(), static::getIconBlockTypes())) {
            $cursor->advanceToFirstNonSpace();
            if ($cursor->peek() === '>') {
                $cursor->advanceBy(2);
                if ($cursor->getCharacter() === ' ') {
                    $cursor->advance();
                }
                return true;
            }
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
