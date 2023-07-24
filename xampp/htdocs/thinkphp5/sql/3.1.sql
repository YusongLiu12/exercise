SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `yunzhi_project`
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_project`;
CREATE TABLE `yunzhi_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(30) DEFAULT '' COMMENT '项目名称',
  `access_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0公开，1私有',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `yunzhi_project`
-- ----------------------------
BEGIN;
INSERT INTO `yunzhi_project` VALUES ('1', '项目1', '0', '123123', '123213'), ('2', '项目2', '0', '123213', '1232');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;