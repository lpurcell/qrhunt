SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `qrproject` DEFAULT CHARACTER SET latin1 ;
USE `qrproject` ;

-- -----------------------------------------------------
-- Table `qrproject`.`ci_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `qrproject`.`ci_sessions` (
  `session_id` VARCHAR(40) NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(45) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(120) NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT NOT NULL ,
  PRIMARY KEY (`session_id`) ,
  INDEX `last_activity_idx` (`last_activity` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`organization`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `qrproject`.`organization` (
  `ORGANIZATION_ID` INT(11) NOT NULL AUTO_INCREMENT ,
  `ORGANIZATION_NAME` VARCHAR(45) NOT NULL ,
  `ORGANIZATION_SPONSOR` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`ORGANIZATION_ID`) )
ENGINE = InnoDB
AUTO_INCREMENT = 466
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`event`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `qrproject`.`event` (
  `EVENT_ID` INT(11) NOT NULL AUTO_INCREMENT ,
  `ORGANIZATION_ID` INT(11) NOT NULL ,
  `EVENT_NAME` VARCHAR(45) NOT NULL ,
  `EVENT_LOCATION` VARCHAR(45) NOT NULL ,
  `EVENT_DATE` DATE NULL DEFAULT NULL ,
  `EVENT_COORDINATOR` VARCHAR(45) NOT NULL ,
  `EVENT_EMAIL` VARCHAR(60) NOT NULL ,
  `EVENT_LOGO` VARCHAR(100) NULL DEFAULT NULL ,
  `EVENT_MAINCOLOR` VARCHAR(7) NULL DEFAULT NULL ,
  `EVENT_TEXTCOLOR` VARCHAR(7) NULL DEFAULT NULL ,
  `EVENT_HEADERCOLOR` VARCHAR(7) NULL DEFAULT NULL ,
  `EVENT_FOOTER` VARCHAR(7) NULL DEFAULT NULL ,
  `EVENT_LOGOBACKGROUND` VARCHAR(7) NULL DEFAULT NULL ,
  `EVENT_TWITTER` VARCHAR(32) NULL DEFAULT NULL ,
  PRIMARY KEY (`EVENT_ID`) ,
  INDEX `fk_event_organization_idx` (`ORGANIZATION_ID` ASC) ,
  CONSTRAINT `fk_event_organization`
    FOREIGN KEY (`ORGANIZATION_ID` )
    REFERENCES `qrproject`.`organization` (`ORGANIZATION_ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 838
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`participant`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `qrproject`.`participant` (
  `PARTICIPANT_ID` INT(11) NOT NULL AUTO_INCREMENT ,
  `EVENT_ID` INT(11) NOT NULL ,
  `PARTICIPANT_LNAME` VARCHAR(45) NOT NULL ,
  `PARTICIPANT_FNAME` VARCHAR(45) NOT NULL ,
  `PARTICIPANT_EMAIL` VARCHAR(60) NOT NULL ,
  `MISC1` VARCHAR(100) NULL DEFAULT NULL ,
  `MISC2` VARCHAR(40) NULL DEFAULT NULL ,
  `MISC3` VARCHAR(40) NULL DEFAULT NULL ,
  `QRCODE` VARCHAR(10) NOT NULL ,
  `PARTICIPANT_PICTURE` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`PARTICIPANT_ID`) ,
  INDEX `fk_participant_event1_idx` (`EVENT_ID` ASC) ,
  CONSTRAINT `fk_participant_event1`
    FOREIGN KEY (`EVENT_ID` )
    REFERENCES `qrproject`.`event` (`EVENT_ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 50
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`scan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `qrproject`.`scan` (
  `PARTICIPANT_ID` INT(11) NOT NULL ,
  `QR_SCANNED` VARCHAR(10) NOT NULL ,
  `EVENT_ID` INT(11) NOT NULL ,
  `SCAN_TIME` DATETIME NOT NULL ,
  PRIMARY KEY (`QR_SCANNED`, `PARTICIPANT_ID`) ,
  INDEX `fk_scan_participant1_idx` (`PARTICIPANT_ID` ASC) ,
  CONSTRAINT `fk_scan_participant1`
    FOREIGN KEY (`PARTICIPANT_ID` )
    REFERENCES `qrproject`.`participant` (`PARTICIPANT_ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`user_agent`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `qrproject`.`user_agent` (
  `AGENT_ID` INT(11) NOT NULL AUTO_INCREMENT ,
  `PARTICIPANT_ID` INT(11) NOT NULL ,
  `AGENT` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`AGENT_ID`) ,
  INDEX `fk_user_agent_participant1_idx` (`PARTICIPANT_ID` ASC) ,
  CONSTRAINT `fk_user_agent_participant1`
    FOREIGN KEY (`PARTICIPANT_ID` )
    REFERENCES `qrproject`.`participant` (`PARTICIPANT_ID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `qrproject`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(128) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `username` VARCHAR(30) NOT NULL ,
  `pwchange` ENUM('0','1') NOT NULL DEFAULT '0' ,
  INDEX `id` (`id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;

USE `qrproject` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
