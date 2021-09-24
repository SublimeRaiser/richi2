<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Account;

use Richi\CashFlow\Domain\AbstractAggregateRoot;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class Account extends AbstractAggregateRoot
{
    /**
     * @param AccountId   $id
     * @param string      $name
     * @param string|null $description
     * @param string|null $icon
     * @param int         $initialBalance
     * @param bool        $archived
     */
    public function __construct(
        private AccountId $id,
        private string $name,
        private ?string $description,
        private ?string $icon,
        private int $initialBalance,
        private bool $archived,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getId(): AccountId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @return int
     */
    public function getInitialBalance(): int
    {
        return $this->initialBalance;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }








    public function archive(): void
    {
        $this->archived = true;
    }

    public function dearchive(): void
    {
        $this->archived = false;
    }
}
