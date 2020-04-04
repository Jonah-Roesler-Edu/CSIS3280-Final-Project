DROP DATABASE IF EXISTS codeigniter;
CREATE DATABASE codeigniter;
USE codeigniter;

CREATE TABLE news (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id),
        KEY slug (slug)
);

insert into news VALUES 
(1,'hello','slug','text'),
(2,'hi','slug','text'),
(3,'bye','slug','text');