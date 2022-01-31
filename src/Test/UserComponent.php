<?php

declare(strict_types=1);

namespace Araz\Micro\Test;

final class UserComponent
{
    /**
     * Two number addition
     *
     * @param  float $a
     * @param  float $b
     * @return float
     */
    public function add(float $a, float $b): float
    {
        return $a + $b;
    }
}
