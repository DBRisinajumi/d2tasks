<?php
 
class m100101_000000_auth_TtskTask extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.*','0','D2tasks.TtskTask',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Create','0','D2tasks.TtskTask module create',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.View','0','D2tasks.TtskTask module view',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Update','0','D2tasks.TtskTask module update',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Delete','0','D2tasks.TtskTask module delete',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Menu','0','D2tasks.TtskTask show menu',NULL,'N;') on duplicate key update `data` = values(`data`);

        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TtskTask.*';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TtskTask.Create';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TtskTask.View';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TtskTask.Update';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TtskTask.Delete';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TtskTask.Menu';

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


