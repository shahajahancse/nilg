<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-03-22 12:03:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'COUNT(t.id) AS total_row
FROM `evaluation_trainer` `et`
LEFT JOIN `users` `u` ON' at line 2 - Invalid query: SELECT `et`.`training_id`, `et`.`topic_trainer_id`, `u`.`name_bn`, et.topic_id
                    COUNT(t.id) AS total_row
FROM `evaluation_trainer` `et`
LEFT JOIN `users` `u` ON `u`.`id` = `et`.`topic_trainer_id`
LEFT JOIN `training_schedule` `t` ON `t`.`id` = `et`.`topic_id`
WHERE `et`.`training_id` = 435
GROUP BY `et`.`topic_trainer_id`
ERROR - 2023-03-22 12:57:32 --> Severity: Notice --> Undefined property: Evaluation_report::$Evaluation_model D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\controllers\Evaluation_report.php 61
ERROR - 2023-03-22 12:57:32 --> Severity: Error --> Call to a member function get_training_info() on null D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\controllers\Evaluation_report.php 61
ERROR - 2023-03-22 12:57:51 --> Severity: error --> Exception: Unable to locate the model you have specified: Evaluation_model D:\xampp\htdocs\nilg-erp\system\core\Loader.php 344
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:47:00 --> Severity: Notice --> Undefined property: stdClass::$participant_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 88
ERROR - 2023-03-22 14:59:18 --> Severity: Parsing Error --> syntax error, unexpected 'endforeach' (T_ENDFOREACH) D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 114
ERROR - 2023-03-22 14:59:39 --> Severity: Notice --> Undefined property: stdClass::$training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 79
ERROR - 2023-03-22 16:13:09 --> Query error: Unknown column 'et.topic_trainer_id' in 'field list' - Invalid query: SELECT `et`.`topic_trainer_id`
FROM `training_schedule` `t`
WHERE `t`.`training_id` = '465'
ERROR - 2023-03-22 16:19:23 --> Severity: Error --> Call to undefined method CI_DB_mysqli_result::group_by() D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 71
ERROR - 2023-03-22 16:27:57 --> Severity: Compile Error --> Cannot use [] for reading D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 72
ERROR - 2023-03-22 16:35:49 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\nilg-erp\system\database\DB_query_builder.php 683
ERROR - 2023-03-22 16:35:49 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `t`.`training_id`, `t`.`trainer_id`, `u`.`name_bn`, COUNT(t.id) AS total_row
FROM `training_schedule` `t`
LEFT JOIN `users` `u` ON `u`.`id` = `t`.`trainer_id`
WHERE `t`.`training_id` = 435
AND `t`.`trainer_id` = `Array`
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`
ERROR - 2023-03-22 17:00:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`' at line 5 - Invalid query: SELECT `t`.`training_id`, `t`.`trainer_id`, `u`.`name_bn`, COUNT(t.id) AS total_row
FROM `training_schedule` `t`
LEFT JOIN `users` `u` ON `u`.`id` = `t`.`trainer_id`
WHERE `t`.`training_id` = 435
AND `t`.`trainer_id` IN()
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`
ERROR - 2023-03-22 17:01:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`' at line 5 - Invalid query: SELECT `t`.`training_id`, `t`.`trainer_id`, `u`.`name_bn`, COUNT(t.id) AS total_row
FROM `training_schedule` `t`
LEFT JOIN `users` `u` ON `u`.`id` = `t`.`trainer_id`
WHERE `t`.`training_id` = 435
AND `t`.`trainer_id` IN()
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`
ERROR - 2023-03-22 17:01:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`' at line 5 - Invalid query: SELECT `t`.`training_id`, `t`.`trainer_id`, `u`.`name_bn`, COUNT(t.id) AS total_row
FROM `training_schedule` `t`
LEFT JOIN `users` `u` ON `u`.`id` = `t`.`trainer_id`
WHERE `t`.`training_id` = 435
AND `t`.`trainer_id` IN()
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`
ERROR - 2023-03-22 17:01:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`' at line 5 - Invalid query: SELECT `t`.`training_id`, `t`.`trainer_id`, `u`.`name_bn`, COUNT(t.id) AS total_row
FROM `training_schedule` `t`
LEFT JOIN `users` `u` ON `u`.`id` = `t`.`trainer_id`
WHERE `t`.`training_id` = 435
AND `t`.`trainer_id` IN()
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`
ERROR - 2023-03-22 17:01:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`' at line 5 - Invalid query: SELECT `t`.`training_id`, `t`.`trainer_id`, `u`.`name_bn`, COUNT(t.id) AS total_row
FROM `training_schedule` `t`
LEFT JOIN `users` `u` ON `u`.`id` = `t`.`trainer_id`
WHERE `t`.`training_id` = 435
AND `t`.`trainer_id` IN()
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`
ERROR - 2023-03-22 17:02:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`' at line 5 - Invalid query: SELECT `t`.`training_id`, `t`.`trainer_id`, `u`.`name_bn`, COUNT(t.id) AS total_row
FROM `training_schedule` `t`
LEFT JOIN `users` `u` ON `u`.`id` = `t`.`trainer_id`
WHERE `t`.`training_id` = 435
AND `t`.`trainer_id` IN()
AND t.trainer_id !=0
GROUP BY `t`.`trainer_id`
ERROR - 2023-03-22 18:45:08 --> Severity: Parsing Error --> syntax error, unexpected 'return' (T_RETURN) D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 139
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
ERROR - 2023-03-22 18:45:20 --> Severity: Notice --> Undefined property: stdClass::$total D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 117
