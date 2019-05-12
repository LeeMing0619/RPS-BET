/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100121
 Source Host           : localhost:3306
 Source Schema         : gym

 Target Server Type    : MySQL
 Target Server Version : 100121
 File Encoding         : 65001

 Date: 30/03/2019 18:00:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `balance` bigint(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of auth
-- ----------------------------
INSERT INTO `auth` VALUES (6, 'panda', 'pandan@panda.com', '21232f297a57a5a743894a0e4a801fc3', 'regular', 1, '', NULL);
INSERT INTO `auth` VALUES (7, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, '', NULL);

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bet_amount` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `card1` tinyint(2) NOT NULL,
  `user2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `card2` tinyint(2) NULL DEFAULT NULL,
  `win` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `balance` bigint(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (17, 'adf', '12', 1, '', 0, NULL, 1, '1', 'asfdasfdasfdasfasdf', NULL);
INSERT INTO `member` VALUES (18, 'dff', '123', 0, '', 0, NULL, NULL, NULL, '0safasdf', NULL);
INSERT INTO `member` VALUES (19, 'daf', '23232', 0, '', 0, NULL, NULL, '', '1safasfdasfdasfasdfasdf', NULL);
INSERT INTO `member` VALUES (20, 'vikramfsdfasf', '232323', 0, 'aaaa', 0, NULL, NULL, '', '0asdffffffffffffffffffffffffffffffffffffffffff', NULL);
INSERT INTO `member` VALUES (21, 'asdfasdf', '2234', 1, '11231', 0, NULL, NULL, '', 'dffasf', NULL);
INSERT INTO `member` VALUES (22, 'dfdfafaf', '33', 0, 'ssdf', 2, NULL, NULL, '', 'fddfasf', NULL);
INSERT INTO `member` VALUES (23, 'gsdgsdgsdg1', '1332', 1, 'dfgdfgsdsf', 1, NULL, NULL, '', 'sdfsgsdfg', NULL);
INSERT INTO `member` VALUES (24, 'jfkalsflklklklklk', '11312', 0, 'dkdkdlaaf', 1, NULL, NULL, '', 'asdflasfkdlaskflkl', NULL);

-- ----------------------------
-- Table structure for member_plan
-- ----------------------------
DROP TABLE IF EXISTS `member_plan`;
CREATE TABLE `member_plan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `package_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `package_period` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NULL DEFAULT NULL,
  `paid` int(11) NOT NULL,
  `unpaid` int(11) NOT NULL DEFAULT 0,
  `next_installment` date NULL DEFAULT NULL,
  `desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` date NULL DEFAULT NULL,
  `modified` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of member_plan
-- ----------------------------
INSERT INTO `member_plan` VALUES (11, 17, '3', '7', '2014-08-15', '2014-11-01', 12000, 12000, '2015-02-20', '1200 rupees for 3 months', '2015-02-20', '2015-02-20');
INSERT INTO `member_plan` VALUES (12, 18, '8', '5', '2014-08-15', '2014-11-01', 12000, 12000, '2015-03-01', 'Weight training for 6 months 1500 fee plus 100 entry free total 1600 plus one month free total 7 month', '2015-02-20', '2015-02-20');
INSERT INTO `member_plan` VALUES (13, 19, '9', '10', '2014-08-15', '2014-11-01', 12000, 12000, '2015-02-20', '3 members ! per member 750 plus 100 entry fee (total 850).\r\ntotal 2550', '2015-02-20', '2015-02-20');
INSERT INTO `member_plan` VALUES (14, 20, '8', '4', '2015-02-22', '2015-03-23', 12000, 12000, '2015-03-20', 'Weight training for 3 months 800 fee plus 100 entry free total 900', '2015-02-22', '2015-02-22');

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of plan
-- ----------------------------
INSERT INTO `plan` VALUES (3, 'Cardio Training', 'CT');
INSERT INTO `plan` VALUES (4, 'Weight Training  plus Cardio Training  ', 'WCT');
INSERT INTO `plan` VALUES (8, 'Weight Training', 'WT');
INSERT INTO `plan` VALUES (9, 'group entry', 'GE');

-- ----------------------------
-- Table structure for temp
-- ----------------------------
DROP TABLE IF EXISTS `temp`;
CREATE TABLE `temp`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of temp
-- ----------------------------
INSERT INTO `temp` VALUES (1, 'yes');
INSERT INTO `temp` VALUES (2, 'yes');
INSERT INTO `temp` VALUES (3, 'yes');
INSERT INTO `temp` VALUES (4, 'yes');
INSERT INTO `temp` VALUES (5, 'no');
INSERT INTO `temp` VALUES (6, 'yes');

-- ----------------------------
-- Table structure for teriff
-- ----------------------------
DROP TABLE IF EXISTS `teriff`;
CREATE TABLE `teriff`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `duration` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` int(11) NOT NULL,
  `offer` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `plan_id`(`plan_id`) USING BTREE,
  CONSTRAINT `teriff_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of teriff
-- ----------------------------
INSERT INTO `teriff` VALUES (4, 8, '3  months', 900, 'none', 'Weight training for 3 months 800 fee plus 100 entry free total 900');
INSERT INTO `teriff` VALUES (5, 8, '6 months', 1600, '1 month free', 'Weight training for 6 months 1500 fee plus 100 entry free total 1600 plus one month free total 7 month');
INSERT INTO `teriff` VALUES (6, 8, '12 months', 3000, '2 months free', 'Weight training for 12 months 3000 fee plus 2 month free total 14 months');
INSERT INTO `teriff` VALUES (7, 3, '3  months', 1200, 'none', '1200 rupees for 3 months');
INSERT INTO `teriff` VALUES (8, 3, '6 months', 2000, '', '2000 rupees for 6 months');
INSERT INTO `teriff` VALUES (9, 3, '12 months', 4000, '', '4000 rupees for 12 months');
INSERT INTO `teriff` VALUES (10, 9, '3  months', 2550, '', '3 members ! per member 750 plus 100 entry fee (total 850).\r\ntotal 2550');
INSERT INTO `teriff` VALUES (11, 9, '3  months', 4000, '', '5 members ! per member 700 plus 100 entry fee (total 800). total 4000');

SET FOREIGN_KEY_CHECKS = 1;
