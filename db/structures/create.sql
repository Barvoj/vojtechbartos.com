SET NAMES utf8;
SET foreign_key_checks = 0;

--
-- Číselník jazyků
--
DROP TABLE IF EXISTS `vojtechbartos`.`languages`;
CREATE TABLE `vojtechbartos`.`languages` (
  `language_id`     INT          NOT NULL AUTO_INCREMENT
  COMMENT 'Id jazyka',
  `code`            VARCHAR(3)   NOT NULL
  COMMENT 'Kód jazyka dle normy ISO639-2 př.: eng',
  `locale`          VARCHAR(5)   NOT NULL
  COMMENT 'Locale dle normy BCP 47 př.: en, cs-CZ',
  `locale_language` VARCHAR(2)   NOT NULL
  COMMENT 'Jazyk z locale př.: en, cs',
  `locale_region`   VARCHAR(2)   NOT NULL
  COMMENT 'Region z locale př.: US, CZ',
  `name`            VARCHAR(255) NOT NULL
  COMMENT 'Název jazyka př.: English',
  `is_enabled`      BOOLEAN      NOT NULL DEFAULT 0
  COMMENT 'Příznak, zda je jazyk v aplikaci zapnut',
  PRIMARY KEY (`language_id`),
  UNIQUE KEY (`locale`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Číselník jazyků';

--
-- Tabulka uživatelů
--
DROP TABLE IF EXISTS `vojtechbartos`.`users`;
CREATE TABLE `vojtechbartos`.`users` (
  `user_id`     INT          NOT NULL AUTO_INCREMENT
  COMMENT 'Id uživatele',
  `username`    VARCHAR(255) NOT NULL
  COMMENT 'Uživatelské jméno',
  `email`       VARCHAR(255) NOT NULL
  COMMENT 'Emailová adresa',
  `role_id`     INT          NOT NULL DEFAULT 1
  COMMENT 'Role uživatele',
  `first_name`  VARCHAR(255)          DEFAULT NULL
  COMMENT 'Jméno',
  `last_name`   VARCHAR(255)          DEFAULT NULL
  COMMENT 'Příjmení',
  `password`    VARCHAR(60)  NOT NULL
  COMMENT 'Osolený hash hesla',
  `language_id` INT          NOT NULL DEFAULT 1
  COMMENT 'Jazyk pro komunikaci s uživatelem',
  PRIMARY KEY (`user_id`),
  UNIQUE (`username`),
  UNIQUE (`email`),
  FOREIGN KEY (`language_id`) REFERENCES `vojtechbartos`.`languages` (`language_id`)
    ON DELETE RESTRICT
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Tabulka všech uživatelů';

--
-- Číselník uživatelských rolí
--
DROP TABLE IF EXISTS `vojtechbartos`.`roles`;
CREATE TABLE `vojtechbartos`.`roles` (
  `role_id` INT         NOT NULL AUTO_INCREMENT
  COMMENT 'Id role',
  `code`    VARCHAR(20) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY (`code`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Číselník uživatelských rolí';

--
-- Tabulka článků
--
DROP TABLE IF EXISTS `vojtechbartos`.`articles`;
CREATE TABLE `vojtechbartos`.`articles` (
  `article_id`       INT          NOT NULL AUTO_INCREMENT
  COMMENT 'Id článku',
  `title`        VARCHAR(255)          DEFAULT NULL
  COMMENT 'Titulek',
  `content`      TEXT  NOT NULL
  COMMENT 'Obsah článku',
  `language_id`   INT          NOT NULL DEFAULT 1
  COMMENT 'Jazyk ve kterém je článek napsaný',
  `user_id`   INT          NOT NULL DEFAULT 1
  COMMENT 'Autor',
  `published` DATETIME DEFAULT NULL
  COMMENT 'Datum publikování',
  PRIMARY KEY (`article_id`),
  FOREIGN KEY (`language_id`) REFERENCES `vojtechbartos`.`languages` (`language_id`)
    ON DELETE RESTRICT,
  FOREIGN KEY (`user_id`) REFERENCES `vojtechbartos`.`users` (`user_id`)
    ON DELETE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Tabulka všech uživatelů';

DROP TABLE IF EXISTS `vojtechbartos`.`pages`;
CREATE TABLE `vojtechbartos`.`pages` (
  `page_id` INT  NOT NULL AUTO_INCREMENT
  COMMENT 'Id stránky',
  `code`    VARCHAR(100)  DEFAULT NULL
  COMMENT 'Kód',
  `title`   VARCHAR(255)  DEFAULT NULL
  COMMENT 'Titulek',
  `content` TEXT NOT NULL
  COMMENT 'Obsah stránky',
  PRIMARY KEY (`page_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Tabulka stránek';