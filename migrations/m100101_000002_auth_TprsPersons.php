<?php
 
class m100101_000002_auth_TprsPersons extends CDbMigration
{

 public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.*','0','D2tasks.TprsPersons',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.Create','0','D2tasks.TprsPersons module create',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.View','0','D2tasks.TprsPersons module view',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.Update','0','D2tasks.TprsPersons module update',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.Delete','0','D2tasks.TprsPersons module delete',NULL,'N;') on duplicate key update `data` = values(`data`);
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TprsPersons.*';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TprsPersons.Create';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TprsPersons.View';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TprsPersons.Update';
            DELETE FROM `authitem` WHERE `name`= 'D2tasks.TprsPersons.Delete';
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


