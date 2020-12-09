CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址信息',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '录入时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='种植人信息表';

CREATE TABLE `member_plants` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `plant_id` int(11) NOT NULL DEFAULT '0' COMMENT '植物Id',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '种植人Id',
  `plant_area` decimal(30,5) NOT NULL DEFAULT '0.00000' COMMENT '面积: 亩',
  `plant_number` int(10) NOT NULL DEFAULT '0' COMMENT '数量：万株',
  `plant_age` decimal(10,1) NOT NULL DEFAULT '0.0' COMMENT '苗龄: 年',
  `plant_height` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '苗高: cm',
  `plant_gj` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '根茎: cm',
  `plant_xj` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '胸茎: cm',
  `plant_gf` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '冠幅: cm',
  `plant_grade` tinyint(1) NOT NULL DEFAULT '1' COMMENT '等级: 1=>一级, 2=>二级, 3=>三级',
  `plant_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `plant_note` tinytext NOT NULL COMMENT '备注',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '录入时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='种植信息表';