<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Account;

use Richi\CashFlow\Domain\AbstractDomainEntityCollection;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class AccountCollection extends AbstractDomainEntityCollection
{
    /**
     * {@inheritdoc}
     */
    public function getSupportedEntityClass(): string
    {
        return Account::class;
    }
}
