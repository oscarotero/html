<?php
declare(strict_types = 1);

namespace Html\Tests;

use function Html\array2Html;
use function Html\div;
use function Html\raw;
use function Html\strong;
use PHPUnit\Framework\TestCase;

class SerializableTest extends TestCase
{
    public function testJson()
    {
        $div = div('Hello ', strong(raw('<em>World</em>')))->hidden();
        $expected = [
            'tag' => 'div',
            'attributes' => [
                'hidden' => true,
            ],
            'children' => [
                'Hello ',
                [
                    'tag' => 'strong',
                    'attributes' => [],
                    'children' => [
                        [
                            'tag' => 'raw',
                            'children' => [
                                '<em>World</em>',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertSame(json_encode($expected), json_encode($div));
        $this->assertEquals($expected, json_decode(json_encode($div), true));

        $div2 = array2Html($expected);
        $this->assertSame((string) $div, (string) $div2);
    }

    public function testSerialize()
    {
        $div = div('Hello ', strong(raw('<em>World</em>')))->hidden();

        $ser = \serialize($div);
        $div2 = \unserialize($ser);

        $this->assertSame((string) $div, (string) $div2);
    }
}
