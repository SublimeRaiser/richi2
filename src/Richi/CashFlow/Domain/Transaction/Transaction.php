<?php

declare(strict_types=1);

namespace Richi\CashFlow\Domain\Transaction;

use Richi\CashFlow\Domain\AbstractEntity;
use Richi\CashFlow\Domain\Amount;
use Richi\CashFlow\Domain\Account\Account;

/**
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class Transaction extends AbstractEntity
{
    /**
     * @param TransactionId $id
     * @param Account       $account
     * @param Amount        $amount
     */
    public function __construct(
        private TransactionId $id,
        private Account       $account,
        private Amount        $amount,
    ) {}

    /**
     * @return TransactionId
     */
    public function getId(): TransactionId
    {
        return $this->id;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }
}
