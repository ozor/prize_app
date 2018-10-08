<?php

namespace app\services\prize;

use app\models\Money;
use app\models\Prize;
use app\models\UserPrize;
use app\models\PrizeMoney as PrizeMoneyModel;

class PrizeMoney implements PrizeInterface
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
        $userPrizeModel->save();

        /** @var PrizeMoneyModel $model */
        $model = $userPrizeModel->getPrize();

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
     * @param PrizeMoneyModel $model
     */
    public function refuse($model)
    {
        $transaction = PrizeMoneyModel::getDb()->beginTransaction();

        $moneyModel = $model->getMoney();
        $moneyModel->amount += $model->amount;
        $moneyModel->save();

        $model->delete();

        $transaction->commit();
    }

    /**
     * @param PrizeMoneyModel $model
     * @param float $amount
     */
    private function moveMoneyToUser($model, $amount)
    {
        $transaction = PrizeMoneyModel::getDb()->beginTransaction();

        $model->amount = $amount;
        $model->save();

        $moneyModel = $model->getMoney();
        $moneyModel->amount -= $amount;
        $moneyModel->save();

        $transaction->commit();
    }
}