/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `sale_items` (
	`id` int (11),
	`sales_id` int (11),
	`item_id` int (11),
	`quantity` int (11),
	`rate` Decimal (12),
	`tax_id` int (11),
	`tax_amount` Decimal (12),
	`discount_id` int (11),
	`discount_amount` Decimal (12),
	`total_amount` Decimal (12),
	`status` int (11),
	`created_at` datetime ,
	`updated_at` datetime ,
	`deleted_at` datetime 
); 
