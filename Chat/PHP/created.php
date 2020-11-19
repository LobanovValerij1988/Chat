<?php 
include_once('classes.php');
if(!$pdo=Tools::connect())
{
	echo "we cannot connect to database";
	return false;
} 
$Users='create table Users(
id            int not null  auto_increment primary key, 
firstname     varchar(25)not null,
lastname      varchar(25)not null,
reportSubject varchar(35)not null,
birthdate     varchar(15)not null,
country       varchar(50)not null,
phone         varchar(14)not null,
email         varchar(100)not null  unique,
company       varchar(50),
position      varchar(50),
aboutMe       varchar(500),
imagepath     varchar(255))default charset="utf8"';
$pdo->exec($Users); 
?>
