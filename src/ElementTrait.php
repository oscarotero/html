<?php
declare(strict_types = 1);

namespace Html;

trait ElementTrait
{
    private $tagName;
    private $attributes = [];

    public function __construct(string $tagName, array $attributes = [])
    {
        $this->tagName = $tagName;

        foreach ($attributes as $name => $value) {
            if (is_int($name)) {
                $this->__call($value, []);
            } else {
                $this->__call($name, [$value]);
            }
        }
    }

    public function data(string $key, $value): ElementInterface
    {
        return $this->__call("data-{$key}", [$value]);
    }

    public function __call(string $name, array $arguments): ElementInterface
    {
        $this->attributes[$name] = array_key_exists(0, $arguments) ? $arguments[0] : true;
        return $this;
    }

    private function getOpeningHtml(): string
    {
        $attributes = [];

        foreach ($this->attributes as $name => $value) {
            $attributes[] = self::stringifyAttribute($name, $value);
        }

        $attributes = trim(implode(' ', array_filter($attributes)));

        return sprintf('<%s%s>', $this->tagName, $attributes === '' ? '' : " {$attributes}");
    }

    private static function stringifyAttribute(string $name, $value): string
    {
        if (stripos($name, 'data-') === 0) {
            $value = self::handleDataAttribute($value);
        } elseif (is_array($value)) {
            $value = self::handleArrayAttribute($value);
        }

        if ($value === false || $value === null) {
            return '';
        }

        if ($value === true) {
            return $name;
        }

        if (is_string($value)) {
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        return sprintf('%s="%s"', $name, $value);
    }

    private static function handleDataAttribute($value): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (is_bool($value)) {
            return json_encode($value);
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        return json_encode($value);
    }

    private static function handleArrayAttribute(array $values, string $glue = ' '): ?string
    {
        $filtered = [];

        foreach ($values as $k => $v) {
            if (is_int($k)) {
                if ($v !== '' && $v !== false && $v !== null) {
                    $filtered[] = $v;
                }
                continue;
            }

            if (!empty($v)) {
                $filtered[] = $k;
            }
        }

        if (empty($filtered)) {
            return null;
        }

        return implode($glue, $filtered);
    }
}
