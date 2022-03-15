CREATE DATABASE `adaurum` /*!40100 COLLATE 'utf8mb4_0900_ai_ci' */
/* создание таблицы компаний*/
CREATE TABLE `companies` (
`cid` int NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`c_name` varchar(200) NOT NULL UNIQUE,
`inn` varchar(10) NOT NULL UNIQUE,
`c_profile` varchar(500) NOT NULL,
`director` varchar(100) NOT NULL,
`c_address` varchar(250) NOT NULL,
`tel` varchar(15) NOT NULL
);
/* создание таблицы комментариев */
CREATE TABLE `comments` (
`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`cid` int NOT NULL,
`uid` int NOT NULL,
`date_com` date NOT NULL ,
`comment` varchar(250) NOT NULL,
`f_name` varchar(10) NOT NULL
);
/* создание таблицы пользователей */
CREATE TABLE `users` (
`uid` int NOT NULL PRIMARY KEY AUTO_INCREMENT ,
`username` varchar(30) NOT NULL UNIQUE,
`login` varchar(15) NOT NULL
`pswd` varchar(10) NOT NULL
);