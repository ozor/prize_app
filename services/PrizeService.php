<?php

namespace app\services;

use app\models\Prize;
use app\models\UserPrize;
use app\services\prize\PrizeFactory;
use Yii;

/**
 * Service that generates a prize
 */
class PrizeService
{
    /**
     * Prize type (money|products|loyalty points)
     *
     * @var string
     */
    private $prizeType;

    /**
     * Amount|count of prize(s)
     *
     * @var float
     */
    private $prizeValue;

    /**
     * Generates a prize
     */
    public function generate()
    {
        $this->generatePrizeType();
        $this->generatePrizeValue();
    }

    /**
     * Refuses a prize
     */
    public function refuse($id)
    {
        /** @var UserPrize $model */
        $model = null; // TODO: Correct Prize model!

        PrizeFactory::getPrize($model->prizeType)->refuse();
    }

    private function generatePrizeType()
    {
        $prizeTypes = Prize::getAvailableTypes();
        $item = rand(0, (count($prizeTypes)-1));

        $this->prizeType = $prizeTypes[$item];
    }

    private function generatePrizeValue()
    {
        $userPrizeModel = new UserPrize();
        $userPrizeModel->prize_type = $this->prizeType;

        $this->prizeValue = PrizeFactory::getPrize($this->prizeType)->generate();
    }

    /**
     * @return string
     */
    public function getPrizeType()
    {
        return $this->prizeType;
    }

    /**
     * @return float
     */
    public function getPrizeValue()
    {
        return $this->prizeValue;
    }
}
