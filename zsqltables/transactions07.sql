/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `transactions` (
	`id` int (10),
	`type` varchar (150),
	`transaction_type_id` int (11),
	`date` date ,
	`reference_no` varchar (150),
	`supplier_id` int (11),
	`customer_name` varchar (150),
	`gst` varchar (150),
	`total_amount` int (11),
	`user_id` int (11),
	`created_at` date ,
	`updated_at` date ,
	`deleted_at` date 
); 
