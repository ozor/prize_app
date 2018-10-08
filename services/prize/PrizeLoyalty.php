<?php

namespace app\services\prize;

use app\models\Prize;
use app\models\UserPrize;

class PrizeLoyalty implements PrizeInterface
{
    // TODO: Not implemented yet
    public function generate()
    {
        $userPrizeModel = new UserPrize();
        $userPrizeModel->prize_type = Prize::TYPE_PRODUCT;

        // TODO
    }

    // TODO: Not implemented yet
    public function refuse()
    {
        // TODO
    }
}