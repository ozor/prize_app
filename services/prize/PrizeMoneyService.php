<?php

namespace app\services\prize;

use app\models\Money;
use app\models\Prize;
use app\models\UserPrize;
use app\models\PrizeMoney;

class PrizeMoneyService implements PrizeInterface
{
    /**
     * TODO: Not checked for workability yet
     *
     * @return int
     * @throws \Exception
     */
    public function generate()
    {
        $userPrizeModel = new UserPrize();
        $userPrizeModel->prize_type = Prize::TYPE_MONEY;
        $userPrizeModel->save(false);

        $model = new PrizeMoney();
        $userPrizeModel->save(false);
        $model->link('userPrise', $userPrizeModel);
        $model->link('money', Money::find()->one());

        $amount = rand($model->getMinAmount(), $model->getMaxAmount());

        if ($amount == 0) {
            throw new \Exception("No money here");
        }

        $this->moveMoneyToUser($model, $amount);

        return $amount;
    }

    /**
     * TODO: Not checked for workability yet
     *
     * @param PrizeMoney $model
     */
    public function refuse($model)
    {
        $transaction = PrizeMoney::getDb()->beginTransaction();

        $moneyModel = $model->getMoney();
        $moneyModel->amount += $model->amount;
        $moneyModel->save(false);

        $model->delete();

        $transaction->commit();
    }

    /**
     * @param PrizeMoney $model
     * @param float $amount
     */
    private function moveMoneyToUser($model, $amount)
    {
        $transaction = PrizeMoney::getDb()->beginTransaction();

        $model->amount = $amount;
        $model->save(false);

        $moneyModel = $model->getMoney();
        $moneyModel->amount -= $amount;
        $moneyModel->save(false);

        $transaction->commit();
    }
}