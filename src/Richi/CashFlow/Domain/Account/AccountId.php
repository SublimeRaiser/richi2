<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Account;

use Richi\CashFlow\Domain\AbstractDomainEntityId;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class AccountId extends AbstractDomainEntityId
{
    /**
     * @param string $id
     */
    protected function setId(string $id): void
    {
        if ($id === '') {
            throw new \InvalidArgumentException('Account ID cannot be empty string.');
        }
        $this->id = $id;
    }
}
