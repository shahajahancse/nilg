<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-04-09 11:55:55 --> Severity: Notice --> Undefined variable: start_time D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 16
ERROR - 2023-04-09 11:55:55 --> Severity: Notice --> Undefined variable: end_time D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 16
ERROR - 2023-04-09 11:55:55 --> Severity: Notice --> Undefined variable: trainingID D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\controllers\Evaluation_report.php 39
ERROR - 2023-04-09 11:55:55 --> Severity: Notice --> Undefined variable: excel D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\controllers\Evaluation_report.php 44
ERROR - 2023-04-09 11:55:55 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 22
ERROR - 2023-04-09 11:56:44 --> Severity: Notice --> Undefined variable: start_time D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 16
ERROR - 2023-04-09 11:56:44 --> Severity: Notice --> Undefined variable: end_time D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 16
ERROR - 2023-04-09 11:56:44 --> Severity: Notice --> Undefined variable: trainingID D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\controllers\Evaluation_report.php 39
ERROR - 2023-04-09 11:56:44 --> Severity: Notice --> Undefined variable: excel D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\controllers\Evaluation_report.php 44
ERROR - 2023-04-09 11:56:44 --> Severity: Notice --> Trying to get property of non-object D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\views\trainer_evaluation_result.php 22
ERROR - 2023-04-09 11:58:20 --> Severity: Notice --> Undefined variable: start_time D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 16
ERROR - 2023-04-09 11:58:20 --> Severity: Notice --> Undefined variable: end_time D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 16
ERROR - 2023-04-09 13:12:00 --> Severity: Notice --> Undefined variable: training_id D:\xampp\htdocs\nilg-erp\application\modules\evaluation_report\models\Evaluation_report_model.php 17
ERROR - 2023-04-09 13:12:00 --> Query error: Unknown column 't.training_id' in 'where clause' - Invalid query: SELECT `t`.`id`, `t`.`course_id`, `c`.`course_title`, COUNT(t.course_id) AS total_course
FROM `training` `t`
LEFT JOIN `course` `c` ON `c`.`id` = `t`.`course_id`
WHERE `t`.`training_id` IS NULL
AND `t`.`end_date` BETWEEN '2023-03-01' and '2023-04-09'
GROUP BY `t`.`course_id`
