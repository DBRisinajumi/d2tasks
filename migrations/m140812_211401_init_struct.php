<?php

class m140812_211401_init_struct extends CDbMigration
{

    /**
	 * Creates initial version of the table
	 */
    public function up()
    {
        $this->execute("


CREATE TABLE `tstt_status` (
  `tstt_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tstt_name` varchar(50) NOT NULL,
  `tstt_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tstt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Task status';

/*Table structure for table `tmed_media` */

CREATE TABLE `tmed_media` (
  `tmed_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tmed_name` varchar(50) NOT NULL,
  `tmed_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tmed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tcst_communication_status` */

CREATE TABLE `tcst_communication_status` (
  `tcst_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tcst_name` varchar(50) DEFAULT NULL,
  `tcst_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tcst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `ttsk_task` (
  `ttsk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ttsk_ccmp_id` int(10) unsigned NOT NULL,
  `ttsk_name` varchar(256) NOT NULL,
  `ttsk_description` text,
  `ttsk_tstt_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`ttsk_id`),
  KEY `ttsk_ccmp_id` (`ttsk_ccmp_id`),
  KEY `ttsk_tstt_id` (`ttsk_tstt_id`),
  CONSTRAINT `ttsk_task_ibfk_2` FOREIGN KEY (`ttsk_tstt_id`) REFERENCES `tstt_status` (`tstt_id`),
  CONSTRAINT `ttsk_task_ibfk_1` FOREIGN KEY (`ttsk_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tasks';


CREATE TABLE `tcmn_communication` (
  `tcmn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tcmn_ttsk_id` int(10) unsigned NOT NULL COMMENT 'task',
  `tcmn_pprs_id` smallint(5) unsigned DEFAULT NULL COMMENT 'person',
  `tcmn_client_pprs_id` smallint(6) unsigned DEFAULT NULL COMMENT 'client person',
  `tcmn_task` text,
  `tcmn_result` text,
  `tcmn_tcst_id` tinyint(3) unsigned DEFAULT NULL COMMENT 'status',
  `tcmn_date` date DEFAULT NULL,
  `tcmn_tmed_id` tinyint(4) unsigned DEFAULT NULL COMMENT 'medijs',
  PRIMARY KEY (`tcmn_id`),
  KEY `tcmn_ttsk_id` (`tcmn_ttsk_id`),
  KEY `tcmn_pprs_id` (`tcmn_pprs_id`),
  KEY `tcmn_client_pprs_id` (`tcmn_client_pprs_id`),
  KEY `tcmn_tcst_id` (`tcmn_tcst_id`),
  KEY `tcmn_tmed_id` (`tcmn_tmed_id`),
  CONSTRAINT `tcmn_communication_ibfk_5` FOREIGN KEY (`tcmn_tmed_id`) REFERENCES `tmed_media` (`tmed_id`),
  CONSTRAINT `tcmn_communication_ibfk_1` FOREIGN KEY (`tcmn_ttsk_id`) REFERENCES `ttsk_task` (`ttsk_id`),
  CONSTRAINT `tcmn_communication_ibfk_2` FOREIGN KEY (`tcmn_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
  CONSTRAINT `tcmn_communication_ibfk_3` FOREIGN KEY (`tcmn_client_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
  CONSTRAINT `tcmn_communication_ibfk_4` FOREIGN KEY (`tcmn_tcst_id`) REFERENCES `tcst_communication_status` (`tcst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tcmt_comments` */

CREATE TABLE `tcmt_comments` (
  `tcmt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tcmt_ttsk_id` int(10) unsigned NOT NULL,
  `tcmt_pprs_id` smallint(10) unsigned DEFAULT NULL,
  `tcmt_datetime` datetime DEFAULT NULL,
  `tcmt_notes` text,
  PRIMARY KEY (`tcmt_id`),
  KEY `tcmt_ttsk_id` (`tcmt_ttsk_id`),
  KEY `tcmt_pprs_id` (`tcmt_pprs_id`),
  CONSTRAINT `tcmt_comments_ibfk_2` FOREIGN KEY (`tcmt_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
  CONSTRAINT `tcmt_comments_ibfk_1` FOREIGN KEY (`tcmt_ttsk_id`) REFERENCES `ttsk_task` (`ttsk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*Table structure for table `tcsh_comminication_status_history` */

CREATE TABLE `tcsh_comminication_status_history` (
  `tcsh_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tcsh_tcmn_id` int(10) unsigned NOT NULL COMMENT 'communication',
  `tcsh_tcst_id` tinyint(3) unsigned NOT NULL COMMENT 'status',
  `tcsh_pprs_id` smallint(5) unsigned NOT NULL COMMENT 'person',
  `tcsh_datetime` datetime NOT NULL,
  PRIMARY KEY (`tcsh_id`),
  KEY `tcsh_tcmn_id` (`tcsh_tcmn_id`),
  KEY `tcsh_pprs_id` (`tcsh_pprs_id`),
  KEY `tcsh_tcst_id` (`tcsh_tcst_id`),
  CONSTRAINT `tcsh_comminication_status_history_ibfk_3` FOREIGN KEY (`tcsh_tcst_id`) REFERENCES `tcst_communication_status` (`tcst_id`),
  CONSTRAINT `tcsh_comminication_status_history_ibfk_1` FOREIGN KEY (`tcsh_tcmn_id`) REFERENCES `tcmn_communication` (`tcmn_id`),
  CONSTRAINT `tcsh_comminication_status_history_ibfk_2` FOREIGN KEY (`tcsh_pprs_id`) REFERENCES `pprs_person` (`pprs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*Table structure for table `tprs_persons` */

CREATE TABLE `tprs_persons` (
  `tprs_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tprs_ttsk_id` int(10) unsigned NOT NULL,
  `tprs_pprs_id` smallint(10) unsigned DEFAULT NULL,
  `tprs_notes` text,
  PRIMARY KEY (`tprs_id`),
  KEY `tprs_ttsk_id` (`tprs_ttsk_id`),
  KEY `tprs_pprs_id` (`tprs_pprs_id`),
  CONSTRAINT `tprs_persons_ibfk_2` FOREIGN KEY (`tprs_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
  CONSTRAINT `tprs_persons_ibfk_1` FOREIGN KEY (`tprs_ttsk_id`) REFERENCES `ttsk_task` (`ttsk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tsth_status_history` */

CREATE TABLE `tsth_status_history` (
  `tsth_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tsth_ttsk_id` int(10) unsigned NOT NULL,
  `tsth_tstt_id` tinyint(3) unsigned DEFAULT NULL COMMENT 'status',
  `tsth_pprs_id` smallint(5) unsigned DEFAULT NULL,
  `tsth_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`tsth_id`),
  KEY `tsth_pprs_id` (`tsth_pprs_id`),
  KEY `tsth_ttsk_id` (`tsth_ttsk_id`),
  KEY `tsth_tstt_id` (`tsth_tstt_id`),
  CONSTRAINT `tsth_status_history_ibfk_3` FOREIGN KEY (`tsth_tstt_id`) REFERENCES `tstt_status` (`tstt_id`),
  CONSTRAINT `tsth_status_history_ibfk_1` FOREIGN KEY (`tsth_pprs_id`) REFERENCES `pprs_person` (`pprs_id`),
  CONSTRAINT `tsth_status_history_ibfk_2` FOREIGN KEY (`tsth_ttsk_id`) REFERENCES `ttsk_task` (`ttsk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Task status history';


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
