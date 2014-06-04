SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`artiest`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`artiest` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`artiest` (
  `artiest_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(80) NULL DEFAULT NULL ,
  `omschrijving` TEXT NOT NULL ,
  `foto` TEXT NOT NULL ,
  `geluids_fragment` TEXT NULL DEFAULT NULL ,
  `video_fragment` TEXT NULL DEFAULT NULL ,
  `website` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`artiest_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`klant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`klant` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`klant` (
  `klant_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `voornaam` VARCHAR(80) NOT NULL ,
  `achternaam` VARCHAR(80) NOT NULL ,
  `email` VARCHAR(80) NOT NULL ,
  `wachtwoord` TEXT NOT NULL ,
  PRIMARY KEY (`klant_id`, `email`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`zaal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`zaal` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`zaal` (
  `zaal_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(80) NOT NULL ,
  `status` ENUM('vrij','schoonmaak','ingebruik') NOT NULL ,
  `plaatsen` INT(11) NOT NULL ,
  PRIMARY KEY (`zaal_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`optreden`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`optreden` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`optreden` (
  `optreden_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `datum` DATE NOT NULL ,
  `artiest` INT(11) NOT NULL ,
  `zaal` INT(11) NOT NULL ,
  `uitverkocht` TINYINT(1) NULL DEFAULT NULL ,
  `kaarten_beschikbaar` INT(11) NOT NULL ,
  `kaarten_verkocht` INT(11) NULL DEFAULT NULL ,
  `afgelast` TINYINT(1) NOT NULL ,
  `datum_uitverkocht` DATE NOT NULL ,
  PRIMARY KEY (`optreden_id`) ,
  INDEX `artiest` (`artiest` ASC) ,
  INDEX `zaal` (`zaal` ASC) ,
  CONSTRAINT `optreden_ibfk_1`
    FOREIGN KEY (`artiest` )
    REFERENCES `ManifestoDriebruggen`.`artiest` (`artiest_id` )
    ON DELETE CASCADE,
  CONSTRAINT `optreden_ibfk_2`
    FOREIGN KEY (`zaal` )
    REFERENCES `ManifestoDriebruggen`.`zaal` (`zaal_id` )
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`bestelling`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`bestelling` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`bestelling` (
  `bestelling_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `klant` INT(11) NOT NULL ,
  `optreden` INT(11) NOT NULL ,
  `aantal` INT(11) NOT NULL ,
  PRIMARY KEY (`bestelling_id`) ,
  INDEX `klant` (`klant` ASC) ,
  INDEX `optreden` (`optreden` ASC) ,
  CONSTRAINT `bestelling_ibfk_1`
    FOREIGN KEY (`klant` )
    REFERENCES `ManifestoDriebruggen`.`klant` (`klant_id` )
    ON DELETE CASCADE,
  CONSTRAINT `bestelling_ibfk_2`
    FOREIGN KEY (`optreden` )
    REFERENCES `ManifestoDriebruggen`.`optreden` (`optreden_id` )
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`genre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`genre` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`genre` (
  `genre_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(80) NOT NULL ,
  PRIMARY KEY (`genre_id`, `naam`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`genre_artiest`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`genre_artiest` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`genre_artiest` (
  `genre` INT(11) NOT NULL ,
  `artiest` INT(11) NOT NULL ,
  PRIMARY KEY (`genre`, `artiest`) ,
  INDEX `artiest` (`artiest` ASC) ,
  CONSTRAINT `genre_artiest_ibfk_1`
    FOREIGN KEY (`genre` )
    REFERENCES `ManifestoDriebruggen`.`genre` (`genre_id` )
    ON DELETE CASCADE,
  CONSTRAINT `genre_artiest_ibfk_2`
    FOREIGN KEY (`artiest` )
    REFERENCES `ManifestoDriebruggen`.`artiest` (`artiest_id` )
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`mailing_list`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`mailing_list` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`mailing_list` (
  `mailinglist_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `klant` INT(11) NOT NULL ,
  `genre` INT(11) NULL DEFAULT NULL ,
  `artiesten` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`mailinglist_id`) ,
  INDEX `klant` (`klant` ASC) ,
  INDEX `genre` (`genre` ASC) ,
  CONSTRAINT `mailing_list_ibfk_1`
    FOREIGN KEY (`klant` )
    REFERENCES `ManifestoDriebruggen`.`klant` (`klant_id` )
    ON DELETE CASCADE,
  CONSTRAINT `mailing_list_ibfk_2`
    FOREIGN KEY (`genre` )
    REFERENCES `ManifestoDriebruggen`.`genre` (`genre_id` )
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`persbericht`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`persbericht` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`persbericht` (
  `persbericht_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `titel` VARCHAR(80) NOT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`persbericht_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ManifestoDriebruggen`.`artiesten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ManifestoDriebruggen`.`artiesten` ;

CREATE  TABLE IF NOT EXISTS `ManifestoDriebruggen`.`artiesten` (
  `artiesten_id` INT NOT NULL ,
  `optreden` INT NOT NULL ,
  `artiest` INT NOT NULL ,
  PRIMARY KEY (`artiesten_id`) ,
  UNIQUE INDEX `artiesten_id_UNIQUE` (`artiesten_id` ASC) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
