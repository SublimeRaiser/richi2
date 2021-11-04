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
        private string    $name,
        private ?string   $description,
        private ?string   $icon,                // Icon (VO)
        private int       $initialBalance,      // Amount (VO)
        private bool      $archived,
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
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->assertValidName($name);
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->assertValidDescription($description);
        $this->description = $description;
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

    /**
     * @param string $name
     */
    private function assertValidName(string $name): void
    {
        $this->assertNotEmpty($name, 'Account name');
    }

    /**
     * @param string $description
     */
    private function assertValidDescription(string $description): void
    {
        $this->assertNotEmpty($description, 'Description');
    }

    /**
     * @param string $value
     * @param string $description
     *
     * @throws \InvalidArgumentException
     */
    private function assertNotEmpty(string $value, string $description): void
    {
        if ($value === '') {
            throw new \InvalidArgumentException(\sprintf('%s cannot be empty string.', $description));
        }
    }
}
