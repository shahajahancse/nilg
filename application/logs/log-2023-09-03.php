<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-09-03 15:00:03 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 D:\xampp\htdocs\nilg\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2023-09-03 15:00:03 --> Unable to connect to the database
ERROR - 2023-09-03 16:31:50 --> Severity: Compile Error --> Cannot use isset() on the result of a function call (you can use "null !== func()" instead) D:\xampp\htdocs\nilg\application\modules\acl\controllers\Acl.php 216
ERROR - 2023-09-03 16:31:56 --> Severity: Compile Error --> Cannot use isset() on the result of a function call (you can use "null !== func()" instead) D:\xampp\htdocs\nilg\application\modules\acl\controllers\Acl.php 216
ERROR - 2023-09-03 17:43:39 --> Query error: Unknown column 'age' in 'where clause' - Invalid query: SELECT COUNT(id) as total
FROM `users`
WHERE `employee_type` = '2'
AND `age` = 18
AND `office_type` = 7
ERROR - 2023-09-03 18:14:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '18' at line 5 - Invalid query: SELECT COUNT(id) as total, `dob`, YEAR(CURDATE()) - YEAR(dob) AS age
FROM `users`
WHERE `employee_type` = '2'
AND `office_type` = 7
AND YEAR(CURDATE()) - YEAR(dob) 18
ERROR - 2023-09-03 18:17:15 --> Severity: Parsing Error --> syntax error, unexpected 'if' (T_IF) D:\xampp\htdocs\nilg\application\modules\reports\models\Reports_model.php 728
