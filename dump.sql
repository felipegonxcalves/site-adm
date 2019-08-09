-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projeto-site
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projeto-site
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projeto-site` DEFAULT CHARACTER SET utf8 ;
USE `projeto-site` ;

-- -----------------------------------------------------
-- Table `projeto-site`.`pages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto-site`.`pages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `body` TEXT NULL,
  `created` DATETIME NOT NULL,
  `updated` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto-site`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto-site`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `created` DATETIME NULL,
  `updated` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
