<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-03-20 10:37:15 --> Query error: Table 'nilg_erp.users' doesn't exist - Invalid query: SELECT `u`.`id`, `u`.`username`, `u`.`name_bn`, `u`.`is_office`, `u`.`office_type`, `ot`.`office_type_name`, `u`.`crrnt_office_id`, `u`.`crrnt_dept_id`, `u`.`crrnt_desig_id`, `o`.`office_name`, `u`.`office_name` as `user_office_name`, `u`.`div_id`, `u`.`dis_id`, `u`.`upa_id`, `u`.`union_id`, `dv`.`div_name_bn`, `ds`.`dis_name_bn`, `ut`.`upa_name_bn`, `uni`.`uni_name_bn`, `u`.`profile_img`, FROM_UNIXTIME(u.last_login) AS last_login
FROM `users` `u`
LEFT JOIN `office` `o` ON `o`.`id` = `u`.`crrnt_office_id`
LEFT JOIN `office_type` `ot` ON `ot`.`id` = `u`.`office_type`
LEFT JOIN `divisions` `dv` ON `dv`.`id` = `u`.`div_id`
LEFT JOIN `districts` `ds` ON `ds`.`id` = `u`.`dis_id`
LEFT JOIN `upazilas` `ut` ON `ut`.`id` = `u`.`upa_id`
LEFT JOIN `unions` `uni` ON `uni`.`id` = `u`.`union_id`
WHERE `u`.`id` = '1'
ERROR - 2023-03-20 17:32:10 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\xampp\htdocs\nilg-erp\application\modules\evaluation\controllers\Evaluation.php 1253
