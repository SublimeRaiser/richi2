<?php

declare(strict_types=1);

namespace Richi\CashFlow\Application\Account\CreateAccount;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class CreateAccountRequest
{
    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $icon
     * @param int         $initialBalance
     * @param bool        $archived
     */
    public function __construct(
        public string  $name,
        public ?string $description,
        public ?string $icon,
        public int     $initialBalance,
        public bool    $archived,
    ) {}
}
