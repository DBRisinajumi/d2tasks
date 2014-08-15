<?php

class m140812_212801_init_data extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $this->execute("


        insert  into `tcst_communication_status`(`tcst_id`,`tcst_name`,`tcst_icon`) values (1,'Active',NULL),(2,'Closed',NULL),(3,'Canceled',NULL);
        insert  into `tmed_media`(`tmed_id`,`tmed_name`,`tmed_icon`) values (1,'Email',NULL),(2,'Phone',NULL),(3,'Fax',NULL),(4,'Meeting',NULL);
        insert  into `tstt_status`(`tstt_id`,`tstt_name`,`tstt_icon`) values (1,'Not started',NULL),(2,'In progress',NULL),(3,'Canceled',NULL),(4,'Completed',NULL);

        ");
    }

    /**
	 * Drops the table
	 */
    public function down()
    {
        $this->execute("

        ");
    }

    /**
	 * Creates initial version of the table in a transaction-safe way.
	 * Uses $this->up to not duplicate code.
	 */
    public function safeUp()
    {
        $this->up();
    }

    /**
	 * Drops the table in a transaction-safe way.
	 * Uses $this->down to not duplicate code.
	 */
    public function safeDown()
    {
        $this->down();
    }
}
