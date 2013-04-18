CREATE TABLE tbl_user (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL
);

# Dump of table attraction
# ------------------------------------------------------------

CREATE TABLE `attraction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `phone` varchar(31) NOT NULL DEFAULT '',
  `website` varchar(400) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table event
# ------------------------------------------------------------

CREATE TABLE `event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table hotel
# ------------------------------------------------------------

CREATE TABLE `hotel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127),
  `address` varchar(255) NOT NULL DEFAULT '',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `phone` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table parking
# ------------------------------------------------------------

CREATE TABLE `parking` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127),
  `address` varchar(255) NOT NULL DEFAULT '',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `rates` varchar(127) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table restaurant
# ------------------------------------------------------------

CREATE TABLE `restaurant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `address` varchar(256) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `price` varchar(15) NOT NULL DEFAULT '',
  `type` varchar(63) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
