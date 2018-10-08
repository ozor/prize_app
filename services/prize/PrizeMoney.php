<?php

namespace app\services\prize;

use app\models\Prize;
use app\models\UserPrize;
use app\models\PrizeMoney as PrizeMoneyModel;

class PrizeMoney implements PrizeInterface
{
    // TODO: Not checked for workability yet
    public function generate()
    {
        $userPrizeModel = new UserPrize();
        $userPrizeModel->prize_type = Prize::TYPE_MONEY;

        /** @var PrizeMoneyModel $model */
        $model = $userPrizeModel->getPrize();

        $amount = rand($model->getMinAmount(), $model->getMaxAmount());

        $model->amount = $amount;
        $model->getMoney()->amount -= $amount;
        // TODO: Save changes

        return $amount;
    }

    // TODO: Not implemented yet
    public function refuse()
    {
        // TODO
    }
}