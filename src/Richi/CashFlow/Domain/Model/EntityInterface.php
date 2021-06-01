<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Model;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
interface EntityInterface
{
    /**
     * Returns the ID of the entity.
     *
     * @return DomainIdInterface
     */
    public function getId(): DomainIdInterface;
}
