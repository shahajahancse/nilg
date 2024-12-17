<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-05-17 10:19:03 --> Severity: Parsing Error --> syntax error, unexpected '}' D:\xampp\htdocs\nilg\application\modules\evaluation_report\views\trainer_evaluation_result_excel.php 47
ERROR - 2023-05-17 12:45:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\nilg\application\modules\nilg_setting\views\evaluation_subject\index.php 52
ERROR - 2023-05-17 14:59:19 --> Query error: Unknown column 'edu_exam_id' in 'field list' - Invalid query: SELECT `u`.`id`, `u`.`name_bn`, `u`.`nid`, `u`.`mobile_no`, `d`.`desig_name`, `o`.`office_name`, COUNT(edu_exam_id) as total
FROM `users` `u`, `training_participant` `p`, `office` `o`, `designations` `d`
WHERE `u`.`id` = `p`.`app_user_id`
AND `o`.`id` = `u`.`crrnt_office_id`
AND `d`.`id` = `u`.`crrnt_desig_id`
AND `u`.`employee_type` = 1
AND `u`.`div_id` = '4'
GROUP BY `p`.`app_user_id`
ERROR - 2023-05-17 15:19:45 --> Severity: Error --> Allowed memory size of 134217728 bytes exhausted (tried to allocate 130968 bytes) D:\xampp\htdocs\nilg\vendor\mpdf\mpdf\mpdf.php 20691
