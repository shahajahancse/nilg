<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-15 10:18:46 --> 404 Page Not Found: /index
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-15 10:18:46 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:18:47 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:19:21 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1013
ERROR - 2024-07-15 10:19:21 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1014
ERROR - 2024-07-15 10:19:22 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:19:22 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:19:22 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:22:20 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:22:21 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:22:32 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:22:32 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:22:35 --> Severity: Notice --> Undefined variable: results I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:22:35 --> Severity: Warning --> Invalid argument supplied for foreach() I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:22:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LEFT JOIN `budget_j_publication_group` as `pg` ON `pb`.`group_id`=`pg`.`id`.
WHE' at line 4 - Invalid query: SELECT `pb`.`id`, `pg`.`name_bn`, `pg`.`name_en`, `prd`.`price`, SUM(CASE WHEN prd.type = 1 THEN prd.quantity ELSE 0 END) as book_in, SUM(CASE WHEN prd.type = 2 THEN prd.quantity ELSE 0 END) as book_sale, SUM(CASE WHEN prd.type = 3 THEN prd.quantity ELSE 0 END) as book_give, SUM(CASE WHEN prd.type = 4 THEN prd.quantity ELSE 0 END) as sell_by_kg, SUM(CASE WHEN prd.type = 1 THEN prd.amount ELSE 0 END) as book_in_amt, SUM(CASE WHEN prd.type = 2 THEN prd.amount ELSE 0 END) as book_sale_amt, SUM(CASE WHEN prd.type = 3 THEN prd.amount ELSE 0 END) as book_give_amt, SUM(CASE WHEN prd.type = 4 THEN prd.amount ELSE 0 END) as sell_by_kg_amt
FROM `budget_j_publication_register_details` as `prd`
LEFT JOIN `budget_j_publication_book` as `pb` ON `prd`.`book_id`=`pb`.`id`.
LEFT JOIN `budget_j_publication_group` as `pg` ON `pb`.`group_id`=`pg`.`id`.
WHERE `pb`.`status` = 1
GROUP BY `pb`.`group_id`
ERROR - 2024-07-15 10:22:57 --> Severity: Notice --> Undefined variable: results I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:22:57 --> Severity: Warning --> Invalid argument supplied for foreach() I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:30:24 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:30:24 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:33:59 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:34:00 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:43:53 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:43:53 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:43:54 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:43:55 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:43:56 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:44:03 --> Severity: Notice --> Undefined variable: results I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:44:03 --> Severity: Warning --> Invalid argument supplied for foreach() I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:44:26 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:44:26 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:44:27 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:44:28 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:44:29 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:45:03 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:45:04 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:45:04 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:45:05 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:45:05 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:45:15 --> Severity: Notice --> Undefined variable: book_id I:\xampp\htdocs\nilg\application\modules\journal_entry\models\Journal_entry_model.php 121
ERROR - 2024-07-15 10:46:38 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:46:39 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:46:39 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:46:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:46:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:46:44 --> Severity: Notice --> Undefined variable: book_id I:\xampp\htdocs\nilg\application\modules\journal_entry\models\Journal_entry_model.php 121
ERROR - 2024-07-15 10:47:46 --> Severity: Notice --> Undefined variable: book_id I:\xampp\htdocs\nilg\application\modules\journal_entry\models\Journal_entry_model.php 121
ERROR - 2024-07-15 10:49:07 --> Severity: Notice --> Undefined variable: results I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:49:07 --> Severity: Warning --> Invalid argument supplied for foreach() I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:55:04 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:55:05 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:55:05 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:55:05 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:59:28 --> Severity: Notice --> Undefined variable: results I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:59:28 --> Severity: Warning --> Invalid argument supplied for foreach() I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 10:59:55 --> 404 Page Not Found: /index
ERROR - 2024-07-15 10:59:59 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:00:00 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:00:00 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:10:41 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:10:41 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:10:42 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:10:42 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:10:46 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:10:46 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:15 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:16 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:16 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:16 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:18 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:18 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:19 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:19 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:20 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:16:20 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:18:46 --> Severity: Notice --> Undefined variable: results I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 11:18:46 --> Severity: Warning --> Invalid argument supplied for foreach() I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 301
ERROR - 2024-07-15 11:19:23 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:19:24 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:19:24 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:19:25 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:19:25 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:19:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LEFT JOIN `budget_j_publication_group` as `pg` ON `pb`.`group_id`=`pg`.`id`.
WHE' at line 4 - Invalid query: SELECT `pb`.`id`, `pg`.`name_bn`, `pg`.`name_en`, `prd`.`price`, SUM(CASE WHEN prd.type = 1 THEN prd.quantity ELSE 0 END) as book_in, SUM(CASE WHEN prd.type = 2 THEN prd.quantity ELSE 0 END) as book_sale, SUM(CASE WHEN prd.type = 3 THEN prd.quantity ELSE 0 END) as book_give, SUM(CASE WHEN prd.type = 4 THEN prd.quantity ELSE 0 END) as sell_by_kg, SUM(CASE WHEN prd.type = 1 THEN prd.amount ELSE 0 END) as book_in_amt, SUM(CASE WHEN prd.type = 2 THEN prd.amount ELSE 0 END) as book_sale_amt, SUM(CASE WHEN prd.type = 3 THEN prd.amount ELSE 0 END) as book_give_amt, SUM(CASE WHEN prd.type = 4 THEN prd.amount ELSE 0 END) as sell_by_kg_amt
FROM `budget_j_publication_register_details` as `prd`
LEFT JOIN `budget_j_publication_book` as `pb` ON `prd`.`book_id`=`pb`.`id`.
LEFT JOIN `budget_j_publication_group` as `pg` ON `pb`.`group_id`=`pg`.`id`.
WHERE `pb`.`status` = 1
GROUP BY `pb`.`group_id`
ERROR - 2024-07-15 11:21:44 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:21:45 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:21:46 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:21:46 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:21:47 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:21:47 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:22:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LEFT JOIN `budget_j_publication_group` as `pg` ON `pb`.`group_id`=`pg`.`id`.
WHE' at line 4 - Invalid query: SELECT `pb`.`id`, `pg`.`name_bn`, `pg`.`name_en`, `prd`.`price`, SUM(CASE WHEN prd.type = 1 THEN prd.quantity ELSE 0 END) as book_in, SUM(CASE WHEN prd.type = 2 THEN prd.quantity ELSE 0 END) as book_sale, SUM(CASE WHEN prd.type = 3 THEN prd.quantity ELSE 0 END) as book_give, SUM(CASE WHEN prd.type = 4 THEN prd.quantity ELSE 0 END) as sell_by_kg, SUM(CASE WHEN prd.type = 1 THEN prd.amount ELSE 0 END) as book_in_amt, SUM(CASE WHEN prd.type = 2 THEN prd.amount ELSE 0 END) as book_sale_amt, SUM(CASE WHEN prd.type = 3 THEN prd.amount ELSE 0 END) as book_give_amt, SUM(CASE WHEN prd.type = 4 THEN prd.amount ELSE 0 END) as sell_by_kg_amt
FROM `budget_j_publication_register_details` as `prd`
LEFT JOIN `budget_j_publication_book` as `pb` ON `prd`.`book_id`=`pb`.`id`.
LEFT JOIN `budget_j_publication_group` as `pg` ON `pb`.`group_id`=`pg`.`id`.
WHERE `pb`.`status` = 1
GROUP BY `pb`.`group_id`
ERROR - 2024-07-15 11:38:37 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:38:37 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:38:37 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:38:38 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:40:35 --> 404 Page Not Found: ../modules/journal_entry/controllers/Journal_entry/index
ERROR - 2024-07-15 11:40:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:40:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:40:41 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:40:45 --> 404 Page Not Found: /index
ERROR - 2024-07-15 11:40:45 --> 404 Page Not Found: /index
ERROR - 2024-07-15 12:46:03 --> 404 Page Not Found: /index
ERROR - 2024-07-15 12:46:03 --> 404 Page Not Found: /index
ERROR - 2024-07-15 12:46:04 --> 404 Page Not Found: /index
ERROR - 2024-07-15 12:48:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 12:48:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 12:48:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeUnion I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officePaurashava I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeUpazila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeDdlg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeZila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeCity I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeNilg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeMinistry I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeDirectorate I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> Severity: Notice --> Undefined variable: officeDevlopment I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 12:55:47 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:27:32 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1013
ERROR - 2024-07-15 14:27:32 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1014
ERROR - 2024-07-15 14:27:33 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:27:33 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:27:33 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:27:38 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:27:38 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined variable: group_id I:\xampp\htdocs\nilg\application\modules\journal_entry\controllers\Journal_entry.php 1209
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$voucher_no I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 305
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$amount I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 308
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$date I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 310
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 312
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 314
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$status I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 320
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$reference I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 326
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$voucher_no I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 305
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$amount I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 308
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$date I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 310
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 312
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 314
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$status I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 320
ERROR - 2024-07-15 14:27:41 --> Severity: Notice --> Undefined property: stdClass::$reference I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 326
ERROR - 2024-07-15 14:29:25 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:29:26 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:29:47 --> Severity: Notice --> Undefined variable: group_id I:\xampp\htdocs\nilg\application\modules\journal_entry\controllers\Journal_entry.php 1209
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$voucher_no I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 305
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$amount I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 308
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$date I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 310
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 312
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 314
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$status I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 320
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$reference I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 326
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$voucher_no I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 305
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$amount I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 308
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$date I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 310
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 312
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 314
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$status I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 320
ERROR - 2024-07-15 14:39:39 --> Severity: Notice --> Undefined property: stdClass::$reference I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 326
ERROR - 2024-07-15 14:40:02 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:40:03 --> 404 Page Not Found: /index
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$voucher_no I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 305
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$amount I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 308
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$date I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 310
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 312
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 314
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$status I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 320
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$reference I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 326
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$voucher_no I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 305
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$amount I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 308
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$date I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 310
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 312
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$type I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 314
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$status I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 320
ERROR - 2024-07-15 14:40:04 --> Severity: Notice --> Undefined property: stdClass::$reference I:\xampp\htdocs\nilg\application\modules\journal_entry\views\all_journal_report.php 326
ERROR - 2024-07-15 15:02:54 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:02:54 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:02:54 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:02:55 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeUnion I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officePaurashava I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeUpazila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeDdlg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeZila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeCity I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeNilg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeMinistry I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeDirectorate I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> Severity: Notice --> Undefined variable: officeDevlopment I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-07-15 15:03:07 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:04:51 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:04:53 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:05:18 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:15:39 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1013
ERROR - 2024-07-15 15:15:39 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1014
ERROR - 2024-07-15 15:15:39 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:15:39 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:15:40 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:15:50 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:15:51 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:15:53 --> 404 Page Not Found: /index
ERROR - 2024-07-15 15:15:54 --> 404 Page Not Found: /index
