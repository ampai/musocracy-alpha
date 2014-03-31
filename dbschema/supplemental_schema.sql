SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `events` ;

CREATE  TABLE IF NOT EXISTS `events` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `access_code` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `host_id` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `start` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `end` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `max_users` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,

  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `event_guests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event_guests` ;

CREATE  TABLE IF NOT EXISTS `event_guests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `event_id` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `is_online` VARCHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;






SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
