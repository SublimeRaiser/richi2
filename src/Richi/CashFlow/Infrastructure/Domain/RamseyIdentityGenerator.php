<?php

declare(strict_types=1);

namespace Richi\CashFlow\Infrastructure\Domain;

use Richi\CashFlow\Domain\IdentityGeneratorInterface;
use Ramsey\Uuid\UuidFactory;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class RamseyIdentityGenerator implements IdentityGeneratorInterface
{
    /**
     * @param UuidFactory $uuidFactory
     */
    public function __construct(
        private UuidFactory $uuidFactory,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getNextIdentity(): string
    {
        return $this->getUuidFactory()->uuid4()->toString();
    }

    /**
     * @return UuidFactory
     */
    private function getUuidFactory(): UuidFactory
    {
        return $this->uuidFactory;
    }
}
