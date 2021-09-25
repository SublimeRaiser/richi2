<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
abstract class AbstractEntity
{
    /**
     * Returns the identity of the entity.
     *
     * @return EntityId
     */
    abstract public function getId(): EntityId;
}
