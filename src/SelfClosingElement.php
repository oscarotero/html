<?php
declare(strict_types = 1);

namespace Html;

final class SelfClosingElement implements ElementInterface
{
    use ElementTrait;

    public static function create(string $tagName, array $attributes)
    {
        return new static($tagName, $attributes[0] ?? []);
    }

    public function __toString(): string
    {
        return $this->getOpeningHtml();
    }

    public function jsonSerialize()
    {
        return [
            'tag' => $this->tagName,
            'attributes' => $this->attributes
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
    }
}
