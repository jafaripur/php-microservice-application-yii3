<?php

declare(strict_types=1);

namespace Araz\Micro\Test;

final class UserComponent
{
    /**
     * Two number addition.
     */
    public function add(float $a, float $b): float
    {
        return $a + $b;
    }
}
