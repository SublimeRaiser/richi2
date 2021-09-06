<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractDomainEntity
{
    /**
     * Returns the identity of the domain entity.
     *
     * @return AbstractDomainEntityId
     */
    abstract public function getId(): AbstractDomainEntityId;
}
