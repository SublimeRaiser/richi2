<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain;

use PHPUnit\Framework\TestCase;
use Richi\CashFlow\Domain\Icon;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class IconTest extends TestCase
{
    public function testItSuccessfullyCreated(): void
    {
        $icon = new Icon('some/path/to/file');

        $this->assertSame('some/path/to/file', $icon->getFilePath());
    }

    public function testItFailsWithEmptyFilePathString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('File path cannot be empty string.');
        new Icon('');
    }

    public function testItStringifyable(): void
    {
        $icon = new Icon('some/path/to/file');

        $this->assertSame('some/path/to/file', (string) $icon);
    }

    public function testItComparable(): void
    {
        $iconA = new Icon('some/path/to/fileA');
        $iconB = new Icon('some/path/to/fileB');
        $iconC = new Icon('some/path/to/fileA');

        $this->assertFalse($iconA->isEqual($iconB));
        $this->assertTrue($iconA->isEqual($iconC));
        $this->assertFalse($iconB->isEqual($iconC));
    }
}
