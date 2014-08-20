<?php
 
class m100101_000002_auth_TprsPersons extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.*','0','D2tasks.TprsPersons',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.edit','0','D2tasks.TprsPersons module edit',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.fullcontrol','0','D2tasks.TprsPersons module full control',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.readonly','0','D2tasks.TprsPersons module readonly',NULL,'N;');
                
           
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TprsPersons.*');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TprsPersons.edit');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TprsPersons.fullcontrol');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskView', 'D2tasks.TprsPersons.readonly');

        ");
    }

    public function down()
    {
        $this->execute("

            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TprsPersons.*';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TprsPersons.edit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TprsPersons.fullcontrol';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TprsPersons.readonly';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TprsPersonsEdit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TprsPersonsView';
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


