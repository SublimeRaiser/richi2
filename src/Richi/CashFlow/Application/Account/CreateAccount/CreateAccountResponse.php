<?php

declare(strict_types=1);

namespace Richi\CashFlow\Application\Account\CreateAccount;

use Richi\CashFlow\Domain\EntityId;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class CreateAccountResponse
{
    /**
     * @param string $accountId
     */
    public function __construct(
        public string $accountId,
    ) {}
}
