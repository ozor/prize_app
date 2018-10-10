<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * When User win this product, it product marks as reserver and doen't participating in lottery.
     * If User receives this product, the product will be deleted.
     * If User refuse to receive, the product will be unmarked as reserved.
     *
     * @var boolean
     */
    public $is_reserved = false;

    public static function tableName()
    {
        return '{{%product}}';
    }
}