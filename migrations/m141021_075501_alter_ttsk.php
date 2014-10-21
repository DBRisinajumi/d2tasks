<?php

class m141021_075501_alter_ttsk extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $this->execute("
            ALTER TABLE `ttsk_task`   
              CHANGE `ttsk_ccmp_id` `ttsk_ccmp_id` INT(10) UNSIGNED NULL,
              ADD COLUMN `ttsk_pprs_id` SMALLINT(5) UNSIGNED NULL AFTER `ttsk_ccmp_id`;
            ALTER TABLE `ttsk_task`   
              ADD CONSTRAINT `fk_ttsk_pprs` FOREIGN KEY (`ttsk_pprs_id`) REFERENCES `pprs_person`(`pprs_id`);

        ");
    }

    /**
	 * Drops the table
	 */
    public function down()
    {

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
