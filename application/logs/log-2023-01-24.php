<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-01-24 11:31:49 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\xampp\htdocs\nilg-erp\application\modules\reports\controllers\Reports.php 741
ERROR - 2023-01-24 11:32:33 --> Query error: Column 'office_type' in where clause is ambiguous - Invalid query: SELECT `u`.`name_bn` as `name_bangla`, `u`.`crrnt_attend_date` as `curr_attend_date`, `u`.`nid` as `national_id`, `u`.`mobile_no` as `telephone_mobile`, `ds`.`dis_name_bn`, `dg`.`desig_name`
FROM `users` `u`
LEFT JOIN `districts` `ds` ON `ds`.`id`=`u`.`per_dis_id`
LEFT JOIN `designations` `dg` ON `dg`.`id`=`u`.`crrnt_desig_id`
WHERE `u`.`employee_type` = '2'
AND `office_type` = 5
AND `u`.`status` = 1
AND `u`.`div_id` = '3'
ERROR - 2023-01-24 12:07:48 --> Severity: Warning --> Missing argument 1 for Common::ajax_district_by_div() D:\xampp\htdocs\nilg-erp\application\controllers\Common.php 495
ERROR - 2023-01-24 12:07:48 --> Severity: Notice --> Undefined variable: div_id D:\xampp\htdocs\nilg-erp\application\controllers\Common.php 497
ERROR - 2023-01-24 15:17:07 --> Severity: Notice --> Undefined index: type_details D:\xampp\htdocs\nilg-erp\application\modules\reports\controllers\Reports.php 912
ERROR - 2023-01-24 15:17:32 --> Severity: Notice --> Undefined index: type_details D:\xampp\htdocs\nilg-erp\application\modules\reports\controllers\Reports.php 912
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$curr_attend_date D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 97
ERROR - 2023-01-24 17:07:14 --> Severity: Notice --> Undefined property: stdClass::$district_name D:\xampp\htdocs\nilg-erp\application\modules\reports\views\pdf_nilg_nilg_course_complete.php 98
ERROR - 2023-01-24 17:32:00 --> Severity: Notice --> Undefined index: videofile D:\xampp\htdocs\nilg-erp\application\modules\training\controllers\Training.php 1973
