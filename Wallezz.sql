/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : wallezz

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-02-11 20:05:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for barang_terjual
-- ----------------------------
DROP TABLE IF EXISTS `barang_terjual`;
CREATE TABLE `barang_terjual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `harga_satuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of barang_terjual
-- ----------------------------

-- ----------------------------
-- Table structure for log_restok_barang
-- ----------------------------
DROP TABLE IF EXISTS `log_restok_barang`;
CREATE TABLE `log_restok_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL COMMENT 'tanggal restok',
  `stok` varchar(255) DEFAULT NULL COMMENT 'stok yang ditambahkan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_restok_barang
-- ----------------------------

-- ----------------------------
-- Table structure for master_barang
-- ----------------------------
DROP TABLE IF EXISTS `master_barang`;
CREATE TABLE `master_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli` varchar(255) DEFAULT NULL,
  `harga_jual` varchar(255) DEFAULT NULL,
  `satuan` int(11) DEFAULT NULL,
  `kategori` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama barang` (`nama_barang`),
  KEY `kategori` (`kategori`),
  KEY `satuan` (`satuan`),
  CONSTRAINT `kategori` FOREIGN KEY (`kategori`) REFERENCES `master_kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `satuan` FOREIGN KEY (`satuan`) REFERENCES `master_satuan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_barang
-- ----------------------------
INSERT INTO `master_barang` VALUES ('1', 'LOG1', 'Knalpot', '4000', '5000', '2', '1', '10');
INSERT INTO `master_barang` VALUES ('3', 'LOG2', 'Knalpot Toyota544', '4000', '5000', '2', '1', '10');
INSERT INTO `master_barang` VALUES ('4', 'CAI1', 'Oli Mesran Biru', '4500', '5000', '4', '3', '40');

-- ----------------------------
-- Table structure for master_kategori
-- ----------------------------
DROP TABLE IF EXISTS `master_kategori`;
CREATE TABLE `master_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nama_kategori` (`nama_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_kategori
-- ----------------------------
INSERT INTO `master_kategori` VALUES ('3', 'Cair');
INSERT INTO `master_kategori` VALUES ('1', 'Logam');
INSERT INTO `master_kategori` VALUES ('4', 'Pelumas');
INSERT INTO `master_kategori` VALUES ('2', 'Plastik');

-- ----------------------------
-- Table structure for master_satuan
-- ----------------------------
DROP TABLE IF EXISTS `master_satuan`;
CREATE TABLE `master_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unik satuan` (`nama_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_satuan
-- ----------------------------
INSERT INTO `master_satuan` VALUES ('8', 'Botol');
INSERT INTO `master_satuan` VALUES ('5', 'Box');
INSERT INTO `master_satuan` VALUES ('1', 'Buah');
INSERT INTO `master_satuan` VALUES ('3', 'Butir');
INSERT INTO `master_satuan` VALUES ('4', 'Liter');
INSERT INTO `master_satuan` VALUES ('2', 'Unit');

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_faktur` date DEFAULT NULL,
  `no_faktur` varchar(255) DEFAULT NULL,
  `nama_konsumen` varchar(255) DEFAULT NULL,
  `harga_total` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES ('1', '2019-02-11', '2019FEB11/1', 'sulaiman', '10000');
