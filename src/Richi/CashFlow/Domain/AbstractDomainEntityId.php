<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractDomainEntityId
{
    /**
     * @var string
     */
    protected string $id;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->setId($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param self $id
     *
     * @return bool
     */
    public function isEqual(self $id): bool
    {
        return $id->getId() === $this->getId();
    }

    /**
     * @param string $id
     */
    protected function setId(string $id): void
    {
        if ($id === '') {
            throw new \InvalidArgumentException('Domain entity ID cannot be empty string.');
        }
        $this->id = $id;
    }
}
