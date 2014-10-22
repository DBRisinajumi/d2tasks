Rights example
--------------

	-- authitem -------------------------
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.*','0','D2tasks.TtskTask',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Create','0','D2tasks.TtskTask module create',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.View','0','D2tasks.TtskTask module view',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Update','0','D2tasks.TtskTask module update',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Delete','0','D2tasks.TtskTask module delete',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TtskTask.Menu','0','D2tasks.TtskTask show menu',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);


	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.*','0','D2tasks.TcmnCommunication',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.Create','0','D2tasks.TcmnCommunication module create',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.View','0','D2tasks.TcmnCommunication module view',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.Update','0','D2tasks.TcmnCommunication module update',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmnCommunication.Delete','0','D2tasks.TcmnCommunication module delete',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);

	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.*','0','D2tasks.TprsPersons',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.Create','0','D2tasks.TprsPersons module create',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.View','0','D2tasks.TprsPersons module view',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.Update','0','D2tasks.TprsPersons module update',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TprsPersons.Delete','0','D2tasks.TprsPersons module delete',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);

	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.*','0','D2tasks.TcmtComments',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Create','0','D2tasks.TcmtComments module create',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.View','0','D2tasks.TcmtComments module view',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Update','0','D2tasks.TcmtComments module update',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);
	INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2tasks.TcmtComments.Delete','0','D2tasks.TcmtComments module delete',NULL,'N;') ON DUPLICATE KEY UPDATE `data` = VALUES(`data`);

	-- add to roles D2tasks.TtskTaskEdit
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TtskTask.Menu');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TtskTask.View');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TtskTask.Create');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TtskTask.Update');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TcmnCommunication.Create');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TcmnCommunication.Update');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TcmnCommunication.View');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TcmtComments.Create');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TprsPersons.Create');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TprsPersons.Update');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TprsPersons.Delete');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TprsPersons.View');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TcmtComments.View');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskEdit','D2tasks.TcmtComments.Create');

	-- add to roles D2tasks.TtskTaskView
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskView','D2tasks.TtskTask.Menu');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskView','D2tasks.TtskTask.View');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskView','D2tasks.TcmnCommunication.View');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskView','D2tasks.TcmtComments.View');
	INSERT INTO authitemchild VALUES ('D2tasks.TtskTaskView','D2tasks.TprsPersons.View');


	SELECT * FROM `authitemchild` WHERE `parent` LIKE 'D2tasks.%' 



