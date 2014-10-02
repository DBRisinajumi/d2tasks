<?php

class m141002_210801_alter_tcmn extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $this->execute("
        ALTER TABLE `tcmn_communication`   
           CHANGE `tcmn_pprs_id` `tcmn_pprs_id` SMALLINT(5) UNSIGNED NULL  COMMENT 'person',
           CHANGE `tcmn_tmed_id` `tcmn_tmed_id` TINYINT(4) UNSIGNED NULL  COMMENT 'medijs';
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
