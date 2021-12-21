<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain\Transaction;

use Richi\CashFlow\Domain\Transaction\TransactionId;
use Richi\Tests\CashFlow\Domain\AbstractEntityIdTest;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class TransactionIdTest extends AbstractEntityIdTest
{
    protected string $className = TransactionId::class;
}
