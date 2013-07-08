SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `qrproject` ;
CREATE SCHEMA IF NOT EXISTS `qrproject` DEFAULT CHARACTER SET latin1 ;
USE `qrproject` ;

-- -----------------------------------------------------
-- Table `qrproject`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `qrproject`.`event` ;

CREATE  TABLE IF NOT EXISTS `qrproject`.`event` (
  `EVENT_ID` INT(11) NOT NULL AUTO_INCREMENT ,
  `ORGANIZATION_ID` INT(11) NOT NULL ,
  `EVENT_NAME` VARCHAR(45) NOT NULL ,
  `EVENT_LOCATION` VARCHAR(45) NOT NULL ,
  `EVENT_DATE` DATE NULL DEFAULT NULL ,
  `EVENT_COORDINATOR` VARCHAR(45) NOT NULL ,
  `EVENT_EMAIL` VARCHAR(60) NOT NULL ,
  `EVENT_LOGO` VARCHAR(100) NULL DEFAULT NULL ,
  `EVENT_MAINCOLOR` VARCHAR(20) NULL DEFAULT NULL ,
  `EVENT_TEXTCOLOR` VARCHAR(7) NULL DEFAULT NULL ,
  `EVENT_HEADERCOLOR` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`EVENT_ID`) )
ENGINE = InnoDB
AUTO_INCREMENT = 827
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`organization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `qrproject`.`organization` ;

CREATE  TABLE IF NOT EXISTS `qrproject`.`organization` (
  `ORGANIZATION_ID` INT(11) NOT NULL AUTO_INCREMENT ,
  `ORGANIZATION_NAME` VARCHAR(45) NOT NULL ,
  `ORGANIZATION_SPONSOR` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`ORGANIZATION_ID`) )
ENGINE = InnoDB
AUTO_INCREMENT = 460
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`participant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `qrproject`.`participant` ;

CREATE  TABLE IF NOT EXISTS `qrproject`.`participant` (
  `PARTICIPANT_ID` INT(11) NOT NULL AUTO_INCREMENT ,
  `EVENT_ID` INT(11) NOT NULL ,
  `PARTICIPANT_LNAME` VARCHAR(45) NOT NULL ,
  `PARTICIPANT_FNAME` VARCHAR(45) NOT NULL ,
  `PARTICIPANT_EMAIL` VARCHAR(60) NOT NULL ,
  `PARTICIPANT_WEBSITE` VARCHAR(100) NULL DEFAULT NULL ,
  `QRCODE` VARCHAR(10) NOT NULL ,
  `PARTICIPANT_PICTURE` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`PARTICIPANT_ID`) )
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `qrproject`.`scan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `qrproject`.`scan` ;

CREATE  TABLE IF NOT EXISTS `qrproject`.`scan` (
  `PARTICIPANT_ID` INT(11) NOT NULL DEFAULT '0' ,
  `QR_SCANNED` VARCHAR(10) NOT NULL ,
  `SCAN_TIME` DATETIME NOT NULL ,
  PRIMARY KEY (`PARTICIPANT_ID`, `QR_SCANNED`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

USE `qrproject` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
