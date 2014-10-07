<?php
 
class m100101_000001_auth_TcmnCommunication extends CDbMigration
{

  public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.*','0','D2tasks.TcmnCommunication',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.Create','0','D2tasks.TcmnCommunication module create',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.View','0','D2tasks.TcmnCommunication module view',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.Update','0','D2tasks.TcmnCommunication module update',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.Delete','0','D2tasks.TcmnCommunication module delete',NULL,'N;') on duplicate key update `data` = values(`data`);
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmnCommunication.*';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmnCommunication.Create';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmnCommunication.View';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmnCommunication.Update';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmnCommunication.Delete';
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


