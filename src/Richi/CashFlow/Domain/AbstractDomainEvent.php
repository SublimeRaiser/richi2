<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractDomainEvent implements DomainEventInterface
{
    /**
     * @var \DateTimeImmutable
     */
    protected \DateTimeImmutable $occurredAt;

    public function __construct()
    {
        $this->occurredAt = new \DateTimeImmutable();
    }

    /**
     * {@inheritdoc}
     */
    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}
