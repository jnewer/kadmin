
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `nickname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '昵称',
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/app/admin/avatar.png' COMMENT '头像',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '手机',
  `status` tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态: 1=正常, 0=禁用',
  `created_at` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime NULL DEFAULT NULL COMMENT '更新时间',
  `login_at` datetime NULL DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uk_username`(`username` ASC) USING BTREE,
  UNIQUE INDEX `uk_email`(`email` ASC) USING BTREE,
  UNIQUE INDEX `uk_phone`(`phone` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '超级管理员', '$2y$10$aZifaJkCZDr2NFFmad8a3eON77hkYb7JbJ9lnhuZ8Arz8OedHhBG2', '/avatar.png', '\'\'', '\'\'', 1, '2024-08-05 20:11:24', '2024-08-05 21:21:12', '2024-08-05 21:21:12');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int UNSIGNED NOT NULL COMMENT '角色ID',
  `admin_id` int UNSIGNED NOT NULL COMMENT '管理员ID',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uk_role_admin_id`(`role_id` ASC, `admin_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员角色' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES (1, 1, 1);

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件',
  `admin_id` int UNSIGNED NULL DEFAULT 0 COMMENT '管理员',
  `file_size` int NOT NULL COMMENT '文件大小',
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mime类型',
  `image_width` int UNSIGNED NULL DEFAULT NULL COMMENT '图片宽度',
  `image_height` int UNSIGNED NULL DEFAULT NULL COMMENT '图片高度',
  `ext` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展名',
  `storage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local' COMMENT '存储位置',
  `category` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '类别',
  `created_at` datetime NULL DEFAULT NULL COMMENT '上传时间',
  `updated_at` datetime NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_category`(`category` ASC) USING BTREE,
  INDEX `idx_admin_id`(`admin_id` ASC) USING BTREE,
  INDEX `idx_name`(`name` ASC) USING BTREE,
  INDEX `idx_ext`(`ext` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '附件' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of media
-- ----------------------------
INSERT INTO `media` VALUES (1, 'bg.jpg', '/upload/files/20240805/66b0d1d72c9a.jpg', 1, 373081, 'image/jpeg', 1920, 1080, 'jpg', 'local', '1', '2024-08-05 00:00:00', '2024-08-05 00:00:00');

-- ----------------------------
-- Table structure for option
-- ----------------------------
DROP TABLE IF EXISTS `option`;
CREATE TABLE `option`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '键',
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '值',
  `created_at` datetime NOT NULL DEFAULT '2022-08-15 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT '2022-08-15 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uk_name`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '选项' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of option
-- ----------------------------
INSERT INTO `option` VALUES (1, 'system_config', '{\"logo\":{\"title\":\"Webman Admin\",\"image\":\"\\/app\\/admin\\/admin\\/images\\/logo.png\"},\"menu\":{\"data\":\"\\/app\\/admin\\/rule\\/get\",\"method\":\"GET\",\"accordion\":true,\"collapse\":false,\"control\":false,\"controlWidth\":500,\"select\":\"0\",\"async\":true},\"tab\":{\"enable\":true,\"keepState\":true,\"preload\":false,\"session\":true,\"max\":\"30\",\"index\":{\"id\":\"0\",\"href\":\"\\/app\\/admin\\/index\\/dashboard\",\"title\":\"\\u4eea\\u8868\\u76d8\"}},\"theme\":{\"defaultColor\":\"2\",\"defaultMenu\":\"light-theme\",\"defaultHeader\":\"light-theme\",\"allowCustom\":true,\"banner\":false},\"colors\":[{\"id\":\"1\",\"color\":\"#36b368\",\"second\":\"#f0f9eb\"},{\"id\":\"2\",\"color\":\"#2d8cf0\",\"second\":\"#ecf5ff\"},{\"id\":\"3\",\"color\":\"#f6ad55\",\"second\":\"#fdf6ec\"},{\"id\":\"4\",\"color\":\"#f56c6c\",\"second\":\"#fef0f0\"},{\"id\":\"5\",\"color\":\"#3963bc\",\"second\":\"#ecf5ff\"}],\"other\":{\"keepLoad\":\"500\",\"autoHead\":false,\"footer\":false},\"header\":{\"message\":false}}', '2022-12-05 14:49:01', '2022-12-08 20:20:28');
INSERT INTO `option` VALUES (2, 'table_form_schema_wa_users', '{\"id\":{\"field\":\"id\",\"_field_id\":\"0\",\"comment\":\"主键\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"enable_sort\":true,\"searchable\":true,\"search_type\":\"normal\",\"form_show\":false},\"username\":{\"field\":\"username\",\"_field_id\":\"1\",\"comment\":\"用户名\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"nickname\":{\"field\":\"nickname\",\"_field_id\":\"2\",\"comment\":\"昵称\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"password\":{\"field\":\"password\",\"_field_id\":\"3\",\"comment\":\"密码\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"sex\":{\"field\":\"sex\",\"_field_id\":\"4\",\"comment\":\"性别\",\"control\":\"select\",\"control_args\":\"url:\\/app\\/admin\\/dict\\/get\\/sex\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"avatar\":{\"field\":\"avatar\",\"_field_id\":\"5\",\"comment\":\"头像\",\"control\":\"uploadImage\",\"control_args\":\"url:\\/app\\/admin\\/upload\\/avatar\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"email\":{\"field\":\"email\",\"_field_id\":\"6\",\"comment\":\"邮箱\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"mobile\":{\"field\":\"mobile\",\"_field_id\":\"7\",\"comment\":\"手机\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"level\":{\"field\":\"level\",\"_field_id\":\"8\",\"comment\":\"等级\",\"control\":\"inputNumber\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false},\"birthday\":{\"field\":\"birthday\",\"_field_id\":\"9\",\"comment\":\"生日\",\"control\":\"datePicker\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"between\",\"list_show\":false,\"enable_sort\":false},\"money\":{\"field\":\"money\",\"_field_id\":\"10\",\"comment\":\"余额(元)\",\"control\":\"inputNumber\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false},\"score\":{\"field\":\"score\",\"_field_id\":\"11\",\"comment\":\"积分\",\"control\":\"inputNumber\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false},\"last_time\":{\"field\":\"last_time\",\"_field_id\":\"12\",\"comment\":\"登录时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"between\",\"list_show\":false,\"enable_sort\":false},\"last_ip\":{\"field\":\"last_ip\",\"_field_id\":\"13\",\"comment\":\"登录ip\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false},\"join_time\":{\"field\":\"join_time\",\"_field_id\":\"14\",\"comment\":\"注册时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"between\",\"list_show\":false,\"enable_sort\":false},\"join_ip\":{\"field\":\"join_ip\",\"_field_id\":\"15\",\"comment\":\"注册ip\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false},\"token\":{\"field\":\"token\",\"_field_id\":\"16\",\"comment\":\"token\",\"control\":\"input\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"created_at\":{\"field\":\"created_at\",\"_field_id\":\"17\",\"comment\":\"创建时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"form_show\":true,\"search_type\":\"between\",\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"updated_at\":{\"field\":\"updated_at\",\"_field_id\":\"18\",\"comment\":\"更新时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"search_type\":\"between\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"role\":{\"field\":\"role\",\"_field_id\":\"19\",\"comment\":\"角色\",\"control\":\"inputNumber\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"status\":{\"field\":\"status\",\"_field_id\":\"20\",\"comment\":\"禁用\",\"control\":\"switch\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false}}', '2022-08-15 00:00:00', '2022-12-23 15:28:13');
INSERT INTO `option` VALUES (3, 'table_form_schema_wa_roles', '{\"id\":{\"field\":\"id\",\"_field_id\":\"0\",\"comment\":\"主键\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"search_type\":\"normal\",\"form_show\":false,\"enable_sort\":false,\"searchable\":false},\"name\":{\"field\":\"name\",\"_field_id\":\"1\",\"comment\":\"角色组\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"rules\":{\"field\":\"rules\",\"_field_id\":\"2\",\"comment\":\"权限\",\"control\":\"treeSelectMulti\",\"control_args\":\"url:\\/app\\/admin\\/rule\\/get?type=0,1,2\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"created_at\":{\"field\":\"created_at\",\"_field_id\":\"3\",\"comment\":\"创建时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"updated_at\":{\"field\":\"updated_at\",\"_field_id\":\"4\",\"comment\":\"更新时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"pid\":{\"field\":\"pid\",\"_field_id\":\"5\",\"comment\":\"父级\",\"control\":\"select\",\"control_args\":\"url:\\/app\\/admin\\/role\\/select?format=tree\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false}}', '2022-08-15 00:00:00', '2022-12-19 14:24:25');
INSERT INTO `option` VALUES (4, 'table_form_schema_wa_rules', '{\"id\":{\"field\":\"id\",\"_field_id\":\"0\",\"comment\":\"主键\",\"control\":\"inputNumber\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"title\":{\"field\":\"title\",\"_field_id\":\"1\",\"comment\":\"标题\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"icon\":{\"field\":\"icon\",\"_field_id\":\"2\",\"comment\":\"图标\",\"control\":\"iconPicker\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"key\":{\"field\":\"key\",\"_field_id\":\"3\",\"comment\":\"标识\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"pid\":{\"field\":\"pid\",\"_field_id\":\"4\",\"comment\":\"上级菜单\",\"control\":\"treeSelect\",\"control_args\":\"\\/app\\/admin\\/rule\\/select?format=tree&type=0,1\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"created_at\":{\"field\":\"created_at\",\"_field_id\":\"5\",\"comment\":\"创建时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"updated_at\":{\"field\":\"updated_at\",\"_field_id\":\"6\",\"comment\":\"更新时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"href\":{\"field\":\"href\",\"_field_id\":\"7\",\"comment\":\"url\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"type\":{\"field\":\"type\",\"_field_id\":\"8\",\"comment\":\"类型\",\"control\":\"select\",\"control_args\":\"data:0:目录,1:菜单,2:权限\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"weight\":{\"field\":\"weight\",\"_field_id\":\"9\",\"comment\":\"排序\",\"control\":\"inputNumber\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false}}', '2022-08-15 00:00:00', '2022-12-08 11:44:45');
INSERT INTO `option` VALUES (5, 'table_form_schema_wa_admins', '{\"id\":{\"field\":\"id\",\"_field_id\":\"0\",\"comment\":\"ID\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"enable_sort\":true,\"search_type\":\"between\",\"form_show\":false,\"searchable\":false},\"username\":{\"field\":\"username\",\"_field_id\":\"1\",\"comment\":\"用户名\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"nickname\":{\"field\":\"nickname\",\"_field_id\":\"2\",\"comment\":\"昵称\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"password\":{\"field\":\"password\",\"_field_id\":\"3\",\"comment\":\"密码\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"avatar\":{\"field\":\"avatar\",\"_field_id\":\"4\",\"comment\":\"头像\",\"control\":\"uploadImage\",\"control_args\":\"url:\\/app\\/admin\\/upload\\/avatar\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"email\":{\"field\":\"email\",\"_field_id\":\"5\",\"comment\":\"邮箱\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"mobile\":{\"field\":\"mobile\",\"_field_id\":\"6\",\"comment\":\"手机\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"created_at\":{\"field\":\"created_at\",\"_field_id\":\"7\",\"comment\":\"创建时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"form_show\":true,\"searchable\":true,\"search_type\":\"between\",\"list_show\":false,\"enable_sort\":false},\"updated_at\":{\"field\":\"updated_at\",\"_field_id\":\"8\",\"comment\":\"更新时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"form_show\":true,\"search_type\":\"normal\",\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"login_at\":{\"field\":\"login_at\",\"_field_id\":\"9\",\"comment\":\"登录时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"between\",\"enable_sort\":false,\"searchable\":false},\"status\":{\"field\":\"status\",\"_field_id\":\"10\",\"comment\":\"禁用\",\"control\":\"switch\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false}}', '2022-08-15 00:00:00', '2022-12-23 15:36:48');
INSERT INTO `option` VALUES (6, 'table_form_schema_wa_options', '{\"id\":{\"field\":\"id\",\"_field_id\":\"0\",\"comment\":\"\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"search_type\":\"normal\",\"form_show\":false,\"enable_sort\":false,\"searchable\":false},\"name\":{\"field\":\"name\",\"_field_id\":\"1\",\"comment\":\"键\",\"control\":\"input\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"value\":{\"field\":\"value\",\"_field_id\":\"2\",\"comment\":\"值\",\"control\":\"textArea\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"created_at\":{\"field\":\"created_at\",\"_field_id\":\"3\",\"comment\":\"创建时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"updated_at\":{\"field\":\"updated_at\",\"_field_id\":\"4\",\"comment\":\"更新时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false}}', '2022-08-15 00:00:00', '2022-12-08 11:36:57');
INSERT INTO `option` VALUES (7, 'table_form_schema_wa_uploads', '{\"id\":{\"field\":\"id\",\"_field_id\":\"0\",\"comment\":\"主键\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"enable_sort\":true,\"search_type\":\"normal\",\"form_show\":false,\"searchable\":false},\"name\":{\"field\":\"name\",\"_field_id\":\"1\",\"comment\":\"名称\",\"control\":\"input\",\"control_args\":\"\",\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"form_show\":false,\"enable_sort\":false},\"url\":{\"field\":\"url\",\"_field_id\":\"2\",\"comment\":\"文件\",\"control\":\"upload\",\"control_args\":\"url:\\/app\\/admin\\/upload\\/file\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false},\"admin_id\":{\"field\":\"admin_id\",\"_field_id\":\"3\",\"comment\":\"管理员\",\"control\":\"select\",\"control_args\":\"url:\\/app\\/admin\\/admin\\/select?format=select\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"file_size\":{\"field\":\"file_size\",\"_field_id\":\"4\",\"comment\":\"文件大小\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"search_type\":\"between\",\"form_show\":false,\"enable_sort\":false,\"searchable\":false},\"mime_type\":{\"field\":\"mime_type\",\"_field_id\":\"5\",\"comment\":\"mime类型\",\"control\":\"input\",\"control_args\":\"\",\"list_show\":true,\"search_type\":\"normal\",\"form_show\":false,\"enable_sort\":false,\"searchable\":false},\"image_width\":{\"field\":\"image_width\",\"_field_id\":\"6\",\"comment\":\"图片宽度\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"search_type\":\"normal\",\"form_show\":false,\"enable_sort\":false,\"searchable\":false},\"image_height\":{\"field\":\"image_height\",\"_field_id\":\"7\",\"comment\":\"图片高度\",\"control\":\"inputNumber\",\"control_args\":\"\",\"list_show\":true,\"search_type\":\"normal\",\"form_show\":false,\"enable_sort\":false,\"searchable\":false},\"ext\":{\"field\":\"ext\",\"_field_id\":\"8\",\"comment\":\"扩展名\",\"control\":\"input\",\"control_args\":\"\",\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"form_show\":false,\"enable_sort\":false},\"storage\":{\"field\":\"storage\",\"_field_id\":\"9\",\"comment\":\"存储位置\",\"control\":\"input\",\"control_args\":\"\",\"search_type\":\"normal\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false,\"searchable\":false},\"created_at\":{\"field\":\"created_at\",\"_field_id\":\"10\",\"comment\":\"上传时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"searchable\":true,\"search_type\":\"between\",\"form_show\":false,\"list_show\":false,\"enable_sort\":false},\"category\":{\"field\":\"category\",\"_field_id\":\"11\",\"comment\":\"类别\",\"control\":\"select\",\"control_args\":\"url:\\/app\\/admin\\/dict\\/get\\/upload\",\"form_show\":true,\"list_show\":true,\"searchable\":true,\"search_type\":\"normal\",\"enable_sort\":false},\"updated_at\":{\"field\":\"updated_at\",\"_field_id\":\"12\",\"comment\":\"更新时间\",\"control\":\"dateTimePicker\",\"control_args\":\"\",\"form_show\":true,\"list_show\":true,\"search_type\":\"normal\",\"enable_sort\":false,\"searchable\":false}}', '2022-08-15 00:00:00', '2022-12-08 11:47:45');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '图标',
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标识',
  `pid` int UNSIGNED NULL DEFAULT 0 COMMENT '上级菜单',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `href` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'url',
  `type` int NOT NULL DEFAULT 1 COMMENT '类型',
  `weight` int NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限规则' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES (1, '数据库', 'layui-icon-template-1', 'database', 0, '2024-08-05 20:11:13', '2024-08-05 21:42:49', NULL, 0, 1000);
INSERT INTO `permission` VALUES (2, '所有表', NULL, 'app\\controller\\TableController', 1, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/table/index', 1, 800);
INSERT INTO `permission` VALUES (3, '权限管理', 'layui-icon-vercode', 'auth', 0, '2024-08-05 20:11:13', '2024-08-05 21:42:49', NULL, 0, 900);
INSERT INTO `permission` VALUES (4, '账户管理', NULL, 'app\\controller\\AdminController', 3, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/admin/index', 1, 1000);
INSERT INTO `permission` VALUES (5, '角色管理', NULL, 'app\\controller\\RoleController', 3, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/role/index', 1, 900);
INSERT INTO `permission` VALUES (6, '菜单管理', NULL, 'app\\controller\\PermissionController', 3, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/permission/index', 1, 800);
INSERT INTO `permission` VALUES (7, '会员管理', 'layui-icon-username', 'user', 0, '2024-08-05 20:11:13', '2024-08-05 21:42:49', NULL, 0, 800);
INSERT INTO `permission` VALUES (9, '通用设置', 'layui-icon-set', 'common', 0, '2024-08-05 20:11:13', '2024-08-05 21:42:49', NULL, 0, 700);
INSERT INTO `permission` VALUES (10, '个人资料', NULL, 'app\\controller\\AccountController', 9, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/account/index', 1, 800);
INSERT INTO `permission` VALUES (11, '附件管理', NULL, 'app\\controller\\UploadController', 9, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/upload/index', 1, 700);
INSERT INTO `permission` VALUES (12, '字典设置', NULL, 'app\\controller\\OptionController', 9, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/option/index', 1, 600);
INSERT INTO `permission` VALUES (13, '系统设置', NULL, 'app\\controller\\ConfigController', 9, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/config/index', 1, 500);
INSERT INTO `permission` VALUES (14, '插件管理', 'layui-icon-app', 'plugin', 0, '2024-08-05 20:11:13', '2024-08-05 21:42:49', NULL, 0, 600);
INSERT INTO `permission` VALUES (15, '应用插件', NULL, 'app\\controller\\PluginController', 14, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/plugin/index', 1, 800);
INSERT INTO `permission` VALUES (16, '开发辅助', 'layui-icon-fonts-code', 'dev', 0, '2024-08-05 20:11:13', '2024-08-05 21:42:49', NULL, 0, 500);
INSERT INTO `permission` VALUES (17, '表单构建', NULL, 'app\\controller\\DevController', 16, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/dev/form-build', 1, 800);
INSERT INTO `permission` VALUES (18, '示例页面', 'layui-icon-templeate-1', 'demos', 0, '2024-08-05 20:11:13', '2024-08-05 21:42:49', NULL, 0, 400);
INSERT INTO `permission` VALUES (19, '工作空间', 'layui-icon-console', 'demo1', 18, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '', 0, 0);
INSERT INTO `permission` VALUES (20, '控制后台', 'layui-icon-console', 'demo10', 19, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/console/console1.html', 1, 0);
INSERT INTO `permission` VALUES (21, '数据分析', 'layui-icon-console', 'demo13', 19, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/console/console2.html', 1, 0);
INSERT INTO `permission` VALUES (22, '百度一下', 'layui-icon-console', 'demo14', 19, '2024-08-05 20:11:13', '2024-08-05 21:42:49', 'http://www.baidu.com', 1, 0);
INSERT INTO `permission` VALUES (23, '主题预览', 'layui-icon-console', 'demo15', 19, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/system/theme.html', 1, 0);
INSERT INTO `permission` VALUES (24, '常用组件', 'layui-icon-component', 'demo20', 18, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '', 0, 0);
INSERT INTO `permission` VALUES (25, '功能按钮', 'layui-icon-face-smile', 'demo2011', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/button.html', 1, 0);
INSERT INTO `permission` VALUES (26, '表单集合', 'layui-icon-face-cry', 'demo2014', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/form.html', 1, 0);
INSERT INTO `permission` VALUES (27, '字体图标', 'layui-icon-face-cry', 'demo2010', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/icon.html', 1, 0);
INSERT INTO `permission` VALUES (28, '多选下拉', 'layui-icon-face-cry', 'demo2012', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/select.html', 1, 0);
INSERT INTO `permission` VALUES (29, '动态标签', 'layui-icon-face-cry', 'demo2013', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/tag.html', 1, 0);
INSERT INTO `permission` VALUES (30, '数据表格', 'layui-icon-face-cry', 'demo2031', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/table.html', 1, 0);
INSERT INTO `permission` VALUES (31, '分布表单', 'layui-icon-face-cry', 'demo2032', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/step.html', 1, 0);
INSERT INTO `permission` VALUES (32, '树形表格', 'layui-icon-face-cry', 'demo2033', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/treetable.html', 1, 0);
INSERT INTO `permission` VALUES (33, '树状结构', 'layui-icon-face-cry', 'demo2034', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/dtree.html', 1, 0);
INSERT INTO `permission` VALUES (34, '文本编辑', 'layui-icon-face-cry', 'demo2035', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/tinymce.html', 1, 0);
INSERT INTO `permission` VALUES (35, '卡片组件', 'layui-icon-face-cry', 'demo2036', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/card.html', 1, 0);
INSERT INTO `permission` VALUES (36, '抽屉组件', 'layui-icon-face-cry', 'demo2021', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/drawer.html', 1, 0);
INSERT INTO `permission` VALUES (37, '消息通知', 'layui-icon-face-cry', 'demo2022', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/notice.html', 1, 0);
INSERT INTO `permission` VALUES (38, '加载组件', 'layui-icon-face-cry', 'demo2024', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/loading.html', 1, 0);
INSERT INTO `permission` VALUES (39, '弹层组件', 'layui-icon-face-cry', 'demo2023', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/popup.html', 1, 0);
INSERT INTO `permission` VALUES (40, '多选项卡', 'layui-icon-face-cry', 'demo60131', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/tab.html', 1, 0);
INSERT INTO `permission` VALUES (41, '数据菜单', 'layui-icon-face-cry', 'demo60132', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/menu.html', 1, 0);
INSERT INTO `permission` VALUES (42, '哈希加密', 'layui-icon-face-cry', 'demo2041', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/encrypt.html', 1, 0);
INSERT INTO `permission` VALUES (43, '图标选择', 'layui-icon-face-cry', 'demo2042', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/iconPicker.html', 1, 0);
INSERT INTO `permission` VALUES (44, '省市级联', 'layui-icon-face-cry', 'demo2043', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/area.html', 1, 0);
INSERT INTO `permission` VALUES (45, '数字滚动', 'layui-icon-face-cry', 'demo2044', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/count.html', 1, 0);
INSERT INTO `permission` VALUES (46, '顶部返回', 'layui-icon-face-cry', 'demo2045', 24, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/document/topBar.html', 1, 0);
INSERT INTO `permission` VALUES (47, '结果页面', 'layui-icon-auz', 'demo666', 18, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '', 0, 0);
INSERT INTO `permission` VALUES (48, '成功', 'layui-icon-face-smile', 'demo667', 47, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/result/success.html', 1, 0);
INSERT INTO `permission` VALUES (49, '失败', 'layui-icon-face-cry', 'demo668', 47, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/result/error.html', 1, 0);
INSERT INTO `permission` VALUES (50, '错误页面', 'layui-icon-face-cry', 'demo-error', 18, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '', 0, 0);
INSERT INTO `permission` VALUES (51, '403', 'layui-icon-face-smile', 'demo403', 50, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/error/403.html', 1, 0);
INSERT INTO `permission` VALUES (52, '404', 'layui-icon-face-cry', 'demo404', 50, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/error/404.html', 1, 0);
INSERT INTO `permission` VALUES (53, '500', 'layui-icon-face-cry', 'demo500', 50, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/error/500.html', 1, 0);
INSERT INTO `permission` VALUES (54, '系统管理', 'layui-icon-set-fill', 'demo-system', 18, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '', 0, 0);
INSERT INTO `permission` VALUES (55, '用户管理', 'layui-icon-face-smile', 'demo601', 54, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/system/user.html', 1, 0);
INSERT INTO `permission` VALUES (56, '角色管理', 'layui-icon-face-cry', 'demo602', 54, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/system/role.html', 1, 0);
INSERT INTO `permission` VALUES (57, '权限管理', 'layui-icon-face-cry', 'demo603', 54, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/system/power.html', 1, 0);
INSERT INTO `permission` VALUES (58, '部门管理', 'layui-icon-face-cry', 'demo604', 54, '2024-08-05 20:11:13', '2024-08-05 21:42:49', '/demos/system/deptment.html', 1, 0);
INSERT INTO `permission` VALUES (59, '行为日志', 'layui-icon-face-cry', 'demo605', 54, '2024-08-05 20:11:14', '2024-08-05 21:42:49', '/demos/system/log.html', 1, 0);
INSERT INTO `permission` VALUES (60, '数据字典', 'layui-icon-face-cry', 'demo606', 54, '2024-08-05 20:11:14', '2024-08-05 21:42:49', '/demos/system/option.html', 1, 0);
INSERT INTO `permission` VALUES (61, '常用页面', 'layui-icon-template-1', 'demo-common', 18, '2024-08-05 20:11:14', '2024-08-05 21:42:49', '', 0, 0);
INSERT INTO `permission` VALUES (62, '空白页面', 'layui-icon-face-smile', 'demo702', 61, '2024-08-05 20:11:14', '2024-08-05 21:42:49', '/demos/system/space.html', 1, 0);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `pid` int UNSIGNED NULL DEFAULT NULL COMMENT '父级',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uk_name`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员角色' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, '超级管理员', '2022-08-13 16:15:01', '2022-12-23 12:05:07', 0);
INSERT INTO `role` VALUES (2, '开发组', '2024-08-11 21:31:39', '2024-08-11 21:39:15', 1);
INSERT INTO `role` VALUES (3, '测试', '2024-08-11 21:32:27', '2024-08-11 21:32:27', 1);
INSERT INTO `role` VALUES (4, '产品', '2024-08-11 21:32:37', '2024-08-11 21:32:37', 1);
INSERT INTO `role` VALUES (5, '产品一组', '2024-08-11 21:33:02', '2024-08-11 21:33:02', 4);
INSERT INTO `role` VALUES (6, '产品二组', '2024-08-11 21:33:08', '2024-08-11 21:33:08', 4);
INSERT INTO `role` VALUES (7, '开发一组', '2024-08-11 21:33:22', '2024-08-11 21:33:22', 2);
INSERT INTO `role` VALUES (8, '开发二组', '2024-08-11 21:33:27', '2024-08-11 21:33:27', 2);
INSERT INTO `role` VALUES (17, '测试二组', '2024-08-11 22:02:59', '2024-08-11 22:02:59', 3);
INSERT INTO `role` VALUES (18, '测试一组', '2024-08-11 22:03:24', '2024-08-11 22:03:24', 3);

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `role_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色ID',
  `permission_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '权限ID',
  PRIMARY KEY (`id` DESC) USING BTREE,
  UNIQUE INDEX `uk_role_permission_id`(`role_id` ASC, `permission_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '角色权限' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_permission
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
