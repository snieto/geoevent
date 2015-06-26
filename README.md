### README

Just execute this SQL to create the UNIQUE table you'll need:

```SQL 
CREATE TABLE `geospots` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `text` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
```