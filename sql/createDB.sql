/* Modified: [createDB.sql] <2014-10-29 07:47:29> [norman@albany:/ftp:pi@192.168.0.31:/home/pi/www/mystats/sql/createDB.sql]
*/

--
-- Create schema mystats
--

CREATE DATABASE IF NOT EXISTS mystats;
USE mystats;


--
-- Definition of table `DevOps`.`actual`
--

DROP TABLE IF EXISTS `mystats`.`actual`;
CREATE TABLE  `mystats`.`actual` (
  `id`               int(11)              NOT NULL AUTO_INCREMENT,
  `when`             timestamp    	  NOT NULL,
  `weight_in_pounds` decimal(5,2)         NOT NULL,
  `systolic`         int(11)              NOT NULL,
  `diastolic`        int(11)              NOT NULL,
  `pulse`            int(11)              NOT NULL,
  `comment`          text,                 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE USER 'fromweb'@'%' IDENTIFIED BY 'bollox';
GRANT ALL PRIVILEGES ON *.* TO 'fromweb'@'%' WITH GRANT OPTION;


CREATE USER 'rupert'@'%' IDENTIFIED BY 'some_pass';
GRANT ALL PRIVILEGES ON *.* TO 'rupert'@'%' WITH GRANT OPTION;


/* --
-- how to insert data into `actual` table
--

-- open terminal on albany
-- connect to raspberry pi
> ssh pi@192.168.0.31
-- type in password
> pi@192.168.0.31's password: pi
-- connect to my
> mysql -u rupert -pbollox mystats

mysql> INSERT INTO `mystats`.`actual` (`id`, `when`, `weight_in_pounds`, `systolic`, `dyastolic`, `pulse`) 
mysql> VALUES (2, NOW(), '253.8', '142', '87', '68');





INSERT INTO `mystats`.`actual` 
(`id`, `when`, `weight_in_pounds`, `systolic`, `dyastolic`, `pulse`, `comment`) 
VALUES ('NULL','Saturday, 15 June, 2013','256.60','129','89','58', 'NULL'),


*/
