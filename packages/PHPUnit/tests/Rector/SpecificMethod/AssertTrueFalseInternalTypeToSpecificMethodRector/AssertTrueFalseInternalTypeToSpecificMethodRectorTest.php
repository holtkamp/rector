<?php

declare(strict_types=1);

namespace Rector\PHPUnit\Tests\Rector\SpecificMethod\AssertTrueFalseInternalTypeToSpecificMethodRector;

use Iterator;
use Rector\PHPUnit\Rector\SpecificMethod\AssertTrueFalseInternalTypeToSpecificMethodRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class AssertTrueFalseInternalTypeToSpecificMethodRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideDataForTest()
     */
    public function test(string $file): void
    {
        $this->doTestFile($file);
    }

    public function provideDataForTest(): Iterator
    {
        yield [__DIR__ . '/Fixture/fixture.php.inc'];
    }

    protected function getRectorClass(): string
    {
        return AssertTrueFalseInternalTypeToSpecificMethodRector::class;
    }
}
