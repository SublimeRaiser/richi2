<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class Amount
{
    /**
     * @param int $value
     */
    public function __construct(
        protected int $value,
    ) {
        $this->assertValidValue($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param self $amount
     *
     * @return bool
     */
    public function isEqual(self $amount): bool
    {
        return $amount->getValue() === $this->getValue();
    }

    /**
     * @param int $value
     */
    protected function assertValidValue(int $value): void
    {
        $this->assertNotZero($value);
        $this->assertNotNegative($value);
    }

    /**
     * @param int $value
     *
     * @throws \InvalidArgumentException when the amount value is zero
     */
    private function assertNotZero(int $value): void
    {
        if ($value === 0) {
            throw new \InvalidArgumentException('Amount value cannot be zero.');
        }
    }

    /**
     * @param int $value
     *
     * @throws \InvalidArgumentException when the amount value is negative
     */
    private function assertNotNegative(int $value): void
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Amount value cannot be negative.');
        }
    }
}
