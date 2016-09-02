<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-08-05 13:25:00 --> 404 Page Not Found: Assets/img
ERROR - 2016-08-05 13:25:49 --> Query error: Unknown column 'babes_client_reviews.deleted_at' in 'where clause' - Invalid query: SELECT *
FROM `babes_client_reviews`
JOIN `users` as `ctable` ON `ctable`.`id`=`babes_client_reviews`.`client_id`
JOIN `users` as `stable` ON `stable`.`id`=`babes_client_reviews`.`staff_id`
LEFT JOIN `users` as `atable` ON `atable`.`id`=`babes_client_reviews`.`approved_by`
WHERE `babes_client_reviews`.`deleted_at` IS NULL
ERROR - 2016-08-05 13:26:32 --> Query error: Unknown column 'babes_client_reviews.approval' in 'field list' - Invalid query: SELECT `babes_client_reviews`.`id`, `ctable`.`username` as `client`, `ctable`.`email` as `clientEmail`, `stable`.`username` as `staff`, `stable`.`email` as `staffEmail`, `atable`.`username` as `approvedBy`, `babes_client_reviews`.`comments`, `babes_client_reviews`.`approval`, `babes_client_reviews`.`rating`
FROM `babes_client_reviews`
JOIN `users` as `ctable` ON `ctable`.`id`=`babes_client_reviews`.`client_id`
JOIN `users` as `stable` ON `stable`.`id`=`babes_client_reviews`.`staff_id`
LEFT JOIN `users` as `atable` ON `atable`.`id`=`babes_client_reviews`.`approved_by`
WHERE `babes_client_reviews`.`deleted_at` IS NULL
 LIMIT 10
ERROR - 2016-08-05 13:27:20 --> 404 Page Not Found: Assets/img
