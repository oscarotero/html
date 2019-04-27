<?php
declare(strict_types = 1);

namespace Html;

use InvalidArgumentException;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Countable;

class Element extends SelfClosingElement implements ElementInterface, ArrayAccess, IteratorAggregate, Countable
{
    use ElementTrait;

    private $children = [];

    public static function create(string $tagName, array $children)
    {
        if (isset($children[0]) && is_array($children[0])) {
            $attributes = array_shift($children);

            $element = new static($tagName, $attributes);
        } else {
            $element = new static($tagName);
        }

        if ($children) {
            return $element->append(...$children);
        }

        return $element;
    }

    public function __clone()
    {
        foreach ($this->children as &$child) {
            if ($child instanceof ElementInterface) {
                $child = clone $child;
            }
        }
    }

    public function __toString(): string
    {
        $content = implode('', $this->children);

        return sprintf('%s%s</%s>', $this->getOpeningHtml(), $content, $this->tagName);
    }

    public function jsonSerialize()
    {
        return [
            'tag' => $this->tagName,
            'attributes' => $this->attributes,
            'children' => $this->children
        ];
    }

    public function serialize()
    {
        return serialize($this->jsonSerialize());
    }

    public function unserialize($data)
    {
        $data = unserialize($data);

        $this->tagName = $data['tag'];
        $this->attributes = $data['attributes'];
        $this->children = $data['children'];
    }

    public function append(...$children): self
    {
        foreach ($children as $child) {
            $this->offsetSet(null, $child);
        }

        return $this;
    }

    public function offsetExists($offset)
    {
        return isset($this->children[$offset]);
    }
    public function offsetGet($offset)
    {
        return $this->children[$offset] ?? null;
    }
    public function offsetSet($offset, $value)
    {
        if (!\is_scalar($value) && !($value instanceof ElementInterface)) {
            throw new InvalidArgumentException(
                sprintf('Invalid child. Must be a scalar or an object implementing %s', ElementInterface::class)
            );
        }

        if ($offset === null) {
            $this->children[] = $value;
        } else {
            $this->children[$offset] = $value;
        }
    }
    public function offsetUnset($offset)
    {
        unset($this->children[$offset]);
    }
    public function getIterator()
    {
        return new ArrayIterator($this->children);
    }
    public function count(): int
    {
        return count($this->children);
    }
}
