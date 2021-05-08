<?php

declare(strict_types=1);

namespace Richi\Tests\CashFlow\Application\Account;

use PHPUnit\Framework\TestCase;
use Richi\CashFlow\Domain\Model\Account\Account;

class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $account = new Account('111', 'description', '/var/www/richi/public/icon.ico', false);

        self::assertNotNull($account->getId());
        self::assertNotNull($account->getDescription());
        self::assertNotNull($account->getIcon());
        self::assertFalse($account->isActive());
    }
}
