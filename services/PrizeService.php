<?php

namespace app\models;

use Yii;

/**
 * Service that generates a prize
 */
class PrizeService
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
     * Generate a prize
     */
    public function generate()
    {
        // Magic
    }
}
