-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema MajorProject
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema MajorProject
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `MajorProject` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `MajorProject` ;

-- -----------------------------------------------------
-- Table `MajorProject`.`faculties`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`faculties` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`faculties` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL,
  `code` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`schools`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`schools` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`schools` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL,
  `code` VARCHAR(10) NULL,
  `faculty_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_schools_faculties_idx` (`faculty_id` ASC),
  CONSTRAINT `fk_schools_faculties`
    FOREIGN KEY (`faculty_id`)
    REFERENCES `MajorProject`.`faculties` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`courses` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`courses` (
  `id` INT NOT NULL,
  `description` VARCHAR(255) NULL,
  `code` VARCHAR(45) NULL,
  `name` VARCHAR(255) NULL,
  `school_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_courses_schools1_idx` (`school_id` ASC),
  CONSTRAINT `fk_courses_schools1`
    FOREIGN KEY (`school_id`)
    REFERENCES `MajorProject`.`schools` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`user_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`user_types` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`user_types` (
  `id` INT NOT NULL,
  `type` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`users` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`users` (
  `id` INT NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  `remember_token` VARCHAR(255) NULL,
  `user_type_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_user_types1_idx` (`user_type_id` ASC),
  CONSTRAINT `fk_users_user_types1`
    FOREIGN KEY (`user_type_id`)
    REFERENCES `MajorProject`.`user_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`users_has_courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`users_has_courses` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`users_has_courses` (
  `users_id` INT NOT NULL,
  `courses_id` INT NOT NULL,
  `start_date` DATETIME NULL,
  `end_date` DATETIME NULL,
  PRIMARY KEY (`users_id`, `courses_id`),
  INDEX `fk_users_has_courses_courses1_idx` (`courses_id` ASC),
  INDEX `fk_users_has_courses_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_courses_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `MajorProject`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_courses_courses1`
    FOREIGN KEY (`courses_id`)
    REFERENCES `MajorProject`.`courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`assignments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`assignments` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`assignments` (
  `id` INT NOT NULL,
  `title` VARCHAR(255) NULL,
  `description` LONGTEXT NULL,
  `start_date` DATETIME NULL,
  `end_date` DATETIME NULL,
  `course_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_assignments_courses1_idx` (`course_id` ASC),
  CONSTRAINT `fk_assignments_courses1`
    FOREIGN KEY (`course_id`)
    REFERENCES `MajorProject`.`courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`submissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`submissions` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`submissions` (
  `id` INT NOT NULL,
  `filePath` MEDIUMTEXT NULL,
  `assignment_id` INT NOT NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_submissions_assignments1_idx` (`assignment_id` ASC),
  CONSTRAINT `fk_submissions_assignments1`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `MajorProject`.`assignments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MajorProject`.`users_has_submissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MajorProject`.`users_has_submissions` ;

CREATE TABLE IF NOT EXISTS `MajorProject`.`users_has_submissions` (
  `user_id` INT NOT NULL,
  `submission_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `submission_id`),
  INDEX `fk_users_has_submissions_submissions1_idx` (`submission_id` ASC),
  INDEX `fk_users_has_submissions_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_users_has_submissions_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `MajorProject`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_submissions_submissions1`
    FOREIGN KEY (`submission_id`)
    REFERENCES `MajorProject`.`submissions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
