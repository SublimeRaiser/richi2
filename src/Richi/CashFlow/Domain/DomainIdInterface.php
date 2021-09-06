<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
interface DomainIdInterface
{
    public function __toString(): string;

    public function equals(DomainIdInterface $id): bool;

    public function toString(): string;
}
