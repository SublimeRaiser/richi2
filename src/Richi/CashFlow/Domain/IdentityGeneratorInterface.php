<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
interface IdentityGeneratorInterface
{
    /**
     * @return string
     */
    public function getNextIdentity(): string;
}
