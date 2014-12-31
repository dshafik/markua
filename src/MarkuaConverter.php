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

namespace League\Markua;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use League\Markua\Extension\MarkuaExtension;

/**
 * Converts Markua-compatible Markdown to HTML.
 */
class MarkuaConverter extends CommonMarkConverter
{
    /**
     * Create a new markua converter instance.
     */
    public function __construct()
    {
        $environment = new Environment();
        $environment->addExtension(new MarkuaExtension());
        
        $this->docParser = new DocParser($environment);
        $this->htmlRenderer = new HtmlRenderer($environment);
    }
}
