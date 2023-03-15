CREATE TABLE
  `document_type` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `desc_document_type` varchar(60) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = latin1;

CREATE TABLE
  `sector` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `sigla` varchar(20) NOT NULL,
    `description` varchar(150) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = latin1;

CREATE TABLE
  `documents` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `type_document_id` int unsigned NOT NULL,
    `num_document` varchar(20) NOT NULL,
    `title` varchar(40) NOT NULL,
    `desc_document` varchar(255) NOT NULL,
    `path_pdf` varchar(100) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `fk_document_type` (`type_document_id`),
    CONSTRAINT `fk_document_type` FOREIGN KEY (`type_document_id`) REFERENCES `document_type` (`id`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = latin1;

  CREATE TABLE
  `document_processing` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `document_id` int unsigned NOT NULL,
    `sector_receive_id` int unsigned DEFAULT NULL,
    `sector_send_id` int unsigned DEFAULT NULL,
    `datetime_send` timestamp NULL DEFAULT NULL,
    `datetime_received` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_sector_receive` (`sector_receive_id`),
    KEY `fk_sector_send` (`sector_send_id`),
    KEY `fk_document` (`document_id`),
    CONSTRAINT `fk_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`),
    CONSTRAINT `fk_sector_receive` FOREIGN KEY (`sector_receive_id`) REFERENCES `sector` (`id`),
    CONSTRAINT `fk_sector_send` FOREIGN KEY (`sector_send_id`) REFERENCES `sector` (`id`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 16 DEFAULT CHARSET = latin1;

INSERT INTO
    document_type (`desc_document_type`)
  VALUES
    ("Edital"), ("Informativo"), ("Finanças") ;