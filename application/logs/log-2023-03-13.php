<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-03-13 18:34:39 --> Query error: Column 'office_type' in field list is ambiguous - Invalid query: SELECT `o`.`id`, `o`.`office_name`, `d`.`div_name_bn`, SUM(CASE WHEN office_type = 5 THEN 1 ELSE 0 END ) AS city_c
FROM `office` as `o`, `divisions` as `d`, `users` as `u`
WHERE `o`.`division_id` = `d`.`id`
AND `o`.`id` = `u`.`crrnt_office_id`
AND `o`.`office_type` = 5
GROUP BY `o`.`id`
