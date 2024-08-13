
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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员' ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员角色' ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '附件' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of media
-- ----------------------------
INSERT INTO `media` VALUES (1, 'bg.jpg', '/upload/files/20240805/66b0d1d72c9a.jpg', 1, 373081, 'image/jpeg', 1920, 1080, 'jpg', 'local', '1', '2024-08-05 00:00:00', '2024-08-05 00:00:00');

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限规则' ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员角色' ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '角色权限' ROW_FORMAT = Dynamic;

CREATE TABLE `dict_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '字典名称',
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '字典标识',
  `status` tinyint(3) unsigned DEFAULT '1' COMMENT '状态 (1正常 0禁用)',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='字典类型';

CREATE TABLE `dict_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '字典类型ID',
  `label` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '字典标签',
  `value` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '字典值',
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '字典标识',
  `sort` smallint(5) unsigned DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) unsigned DEFAULT '1' COMMENT '状态 (1正常 0禁用)',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `idx_type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='字典数据表';

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '值',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
