CREATE TABLE `users` (
  `UserID` int(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `NotificationPreferences` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `date_registered` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `citizen` (
  `CitizenID` int(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `UserID` int(12) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  `MaritalStatus` varchar(20) DEFAULT NULL,
  `Occupation` varchar(50) DEFAULT NULL,
  `addressPresent` varchar(255) DEFAULT NULL,
  `addressPermanent` varchar(255) DEFAULT NULL,
  `ContactInfo` varchar(100) DEFAULT NULL,
  `Age` int(10) DEFAULT NULL,
  `TIN` int(20) DEFAULT NULL,
 
  FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `expat` (
  `ExpatID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `UserID` int(12) NOT NULL,
  `VisaType` varchar(50) DEFAULT NULL,
  `WorkPermitStatus` varchar(50) DEFAULT NULL,
  `ExpectedDepartureDate` date DEFAULT NULL,
  `EntryDate` date DEFAULT NULL,
  `BankAccount` varchar(50) DEFAULT NULL,
  `Origin` varchar(50) DEFAULT NULL,
  `PassportNumber` varchar(50) DEFAULT NULL,

  FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `governmentofficial` (
  `OfficialID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Username` varchar(50) NOT NULL UNIQUE,
  `FullName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `EmploymentType` varchar(50) DEFAULT NULL,
  `DateOfAppointment` date DEFAULT NULL,
  `WorkLocation` varchar(100) DEFAULT NULL,
  `Supervisor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DepartmentName` varchar(100) NOT NULL,
  `FoundingDate` date DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Budget` decimal(15,2) DEFAULT NULL,
  `NumberOfEmployees` int(11) DEFAULT NULL,
  `ContactInfo` varchar(100) DEFAULT NULL,
  `KeyPolicies` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `services` (
  `ServiceID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `ServiceType` varchar(100) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `ServiceDescription` text DEFAULT NULL,
  `ApplicationProcess` text DEFAULT NULL,
  `PriorityLevel` varchar(20) DEFAULT NULL,
  `DocumentsRequired` text DEFAULT NULL,
  `ServiceHistory` text DEFAULT NULL,

    FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `servicerequest` (
  `RequestID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CitizenID` int(12) NOT NULL,
  `ServiceID` int(11) DEFAULT NULL,
  `RequestStatus` varchar(50) NOT NULL DEFAULT 'Pending',
  `RequestDescription` text DEFAULT NULL,
  `SupportingEvidence` text DEFAULT NULL,

  FOREIGN KEY (`CitizenID`) REFERENCES `citizen` (`CitizenID`) ON DELETE CASCADE,
  FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `admin` (
  `Username` varchar(50) NOT NULL PRIMARY KEY,
  `FullName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO services (ServiceType) VALUES ('Passport');
INSERT INTO services (ServiceType) VALUES ('Transport');
INSERT INTO services (ServiceType) VALUES ('Citizenship');

CREATE TABLE `review` (
  `ReviewID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `RequestID` INT(11) NOT NULL,
  `CitizenID` int(12) NOT NULL,
  `ServiceID` INT(11) NOT NULL,
  `Review` TEXT DEFAULT NULL,
  `DateSubmitted` DATETIME DEFAULT CURRENT_TIMESTAMP,
  
  FOREIGN KEY (`UserID`) REFERENCES `users`(`UserID`) ON DELETE CASCADE,
  FOREIGN KEY (`RequestID`) REFERENCES `servicerequest`(`RequestID`) ON DELETE CASCADE,
  FOREIGN KEY (`ServiceID`) REFERENCES `services`(`ServiceID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




