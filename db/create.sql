CREATE DATABASE `vojtechbartos`
  CHARACTER SET utf8
  COLLATE utf8_general_ci;
USE `vojtechbartos`;

--
-- Číselník jazyků
--
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
CREATE TABLE `vojtechbartos`.`users` (
  `user_id`       INT          NOT NULL AUTO_INCREMENT
  COMMENT 'Id uživatele',
  `username`      VARCHAR(255) NOT NULL
  COMMENT 'Uživatelské jméno',
  `email`         VARCHAR(255) NOT NULL
  COMMENT 'Emailová adresa',
  `first_name`    VARCHAR(255)          DEFAULT NULL
  COMMENT 'Jméno',
  `last_name`     VARCHAR(255)          DEFAULT NULL
  COMMENT 'Příjmení',
  `password`      VARCHAR(60)  NOT NULL
  COMMENT 'Osolený hash hesla',
  `language_id`   INT          NOT NULL DEFAULT 1
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
-- Tabulka článků
--
CREATE TABLE `vojtechbartos`.`articles` (
  `article_id`       INT          NOT NULL AUTO_INCREMENT
  COMMENT 'Id článku',
  `title`        VARCHAR(255)          DEFAULT NULL
  COMMENT 'Příjmení',
  `content`      TEXT  NOT NULL
  COMMENT 'Osolený hash hesla',
  `language_id`   INT          NOT NULL DEFAULT 1
  COMMENT 'Jazyk pro komunikaci s uživatelem',
  PRIMARY KEY (`article_id`),
  FOREIGN KEY (`language_id`) REFERENCES `vojtechbartos`.`languages` (`language_id`)
    ON DELETE RESTRICT
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Tabulka všech uživatelů';