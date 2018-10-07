<?php

namespace app\models;

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
     * Generate a prize
     */
    public function generate()
    {
        $this->generatePrizeType();
        $this->generatePrizeValue();
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
        $userPrizeModel->prizeType = $this->prizeType;

        switch ($this->prizeType) {
            case Prize::TYPE_PRODUCT:
                return $this->generatePrizeProduct($userPrizeModel);
            case Prize::TYPE_MONEY:
                return $this->generatePrizeMoney($userPrizeModel);
            case Prize::TYPE_LOYALTY:
                return $this->generatePrizeLoyalty($userPrizeModel);
            default:
                throw new \Exception('Unknown Prize type');
        }
    }

    private function generatePrizeProduct($userPrizeModel)
    {
        /** @var PrizeProduct $model */
        $model = $userPrizeModel->getPrize();

        $products = $model->getProducts();
        $item = rand(0, (count($products)-1));

        /** @var Product $product */
        $product = $products[$item];

        $this->prizeValue = $product;
        $product->isReserved = true;

        return $this->prizeValue;
    }

    private function generatePrizeMoney($userPrizeModel)
    {
        /** @var PrizeMoney $model */
        $model = $userPrizeModel->getPrize();

        $this->prizeValue = rand($model->getMinAmount(), $model->getMaxAmount());
        $model->amount = $this->prizeValue;
        $model->getMoney()->amount -= $this->prizeValue;

        return $this->prizeValue;
    }

    private function generatePrizeLoyalty($userPrizeModel)
    {
        /** @var PrizeLoyalty $model */
        $model = $userPrizeModel->getPrize();

        return $this->prizeValue;
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
