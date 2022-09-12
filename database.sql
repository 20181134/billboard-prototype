drop database if exists tweet;
create database tweet character set utf8 collate utf8_general_ci;
grant all on tweet.* to 'admin'@'localhost' identified by 'password';
use tweet;

-- varchar -> text
create table userdata (
    userid int auto_increment primary key,
    username varchar(30) not null,
    password varchar(30) not null,
    avatar varchar(30) not null,
    profilepage varchar(30)
);

create table tweets (
    id int auto_increment primary key,
    contents varchar(250) not null,
    uploader varchar(30) not null,
    avatar varchar(30) not null,
    time varchar(30) not null
);