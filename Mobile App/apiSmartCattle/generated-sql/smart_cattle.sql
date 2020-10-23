
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- behavior_data
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `behavior_data`;

CREATE TABLE `behavior_data`
(
    `ID` INTEGER NOT NULL AUTO_INCREMENT,
    `cowID` INTEGER NOT NULL,
    `behavior` VARCHAR(100) NOT NULL,
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `duration` INTEGER,
    PRIMARY KEY (`ID`),
    INDEX `cowID` (`cowID`),
    CONSTRAINT `behavior_data_ibfk_1`
        FOREIGN KEY (`cowID`)
        REFERENCES `cow` (`cowID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- cow
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cow`;

CREATE TABLE `cow`
(
    `cowID` INTEGER NOT NULL AUTO_INCREMENT,
    `farmID` INTEGER NOT NULL,
    `hwID1` INTEGER NOT NULL,
    `hwID2` INTEGER NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `birthDate` DATE NOT NULL,
    PRIMARY KEY (`cowID`),
    INDEX `farmID` (`farmID`),
    INDEX `hwID1` (`hwID1`),
    INDEX `hwID2` (`hwID2`),
    CONSTRAINT `cow_ibfk_1`
        FOREIGN KEY (`farmID`)
        REFERENCES `farm` (`farmID`),
    CONSTRAINT `cow_ibfk_2`
        FOREIGN KEY (`hwID1`)
        REFERENCES `hardware` (`hwID`),
    CONSTRAINT `cow_ibfk_3`
        FOREIGN KEY (`hwID2`)
        REFERENCES `hardware` (`hwID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- farm
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `farm`;

CREATE TABLE `farm`
(
    `farmID` INTEGER NOT NULL AUTO_INCREMENT,
    `farmName` VARCHAR(100) NOT NULL,
    `username` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`farmID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- general_data
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `general_data`;

CREATE TABLE `general_data`
(
    `ID` INTEGER NOT NULL AUTO_INCREMENT,
    `cowID` INTEGER NOT NULL,
    `action` VARCHAR(200) NOT NULL,
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`),
    INDEX `cowID` (`cowID`),
    CONSTRAINT `general_data_ibfk_1`
        FOREIGN KEY (`cowID`)
        REFERENCES `cow` (`cowID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- hardware
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `hardware`;

CREATE TABLE `hardware`
(
    `hwID` INTEGER NOT NULL AUTO_INCREMENT,
    `installPath` VARCHAR(100) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`hwID`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
