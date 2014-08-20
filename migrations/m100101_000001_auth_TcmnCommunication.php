<?php
 
class m100101_000001_auth_TcmnCommunication extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.*','0','D2tasks.TcmnCommunication',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.edit','0','D2tasks.TcmnCommunication module edit',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.fullcontrol','0','D2tasks.TcmnCommunication module full control',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.readonly','0','D2tasks.TcmnCommunication module readonly',NULL,'N;');
                
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TcmnCommunication.*');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TcmnCommunication.edit');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TcmnCommunication.fullcontrol');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskView', 'D2tasks.TcmnCommunication.readonly');

        ");
    }

    public function down()
    {
        $this->execute("

            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmnCommunication.*';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmnCommunication.edit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmnCommunication.fullcontrol';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmnCommunication.readonly';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmnCommunicationEdit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmnCommunicationView';
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


