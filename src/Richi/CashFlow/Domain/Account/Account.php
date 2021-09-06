<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Account;

use Richi\CashFlow\Domain\EntityInterface;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class Account implements EntityInterface
{
    /**
     * @var AccountId
     */
    private AccountId $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string|null
     */
    private ?string $description;

    /**
     * @var string|null
     */
    private ?string $icon;

    /**
     * @var int
     */
    private int $initialBalance;

    /**
     * @var bool
     */
    private bool $archived;

    /**
     * @param AccountId   $id
     * @param string      $name
     * @param string|null $description
     * @param string|null $icon
     * @param int         $initialBalance
     * @param bool        $archived
     */
    public function __construct(
        AccountId $id,
        string $name,
        ?string $description,
        ?string $icon,
        int $initialBalance,
        bool $archived
    ) {
        $this->id             = $id;
        $this->name           = $name;
        $this->description    = $description;
        $this->icon           = $icon;
        $this->initialBalance = $initialBalance;
        $this->archived       = $archived;
    }

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
