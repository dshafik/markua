<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Davey Shafik <me@daveyshafik.com>
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmarkjs)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Markua\Block\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\HtmlRenderer;
use League\Markua\Block\Element\IconBlock;

class IconBlockRenderer extends AsideRenderer implements BlockRendererInterface
{
    /**
     * @param IconBlock $block
     * @param HtmlRenderer $htmlRenderer
     * @param bool $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, HtmlRenderer $htmlRenderer, $inTightList = false)
    {
        if (!($block instanceof IconBlock)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        $htmlBlock = parent::render($block, $htmlRenderer, $inTightList);
        $htmlBlock->setAttribute('class', $block->getTypeName());
        
        return $htmlBlock;
    }
}
