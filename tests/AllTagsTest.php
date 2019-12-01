<?php
declare(strict_types = 1);

namespace Html\Tests;

use Html\Element;
use Html\SelfClosingElement;
use PHPUnit\Framework\TestCase;

class AllTagsTest extends TestCase
{
    public function tagProvider(): array
    {
        return [
            ['a'],
            ['abbr'],
            ['address'],
            ['area', true],
            ['article'],
            ['aside'],
            ['audio'],
            ['b'],
            ['base', true],
            ['bdi'],
            ['bdo'],
            ['blockquote'],
            ['body'],
            ['br', true],
            ['button'],
            ['canvas'],
            ['caption'],
            ['cite'],
            ['code'],
            ['col', true],
            ['colgroup'],
            ['data'],
            ['datalist'],
            ['dd'],
            ['del'],
            ['details'],
            ['dfn'],
            ['dialog'],
            ['div'],
            ['dl'],
            ['dt'],
            ['em'],
            ['embed', true],
            ['fieldset'],
            ['figcaption'],
            ['figure'],
            ['footer'],
            ['form'],
            ['h1'],
            ['h2'],
            ['h3'],
            ['h4'],
            ['h5'],
            ['h6'],
            ['header'],
            ['hr', true],
            ['html'],
            ['head'],
            ['i'],
            ['iframe'],
            ['img', true],
            ['input', true],
            ['ins'],
            ['kbd'],
            ['label'],
            ['legend'],
            ['li'],
            ['link', true],
            ['main'],
            ['map'],
            ['mark'],
            ['meta', true],
            ['meter'],
            ['nav'],
            ['noscript'],
            ['object'],
            ['ol'],
            ['optgroup'],
            ['option'],
            ['output'],
            ['p'],
            ['param', true],
            ['picture'],
            ['pre'],
            ['progress'],
            ['q'],
            ['rb'],
            ['rp'],
            ['rt'],
            ['rtc'],
            ['ruby'],
            ['s'],
            ['samp'],
            ['script'],
            ['section'],
            ['select'],
            ['small'],
            ['source', true],
            ['span'],
            ['slot'],
            ['strong'],
            ['style'],
            ['sub'],
            ['summary'],
            ['sup'],
            ['table'],
            ['tbody'],
            ['td'],
            ['template'],
            ['textarea'],
            ['tfoot'],
            ['th'],
            ['thead'],
            ['time'],
            ['title'],
            ['tr'],
            ['track', true],
            ['u'],
            ['ul'],
            ['variable', false, 'var'],
            ['video'],
            ['wbr', true],
        ];
    }

    /**
     * @dataProvider tagProvider
     */
    public function testTag(string $fnName, bool $autoclose = false, string $tagName = null)
    {
        $tagName = $tagName ?: $fnName;
        $fn = "Html\\{$fnName}";
        $tag = $fn();

        if ($autoclose) {
            $this->assertSame("<{$tagName}>", (string) $tag);
            $this->assertInstanceOf(SelfClosingElement::class, $tag);
        } else {
            $this->assertSame("<{$tagName}></{$tagName}>", (string) $tag);
            $this->assertInstanceOf(Element::class, $tag);
        }
    }

    public function testScript()
    {
        $text = 'console.log("<b>hello world</b>")';
        $tag = \Html\script($text);

        $this->assertSame("<script>{$text}</script>", (string) $tag);
    }

    public function testStyle()
    {
        $text = '.foo > div::after { content: ""; }';
        $tag = \Html\style($text);

        $this->assertSame("<style>{$text}</style>", (string) $tag);
    }
}
