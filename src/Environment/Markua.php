<?php
namespace League\Markua\Environment;

use League\CommonMark\Block\Parser as BlockParser;
use League\CommonMark\Environment\CommonMark;
use League\Markua\Block\Parser as MarkuaBlockParser;
use League\Markua\Block\Renderer as MarkuaBlockRenderer;

class Markua extends CommonMark {

    public function getBlockParsers()
    {
        return array(
            // This order is important
            new BlockParser\IndentedCodeParser(),
            new BlockParser\LazyParagraphParser(),
            new BlockParser\BlockQuoteParser(),
            new MarkuaBlockParser\AsideParser(),
            new MarkuaBlockParser\IconBlockParser(),
            new BlockParser\ATXHeaderParser(),
            new BlockParser\FencedCodeParser(),
            new BlockParser\HtmlBlockParser(),
            new BlockParser\SetExtHeaderParser(),
            new BlockParser\HorizontalRuleParser(),
            new BlockParser\ListParser(),
        );
    }

    public function getBlockRenderers()
    {
        $renderers = parent::getBlockRenderers();
        $renderers['League\Markua\Block\Element\Aside'] = new MarkuaBlockRenderer\AsideRenderer();
        $renderers['League\Markua\Block\Element\IconBlock'] = new MarkuaBlockRenderer\IconBlockRenderer();

        return $renderers;
    }
}
