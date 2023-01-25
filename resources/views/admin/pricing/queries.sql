-- Adding Fields in Pricing Table
ALTER TABLE `pricings` ADD `pricing_type` ENUM('single_1','single_2','corporate','enterprise','single_3') NOT NULL AFTER `pricing_name`, ADD `price` DOUBLE(8,2) NOT NULL AFTER `pricing_type`, ADD `expiry_days` INT(5) NOT NULL AFTER `price`, ADD `courses` INT(3) NOT NULL AFTER `expiry_days`, ADD `certificates` INT(3) NOT NULL AFTER `courses`, ADD `badges` INT(3) NOT NULL AFTER `certificates`, ADD `days` INT(5) NOT NULL AFTER `badges`;