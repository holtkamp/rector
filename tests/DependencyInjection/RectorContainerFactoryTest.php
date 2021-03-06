<?php

declare(strict_types=1);

namespace Rector\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Rector\DependencyInjection\RectorContainerFactory;
use Rector\Exception\Configuration\SetNotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class RectorContainerFactoryTest extends TestCase
{
    public function test(): void
    {
        $rectorContainerFactory = new RectorContainerFactory();

        $rectorContainer = $rectorContainerFactory->createFromSet('doctrine');
        $this->assertInstanceOf(ContainerInterface::class, $rectorContainer);
    }

    public function testMissingSet(): void
    {
        $rectorContainerFactory = new RectorContainerFactory();

        $this->expectException(SetNotFoundException::class);
        $rectorContainerFactory->createFromSet('bla');
    }
}
