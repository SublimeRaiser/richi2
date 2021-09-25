<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Account;

use Richi\CashFlow\Domain\AbstractAggregateRoot;
use Richi\CashFlow\Domain\EntityId;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class Account extends AbstractAggregateRoot
{
    /**
     * @param EntityId    $id
     * @param string      $name
     * @param string|null $description
     * @param string|null $icon
     * @param int         $initialBalance
     * @param bool        $archived
     */
    public function __construct(
        private EntityId $id,
        private string   $name,
        private ?string  $description,
        private ?string  $icon,                // Icon (VO)
        private int      $initialBalance,      // Amount (VO)
        private bool     $archived,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getId(): EntityId
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
