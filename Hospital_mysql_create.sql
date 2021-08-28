CREATE TABLE `employees` (
	`empId` INT(10) NOT NULL AUTO_INCREMENT,
	`FirstName` varchar(20) NOT NULL,
	`lastName` varchar(20) NOT NULL,
	`city` varchar(20) NOT NULL,
	`mobile` varchar(20) NOT NULL,
	`empImage` varchar(500) NOT NULL,
	`empTypeId` INT(10) NOT NULL,
	PRIMARY KEY (`empId`)
);

CREATE TABLE `empType` (
	`empTypeId` INT(10) NOT NULL AUTO_INCREMENT,
	`empType` varchar(20) NOT NULL,
	PRIMARY KEY (`empTypeId`)
);

CREATE TABLE `login` (
	`loginId` INT(10) NOT NULL AUTO_INCREMENT,
	`userName` varchar(20) NOT NULL UNIQUE,
	`password` varchar(500) NOT NULL,
	`empId` INT(10) NOT NULL,
	PRIMARY KEY (`loginId`)
);

CREATE TABLE `patients` (
	`patientId` INT(10) NOT NULL AUTO_INCREMENT,
	`name` varchar(20) NOT NULL,
	`gender` varchar(10) NOT NULL,
	`no` varchar(10) NOT NULL,
	`street` varchar(20) NOT NULL,
	`city` varchar(20) NOT NULL,
	PRIMARY KEY (`patientId`)
);

CREATE TABLE `addmission` (
	`addmissionId` INT(10) NOT NULL AUTO_INCREMENT,
	`adimissionDate` DATE NOT NULL,
	`reason` TEXT NOT NULL,
	`payment` INT(100) NOT NULL,
	`employeeId` INT(10) NOT NULL,
	`ptientId` INT(10) NOT NULL,
	PRIMARY KEY (`addmissionId`)
);

CREATE TABLE `payment` (
	`paymentId` INT(10) NOT NULL AUTO_INCREMENT,
	`paymentDate` DATE NOT NULL,
	`amount` INT(10) NOT NULL,
	`remark` VARCHAR(100) NOT NULL,
	`addmissionId` INT(10) NOT NULL,
	PRIMARY KEY (`paymentId`)
);

ALTER TABLE `employees` ADD CONSTRAINT `employees_fk0` FOREIGN KEY (`empTypeId`) REFERENCES `empType`(`empTypeId`);

ALTER TABLE `login` ADD CONSTRAINT `login_fk0` FOREIGN KEY (`empId`) REFERENCES `employees`(`empId`);

ALTER TABLE `addmission` ADD CONSTRAINT `addmission_fk0` FOREIGN KEY (`employeeId`) REFERENCES `employees`(`empId`);

ALTER TABLE `addmission` ADD CONSTRAINT `addmission_fk1` FOREIGN KEY (`ptientId`) REFERENCES `patients`(`patientId`);

ALTER TABLE `payment` ADD CONSTRAINT `payment_fk0` FOREIGN KEY (`addmissionId`) REFERENCES `addmission`(`addmissionId`);







