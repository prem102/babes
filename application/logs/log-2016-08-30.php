<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-08-30 16:58:49 --> Severity: Notice --> Array to string conversion /var/www/html/babesdirect/application/models/admin/Staff_model.php 120
ERROR - 2016-08-30 16:58:49 --> Severity: Notice --> Undefined variable: Array /var/www/html/babesdirect/application/models/admin/Staff_model.php 120
ERROR - 2016-08-30 17:13:56 --> Query error: Unknown column 'gender' in 'field list' - Invalid query: SELECT `gender`
FROM `babes_user_city`
WHERE `user_id` = '10'
ERROR - 2016-08-30 17:18:05 --> Query error: Unknown column 'BUS.main_city' in 'field list' - Invalid query: SELECT CONCAT(BC.name, " ", BS.name) as city, BUC.city_id as cityId, BUS.main_city as cityType
FROM `babes_user_city` as `BUC`
JOIN `babes_city` as `BC` ON `BC`.`id`=`BUC`.`city_id`
JOIN `babes_state` as `BS` ON `BS`.`id`=`BC`.`state`
WHERE `user_id` = '10'
ERROR - 2016-08-30 17:24:22 --> Severity: error --> Exception: syntax error, unexpected '}' /var/www/html/babesdirect/application/views/admin/users/editStaff.php 189
ERROR - 2016-08-30 17:40:29 --> Query error: Unknown column 'BUA.city_id' in 'where clause' - Invalid query: SELECT *
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id`=`users`.`id` AND `users`.`deleted_at` is null
JOIN `groups` ON `groups`.`id`=`users_groups`.`group_id`
LEFT JOIN `babes_user_details` as `BUD` ON `BUD`.`user_id`=`users`.`id`
JOIN `babes_user_city` as `BUC` ON `BUC`.`user_id`=`users`.`id`
JOIN `babes_city` as `BC` ON `BC`.`id`=`BUC`.`city_id`
WHERE `groups`.`id` IN(2)
AND `BUA`.`city_id` = '3'
GROUP BY `users`.`id`
ERROR - 2016-08-30 18:07:58 --> 404 Page Not Found: Assets/img
ERROR - 2016-08-30 18:29:20 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:20 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:28 --> 404 Page Not Found: Registration/step1
ERROR - 2016-08-30 18:29:32 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:32 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:34 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:34 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:34 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:34 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:29:38 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:33:26 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:33:43 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:33:43 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:35:44 --> Severity: Notice --> Undefined variable: clientsCount /var/www/html/babesdirect/application/models/admin/Staff_model.php 217
ERROR - 2016-08-30 18:35:44 --> Severity: error --> Exception: Call to a member function like() on null /var/www/html/babesdirect/application/models/admin/Staff_model.php 217
ERROR - 2016-08-30 18:36:06 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:38:52 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:39:01 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:39:01 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-30 18:39:58 --> 404 Page Not Found: Stafflist/index
ERROR - 2016-08-30 18:43:35 --> Severity: error --> Exception: syntax error, unexpected ';' /var/www/html/babesdirect/application/controllers/admin/Users.php 223
ERROR - 2016-08-30 18:49:28 --> 404 Page Not Found: Assets/img
ERROR - 2016-08-30 18:54:30 --> Severity: error --> Exception: Using $this when not in object context /var/www/html/babesdirect/application/helpers/common_helper.php 636
