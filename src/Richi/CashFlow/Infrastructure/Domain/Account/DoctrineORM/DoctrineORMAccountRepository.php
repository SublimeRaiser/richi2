<?php

declare(strict_types=1);

namespace Richi\CashFlow\Infrastructure\Domain\Account\DoctrineORM;

use Doctrine\ORM\EntityManagerInterface;
use Richi\CashFlow\Domain\Account\Account;
use Richi\CashFlow\Domain\Account\AccountCollection;
use Richi\CashFlow\Domain\Account\AccountId;
use Richi\CashFlow\Domain\Account\AccountRepositoryInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class DoctrineORMAccountRepository implements AccountRepositoryInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function save(Account $account): void
    {
        $this->getEntityManager()->persist($account);
    }

    /**
     * {@inheritdoc}
     */
    public function saveAll(AccountCollection $accounts): void
    {
        foreach ($accounts as $account) {
            $this->save($account);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findById(AccountId $accountId): ?Account
    {
        return $this->getEntityManager()->find(Account::class, (string) $accountId);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(Account $account): void
    {
        $this->getEntityManager()->remove($account);
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll(AccountCollection $accounts): void
    {
        foreach ($accounts as $account) {
            $this->remove($account);
        }
    }

    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
