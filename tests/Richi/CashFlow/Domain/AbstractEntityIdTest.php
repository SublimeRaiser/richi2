<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain;

use PHPUnit\Framework\TestCase;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractEntityIdTest extends TestCase
{
    protected string $className;

    public function testItSuccessfullyCreated(): void
    {
        $accountId = new $this->className('777');

        $this->assertSame('777', $accountId->getValue());
    }

    public function testItFailsWithEmptyIdString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Domain entity ID cannot be empty string.');
        new $this->className('');
    }

    public function testItStringifyable(): void
    {
        $accountId = new $this->className('777');

        $this->assertSame('777', (string) $accountId);
    }

    public function testItComparable(): void
    {
        $accountIdA = new $this->className('777');
        $accountIdB = new $this->className('888');
        $accountIdC = new $this->className('777');

        $this->assertFalse($accountIdA->isEqual($accountIdB));
        $this->assertTrue($accountIdA->isEqual($accountIdC));
        $this->assertFalse($accountIdB->isEqual($accountIdC));
    }
}
