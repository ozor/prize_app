<?php

namespace app\services\prize;

use app\models\Prize;
use app\models\UserPrize;
use app\models\PrizeLoyalty;

class PrizeLoyaltyService implements PrizeInterface
{
    // TODO: Not implemented yet
    public function generate()
    {
        $userPrizeModel = new UserPrize();
        $userPrizeModel->prize_type = Prize::TYPE_LOYALTY;

        var_dump($userPrizeModel); exit;
        $userPrizeModel->save();

        $model = new PrizeLoyalty();
        $model->link('UserPrise', $userPrizeModel);
        $model->amount = rand(PrizeLoyalty::MIN_AMOUNT, PrizeLoyalty::MAX_AMOUNT);
        $model->save();
    }

    // TODO: Not implemented yet
    public function refuse($model)
    {
        $model->delete();
    }
}