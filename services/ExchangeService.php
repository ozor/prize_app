<?php

namespace app\services;

use app\models\Money;
use app\models\PrizeLoyalty;
use app\models\PrizeMoney;
use Yii;

/**
 * Service for money exchange and loyalty points
 */
class ExchangeService
{

    /**
     * Exchange money to loyalty points
     *
     * TODO: Not implemented yet
     */
    public function exchangeMoneyToLoyalty()
    {
        // TODO: Exchange will be here
        $moneyModel = new Money();
        $moneyAmout = $moneyModel->amount;

        $prizeLoyaltyModel = new PrizeLoyalty();
        $exchangeAmount = ($prizeLoyaltyModel->amount / PrizeLoyalty::EXCHANGE_RATE);

        if ($moneyAmout >= $exchangeAmount) {
            $transaction = Money::getDb()->beginTransaction();

            $moneyModel->amount -= $exchangeAmount;
            $moneyModel->save();

            $prizeMoneyModel = new PrizeMoney();
            $prizeMoneyModel->amount = $exchangeAmount;
            // TODO: SetMoney
            // TODO: SetUserPrize
            $prizeMoneyModel->save();

            $prizeLoyaltyModel->delete();

            $transaction->commit();
        }
    }
}
