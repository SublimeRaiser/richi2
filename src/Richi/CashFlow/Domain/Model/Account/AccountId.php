<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Model\Account;

use Richi\CashFlow\Domain\Model\DomainIdInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class AccountId implements DomainIdInterface
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function equals(DomainIdInterface $id): bool
    {
        return $this === $id;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->id;
    }
}
