/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : wallez

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-02-11 15:07:23
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
  `harga_total` varchar(255) DEFAULT NULL,
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
  `satuan` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_barang
-- ----------------------------

-- ----------------------------
-- Table structure for master_kategori
-- ----------------------------
DROP TABLE IF EXISTS `master_kategori`;
CREATE TABLE `master_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_kategori
-- ----------------------------

-- ----------------------------
-- Table structure for master_satuan
-- ----------------------------
DROP TABLE IF EXISTS `master_satuan`;
CREATE TABLE `master_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_satuan
-- ----------------------------

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_faktur` date DEFAULT NULL,
  `no_faktur` varchar(255) DEFAULT NULL,
  `nama_konsumen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
