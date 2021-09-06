<?php

declare(strict_types=1);

namespace Richi\CashFlow\Infrastructure\Domain\Account\DoctrineORM;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Richi\CashFlow\Domain\Account\Account;
use Richi\CashFlow\Domain\Account\AccountId;
use Richi\CashFlow\Domain\Account\AccountRepositoryInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class DoctrineORMAccountRepository implements AccountRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function nextId(): AccountId
    {
        return new AccountId(Uuid::uuid4()->toString());
    }

    /**
     * {@inheritdoc}
     */
    public function add(Account $account): void
    {
        $this->getEntityManager()->persist($account);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(Account $account): void
    {
        $this->getEntityManager()->remove($account);
    }

    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
