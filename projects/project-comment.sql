CREATE  TABLE IF NOT EXISTS `jperetz`.`project_comment` (
  `comment` VARCHAR(2000) NULL ,
  `id_project_comment` INT NOT NULL AUTO_INCREMENT ,
  `class_student_syllabus_id` INT(11) NOT NULL ,
  `student_email` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id_project_comment`) ,
  INDEX `fk_project_comment_class1` (`class_student_syllabus_id` ASC) ,
  INDEX `fk_project_comment_student1` (`student_email` ASC) ,
  CONSTRAINT `fk_project_comment_class1`
    FOREIGN KEY (`class_student_syllabus_id` )
    REFERENCES `jperetz`.`class` (`student_syllabus_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_comment_student1`
    FOREIGN KEY (`student_email` )
    REFERENCES `jperetz`.`student` (`email` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
