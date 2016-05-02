CREATE DATABASE `vojtechbartos`
  CHARACTER SET utf8
  COLLATE utf8_general_ci;
USE `vojtechbartos`;

--
-- Funkce
--
DELIMITER //

CREATE PROCEDURE `vojtechbartos`.set_app_user_id(user_id INT)
  COMMENT 'Setter na aktuálního uživatele aplikace'
  SQL SECURITY INVOKER
  BEGIN
    SET @application_user_id := user_id;
  END;
//
DELIMITER ;


DELIMITER //

CREATE FUNCTION `vojtechbartos`.get_app_user_id()
  RETURNS INT
NO SQL
  COMMENT 'Vrací id aktuálního aplikačního uživatele'
  SQL SECURITY INVOKER
  BEGIN
    RETURN @application_user_id;
  END;
//
DELIMITER ;


DELIMITER //

CREATE FUNCTION `vojtechbartos`.get_db_user_name()
  RETURNS VARCHAR(60)
NO SQL
  COMMENT 'Vrací jméno aktuálního databázového uživatele'
  SQL SECURITY INVOKER
  BEGIN
    RETURN user();
  END;
//
DELIMITER ;

DELIMITER //

CREATE PROCEDURE `vojtechbartos`.`set_stamp`(INOUT io_date_at    DATETIME,
  INOUT                                                                                         io_user_by    INT,
  INOUT                                                                                         io_user_by_db VARCHAR(64))
  COMMENT 'Zapíše značku o vložení/editaci/smazání záznamu'
NO SQL
  SQL SECURITY INVOKER
  BEGIN
    SET io_date_at := now();
    SET io_user_by := get_app_user_id();
    SET io_user_by_db := get_db_user_name();
  END;
//
DELIMITER ;

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
  `created_at`      DATETIME COMMENT 'Datum vytvoření záznamu',
  `created_by`      INT COMMENT 'Id aplikačního uživatele, který záznam vytvořil',
  `created_by_db`   VARCHAR(60) COMMENT 'Jméno DB uživatele, který záznam vytvořil',
  `updated_at`      DATETIME COMMENT 'Datum poslední změny záznamu',
  `updated_by`      INT COMMENT 'Id aplikačního uživatele, který záznam změnil',
  `updated_by_db`   VARCHAR(60) COMMENT 'Jméno DB uživatele, který záznam změnil',
  `deleted_at`      DATETIME COMMENT 'Datum smazání záznamu',
  `deleted_by`      INT COMMENT 'Id aplikačního uživatele, který záznam smazal',
  `deleted_by_db`   VARCHAR(60) COMMENT 'Jméno DB uživatele, který záznam smazal',
  PRIMARY KEY (`language_id`),
  UNIQUE KEY (`locale`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Číselník jazyků';

DELIMITER //
CREATE TRIGGER `vojtechbartos`.`languages_created` BEFORE INSERT ON `vojtechbartos`.`languages`
FOR EACH ROW BEGIN
  CALL `vojtechbartos`.set_stamp(NEW.created_at, NEW.created_by, NEW.created_by_db);
END
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `vojtechbartos`.`languages_updated` BEFORE UPDATE ON `vojtechbartos`.`languages`
FOR EACH ROW BEGIN
  IF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL
  THEN
    CALL `vojtechbartos`.set_stamp(NEW.deleted_at, NEW.deleted_by, NEW.deleted_by_db);

  ELSE
    CALL `vojtechbartos`.set_stamp(NEW.updated_at, NEW.updated_by, NEW.updated_by_db);
  END IF;
END
//
DELIMITER ;

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
  `token`         VARCHAR(255)          DEFAULT NULL
  COMMENT 'Přihlašovací token',
  `created_at`    DATETIME COMMENT 'Datum vytvoření záznamu',
  `created_by`    INT COMMENT 'Id aplikačního uživatele, který záznam vytvořil',
  `created_by_db` VARCHAR(60) COMMENT 'Jméno DB uživatele, který záznam vytvořil',
  `updated_at`    DATETIME COMMENT 'Datum poslední změny záznamu',
  `updated_by`    INT COMMENT 'Id aplikačního uživatele, který záznam změnil',
  `updated_by_db` VARCHAR(60) COMMENT 'Jméno DB uživatele, který záznam změnil',
  `deleted_at`    DATETIME COMMENT 'Datum smazání záznamu',
  `deleted_by`    INT COMMENT 'Id aplikačního uživatele, který záznam smazal',
  `deleted_by_db` VARCHAR(60) COMMENT 'Jméno DB uživatele, který záznam smazal',
  PRIMARY KEY (`user_id`),
  UNIQUE (`username`),
  UNIQUE (`email`),
  FOREIGN KEY (`language_id`) REFERENCES `vojtechbartos`.`languages` (`language_id`)
    ON DELETE RESTRICT
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT 'Tabulka všech uživatelů';

DELIMITER //
CREATE TRIGGER `vojtechbartos`.`users_created` BEFORE INSERT ON `vojtechbartos`.`users`
FOR EACH ROW BEGIN
  CALL `vojtechbartos`.set_stamp(NEW.created_at, NEW.created_by, NEW.created_by_db);
END
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `vojtechbartos`.`users_updated` BEFORE UPDATE ON `vojtechbartos`.`users`
FOR EACH ROW BEGIN
  IF OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL
  THEN
    CALL `vojtechbartos`.set_stamp(NEW.deleted_at, NEW.deleted_by, NEW.deleted_by_db);
  ELSE
    CALL `vojtechbartos`.set_stamp(NEW.updated_at, NEW.updated_by, NEW.updated_by_db);
  END IF;
END
//
DELIMITER ;