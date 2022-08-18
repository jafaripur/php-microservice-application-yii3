<?php

declare(strict_types=1);

namespace Araz\Micro\Tests\Unit;

use Araz\Micro\Test\UserComponent;

final class UnitUserComponentTest extends \Codeception\Test\Unit
{
    public function testCheckAddition(): void
    {
        $object = new UserComponent();

        $this->assertEquals($object->add(10, 2), (float)12);

        $this->assertNotEquals($object->add(10, 2), (float)13);
    }
}
