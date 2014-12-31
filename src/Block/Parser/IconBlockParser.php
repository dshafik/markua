<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Davey Shafik <me@daveyshafik.com
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmarkjs)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Markua\Block\Parser;

use League\CommonMark\Block\Parser\AbstractBlockParser;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;
use League\Markua\Block\Element\IconBlock;

class IconBlockParser extends AbstractBlockParser
{
    /**
     * @param ContextInterface $context
     * @param Cursor $cursor
     *
     * @return bool
     */
    public function parse(ContextInterface $context, Cursor $cursor)
    {
        if (!in_array($cursor->getFirstNonSpaceCharacter(), IconBlock::getIconBlockTypes()) || $cursor->getCharacter($cursor->getFirstNonSpacePosition() + 1) !== '>') {
            return false;
        }

        $type = $cursor->getFirstNonSpaceCharacter();
        
        $cursor->advanceToFirstNonSpace();
        if ($cursor->peek() === '>') {
            $cursor->advanceBy(2);
            if ($cursor->getCharacter() === ' ') {
                $cursor->advance();
            }
        }

        $context->addBlock(new IconBlock($type));

        return true;
    }
}
