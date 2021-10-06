// prod
create table reserve (
	id int auto_increment not null primary key,
	display_date date not null,
	display_time time not null,
  display_status varchar(200) not null,
  update_time datetime,
  patient_type varchar(200),
  patient_id int,
  patient_name varchar(200),
  patient_phone varchar(200),
  patient_mail varchar(200)
);

create table public_holiday (
	date date not null primary key,
	name varchar(200)
);

create table private_holiday (
	date date not null primary key,
	name varchar(200)
);



// dev
drop database if exists honodc;
create database honodc default character set utf8 collate utf8_general_ci;
grant select, insert, update, delete on honodc.* to 'reserveuser'@'localhost' identified by 'Honodc2021';
use honodc;

create table reserve (
	id int auto_increment not null primary key,
	display_date date not null,
	display_time time not null,
  display_status varchar(200) not null,
  update_time datetime,
  patient_type varchar(200),
  patient_id int,
  patient_name varchar(200),
  patient_phone varchar(200),
  patient_mail varchar(200)
);

create table public_holiday (
	date date not null primary key,
	name varchar(200)
);

create table private_holiday (
	date date not null primary key,
	name varchar(200)
);
