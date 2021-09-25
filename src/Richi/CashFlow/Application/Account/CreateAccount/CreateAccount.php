<?php

declare(strict_types=1);

namespace Richi\CashFlow\Application\Account\CreateAccount;

use Richi\CashFlow\Domain\Account\AccountFactory;
use Richi\CashFlow\Domain\Account\AccountRepositoryInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class CreateAccount
{
    /**
     * @param AccountFactory             $accountFactory
     * @param AccountRepositoryInterface $accountRepo
     */
    public function __construct(
        private AccountFactory             $accountFactory,
        private AccountRepositoryInterface $accountRepo,
    ) {}

    /**
     * Processes the account creation request.
     *
     * @param CreateAccountRequest $request
     *
     * @return CreateAccountResponse
     */
    public function execute(CreateAccountRequest $request): CreateAccountResponse
    {
        $name           = $request->name;
        $description    = $request->description;
        $icon           = $request->icon;
        $initialBalance = $request->initialBalance;
        $archived       = $request->archived;
        $account        = $this->getAccountFactory()->create($name, $description, $icon, $initialBalance, $archived);
        $this->getAccountRepo()->save($account);

        return new CreateAccountResponse((string) $account->getId());
    }

    /**
     * @return AccountFactory
     */
    private function getAccountFactory(): AccountFactory
    {
        return $this->accountFactory;
    }

    /**
     * @return AccountRepositoryInterface
     */
    private function getAccountRepo(): AccountRepositoryInterface
    {
        return $this->accountRepo;
    }
}
