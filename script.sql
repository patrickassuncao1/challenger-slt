CREATE TABLE
  `sector` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `sigla` varchar(20) NOT NULL,
    `description` varchar(150) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = latin1