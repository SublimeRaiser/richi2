<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Account;

use Richi\CashFlow\Domain\IdentityGeneratorInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class AccountFactory
{
    /**
     * @param IdentityGeneratorInterface $identityGenerator
     */
    public function __construct(
        private IdentityGeneratorInterface $identityGenerator
    ) {}

    /**
     * Creates an object for the account.
     *
     * @param string      $name
     * @param string|null $description
     * @param string|null $icon
     * @param int         $initialBalance
     * @param bool        $archived
     *
     * @return Account
     */
    public function create(
        string  $name,
        ?string $description,
        ?string $icon,
        int     $initialBalance,
        bool    $archived,
    ): Account {
        $nextId = new AccountId($this->getIdentityGenerator()->getNextIdentity());

        return new Account($nextId, $name, $description, $icon, $initialBalance, $archived);
    }

    /**
     * @return IdentityGeneratorInterface
     */
    private function getIdentityGenerator(): IdentityGeneratorInterface
    {
        return $this->identityGenerator;
    }
}
