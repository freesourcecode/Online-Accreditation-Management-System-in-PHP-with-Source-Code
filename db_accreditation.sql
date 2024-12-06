-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 07:16 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_accreditation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblarea`
--

CREATE TABLE `tblarea` (
  `AreaID` int(11) NOT NULL,
  `SchoolID` int(11) NOT NULL,
  `AreaNo` varchar(90) NOT NULL,
  `AreaDescription` varchar(90) NOT NULL,
  `DateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblattachmentfile`
--

CREATE TABLE `tblattachmentfile` (
  `FILEID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL,
  `FILE_NAME` varchar(90) NOT NULL,
  `FILE_LOCATION` varchar(255) NOT NULL,
  `USERATTACHMENTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblattachmentfile`
--

INSERT INTO `tblattachmentfile` (`FILEID`, `JOBID`, `FILE_NAME`, `FILE_LOCATION`, `USERATTACHMENTID`) VALUES
(202100004, 6, 'Resume', 'photos/08062021014513Calendar Integration in PHP with Full Source Code.docx', 2021023),
(202100005, 7, 'Resume', 'photos/09062021105108Calendar Integration in PHP with Full Source Code.docx', 2021024);

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumbers`
--

CREATE TABLE `tblautonumbers` (
  `AUTOID` int(11) NOT NULL,
  `AUTOSTART` varchar(30) NOT NULL,
  `AUTOEND` int(11) NOT NULL,
  `AUTOINC` int(11) NOT NULL,
  `AUTOKEY` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblautonumbers`
--

INSERT INTO `tblautonumbers` (`AUTOID`, `AUTOSTART`, `AUTOEND`, `AUTOINC`, `AUTOKEY`) VALUES
(1, '02983', 10, 1, 'userid'),
(2, '000', 80, 1, 'employeeid'),
(3, '0', 25, 1, 'APPLICANT'),
(4, '0000', 6, 1, 'FILEID'),
(5, 'T0', 1, 1, 'TransactionNo');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `COMPANYID` int(11) NOT NULL,
  `COMPANYNAME` varchar(90) NOT NULL,
  `COMPANYADDRESS` text NOT NULL,
  `COMPANYCONTACTNO` text NOT NULL,
  `AccreditorName` varchar(90) NOT NULL,
  `C_Username` varchar(90) NOT NULL,
  `C_Password` varchar(90) NOT NULL,
  `Img1` varchar(500) NOT NULL,
  `COMPANYEMAIL` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `AccreditorName`, `C_Username`, `C_Password`, `Img1`, `COMPANYEMAIL`) VALUES
(1, 'asd', 'asd', '123123', '', 'a', '6dcd4ce23d88e2ee9568ba546c007c63d9131c1b', '', ''),
(2, 'sadasd', 'sadasd', '21312', '', 'ff', 'ed70c57d7564e994e7d5f6fd6967cea8b347efbc', '', ''),
(3, 'sadasd', 'sadasd', '21312', '', 'ff', 'ed70c57d7564e994e7d5f6fd6967cea8b347efbc', '', ''),
(4, 'asd', 'asd', '123123', '', 'sdasd', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '', ''),
(5, 'AACCUP', '4A-B Future Point Plaza 3\r\n111 Panay Avenue, South Triangle\r\nQuezon City', ' (034) 471 2109', '', 'as', 'df211ccdd94a63e0bcb9e6ae427a249484a49d60', 'photos/aacup.png', 'jannopalacios@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblnotification`
--

CREATE TABLE `tblnotification` (
  `NotificationID` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `SendTo` int(11) NOT NULL,
  `NotificationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ForeignID` int(11) NOT NULL,
  `NotificationMessage` text NOT NULL,
  `Category` varchar(90) NOT NULL,
  `AlreadyViewed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnotification`
--

INSERT INTO `tblnotification` (`NotificationID`, `CreatedBy`, `SendTo`, `NotificationDate`, `ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES
(1, 1, 5, '2021-11-23 02:59:18', 1, 'The school Adventist University of the Philippines is Requesting for accreditation.', 'Request Accreditation', 1),
(2, 5, 1, '2021-11-23 03:00:03', 1, 'The agency AACCUP is Requesting the following documents', 'Requesting Documents', 1),
(3, 1, 5, '2021-11-23 03:17:01', 1, 'The school Adventist University of the Philippines sent the following document', 'Upload Document', 1),
(4, 5, 1, '2021-11-23 03:27:15', 1, 'visit', 'Schedule', 1),
(5, 1, 5, '2021-11-24 02:05:54', 2, 'The school Adventist University of the Philippines is Requesting for accreditation.', 'Request Accreditation', 0),
(6, 1, 5, '2021-11-24 02:08:58', 3, 'The school Adventist University of the Philippines is Requesting for accreditation.', 'Request Accreditation', 0),
(7, 1, 5, '2021-11-24 02:09:14', 4, 'The school Adventist University of the Philippines is Requesting for accreditation.', 'Request Accreditation', 0),
(8, 1, 5, '2021-11-24 02:10:22', 5, 'The school Adventist University of the Philippines is Requesting for accreditation.', 'Request Accreditation', 0),
(9, 1, 5, '2021-11-24 02:12:08', 6, 'The school Adventist University of the Philippines is Requesting for accreditation.', 'Request Accreditation', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblrequest`
--

CREATE TABLE `tblrequest` (
  `RequestID` int(11) NOT NULL,
  `SchoolID` int(11) NOT NULL,
  `SchoolName` varchar(90) NOT NULL,
  `AgencyID` int(11) NOT NULL,
  `AgencyName` varchar(90) NOT NULL,
  `RequestNotes` text NOT NULL,
  `RequestStatus` varchar(13) NOT NULL DEFAULT 'Pending',
  `DateRequested` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RequestAccepted` tinyint(1) NOT NULL,
  `ConfirmedDate` datetime NOT NULL,
  `DeclinedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblrequestdocuments`
--

CREATE TABLE `tblrequestdocuments` (
  `DocumentID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `RequestDocuments` varchar(90) NOT NULL,
  `AgencyID` int(11) NOT NULL,
  `AgencyName` varchar(90) NOT NULL,
  `SchoolID` int(11) NOT NULL,
  `SchoolName` varchar(90) NOT NULL,
  `SchoolAttachment` text NOT NULL,
  `CheckDocumnets` tinyint(1) NOT NULL,
  `Status` varchar(90) NOT NULL,
  `AccreditationLevel` varchar(90) NOT NULL,
  `DateApproved` datetime NOT NULL,
  `ReadytoSchedule` tinyint(1) NOT NULL,
  `Scheduled` tinyint(1) NOT NULL,
  `AlreadyEvaluated` tinyint(1) NOT NULL,
  `TransactionNo` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

CREATE TABLE `tblschedule` (
  `ScheduleID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateSchedule` datetime NOT NULL,
  `EndScheduleDate` datetime NOT NULL,
  `Remarks` varchar(90) NOT NULL,
  `AgencyID` int(11) NOT NULL,
  `AgencyName` varchar(90) NOT NULL,
  `SchoolID` int(11) NOT NULL,
  `SchoolName` varchar(90) NOT NULL,
  `Settled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblschoollevel`
--

CREATE TABLE `tblschoollevel` (
  `LevelID` int(11) NOT NULL,
  `SurveyID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `SchoolID` int(11) NOT NULL,
  `SchoolName` varchar(90) NOT NULL,
  `AgencyID` int(11) NOT NULL,
  `AgencyName` varchar(90) NOT NULL,
  `SchoolLevel` varchar(90) NOT NULL,
  `ValidationDateFrom` date NOT NULL,
  `ValidationDateTo` date NOT NULL,
  `ValidityStatus` int(11) NOT NULL,
  `LevelAttained` tinyint(1) NOT NULL,
  `SchoolRemarks` varchar(90) NOT NULL,
  `LNotes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblschools`
--

CREATE TABLE `tblschools` (
  `SCHOOLID` int(11) NOT NULL,
  `SCHOOLNAME` varchar(90) NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `MNAME` varchar(90) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `EMAILADDRESS` varchar(90) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `S_PHOTO` varchar(255) NOT NULL,
  `SchoolStatus` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblschools`
--

INSERT INTO `tblschools` (`SCHOOLID`, `SCHOOLNAME`, `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `USERNAME`, `PASS`, `EMAILADDRESS`, `CONTACTNO`, `S_PHOTO`, `SchoolStatus`) VALUES
(1, 'Adventist University of the Philippines', '', '', '', 'Puting Kahoy, Silang, Cavite, Philippines', 'school1', '3b10e318779364e186c2fe7b7f8e07e40bf9eaf5', 'info@aup.edu.ph', '(049) 541 1211', 'photos/adlogo.png', 'Not Accredited'),
(2, 'Emilio Aguinaldo College â€“ Cavite', '', '', '', 'Congressional East Ave, Burol Main, DasmariÃ±as, Cavite', 'school2', '587db024ee9e68fbeee8c799a2ce0c142ae67597', 'emilioaguinaldo@edu.com', ' (046) 416 4341', 'photos/emblem.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblsurvey`
--

CREATE TABLE `tblsurvey` (
  `SurveyID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  `AgencyName` varchar(90) NOT NULL,
  `SchoolName` varchar(90) NOT NULL,
  `SurveyAverage` double NOT NULL,
  `Remarks` varchar(90) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `LevelAttained` varchar(90) NOT NULL DEFAULT 'N/A',
  `DateEvaluated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateFrom` date NOT NULL,
  `DateTo` date NOT NULL,
  `ValidityStatus` varchar(90) NOT NULL,
  `TransactionNo` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `USERID` varchar(30) NOT NULL,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PICLOCATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `PASS`, `ROLE`, `PICLOCATION`) VALUES
('00018', 'JANO ', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 'photos/077db70b-ab84-46c4-bbaa-a5dd6b7332a4_200x200.png'),
('029838', 'hr', 'hr', '51bd95353aeda6615433bea21896c893ef5e62dc', 'HR', ''),
('029839', 'sadsad', 'asdas', 'd5644e8105ad77c3c3324ba693e83d8fffd54950', 'Office Head', ''),
('12321312', 'JANNO PALACIOS', 'PALACIOS', 'b14dacac748455c059624f2cbf81acca743fa1ee', 'Employee', ''),
('2018001', 'Chambe Narciso', 'Narciso', 'f3593fd40c55c33d1788309d4137e82f5eab0dea', 'Employee', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblarea`
--
ALTER TABLE `tblarea`
  ADD PRIMARY KEY (`AreaID`);

--
-- Indexes for table `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  ADD PRIMARY KEY (`FILEID`);

--
-- Indexes for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  ADD PRIMARY KEY (`AUTOID`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`COMPANYID`);

--
-- Indexes for table `tblnotification`
--
ALTER TABLE `tblnotification`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `tblrequest`
--
ALTER TABLE `tblrequest`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `tblrequestdocuments`
--
ALTER TABLE `tblrequestdocuments`
  ADD PRIMARY KEY (`DocumentID`);

--
-- Indexes for table `tblschedule`
--
ALTER TABLE `tblschedule`
  ADD PRIMARY KEY (`ScheduleID`);

--
-- Indexes for table `tblschoollevel`
--
ALTER TABLE `tblschoollevel`
  ADD PRIMARY KEY (`LevelID`);

--
-- Indexes for table `tblschools`
--
ALTER TABLE `tblschools`
  ADD PRIMARY KEY (`SCHOOLID`);

--
-- Indexes for table `tblsurvey`
--
ALTER TABLE `tblsurvey`
  ADD PRIMARY KEY (`SurveyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblarea`
--
ALTER TABLE `tblarea`
  MODIFY `AreaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  MODIFY `FILEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202100006;

--
-- AUTO_INCREMENT for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  MODIFY `AUTOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `COMPANYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblnotification`
--
ALTER TABLE `tblnotification`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblrequest`
--
ALTER TABLE `tblrequest`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblrequestdocuments`
--
ALTER TABLE `tblrequestdocuments`
  MODIFY `DocumentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblschedule`
--
ALTER TABLE `tblschedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblschoollevel`
--
ALTER TABLE `tblschoollevel`
  MODIFY `LevelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblschools`
--
ALTER TABLE `tblschools`
  MODIFY `SCHOOLID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsurvey`
--
ALTER TABLE `tblsurvey`
  MODIFY `SurveyID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
