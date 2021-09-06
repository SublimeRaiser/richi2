<?php

declare(strict_types=1);

namespace Richi\CashFlow\Infrastructure\Domain;

use Richi\CashFlow\Domain\IdentityGeneratorInterface;
use Ramsey\Uuid\UuidFactory;

/**
 * @author Nikolay Ryabkov <nikolay.ryabkov@sibers.com>
 */
final class RamseyIdentityGenerator implements IdentityGeneratorInterface
{
    /**
     * @var UuidFactory
     */
    private UuidFactory $uuidFactory;

    /**
     * @param UuidFactory $uuidFactory
     */
    public function __construct(UuidFactory $uuidFactory)
    {
        $this->uuidFactory = $uuidFactory;
    }

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
