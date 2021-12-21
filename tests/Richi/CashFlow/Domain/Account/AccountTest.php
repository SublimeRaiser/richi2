<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain\Account;

use PHPUnit\Framework\TestCase;
use Richi\CashFlow\Domain\Account\AccountId;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class AccountTest extends TestCase
{
    private AccountId $accountId;

    public function setUp(): void
    {
        $this->accountId = new AccountId('777');
    }

    public function testItSuccessfullyCreated(): void
    {
        $this->markTestIncomplete();
    }
}
