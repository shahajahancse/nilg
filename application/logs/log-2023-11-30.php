<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-11-30 10:59:32 --> 404 Page Not Found: /index
ERROR - 2023-11-30 14:41:24 --> 404 Page Not Found: /index
ERROR - 2023-11-30 14:41:24 --> 404 Page Not Found: /index
ERROR - 2023-11-30 14:41:24 --> 404 Page Not Found: /index
ERROR - 2023-11-30 15:10:35 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1013
ERROR - 2023-11-30 15:10:35 --> Severity: Notice --> Trying to get property of non-object I:\xampp\htdocs\nilg\application\models\Ion_auth_model.php 1014
ERROR - 2023-11-30 16:10:35 --> Severity: Notice --> Array to string conversion I:\xampp\htdocs\nilg\system\database\DB_query_builder.php 683
ERROR - 2023-11-30 16:10:35 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT COUNT(*) as count
FROM `users`
WHERE `is_office` =0
AND `is_verify` = 1
AND `office_type` NOT IN(8, 9)
AND `gender` IS NOT NULL
AND `employee_type` IS NOT NULL
AND `office_type` = `Array`
AND `employee_type` = 1
