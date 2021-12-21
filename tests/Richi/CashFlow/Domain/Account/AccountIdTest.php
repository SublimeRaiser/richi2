<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Domain\Account;

use Richi\CashFlow\Domain\Account\AccountId;
use Richi\Tests\CashFlow\Domain\AbstractEntityIdTest;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class AccountIdTest extends AbstractEntityIdTest
{
    protected string $className = AccountId::class;
}
