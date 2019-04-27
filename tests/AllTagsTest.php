<?php
declare(strict_types = 1);

namespace Html\Tests;

use PHPUnit\Framework\TestCase;
use Html\Element;
use Html\SelfClosingElement;

class AllTagsTest extends TestCase
{
    public function tagProvider(): array
    {
        return [
            ['html'],
            ['base', true],
            ['head'],
            ['link', true],
            ['meta', true],
            ['style'],
            ['title'],
            ['body'],
            ['address'],
            ['article'],
            ['aside'],
            ['footer'],
            ['header'],
            ['h1'],
            ['h2'],
            ['h3'],
            ['h4'],
            ['h5'],
            ['h6'],
            ['main'],
            ['nav'],
            ['section'],
            ['blockquote'],
            ['dd'],
            ['div'],
            ['dl'],
            ['dt'],
            ['figcaption'],
            ['figure'],
            ['hr', true],
            ['li'],
            ['ol'],
            ['p'],
            ['pre'],
            ['ul'],
            ['a'],
            ['abbr'],
            ['b'],
            ['bdi'],
            ['bdo'],
            ['br', true],
            ['cite'],
            ['code'],
            ['data'],
            ['dfn'],
            ['em'],
            ['i'],
            ['kbd'],
            ['mark'],
            ['q'],
            ['rb'],
            ['rp'],
            ['rt'],
            ['rtc'],
            ['ruby'],
            ['s'],
            ['samp'],
            ['small'],
            ['span'],
            ['strong'],
            ['sub'],
            ['sup'],
            ['time'],
            ['u'],
            ['variable', false, 'var'],
            ['wbr', true],
            ['area'],
            ['audio'],
            ['img', true],
            ['map'],
            ['track'],
            ['video'],
            ['embed'],
            ['iframe'],
            ['object'],
            ['param'],
            ['picture'],
            ['source'],
            ['canvas'],
            ['noscript'],
            ['script'],
            ['del'],
            ['ins'],
            ['caption'],
            ['col'],
            ['colgroup'],
            ['table'],
            ['tbody'],
            ['td'],
            ['tfoot'],
            ['th'],
            ['thead'],
            ['tr'],
            ['button'],
            ['datalist'],
            ['fieldset'],
            ['form'],
            ['input', true],
            ['label'],
            ['legend'],
            ['meter'],
            ['optgroup'],
            ['option'],
            ['output'],
            ['progress'],
            ['select'],
            ['textarea'],
            ['details'],
            ['dialog'],
            ['summary'],
            ['slot'],
            ['template'],
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
}
