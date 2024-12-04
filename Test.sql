
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `bdportal`

-- Table structure for table `citizen`  


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

--
-- Triggers `citizen`
--
DELIMITER $$
CREATE TRIGGER `set_age_before_insert` BEFORE INSERT ON `citizen` FOR EACH ROW BEGIN
    SET NEW.Age = TIMESTAMPDIFF(YEAR, NEW.DateOfBirth, CURDATE());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_age_before_update` BEFORE UPDATE ON `citizen` FOR EACH ROW BEGIN
    SET NEW.Age = TIMESTAMPDIFF(YEAR, NEW.DateOfBirth, CURDATE());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `completedrequest`
--

CREATE TABLE `completedrequest` (
  `RequestID` int(11) NOT NULL,
  `CompletionDate` date DEFAULT NULL,
  `ApprovalStatus` varchar(50) DEFAULT NULL,
  `ResolutionSummary` text DEFAULT NULL,
  `FinalProcessing` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expat`
--

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

-- --------------------------------------------------------
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `NotificationPreferences` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `date_registered` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Username`, `Password`, `Email`, `NotificationPreferences`) VALUES
(1, 'John Doe', 'johndoe', 'johndoe', 'johndoe@mail.com', NULL),
(2, 'Jane Doe', 'janedoe', 'janedoe', 'janedoe@mail.com', NULL),
(3, 'Alice', 'alice', 'alice', 'alice@mail.com', NULL),
(4, 'Bob', 'bob', 'bob', 'bob@mail.com', NULL),
(5, 'Charlie', 'charlie', 'charlie', 'charlie@mail.com', NULL),
(6, 'David', 'david', 'david', 'david@mail.com', NULL);

--
--
-- Table structure for table `governmentdepartment`
--

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

-- --------------------------------------------------------

CREATE TABLE `admin` (
  `Username` varchar(50) NOT NULL UNIQUE,
  `FullName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
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

-- --------------------------------------------------------
--

--
-- Table structure for table `nid_card`
--

CREATE TABLE `nid_card` (
  `NID` int(11) NOT NULL,
  `CitizenID` int(12) NOT NULL,
  `FathersName` varchar(100) DEFAULT NULL,
  `MothersName` varchar(100) DEFAULT NULL,
  `DateOfIssue` date DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `BloodType` char(3) DEFAULT NULL,
  `PlaceOfBirth` varchar(100) DEFAULT NULL,
  `Signature` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(12) NOT NULL,
  `Message` text DEFAULT NULL,
  `NotificationType` varchar(50) DEFAULT NULL,
  `DateSent` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendingrequest`
--

CREATE TABLE `pendingrequest` (
  `RequestID` int(11) NOT NULL,
  `SubmissionDate` date DEFAULT NULL,
  `LastUpdatedDate` date DEFAULT NULL,
  `DepartmentInCharge` int(11) DEFAULT NULL,
  `FollowUpRequirement` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servicefeedback`
--

CREATE TABLE `servicefeedback` (
  `FeedbackID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `FeedbackDate` date DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL CHECK (`Rating` between 1 and 5),
  `FinalDocumentIssued` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servicerequest`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `ServiceType` varchar(100) DEFAULT NULL,
  `ServiceDescription` text DEFAULT NULL,
  `ApplicationProcess` text DEFAULT NULL,
  `PriorityLevel` varchar(20) DEFAULT NULL,
  `DocumentsRequired` text DEFAULT NULL,
  `ServiceHistory` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--

-- Indexes for dumped tables
--

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`CitizenID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `completedrequest`
--
ALTER TABLE `completedrequest`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `expat`
--
ALTER TABLE `expat`
  ADD PRIMARY KEY (`ExpatID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `governmentdepartment`
--
ALTER TABLE `governmentdepartment`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `governmentofficial`
--
ALTER TABLE `governmentofficial`
  ADD PRIMARY KEY (`OfficialID`),
  ADD UNIQUE KEY `UserID` (`UserID`),
  ADD KEY `Supervisor` (`Supervisor`);

--
-- Indexes for table `nid_card`
--
ALTER TABLE `nid_card`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `CitizenID` (`CitizenID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `pendingrequest`
--
ALTER TABLE `pendingrequest`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `DepartmentInCharge` (`DepartmentInCharge`);

--
-- Indexes for table `servicefeedback`
--
ALTER TABLE `servicefeedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `RequestID` (`RequestID`);

--
-- Indexes for table `servicerequest`
--
ALTER TABLE `servicerequest`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `CitizenID` (`CitizenID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citizen`
--
ALTER TABLE `citizen`
  ADD CONSTRAINT `citizen_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `completedrequest`
--
ALTER TABLE `completedrequest`
  ADD CONSTRAINT `completedrequest_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `servicerequest` (`RequestID`);

--
-- Constraints for table `expat`
--
ALTER TABLE `expat`
  ADD CONSTRAINT `expat_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `governmentofficial`
--
ALTER TABLE `governmentofficial`
  ADD CONSTRAINT `governmentofficial_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `governmentofficial_ibfk_2` FOREIGN KEY (`Supervisor`) REFERENCES `governmentofficial` (`OfficialID`);

--
-- Constraints for table `nid_card`
--
ALTER TABLE `nid_card`
  ADD CONSTRAINT `nid_card_ibfk_1` FOREIGN KEY (`CitizenID`) REFERENCES `citizen` (`CitizenID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `pendingrequest`
--
ALTER TABLE `pendingrequest`
  ADD CONSTRAINT `pendingrequest_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `servicerequest` (`RequestID`),
  ADD CONSTRAINT `pendingrequest_ibfk_2` FOREIGN KEY (`DepartmentInCharge`) REFERENCES `governmentdepartment` (`DepartmentID`);

--
-- Constraints for table `servicefeedback`
--
ALTER TABLE `servicefeedback`
  ADD CONSTRAINT `servicefeedback_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `servicerequest` (`RequestID`);

--
-- Constraints for table `servicerequest`
--
ALTER TABLE `servicerequest`
  ADD CONSTRAINT `servicerequest_ibfk_1` FOREIGN KEY (`CitizenID`) REFERENCES `citizen` (`CitizenID`),
  ADD CONSTRAINT `servicerequest_ibfk_2` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`);
COMMIT;