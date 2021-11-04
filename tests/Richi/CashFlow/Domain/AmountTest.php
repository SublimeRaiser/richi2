<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain;

use PHPUnit\Framework\TestCase;
use Richi\CashFlow\Domain\Amount;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class AmountTest extends TestCase
{
    public function testItSuccessfullyCreated(): void
    {
        $icon = new Amount(12345);

        $this->assertSame(12345, $icon->getValue());
    }

    public function testItFailsWithZeroValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount value cannot be zero.');
        new Amount(0);
    }

    public function testItFailsWithNegativeValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount value cannot be negative.');
        new Amount(-100);
    }

    public function testItStringifyable(): void
    {
        $amount = new Amount(12345);

        $this->assertSame('12345', (string) $amount);
    }

    public function testItComparable(): void
    {
        $amountA = new Amount(12345);
        $amountB = new Amount(67890);
        $amountC = new Amount(12345);

        $this->assertFalse($amountA->isEqual($amountB));
        $this->assertTrue($amountA->isEqual($amountC));
        $this->assertFalse($amountB->isEqual($amountC));
    }
}
