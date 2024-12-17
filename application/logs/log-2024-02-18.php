<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeUnion I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officePaurashava I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeUpazila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeDdlg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeZila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeCity I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeNilg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeMinistry I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeDirectorate I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 15:21:28 --> Severity: Notice --> Undefined variable: officeDevlopment I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeUnion I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officePaurashava I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeUpazila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeDdlg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeZila I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeCity I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeNilg I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeMinistry I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeDirectorate I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 17:10:56 --> Severity: Notice --> Undefined variable: officeDevlopment I:\xampp\htdocs\nilg\application\modules\dashboard\views\superadmin_dashboard.php 649
ERROR - 2024-02-18 18:59:43 --> Query error: Table 'nilg_erp.dasignation_manage' doesn't exist - Invalid query: SELECT `dm`.`desig_id` as `id`
FROM `dasignation_manage` as `dm`
WHERE `dm`.`groups_id` = '22'
AND `dm`.`dept_id` = '2'
ERROR - 2024-02-18 19:00:10 --> Query error: Table 'nilg_erp.dasignation_manage' doesn't exist - Invalid query: SELECT `dm`.`desig_id` as `id`
FROM `dasignation_manage` as `dm`
WHERE `dm`.`groups_id` = '22'
AND `dm`.`dept_id` = '5'
ERROR - 2024-02-18 19:01:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '*
FROM `designations` as `dg`
WHERE `dg`.`id` IN('10', '11', '83', '84', '85', '' at line 1 - Invalid query: SELECT `dg`.`id`, `dg`.`desig_name`, *
FROM `designations` as `dg`
WHERE `dg`.`id` IN('10', '11', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108', '109', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119', '120', '121', '122', '123', '139', '140', '184', '203', '219', '242', '244', '265', '266')
GROUP BY `dg`.`id`
