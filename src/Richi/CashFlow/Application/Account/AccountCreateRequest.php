<?php

declare(strict_types=1);

namespace Richi\CashFlow\Application\Account;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class AccountCreateRequest
{
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
     * @param string      $name
     * @param string|null $description
     * @param string|null $icon
     * @param int         $initialBalance
     * @param bool        $archived
     */
    public function __construct(
        string $name,
        ?string $description,
        ?string $icon,
        int $initialBalance,
        bool $archived,
    ) {
        $this->name           = $name;
        $this->description    = $description;
        $this->icon           = $icon;
        $this->initialBalance = $initialBalance;
        $this->archived       = $archived;
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
}
