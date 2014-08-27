<?php
 
class m100101_000003_auth_TcmtComments extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Create','0','D2tasks.TcmtComments Create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Update','0','D2tasks.TcmtComments module Update',NULL,'N;');
                
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TcmtComments.Create');
            INSERT INTO `authitemchild` VALUES('D2tasks.TtskTaskEdit', 'D2tasks.TcmtComments.Update');


        ");
    }

    public function down()
    {
        $this->execute("

            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmtComments.*';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmtComments.edit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmtComments.fullcontrol';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmtComments.readonly';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmtCommentsEdit';
            DELETE FROM `authitem` WHERE `name` = 'D2tasks.TcmtCommentsView';
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


