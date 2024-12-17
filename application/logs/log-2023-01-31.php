<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-01-31 11:20:40 --> Severity: Notice --> Undefined index: hideid D:\xampp\htdocs\nilg-erp\application\modules\evaluation\controllers\Evaluation.php 992
ERROR - 2023-01-31 14:39:28 --> Query error: Unknown column 'tp.so' in 'order clause' - Invalid query: SELECT `p`.*, `u`.`name_bn`, `u`.`nid`
FROM `training_participant` `p`
LEFT JOIN `users` `u` ON `u`.`id` = `p`.`app_user_id`
WHERE `p`.`training_id` = 396
ORDER BY `tp`.`so` ASC
ERROR - 2023-01-31 16:21:24 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 16:58:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.`signature`
FROM `training_participant` `tp`
LEFT JOIN `users` `u` ON `u`.`id` ' at line 1 - Invalid query: SELECT `tp`.*, `t`.`training_title`, `t`.`course_id`, `t`.`batch_no`, `t`.`start_date`, `t`.`end_date`, `c`.`course_title`, `dg`.`desig_name`, `div`.`div_name_bn`, `dis`.`dis_name_bn`, `upa`.`upa_name_bn`, `uni`.`uni_name_bn`, `u`.`name_bn`, `u`.`office_type`, `t`.`certificate_text` `t`.`signature`
FROM `training_participant` `tp`
LEFT JOIN `users` `u` ON `u`.`id` = `tp`.`app_user_id`
LEFT JOIN `training` `t` ON `t`.`id` = `tp`.`training_id`
LEFT JOIN `course` `c` ON `c`.`id` = `t`.`course_id`
LEFT JOIN `designations` `dg` ON `dg`.`id` = `u`.`crrnt_desig_id`
LEFT JOIN `divisions` `div` ON `div`.`id` = `u`.`div_id`
LEFT JOIN `districts` `dis` ON `dis`.`id` = `u`.`dis_id`
LEFT JOIN `upazilas` `upa` ON `upa`.`id` = `u`.`upa_id`
LEFT JOIN `unions` `uni` ON `uni`.`id` = `u`.`union_id`
WHERE `tp`.`id` = '4914'
ERROR - 2023-01-31 17:01:21 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:09:28 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:09:51 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:10:12 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:10:43 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:11:21 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:12:27 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:12:45 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:31:45 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:31:55 --> Severity: Warning --> Division by zero D:\xampp\htdocs\nilg-erp\application\modules\training\views\pdf_certificate_jica.php 112
ERROR - 2023-01-31 17:32:55 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:33:03 --> 404 Page Not Found: ../modules/training/controllers/Training/pdf_certificate2
ERROR - 2023-01-31 17:33:16 --> 404 Page Not Found: ../modules/training/controllers/Training/pdf_certificate2
ERROR - 2023-01-31 17:33:50 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:35:13 --> Severity: Warning --> Division by zero D:\xampp\htdocs\nilg-erp\application\modules\training\views\pdf_certificate_jica.php 112
ERROR - 2023-01-31 17:37:56 --> Severity: Warning --> Division by zero D:\xampp\htdocs\nilg-erp\application\modules\training\views\pdf_certificate_jica.php 112
ERROR - 2023-01-31 17:43:32 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 17:43:47 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 18:21:31 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 18:24:54 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
ERROR - 2023-01-31 18:25:08 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 2070
