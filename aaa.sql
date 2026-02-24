/*
 Navicat Premium Data Transfer

 Source Server         : Localhost - 3306 (127.0.0.1)
 Source Server Type    : MySQL
 Source Server Version : 50715 (5.7.15-log)
 Source Host           : localhost:3306
 Source Schema         : aaa

 Target Server Type    : MySQL
 Target Server Version : 50715 (5.7.15-log)
 File Encoding         : 65001

 Date: 24/02/2026 10:16:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_hospital_departmen
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hospital_departmen`;
CREATE TABLE `tbl_hospital_departmen`  (
  `hospital_departmen_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_departmen_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hospital_departmen_name2` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hospital_departmen_tell` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `number_head` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`hospital_departmen_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_hospital_departmen
-- ----------------------------
INSERT INTO `tbl_hospital_departmen` VALUES (1, 'รพ.กะพ้อ (ผู้อำนวยการ)', 'รพ.กะพ้อ (ผู้อำนวยการ)', '132', '000');
INSERT INTO `tbl_hospital_departmen` VALUES (2, 'กลุ่มงานการพยาบาล', 'กลุ่มงานการพยาบาล', '119', '110');
INSERT INTO `tbl_hospital_departmen` VALUES (3, 'กลุ่มงานการแพทย์', 'กลุ่มงานการแพทย์', '114', '050');
INSERT INTO `tbl_hospital_departmen` VALUES (4, 'กลุ่มงานการแพทย์แผนไทยและการแพทย์ทางเลือก', 'กลุ่มงานการแพทย์แผนไทยและการแพทย์ทางเลือก', '251', '120');
INSERT INTO `tbl_hospital_departmen` VALUES (5, 'กลุ่มงานจิตเวชและยาเสพติด', 'กลุ่มงานจิตเวชและยาเสพติด', '127', '130');
INSERT INTO `tbl_hospital_departmen` VALUES (6, 'กลุ่มงานทันตกรรม', 'กลุ่มงานทันตกรรม', '246', '030');
INSERT INTO `tbl_hospital_departmen` VALUES (7, 'กลุ่มงานเทคนิคการแพทย์', 'กลุ่มงานเทคนิคการแพทย์', '118', '020');
INSERT INTO `tbl_hospital_departmen` VALUES (8, 'กลุ่มงานบริการด้านปฐมภูมิองค์รวมและยุทธศาสตร์', 'กลุ่มงานบริการด้านปฐมภูมิฯ', '100', '255');
INSERT INTO `tbl_hospital_departmen` VALUES (9, 'กลุ่มงานบริหารทั่วไป', 'กลุ่มงานบริหารทั่วไป', '121', '010');
INSERT INTO `tbl_hospital_departmen` VALUES (10, 'กลุ่มงานประกันสุขภาพ', 'กลุ่มงานประกันสุขภาพ', '134', '091');
INSERT INTO `tbl_hospital_departmen` VALUES (11, 'กลุ่มงานเภสัชกรรมและคุ้มครองผู้บริโภค', 'กลุ่มงานเภสัชกรรมและคุ้มครองผู้บริโภค', '123', '040');
INSERT INTO `tbl_hospital_departmen` VALUES (12, 'กลุ่มงานรังสีวิทยา', 'กลุ่มงานรังสีวิทยา', '122', '070');
INSERT INTO `tbl_hospital_departmen` VALUES (13, 'กลุ่มงานเวชกรรมฟื้นฟู', 'กลุ่มงานเวชกรรมฟื้นฟู', '251', '080');
INSERT INTO `tbl_hospital_departmen` VALUES (14, 'กลุ่มงานสารสนเทศทางการแพทย์', 'กลุ่มงานสารสนเทศทางการแพทย์', '129', '093');
INSERT INTO `tbl_hospital_departmen` VALUES (15, 'งานการพยาบาลผู้คลอด กลุ่มงานการพยาบาล', 'งานการพยาบาลผู้คลอด', '105', '115');
INSERT INTO `tbl_hospital_departmen` VALUES (16, 'งานการพยาบาลผู้ป่วยนอก กลุ่มงานการพยาบาล', 'งานการพยาบาลผู้ป่วยนอก', '117', '111');
INSERT INTO `tbl_hospital_departmen` VALUES (17, 'งานการพยาบาลผู้ป่วยใน กลุ่มงานการพยาบาล', 'งานการพยาบาลผู้ป่วยใน', '138', '113');
INSERT INTO `tbl_hospital_departmen` VALUES (18, 'งานการพยาบาลผู้ป่วยอุบัติเหตุฉุกเฉินและนิติเวช กลุ่มงานการพยาบาล', 'งานผู้ป่วยอุบัติเหตุฯ', '133', '112');
INSERT INTO `tbl_hospital_departmen` VALUES (19, 'งานการพยาบาลหน่วยควบคุมการติดเชื้อและงานจ่ายกลาง กลุ่มงานการพยาบาล', 'งานควบคุมการติดเชื้อฯ', '143', '114');

-- ----------------------------
-- Table structure for tbl_id_level
-- ----------------------------
DROP TABLE IF EXISTS `tbl_id_level`;
CREATE TABLE `tbl_id_level`  (
  `id_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_id_level
-- ----------------------------
INSERT INTO `tbl_id_level` VALUES ('1', 'admin');
INSERT INTO `tbl_id_level` VALUES ('2', 'user');

-- ----------------------------
-- Table structure for tbl_people_main
-- ----------------------------
DROP TABLE IF EXISTS `tbl_people_main`;
CREATE TABLE `tbl_people_main`  (
  `people_main_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบุคลากร',
  `cid` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'รหัสประจำตัว 13 หลัก',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'เพศ',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'คำนำหน้า',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ชื่อ',
  `sname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'นามสกุล',
  `birthday` date NULL DEFAULT NULL COMMENT 'วันเกิด',
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'มือถือ',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'อีเมลล์',
  `img_yourself` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'รูป',
  `people_type_id` int(11) NULL DEFAULT NULL COMMENT 'สถานะการทำงาน',
  `hospital_departmen_id` int(11) NULL DEFAULT NULL COMMENT 'กลุ่มงาน',
  `id_level` int(11) NULL DEFAULT NULL COMMENT 'ระดับการเข้าใช้',
  PRIMARY KEY (`people_main_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 195 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_people_main
-- ----------------------------
INSERT INTO `tbl_people_main` VALUES (162, '1959800125800', 'ayub', '$2y$10$7.MLY7yLL/9GPJs6ps1Nbe5bkfk/k7CnJxU1g77Ga.NwlYGs9D1Hm', '1', 'นาย', 'อายุบ20', 'บาฮา', '2000-01-01', '0899999999', 'ayub99999@gmail.com', 'admin.png', 1, 14, 1);

-- ----------------------------
-- Table structure for tbl_people_sex
-- ----------------------------
DROP TABLE IF EXISTS `tbl_people_sex`;
CREATE TABLE `tbl_people_sex`  (
  `sex` int(11) NOT NULL AUTO_INCREMENT,
  `sex_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sex`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_people_sex
-- ----------------------------
INSERT INTO `tbl_people_sex` VALUES (1, 'ชาย');
INSERT INTO `tbl_people_sex` VALUES (2, 'หญิง');

-- ----------------------------
-- Table structure for tbl_people_type
-- ----------------------------
DROP TABLE IF EXISTS `tbl_people_type`;
CREATE TABLE `tbl_people_type`  (
  `people_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `people_type_name` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`people_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_people_type
-- ----------------------------
INSERT INTO `tbl_people_type` VALUES (1, 'ปฏิบัติงาน');
INSERT INTO `tbl_people_type` VALUES (2, 'ไม่ปฏิบัติงาน');

SET FOREIGN_KEY_CHECKS = 1;
