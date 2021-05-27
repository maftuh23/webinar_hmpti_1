/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100316
 Source Host           : localhost:3306
 Source Schema         : webinar_hmti_crud

 Target Server Type    : MySQL
 Target Server Version : 100316
 File Encoding         : 65001

 Date: 27/05/2021 06:57:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_barang
-- ----------------------------
DROP TABLE IF EXISTS `tbl_barang`;
CREATE TABLE `tbl_barang`  (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_barang` int NOT NULL,
  `harga_barang` int NOT NULL,
  `tgl_input` date NOT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_barang
-- ----------------------------
INSERT INTO `tbl_barang` VALUES (4, 'Meja', 2, 1000, '2021-05-05');
INSERT INTO `tbl_barang` VALUES (5, 'Kursi', 2, 23000, '2021-05-13');

SET FOREIGN_KEY_CHECKS = 1;
