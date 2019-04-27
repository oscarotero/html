<?php
declare(strict_types = 1);

namespace Html;

use JsonSerializable;
use Serializable;

interface ElementInterface extends JsonSerializable, Serializable
{
    public function __call(string $name, array $arguments): ElementInterface;

    public function __toString(): string;
}
