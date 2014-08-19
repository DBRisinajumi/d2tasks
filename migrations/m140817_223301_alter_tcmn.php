<?php

class m140817_223301_alter_tcmn extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $this->execute("
            ALTER TABLE `tcmn_communication`   
              CHANGE `tcmn_pprs_id` `tcmn_pprs_id` SMALLINT(5) UNSIGNED NOT NULL  COMMENT 'person',
              CHANGE `tcmn_task` `tcmn_task` TEXT CHARSET utf8 COLLATE utf8_general_ci NOT NULL,
              CHANGE `tcmn_tcst_id` `tcmn_tcst_id` TINYINT(3) UNSIGNED NOT NULL  COMMENT 'status',
              CHANGE `tcmn_datetime` `tcmn_datetime` DATETIME NOT NULL,
              CHANGE `tcmn_tmed_id` `tcmn_tmed_id` TINYINT(4) UNSIGNED NOT NULL  COMMENT 'medijs';

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
