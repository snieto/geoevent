### README

Just execute this SQL to create the UNIQUE table you'll need:

```SQL 
CREATE TABLE `geospots` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `text` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
```