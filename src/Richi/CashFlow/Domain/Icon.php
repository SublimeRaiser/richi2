<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class Icon
{
    /**
     * @param string $filePath
     */
    public function __construct(
        protected string $filePath,
    ) {
        $this->assertValidFilePath($filePath);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getFilePath();
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param self $icon
     *
     * @return bool
     */
    public function isEqual(self $icon): bool
    {
        return $icon->getFilePath() === $this->getFilePath();
    }

    /**
     * @param string $filePath
     */
    protected function assertValidFilePath(string $filePath): void
    {
        $this->assertNotEmpty($filePath);
    }

    /**
     * @param string $filePath
     *
     * @throws \InvalidArgumentException when the file path is an empty string
     */
    private function assertNotEmpty(string $filePath): void
    {
        if ($filePath === '') {
            throw new \InvalidArgumentException('File path cannot be empty string.');
        }
    }
}
