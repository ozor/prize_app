<?php

namespace app\models;

use yii\db\ActiveRecord;

class Money extends ActiveRecord
{
    /**
     * @var int
     */
    public $id;

    /**
     * Amount of money currently presents in our deposit
     *
     * @var float
     */
    public $amount;
}