<?php

namespace app\models;

use Yii;

/**
 * Service for money exchange and loyalty points
 */
class ExchangeService
{
    /**
     * @var Yii
     */
    private $yii;

    public function __construct(Yii $yii)
    {
        $this->yii = $yii;
    }

    /**
     * Exchange money to loyalty points
     */
    public function exchange()
    {
        // Exchange will be here
    }
}
