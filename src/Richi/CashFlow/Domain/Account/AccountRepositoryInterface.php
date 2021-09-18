<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Account;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
interface AccountRepositoryInterface
{
    /**
     * Adds the account to the repository. If the account already exist, it will be updated.
     *
     * @param Account $account
     */
    public function save(Account $account): void;

    /**
     * Adds the collection of accounts to the repository. If any of the accounts already exist, they will be updated.
     *
     * @param AccountCollection $accounts
     */
    public function saveAll(AccountCollection $accounts): void;

    /**
     * Returns the account by ID. If no account found, null will be returned.
     *
     * @param AccountId $accountId
     *
     * @return Account|null
     */
    public function findById(AccountId $accountId): ?Account;

    /**
     * Removes the account from the repository.
     *
     * @param Account $account
     */
    public function remove(Account $account): void;

    /**
     * Removes the collection of accounts from the repository.
     *
     * @param AccountCollection $accounts
     */
    public function removeAll(AccountCollection $accounts): void;
}
