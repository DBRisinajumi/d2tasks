<?php
 
class m100101_000003_auth_TcmtComments extends CDbMigration
{

 public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.*','0','D2tasks.TcmtComments',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Create','0','D2tasks.TcmtComments module create',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.View','0','D2tasks.TcmtComments module view',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Update','0','D2tasks.TcmtComments module update',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Delete','0','D2tasks.TcmtComments module delete',NULL,'N;') on duplicate key update `data` = values(`data`);
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmtComments.*';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmtComments.Create';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmtComments.View';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmtComments.Update';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TcmtComments.Delete';
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


