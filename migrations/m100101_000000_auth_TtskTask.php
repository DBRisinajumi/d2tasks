<?php
 
class m100101_000000_auth_TtskTask extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.*','0','D2tasks.TtskTask',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.edit','0','D2tasks.TtskTask module edit',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.fullcontrol','0','D2tasks.TtskTask module full control',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.readonly','0','D2tasks.TtskTask module readonly',NULL,'N;');
                
            INSERT INTO `authitem` VALUES('D2tasks.TtskTaskEdit', 2, 'D2tasks.TtskTask edit', NULL, 'N;');
            INSERT INTO `authitem` VALUES('D2tasks.TtskTaskView', 2, 'D2tasks.TtskTask view', NULL, 'N;');
            
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TtskTask.*');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TtskTask.edit');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TtskTask.fullcontrol');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskView', 'D2tasks.TtskTask.readonly');

        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitemchild` WHERE `parent` = 'D2tasks.TtskTaskEdit';
            DELETE FROM `authitemchild` WHERE `parent` = 'D2tasks.TtskTaskView';

            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TtskTask.*';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TtskTask.edit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TtskTask.fullcontrol';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TtskTask.readonly';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TtskTaskEdit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TtskTaskView';
        ");
    }

    public function safeUp()
    {
        $this->up();
    }

    public function safeDown()
    {
        $this->down();
    }
}


