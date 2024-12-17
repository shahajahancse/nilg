<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-01-12 10:44:08 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:44:13 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:44:31 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:44:35 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:44:41 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:31 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:32 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:37 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:37 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:39 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:40 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:51 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:51 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:54 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:55 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:56 --> 404 Page Not Found: /index
ERROR - 2023-01-12 10:45:57 --> 404 Page Not Found: /index
ERROR - 2023-01-12 12:29:53 --> Query error: Table 'nilg_erp.users' doesn't exist - Invalid query: SELECT `u`.`id`, `u`.`username`, `u`.`name_bn`, `u`.`is_office`, `u`.`office_type`, `ot`.`office_type_name`, `u`.`crrnt_office_id`, `u`.`crrnt_dept_id`, `u`.`crrnt_desig_id`, `o`.`office_name`, `u`.`office_name` as `user_office_name`, `u`.`div_id`, `u`.`dis_id`, `u`.`upa_id`, `u`.`union_id`, `dv`.`div_name_bn`, `ds`.`dis_name_bn`, `ut`.`upa_name_bn`, `uni`.`uni_name_bn`, `u`.`profile_img`, FROM_UNIXTIME(u.last_login) AS last_login
FROM `users` `u`
LEFT JOIN `office` `o` ON `o`.`id` = `u`.`crrnt_office_id`
LEFT JOIN `office_type` `ot` ON `ot`.`id` = `u`.`office_type`
LEFT JOIN `divisions` `dv` ON `dv`.`id` = `u`.`div_id`
LEFT JOIN `districts` `ds` ON `ds`.`id` = `u`.`dis_id`
LEFT JOIN `upazilas` `ut` ON `ut`.`id` = `u`.`upa_id`
LEFT JOIN `unions` `uni` ON `uni`.`id` = `u`.`union_id`
WHERE `u`.`id` = '1'
ERROR - 2023-01-12 12:30:02 --> Query error: Table 'nilg_erp.users_groups' doesn't exist - Invalid query: SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1'
ERROR - 2023-01-12 12:30:03 --> Query error: Table 'nilg_erp.users_groups' doesn't exist - Invalid query: SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1'
ERROR - 2023-01-12 13:11:50 --> Query error: Unknown column 'pnt.training_id' in 'on clause' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `pnt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`batch_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 22469
AND `nt`.`is_complete` = 1
ERROR - 2023-01-12 13:14:37 --> Query error: Unknown column 'pnt.training_id' in 'on clause' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `pnt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`batch_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` as `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 22469
AND `nt`.`is_complete` = 1
ERROR - 2023-01-12 13:14:38 --> Query error: Unknown column 'pnt.training_id' in 'on clause' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `pnt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`batch_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` as `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 22469
AND `nt`.`is_complete` = 1
ERROR - 2023-01-12 13:14:38 --> Query error: Unknown column 'pnt.training_id' in 'on clause' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `pnt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`batch_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` as `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 22469
AND `nt`.`is_complete` = 1
ERROR - 2023-01-12 13:14:39 --> Query error: Unknown column 'pnt.training_id' in 'on clause' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `pnt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`batch_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` as `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 22469
AND `nt`.`is_complete` = 1
ERROR - 2023-01-12 13:14:39 --> Query error: Unknown column 'pnt.training_id' in 'on clause' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `pnt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`batch_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` as `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 22469
AND `nt`.`is_complete` = 1
ERROR - 2023-01-12 15:46:55 --> Query error: Unknown column 'pnt.training_id' in 'on clause' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `pnt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`batch_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 22532
AND `nt`.`is_complete` = 1
ERROR - 2023-01-12 15:48:08 --> 404 Page Not Found: /index
ERROR - 2023-01-12 15:58:49 --> Severity: Notice --> Undefined property: stdClass::$nilg_batch_no D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 312
ERROR - 2023-01-12 15:58:49 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_start D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 313
ERROR - 2023-01-12 15:58:49 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_end D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 313
ERROR - 2023-01-12 15:58:49 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_start D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 314
ERROR - 2023-01-12 15:58:49 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_end D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 314
ERROR - 2023-01-12 15:58:49 --> 404 Page Not Found: /index
ERROR - 2023-01-12 16:02:02 --> Severity: Notice --> Undefined property: stdClass::$nilg_batch_no D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 312
ERROR - 2023-01-12 16:02:02 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_start D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 313
ERROR - 2023-01-12 16:02:02 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_end D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 313
ERROR - 2023-01-12 16:02:02 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_start D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 314
ERROR - 2023-01-12 16:02:02 --> Severity: Notice --> Undefined property: stdClass::$nilg_training_end D:\xampp\htdocs\nilg-erp\application\modules\trainee\views\details_employee_nilg.php 314
ERROR - 2023-01-12 16:02:02 --> 404 Page Not Found: /index
ERROR - 2023-01-12 16:05:05 --> 404 Page Not Found: /index
ERROR - 2023-01-12 16:06:55 --> Severity: Notice --> Undefined variable: 22532 D:\xampp\htdocs\nilg-erp\application\modules\trainee\controllers\Trainee.php 865
ERROR - 2023-01-12 16:11:03 --> 404 Page Not Found: /index
ERROR - 2023-01-12 16:14:41 --> 404 Page Not Found: /index
ERROR - 2023-01-12 16:52:44 --> Severity: Notice --> Undefined variable: subview D:\xampp\htdocs\nilg-erp\application\views\backend\_layout_main.php 2
ERROR - 2023-01-12 16:52:44 --> Severity: Notice --> Undefined variable: _ci_file D:\xampp\htdocs\nilg-erp\application\third_party\MX\Loader.php 348
ERROR - 2023-01-12 16:53:09 --> 404 Page Not Found: /index
