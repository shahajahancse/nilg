<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-01-05 15:08:21 --> 404 Page Not Found: /index
ERROR - 2023-01-05 16:54:44 --> Query error: Unknown column 'nt.nilg_course_id' in 'field list' - Invalid query: SELECT `nt`.`id`, `nt`.`training_id`, `nt`.`app_user_id`, `nt`.`nilg_course_id`, `t`.`participant_name` as `course_title`, `d`.`desig_name`, `t`.`course_no` as `nilg_batch_no`, `t`.`start_date` as `nilg_training_start`, `t`.`end_date` as `nilg_training_end`
FROM `training_participant` `nt`
LEFT JOIN `training` `t` ON `t`.`id` = `nt`.`training_id`
LEFT JOIN `per_nilg_training` `pnt` ON `pnt`.`training_id` = `nt`.`training_id`
LEFT JOIN `designations` `d` ON `d`.`id` = `pnt`.`nilg_desig_id`
WHERE `nt`.`app_user_id` = 11807
AND `nt`.`is_complete` = 1
ERROR - 2023-01-05 17:07:17 --> 404 Page Not Found: /index
