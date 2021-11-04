<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain\Account;

use PHPUnit\Framework\TestCase;
use Richi\CashFlow\Domain\Account\AccountId;
use Richi\CashFlow\Domain\Amount;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class AccountIdTest extends TestCase
{
    public function testItSuccessfullyCreated(): void
    {
        $accountId = new AccountId('777');

        $this->assertSame('777', $accountId->getValue());
    }

    public function testItFailsWithEmptyIdString(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Domain entity ID cannot be empty string.');
        new AccountId('');
    }

    public function testItStringifyable(): void
    {
        $accountId = new AccountId('777');

        $this->assertSame('777', (string) $accountId);
    }

    public function testItComparable(): void
    {
        $accountIdA = new AccountId('777');
        $accountIdB = new AccountId('888');
        $accountIdC = new AccountId('777');

        $this->assertFalse($accountIdA->isEqual($accountIdB));
        $this->assertTrue($accountIdA->isEqual($accountIdC));
        $this->assertFalse($accountIdB->isEqual($accountIdC));
    }
}
