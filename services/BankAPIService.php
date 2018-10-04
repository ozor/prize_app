<?php

namespace app\models;

use Yii;

/**
 * Service that works with the Bank API
 */
class BankAPIService
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
     * Sending money to the client's account via bank API
     */
    public function sendToAccount()
    {
        // Sending will be here here
    }
}
