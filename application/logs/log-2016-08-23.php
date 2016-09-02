<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-08-23 06:04:28 --> Query error: Unknown column 'umedia.featured_image' in 'field list' - Invalid query: SELECT `users`.`id` as `userId`, `users`.`username`, `users`.`email`, `users`.`first_name`, `users`.`last_name`, `users`.`image`, `umedia`.`featured_image`, group_concat(DISTINCT(BC.name)) as city_name, `BUD`.`age`
FROM `users`
JOIN `users_groups` as `UG` ON `UG`.`user_id`=`users`.`id` AND `UG`.`group_id`=2
JOIN `babes_user_details` as `BUD` ON `BUD`.`user_id`=`users`.`id`
JOIN `babes_user_media` as `umedia` ON `umedia`.`user_id`=`users`.`id`
JOIN `babes_user_city` as `BUA` ON `BUA`.`user_id`=`users`.`id`
JOIN `babes_city` as `BC` ON `BC`.`id`=`BUA`.`city_id`
WHERE `users`.`active` = 1
AND `users`.`deleted_at` IS NULL
AND umedia.featured_image is NOT NULL
AND `users`.`featured` = '1'
GROUP BY `users`.`id`
ORDER BY RAND()
 LIMIT 10
ERROR - 2016-08-23 06:04:41 --> Query error: Unknown column 'umedia.featured_image' in 'field list' - Invalid query: SELECT `users`.`id` as `userId`, `users`.`username`, `users`.`email`, `users`.`first_name`, `users`.`last_name`, `users`.`image`, `umedia`.`featured_image`, group_concat(DISTINCT(BC.name)) as city_name, `BUD`.`age`
FROM `users`
JOIN `users_groups` as `UG` ON `UG`.`user_id`=`users`.`id` AND `UG`.`group_id`=2
JOIN `babes_user_details` as `BUD` ON `BUD`.`user_id`=`users`.`id`
JOIN `babes_user_media` as `umedia` ON `umedia`.`user_id`=`users`.`id`
JOIN `babes_user_city` as `BUA` ON `BUA`.`user_id`=`users`.`id`
JOIN `babes_city` as `BC` ON `BC`.`id`=`BUA`.`city_id`
WHERE `users`.`active` = 1
AND `users`.`deleted_at` IS NULL
AND umedia.featured_image is NOT NULL
AND `users`.`featured` = '1'
GROUP BY `users`.`id`
ORDER BY RAND()
 LIMIT 10
ERROR - 2016-08-23 06:16:14 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-23 07:34:56 --> 404 Page Not Found: Assets/front
ERROR - 2016-08-23 07:35:01 --> 404 Page Not Found: Assets/front
