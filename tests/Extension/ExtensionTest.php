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

namespace League\Markua\Tests;

use League\Markua\Extension\MarkuaExtension;
use League\Markua\MarkuaConverter;

class ExtensionTest extends \PHPUnit_Framework_TestCase {
    public function testGetExtensionName()
    {
        $extension = new MarkuaExtension();
        $this->assertEquals('markua', $extension->getName());
    }
}
