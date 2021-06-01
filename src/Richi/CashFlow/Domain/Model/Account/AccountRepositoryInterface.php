<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Model\Account;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
interface AccountRepositoryInterface
{
    /**
     * Generates and returns the ID for an account.
     *
     * @return AccountId
     */
    public function nextId(): AccountId;

    /**
     * Adds the account to the repository.
     *
     * @param Account $account
     */
    public function add(Account $account): void;

    /**
     * Removes the account from the repository.
     *
     * @param Account $account
     */
    public function remove(Account $account): void;
}
