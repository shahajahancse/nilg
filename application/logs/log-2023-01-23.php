<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-01-23 17:13:13 --> Severity: Parsing Error --> syntax error, unexpected 'public' (T_PUBLIC) D:\xampp\htdocs\nilg-erp\application\modules\reports\controllers\Reports.php 415
ERROR - 2023-01-23 17:13:42 --> Severity: Parsing Error --> syntax error, unexpected 'public' (T_PUBLIC) D:\xampp\htdocs\nilg-erp\application\modules\reports\controllers\Reports.php 415
ERROR - 2023-01-23 17:13:48 --> Severity: Parsing Error --> syntax error, unexpected 'public' (T_PUBLIC) D:\xampp\htdocs\nilg-erp\application\modules\reports\controllers\Reports.php 415
ERROR - 2023-01-23 17:43:42 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `u`.`name_bn` as `name_bangla`, `u`.`crrnt_attend_date` as `curr_attend_date`, `u`.`nid` as `national_id`, `u`.`mobile_no` as `telephone_mobile`, `ds`.`dis_name_bn`, `dg`.`desig_name`
FROM `users` `u`
LEFT JOIN `districts` `ds` ON `ds`.`id`=`u`.`per_dis_id`
LEFT JOIN `designations` `dg` ON `dg`.`id`=`u`.`crrnt_desig_id`
WHERE `u`.`employee_type` = '2'
AND `status` = 1
AND `div_id` = '4'
