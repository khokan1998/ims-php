CREATE TABLE `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `created_on` date NOT NULL DEFAULT '1000-10-10',
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8



insert into users(first_name,last_name,email,mobile,PASSWORD,created_on,is_active) values('admin','admin','admin@gmail.com','987654321','admin', now(),1);


CREATE TABLE `blog` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` blob NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '1000-10-10 00:00:00',
  `updated_on` datetime DEFAULT '1000-10-10 00:00:00',
  `created_by` int(6) NOT NULL,
  `updated_by` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8

alter table blog add (
  category_id int(6) null,
    foreign key(category_id) references category(id)

alter table users add(user_role varchar(10) not null default'user');


create table category (
 id int(6) not null auto_increment,
 name varchar(255) not null,
 is_active tinyint(1) default null,
 primary key (id));
 
 select * from category;
 insert into category(name,is_active) values('santosh','1');

 select * from category where is_active = 1;
 select id,name from category where is_active = 1;
 truncate category; 
 