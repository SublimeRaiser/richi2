<?php

declare(strict_types=1);

namespace Richi\CashFlow\Infrastructure\Domain\Model\Account;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Richi\CashFlow\Domain\Model\Account\Account;
use Richi\CashFlow\Domain\Model\Account\AccountId;
use Richi\CashFlow\Domain\Model\Account\AccountRepositoryInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class DoctrineAccountRepository implements AccountRepositoryInterface
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
