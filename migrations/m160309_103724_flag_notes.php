<?php

namespace WondersLabCorporation\yii2\flagNotes\migrations;

use yii\db\Schema;
use yii\db\Migration;

class m160309_103724_flag_notes extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%flag_notes}}', [
            'id' => Schema::TYPE_PK,
            'model' => Schema::TYPE_STRING . ' NOT NULL',
            'model_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'flag_type' => Schema::TYPE_STRING . ' NOT NULL',
            'flag_description' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ]);

        $this->createIndex('object', '{{%flag_notes}}', ['model', 'model_id'], true);
    }
    
    public function safeDown()
    {
        $this->dropTable('{{%flag_notes}}');
    }
}
