<?php
declare(strict_types = 1);

namespace Html\Tests;

use PHPUnit\Framework\TestCase;
use function Html\div;
use function Html\span;
use function Html\strong;
use Html\ElementInterface;

class HtmlTest extends TestCase
{
    public function testDiv()
    {
        $div = div();
        $this->assertSame('<div></div>', (string) $div);
        $this->assertInstanceOf(ElementInterface::class, $div);
    }

    public function testDivWithContent()
    {
        $div = div('Hello world');
        $this->assertSame('<div>Hello world</div>', (string) $div);
    }

    public function testDivWithContentAndAttributes()
    {
        $div = div(['class' => 'welcome'], 'Hello world');
        $this->assertSame('<div class="welcome">Hello world</div>', (string) $div);
    }

    public function testMagicProperties()
    {
        $div = div('Hello world')->class('welcome');
        $this->assertSame('<div class="welcome">Hello world</div>', (string) $div);
    }

    public function testDivWithChildren()
    {
        $div = div(
            ['class' => 'welcome'],
            span('Hello'),
            ' ',
            strong('world')
        );

        $this->assertSame('<div class="welcome"><span>Hello</span> <strong>world</strong></div>', (string) $div);
    }

    public function testFlags()
    {
        $this->assertSame('<div hidden></div>', (string) div(['hidden' => true]));
        $this->assertSame('<div></div>', (string) div(['hidden' => false]));
        $this->assertSame('<div></div>', (string) div(['hidden' => null]));
        $this->assertSame('<div hidden></div>', (string) div(['hidden']));
        $this->assertSame('<div hidden></div>', (string) div()->hidden());
        $this->assertSame('<div></div>', (string) div()->hidden(false));
        $this->assertSame('<div></div>', (string) div()->hidden(null));
    }

    public function testAttributes()
    {
        $this->assertSame('<div title="foo"></div>', (string) div(['title' => 'foo']));
        $this->assertSame('<div title="foo"></div>', (string) div()->title('foo'));
        $this->assertSame('<div title="123"></div>', (string) div(['title' => 123]));
        $this->assertSame('<div title="123"></div>', (string) div()->title(123));
    }

    public function testClasses()
    {
        $this->assertSame('<div class="foo"></div>', (string) div(['class' => 'foo']));
        $this->assertSame('<div class="foo"></div>', (string) div(['class' => ['foo']]));
        $this->assertSame('<div class="foo bar"></div>', (string) div(['class' => ['foo', 'bar']]));
        $this->assertSame('<div class="foo bar"></div>', (string) div(['class' => ['foo', '', 'bar']]));
        $this->assertSame('<div class="foo"></div>', (string) div(['class' => ['foo' => true, 'bar' => false]]));
        $this->assertSame('<div class="foo"></div>', (string) div(['class' => ['foo' => 1, 'bar' => '']]));
        $this->assertSame('<div class="foo"></div>', (string) div(['class' => ['foo', 'bar' => false]]));
        $this->assertSame('<div></div>', (string) div(['class' => ['foo' => null, 'bar' => false]]));
    }

    public function testData()
    {
        $this->assertSame('<div></div>', (string) div(['data-key' => null]));
        $this->assertSame('<div></div>', (string) div()->data('key', null));
        $this->assertSame('<div data-key="false"></div>', (string) div(['data-key' => false]));
        $this->assertSame('<div data-key="false"></div>', (string) div()->data('key', false));
        $this->assertSame('<div data-key="true"></div>', (string) div(['data-key' => true]));
        $this->assertSame('<div data-key="1"></div>', (string) div(['data-key' => 1]));
        $this->assertSame('<div data-key="1.1"></div>', (string) div(['data-key' => 1.1]));
        $this->assertSame('<div data-key="0"></div>', (string) div(['data-key' => 0]));
        $this->assertSame('<div data-key="foo"></div>', (string) div(['data-key' => 'foo']));
        $this->assertSame('<div data-key="[&quot;foo&quot;]"></div>', (string) div(['data-key' => ['foo']]));
        $this->assertSame('<div data-key="{&quot;foo&quot;:&quot;bar&quot;}"></div>', (string) div(['data-key' => ['foo' => 'bar']]));
        $this->assertSame('<div data-key="{&quot;foo&quot;:&quot;bar&quot;}"></div>', (string) div()->data('key', ['foo' => 'bar']));
    }

    public function testClone()
    {
        $div = div('Hello ', strong('World'));
        $div2 = clone $div;

        $this->assertNotSame($div, $div2);
        $this->assertSame($div[0], $div2[0]);
        $this->assertNotSame($div[1], $div2[1]);
    }

    public function testArrayAccess()
    {
        $div = div('Hello ', strong('World'));

        $this->assertArrayHasKey(0, $div);
        $this->assertSame('Hello ', $div[0]);
        $this->assertArrayHasKey(1, $div);
        $this->assertSame('World', $div[1][0]);
        $this->assertArrayNotHasKey(2, $div);

        unset($div[0]);
        $this->assertArrayNotHasKey(0, $div);

        $this->assertSame('<div><strong>World</strong></div>', (string) $div);
    }
    
    public function testIterator()
    {
        $div = div(1, 2, 3);

        $value = '';

        foreach ($div as $child) {
            $value .= $child;
        }

        $this->assertSame('123', $value);
    }

    public function testCount()
    {
        $div = div(1, 2, 3);
        $this->assertCount(3, $div);
    }
}
