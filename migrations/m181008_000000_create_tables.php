<?php

use yii\db\Migration;

class m181008_000000_create_tables extends Migration
{
    public function up()
    {
        $this->createTable('money', [
            'id' => $this->primaryKey(),
            'amount' => $this->float()->notNull(),
        ]);

        $this->createTable('prize_loyalty', [
            'id' => $this->primaryKey(),
            'amount' => $this->float()->notNull(),
            'user_prise_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-user_prise-user_prise_id',
            'prize_loyalty',
            'user_prise_id',
            'user_prise',
            'id',
            'CASCADE'
        );

        $this->createTable('prize_money', [
            'id' => $this->primaryKey(),
            'amount' => $this->float()->notNull(),
            'user_prise_id' => $this->integer()->notNull(),
            'money_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-prize_money-user_prise_id',
            'prize_money',
            'user_prise_id',
            'user_prise',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-money-money_id',
            'prize_money',
            'money_id',
            'money',
            'id',
            'CASCADE'
        );

        $this->createTable('prize_product', [
            'id' => $this->primaryKey(),
            'user_prise_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-prize_money-user_prise_id',
            'prize_money',
            'user_prise_id',
            'user_prise',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-product-product_id',
            'prize_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'is_reserved' => $this->boolean()->notNull(),
        ]);

        $this->createTable('user_prize', [
            'id' => $this->primaryKey(),
            'prize_type' => $this->string()->notNull(),
            'is_received' => $this->boolean()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk-user-user_id',
            'user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('money');
        $this->dropTable('prize_loyalty');
        $this->dropTable('prize_money');
        $this->dropTable('prize_product');
        $this->dropTable('product');
        $this->dropTable('user_prize');
    }
}