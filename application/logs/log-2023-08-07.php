<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-08-07 12:09:42 --> Severity: Notice --> Undefined variable: result_data D:\xampp\htdocs\nilg\application\modules\reports\views\pdf_divisional_rep_number.php 82
ERROR - 2023-08-07 12:09:42 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\nilg\application\modules\reports\views\pdf_divisional_rep_number.php 82
ERROR - 2023-08-07 12:19:34 --> Severity: Notice --> Undefined variable: result_data D:\xampp\htdocs\nilg\application\modules\reports\views\pdf_divisional_rep_number.php 82
ERROR - 2023-08-07 12:19:34 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\nilg\application\modules\reports\views\pdf_divisional_rep_number.php 82
ERROR - 2023-08-07 17:55:53 --> Query error: Unknown column 'u.div_id' in 'where clause' - Invalid query: SELECT COUNT(*) as count
FROM `users`
WHERE `crrnt_desig_id` = '1'
AND `is_verify` = 1
AND `u`.`div_id` = '8'
AND `created_on` BETWEEN '1654020000' AND '1688061600'
