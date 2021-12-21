<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain\Transaction;

use Richi\CashFlow\Domain\AbstractEntity;
use Richi\CashFlow\Domain\Account\Account;
use Richi\CashFlow\Domain\Amount;
use Richi\CashFlow\Domain\Transaction\Transaction;
use Richi\CashFlow\Domain\Transaction\TransactionId;
use PHPUnit\Framework\TestCase;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class TransactionTest extends TestCase
{
    public function testItSuccessfullyCreated(): void
    {
        $transactionId = new TransactionId('777');
        $account       = $this->createMock(Account::class);
        $amount        = new Amount(-10000);
        $transaction   = new Transaction($transactionId, $account, $amount);

        $this->assertInstanceOf(AbstractEntity::class, $transaction);
        $this->assertInstanceOf(TransactionId::class, $transaction->getId());
        $this->assertInstanceOf(Account::class, $transaction->getAccount());
        $this->assertInstanceOf(Amount::class, $transaction->getAmount());
        $this->assertSame('777', (string) $transaction->getId());
        $this->assertSame($account, $transaction->getAccount());
        $this->assertSame(-10000, (int) $transaction->getAmount()->getValue());
    }
}
