<?php

declare(strict_types=1);

namespace Richi\CashFlow\Application\Account;

use Richi\CashFlow\Domain\Model\Account\Account;
use Richi\CashFlow\Domain\Model\Account\AccountRepositoryInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class AccountCreateService
{
    /**
     * @var AccountRepositoryInterface
     */
    private AccountRepositoryInterface $accountRepo;

    /**
     * @param AccountRepositoryInterface $accountRepo
     */
    public function __construct(AccountRepositoryInterface $accountRepo)
    {
        $this->accountRepo = $accountRepo;
    }

    /**
     * Processes the account creation request.
     *
     * @param AccountCreateRequest $request
     */
    public function execute(AccountCreateRequest $request): void
    {
        $account = new Account(
            $this->accountRepo->nextId(),
            $request->getName(),
            $request->getDescription(),
            $request->getIcon(),
            $request->getInitialBalance(),
            $request->isArchived()
        );

        $this->accountRepo->add($account);
    }
}
