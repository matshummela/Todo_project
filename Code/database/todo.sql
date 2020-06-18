/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : todo

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 31/05/2020 11:17:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userlist_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_auth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_read` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (4, 8, 2, '夏嘉邀请您共享TODO列表', NULL, '1', '2020-05-29 02:46:57', '2020-05-29 11:17:30');
INSERT INTO `message` VALUES (5, 1, 1, '张三接受了共享TODO列表的请求', '1', '1', '2020-05-29 03:14:54', '2020-05-29 07:31:07');
INSERT INTO `message` VALUES (7, 19, 3, '夏嘉邀请您共享TODO列表', NULL, '1', '2020-05-29 07:09:26', '2020-05-29 07:14:31');
INSERT INTO `message` VALUES (14, 20, 3, '夏嘉接受了共享TODO列表的请求', '1', '1', '2020-05-29 07:27:33', '2020-05-29 07:39:07');
INSERT INTO `message` VALUES (13, 20, 1, '李四邀请您共享TODO列表', NULL, '1', '2020-05-29 07:26:45', '2020-05-29 07:27:33');
INSERT INTO `message` VALUES (12, 19, 1, '李四接受了共享TODO列表的请求', '1', '1', '2020-05-29 07:14:31', '2020-05-29 07:31:07');
INSERT INTO `message` VALUES (15, 19, 3, '夏嘉解除了与您进行共享___面试任务___ToDo列表的请求', '1', '1', '2020-05-29 07:38:51', '2020-05-29 07:42:08');
INSERT INTO `message` VALUES (16, 21, 3, '夏嘉邀请您共享---面试任务---TODO列表', NULL, '1', '2020-05-29 07:42:49', '2020-05-29 07:43:06');
INSERT INTO `message` VALUES (17, 21, 1, '李四接受了共享---面试任务---TODO列表的请求', '1', '1', '2020-05-29 07:43:06', '2020-05-29 07:43:40');
INSERT INTO `message` VALUES (20, 24, 1, '李四邀请您共享---李四的任务---TODO列表', NULL, '1', '2020-05-29 07:54:36', '2020-05-29 07:54:48');
INSERT INTO `message` VALUES (21, 24, 3, '夏嘉拒绝了共享---李四的任务---TODO列表的请求', '1', '1', '2020-05-29 07:54:48', '2020-05-29 07:54:59');
INSERT INTO `message` VALUES (22, 25, 1, '李四邀请您共享---李四的任务---TODO列表', NULL, '1', '2020-05-29 07:59:18', '2020-05-29 07:59:33');
INSERT INTO `message` VALUES (23, 25, 3, '夏嘉拒绝了共享---李四的任务---TODO列表的请求', '1', '1', '2020-05-29 07:59:33', '2020-05-29 07:59:54');
INSERT INTO `message` VALUES (24, 26, 1, '李四邀请您共享---李四的任务---TODO列表', NULL, '1', '2020-05-29 08:00:02', '2020-05-29 08:00:13');
INSERT INTO `message` VALUES (25, 26, 3, '夏嘉接受了共享---李四的任务---TODO列表的请求', '1', '1', '2020-05-29 08:00:13', '2020-05-30 08:36:59');
INSERT INTO `message` VALUES (26, 21, 3, '夏嘉解除了与您进行共享---面试任务---ToDo列表的请求', '1', '1', '2020-05-30 08:36:45', '2020-05-30 08:36:59');
INSERT INTO `message` VALUES (27, 27, 3, '夏嘉邀请您共享---录屏任务---TODO列表', NULL, '1', '2020-05-31 01:48:14', '2020-05-31 01:48:34');
INSERT INTO `message` VALUES (28, 27, 1, '李四接受了共享---录屏任务---TODO列表的请求', '1', '1', '2020-05-31 01:48:34', '2020-05-31 01:48:56');
INSERT INTO `message` VALUES (29, 27, 3, '夏嘉解除了与您进行共享---录屏任务---ToDo列表的请求', '1', '1', '2020-05-31 01:49:50', '2020-05-31 01:50:01');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for todo
-- ----------------------------
DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `todolist_id` int(10) NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of todo
-- ----------------------------
INSERT INTO `todo` VALUES (5, 1, 1, '0', '任务3', '2020-05-27 01:42:26', '2020-05-27 01:42:26', NULL);
INSERT INTO `todo` VALUES (2, 1, 1, '1', '任务2', '2020-05-27 01:04:14', '2020-05-27 02:16:42', NULL);
INSERT INTO `todo` VALUES (4, 1, 1, '1', '任务1', '2020-05-27 01:42:21', '2020-05-27 01:42:21', NULL);
INSERT INTO `todo` VALUES (6, 1, 1, '1', '任务4', '2020-05-27 01:43:02', '2020-05-27 01:43:02', NULL);
INSERT INTO `todo` VALUES (8, 1, 1, '0', '任务5', '2020-05-27 08:44:07', '2020-05-27 08:44:07', NULL);
INSERT INTO `todo` VALUES (9, 1, 1, '1', '任务6', '2020-05-27 08:59:09', '2020-05-28 02:36:29', NULL);
INSERT INTO `todo` VALUES (11, 1, 3, '1', '面试任务1', '2020-05-29 02:39:17', '2020-05-29 07:43:20', NULL);
INSERT INTO `todo` VALUES (12, 1, 3, '1', '面试任务2', '2020-05-29 02:41:39', '2020-05-29 02:41:42', NULL);
INSERT INTO `todo` VALUES (13, 3, 4, '1', '上午去一趟北京', '2020-05-29 07:25:59', '2020-05-29 07:34:06', NULL);
INSERT INTO `todo` VALUES (14, 1, 4, '0', '上午去一趟河北', '2020-05-29 07:27:57', '2020-05-29 07:27:57', NULL);
INSERT INTO `todo` VALUES (15, 1, 6, '1', '新增事项', '2020-05-31 01:47:19', '2020-05-31 01:47:28', NULL);
INSERT INTO `todo` VALUES (16, 1, 6, '0', '新增事项2', '2020-05-31 01:47:38', '2020-05-31 01:47:38', NULL);

-- ----------------------------
-- Table structure for todo_list
-- ----------------------------
DROP TABLE IF EXISTS `todo_list`;
CREATE TABLE `todo_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of todo_list
-- ----------------------------
INSERT INTO `todo_list` VALUES (1, 'todoList1', 1, '2020-05-27 16:33:16', '2020-05-27 16:33:18');
INSERT INTO `todo_list` VALUES (3, '面试任务', 1, '2020-05-29 02:36:30', '2020-05-29 02:36:30');
INSERT INTO `todo_list` VALUES (4, '李四的任务', 3, '2020-05-29 07:25:32', '2020-05-29 07:25:32');
INSERT INTO `todo_list` VALUES (6, '录屏任务', 1, '2020-05-31 01:47:11', '2020-05-31 01:47:11');

-- ----------------------------
-- Table structure for user_todolist
-- ----------------------------
DROP TABLE IF EXISTS `user_todolist`;
CREATE TABLE `user_todolist`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `author_id` int(11) NOT NULL,
  `todolist_id` int(10) NOT NULL,
  `is_update` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '是否拥有修改权限',
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '0代表未查看，1代表拒绝，2代表接受',
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '是否已读',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_todolist
-- ----------------------------
INSERT INTO `user_todolist` VALUES (2, 2, 1, 1, '1', '2', '1', '2020-05-27 07:11:57', '2020-05-28 02:36:16');
INSERT INTO `user_todolist` VALUES (22, 2, 1, 3, '0', '0', NULL, '2020-05-29 07:47:12', '2020-05-29 07:47:12');
INSERT INTO `user_todolist` VALUES (8, 2, 1, 3, '1', '2', '1', '2020-05-29 02:46:57', '2020-05-29 03:14:30');
INSERT INTO `user_todolist` VALUES (26, 1, 3, 4, '1', '2', '1', '2020-05-29 08:00:02', '2020-05-29 08:00:13');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '夏嘉', '1643329964@qq.com', NULL, '$2y$10$LcEwhkpo90/BqgSPdG6a/u1RrTdMouuoLmKVfeyqwE7JGU2FdD1Cu', 'MDctpukHD7lwAu62u6ps3siwnTHTmKXijtB5YVDQMsJVXuepAhLwWGnoWlf8', '2020-05-26 10:30:44', '2020-05-26 10:30:44');
INSERT INTO `users` VALUES (2, '张三', '917562427@qq.com', NULL, '$2y$10$hOK5tmr9rcNrIxBj.PKFS.p6ObdFJ6RbK9zqQGVW3Ld7QBDHOH7Q.', NULL, '2020-05-27 06:16:49', '2020-05-27 06:16:49');
INSERT INTO `users` VALUES (3, '李四', '2923024960@qq.com', NULL, '$2y$10$kTocwdpqetPZS1yx0Q5vE.ZglsTZlYC2HlKj75r/w.NIb.gu6d3Ym', NULL, '2020-05-27 08:43:28', '2020-05-27 08:43:28');
INSERT INTO `users` VALUES (4, 'test', 'test@laravel58.test', NULL, '$2y$04$AHeBg9Sl.CG8ikrhZX28ouNuLl6Q9P56K3FwhVNs.MgWzM06xeuNe', NULL, '2020-05-30 07:50:52', '2020-05-30 07:50:52');

SET FOREIGN_KEY_CHECKS = 1;
