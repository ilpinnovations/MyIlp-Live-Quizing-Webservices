-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`emp_reg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`emp_reg` (
  `emp_id` INT NOT NULL,
  `emp_name` VARCHAR(45) NOT NULL,
  `emp_loc` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`emp_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ibuzquestions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ibuzquestions` (
  `ques_id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL DEFAULT 'Active',
  `option1` VARCHAR(1000) NOT NULL,
  `option2` VARCHAR(1000) NOT NULL,
  `option3` VARCHAR(1000) NOT NULL,
  `option4` VARCHAR(1000) NOT NULL,
  `question` VARCHAR(1500) NOT NULL,
  `submit_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `correct_ans` INT NOT NULL,
  `emp_id` INT NOT NULL,
  PRIMARY KEY (`ques_id`),
  INDEX `fk_ibuzquestions_emp_reg1_idx` (`emp_id` ASC),
  CONSTRAINT `fk_ibuzquestions_emp_reg1`
    FOREIGN KEY (`emp_id`)
    REFERENCES `mydb`.`emp_reg` (`emp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ibuzanswers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ibuzanswers` (
  `ans_id` INT NOT NULL AUTO_INCREMENT,
  `answer` INT NOT NULL,
  `submit_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emp_id` INT NOT NULL,
  `ques_id` INT NOT NULL,
  PRIMARY KEY (`ans_id`),
  INDEX `fk_ibuzanswers_emp_reg_idx` (`emp_id` ASC),
  INDEX `fk_ibuzanswers_ibuzquestions1_idx` (`ques_id` ASC),
  CONSTRAINT `fk_ibuzanswers_emp_reg`
    FOREIGN KEY (`emp_id`)
    REFERENCES `mydb`.`emp_reg` (`emp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ibuzanswers_ibuzquestions1`
    FOREIGN KEY (`ques_id`)
    REFERENCES `mydb`.`ibuzquestions` (`ques_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mydb` ;

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`emp_ques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`emp_ques` (`emp_id` INT, `emp_loc` INT, `ques_id` INT, `status` INT, `option1` INT, `option2` INT, `option3` INT, `option4` INT, `question` INT, `submit_time` INT, `correct_ans` INT);

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`emp_ans`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`emp_ans` (`emp_emp_id` INT, `faculty_emp_id` INT, `emp_loc` INT, `emp_name` INT, `ans_id` INT, `ques_id` INT, `correct_ans` INT, `answer` INT, `submit_time` INT);

-- -----------------------------------------------------
-- View `mydb`.`emp_ques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`emp_ques`;
USE `mydb`;
CREATE  OR REPLACE VIEW `emp_ques` AS
SELECT ibuzquestions.emp_id,emp_reg.emp_loc,ibuzquestions.ques_id,ibuzquestions.status,ibuzquestions.option1,
ibuzquestions.option2,ibuzquestions.option3,ibuzquestions.option4,ibuzquestions.question,ibuzquestions.submit_time
,ibuzquestions.correct_ans
FROM ibuzquestions,emp_reg
WHERE ibuzquestions.emp_id = emp_reg.emp_id;

-- -----------------------------------------------------
-- View `mydb`.`emp_ans`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`emp_ans`;
USE `mydb`;
CREATE  OR REPLACE VIEW `emp_ans` AS
SELECT ibuzanswers.emp_id AS emp_emp_id,ibuzquestions.emp_id AS faculty_emp_id,emp_reg.emp_loc,emp_reg.emp_name,ibuzanswers.ans_id,ibuzanswers.ques_id,ibuzquestions.correct_ans,ibuzanswers.answer
,ibuzanswers.submit_time
FROM ibuzanswers,ibuzquestions,emp_reg
WHERE
ibuzanswers.emp_id = emp_reg.emp_id
AND ibuzanswers.ques_id = ibuzquestions.ques_id
AND ibuzquestions.emp_id=emp_reg.emp_id;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



CREATE view emp_loc AS
SELECT count(*)
FROM ibuzanswers,emp_reg
WHERE
ibuzanswers.emp_id = emp_reg.emp_id
and emp_loc='Trivandrum'

CREATE view emp_option AS
SELECT ibuzanswers.ques_id,ibuzanswers.emp_id,ibuzquestions.option1,ibuzquestions.option2,ibuzquestions.option3,ibuzquestions.option4,ibuzanswers.answer
FROM ibuzanswers,ibuzquestions
WHERE
ibuzanswers.ques_id = ibuzquestions.ques_id

