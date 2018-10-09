<?php

namespace app\services\prize;

use app\models\Prize;
use app\models\Product;
use app\models\UserPrize;
use app\models\PrizeProduct;

class PrizeProductService implements PrizeInterface
{
    // TODO: Not checked for workability yet
    public function generate()
    {
        $userPrizeModel = new UserPrize();
        $userPrizeModel->prize_type = Prize::TYPE_PRODUCT;
        $userPrizeModel->save();

        $model = new PrizeProduct();
        $model->link('UserPrise', $userPrizeModel);
        $model->save();

        $products = $model->getProducts();
        $item = rand(0, (count($products)-1));

        /** @var Product $product */
        $product = $products[$item];

        $product->is_reserved = true;
        $product->save();

        return $product;
    }

    // TODO: Not implemented yet
    public function refuse($model)
    {
        $model->delete();
    }
}