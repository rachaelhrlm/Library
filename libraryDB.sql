-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2020 at 09:12 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddBook` (IN `ChosenName` VARCHAR(100), IN `ChosenISBN` BIGINT(15), IN `ChosenCategory` VARCHAR(100), IN `ChosenPublisher` VARCHAR(100), IN `ChosenEdition` INT(100), IN `ChosenAuthor` VARCHAR(100), IN `ChosenStockQuantity` INT)  BEGIN
DECLARE StoredISBN bigint;
DECLARE StoredAuthor int;
DECLARE StoredCategory int;
DECLARE StoredPublisher int;
DECLARE TestAuthor varchar(100);
DECLARE TestCategory varchar(100);
DECLARE TestPublisher varchar(100);
SELECT ISBN
INTO StoredISBN
FROM book
WHERE ISBN = ChosenISBN;
IF StoredISBN = ChosenISBN
THEN SELECT 'Already exists';
ELSE
SELECT Name
INTO TestCategory
FROM category
WHERE Name = ChosenCategory;
IF TestCategory = ChosenCategory
THEN SELECT CategoryID
INTO StoredCategory
FROM category
WHERE Name = ChosenCategory;
ELSE
INSERT INTO category (Name)
VALUES (ChosenCategory);
SELECT CategoryID
INTO StoredCategory
FROM category
WHERE Name = ChosenCategory;
END IF;
SELECT Name
INTO TestPublisher
FROM publisher
WHERE Name = ChosenPublisher;
IF TestPublisher = ChosenPublisher
THEN SELECT PublisherID
INTO StoredPublisher
FROM publisher
WHERE Name = ChosenPublisher;
ELSE
INSERT INTO publisher (Name)
VALUES (ChosenPublisher);
SELECT PublisherID
INTO StoredPublisher
FROM publisher
WHERE Name = ChosenPublisher;
END IF;
SELECT Name
INTO TestAuthor
FROM author
WHERE Name = ChosenAuthor;
IF TestAuthor = ChosenAuthor
THEN SELECT AuthorID
INTO StoredAuthor
FROM author
WHERE Name = ChosenAuthor;
ELSE
INSERT INTO author (Name)
VALUES (ChosenAuthor);
SELECT AuthorID
INTO StoredAuthor
FROM author
WHERE Name = ChosenAuthor;
END IF;
INSERT INTO book (Name, ISBN, Category, Publisher, Edition, Author, StockQuantity)
VALUES (ChosenName, ChosenISBN, StoredCategory, StoredPublisher, ChosenEdition, StoredAuthor, ChosenStockQuantity);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddMember` (IN `ChosenFirstName` VARCHAR(150), IN `ChosenSecondName` VARCHAR(150), IN `ChosenDOB` INT, IN `ChosenPostcode` VARCHAR(150), IN `ChosenEmailAddress` VARCHAR(150))  BEGIN

   DECLARE StoredEmailAddress VARCHAR(200);  
   
   SELECT EmailAddress
   INTO StoredEmailAddress
   FROM member
   WHERE EmailAddress = ChosenEmailAddress;
   
   IF StoredEmailAddress = ChosenEmailAddress
   THEN SELECT 'Already Exist' AS RESULT;
   
   ELSE
   INSERT INTO member (FirstName, SecondName, DOB, Postcode, EmailAddress)
   VALUES (ChosenFirstName, ChosenSecondName, ChosenDOB, ChosenPostcode, ChosenEmailAddress);
   SELECT 'Member added successfully' AS RESULT;
   
   END IF;
   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BorrowBook` (IN `ChosenMemberID` INT, IN `ChosenBookID` INT)  BEGIN

DECLARE lentquantity int DEFAULT 0;
DECLARE totalQuantity int DEFAULT 0;

SELECT COUNT(BookID)
INTO lentquantity
FROM borrow
WHERE BookID = ChosenBookID AND dateReturned is NULL;

SELECT StockQuantity
INTO totalQuantity
FROM book
WHERE BookID = ChosenBookID;

IF (totalQuantity - lentquantity) > 0
THEN
INSERT INTO borrow (MemberID,BookID,DateTakenOut,BookDue)
VALUES (ChosenMemberID, ChosenBookID, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 20 DAY));
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ReturnBook` (IN `ChosenMemberID` INT, IN `ChosenBookID` INT)  BEGIN

UPDATE borrow
SET dateReturned = CURDATE()
WHERE bookid = ChosenBookID AND memberid = ChosenMemberID AND datereturned is null;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SearchBook` (IN `SearchAuthorName` VARCHAR(100), IN `SearchBookName` VARCHAR(100), IN `SearchISBN` BIGINT)  BEGIN
SELECT DISTINCT
book.BookID,
book.Name AS Title,
book.ISBN,
publisher.Name AS Publisher,
author.Name AS Author,
category.Name AS Category
FROM book
INNER JOIN category ON book.Category=category.CategoryID
INNER JOIN publisher ON book.Publisher=publisher.PublisherID
INNER JOIN author ON book.Author=author.AuthorID
WHERE book.ISBN=SearchISBN OR
book.Name=SearchBookName OR
author.Name=SearchAuthorName;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `AuthorID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`AuthorID`, `Name`) VALUES
(1, 'Elena Favilli'),
(2, 'David Walliams'),
(3, 'Mrs Hinch'),
(4, 'Fearne Cotton'),
(5, 'Danielle Steele'),
(6, 'Sally Rooney'),
(7, 'Yuval Noah Harari'),
(8, 'Lorna Scobie'),
(9, 'Jade Summer'),
(10, 'Bessel van der Kolk'),
(11, 'Rutger Bregman'),
(12, 'Delia Owens'),
(13, 'Kirstin Innes'),
(14, 'Clive Cussler'),
(15, 'Jane Austen'),
(16, 'Patrick Drake'),
(17, 'James Clear'),
(18, 'Peter Swanson'),
(19, 'Adam Kay'),
(20, 'Dave Pelzer'),
(21, 'Finn, A. J'),
(22, 'Ben Nevis');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `ISBN` bigint(50) NOT NULL,
  `Category` int(11) NOT NULL,
  `Publisher` int(11) NOT NULL,
  `Edition` int(10) NOT NULL,
  `Author` int(11) NOT NULL,
  `StockQuantity` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `Name`, `ISBN`, `Category`, `Publisher`, `Edition`, `Author`, `StockQuantity`) VALUES
(1, 'Good Night for Rebel Girls', 642688063955, 2, 1, 1, 1, 5),
(2, 'Slime', 9780008342586, 2, 2, 1, 2, 10),
(3, 'Mrs Hinch: The little book of hints', 9780241461877, 3, 3, 1, 3, 2),
(4, 'Calm: Working through life\'s daily stresses to find a peaceful centre', 9789123951055, 4, 4, 1, 4, 4),
(5, 'Turning Point', 9780801039966, 5, 5, 2, 5, 3),
(6, 'Normal People', 9781984822185, 5, 6, 1, 6, 1),
(7, 'Sapiens: A Brief History of Humankind', 9780062316110, 7, 7, 1, 7, 7),
(8, '365 Days of Art: A Creative Exercise for Every Day of the Year', 9781784881115, 8, 8, 1, 8, 6),
(9, '100 Animals: An Adult Coloring Book with Lions, Elephants, Owls, Horses, Dogs, Cats, and Many More!', 9781098578800, 8, 9, 1, 9, 4),
(10, 'The Body Keeps the Score: Mind, Brain and Body in the Transformation of Trauma', 9780143127741, 4, 10, 1, 10, 12),
(11, 'Humankind: A Hopeful History', 9780316418539, 1, 11, 1, 11, 3),
(12, 'Where the Crawdads Sing', 9780735219090, 5, 12, 1, 12, 5),
(13, 'Scabby Queen', 9780008342296, 5, 13, 1, 13, 10),
(14, 'Spartan Gold', 9780141042916, 9, 10, 2, 14, 2),
(15, 'Sense and Sensibility', 9780143106524, 5, 14, 5, 15, 13),
(16, 'HelloFresh Recipes that Work', 9781784724658, 6, 15, 1, 16, 25),
(17, 'Atomic Habits', 9780735211292, 10, 10, 1, 17, 6),
(18, 'The Kind Worth Killing', 9781510026957, 11, 6, 1, 18, 21),
(19, 'This is Going to Hurt', 9781509858637, 12, 16, 1, 19, 12),
(20, 'A Child Called \"It\"', 9781558743663, 12, 4, 11, 20, 5),
(21, 'Her Every Fear: A Novel', 9780062427038, 11, 17, 1, 18, 10),
(22, 'The Woman in the Window: A Novel', 9780062678423, 11, 17, 1, 21, 5),
(23, 'This is bonkers', 1000567831456, 13, 18, 2, 22, 6);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `BorrowID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `DateTakenOut` date NOT NULL,
  `BookDue` date NOT NULL,
  `dateReturned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`BorrowID`, `MemberID`, `BookID`, `DateTakenOut`, `BookDue`, `dateReturned`) VALUES
(1, 20, 5, '2020-04-04', '2020-04-24', NULL),
(2, 19, 3, '2020-04-05', '2020-04-25', NULL),
(3, 18, 2, '2020-04-06', '2020-04-26', NULL),
(4, 17, 4, '2020-04-07', '2020-04-27', NULL),
(5, 16, 1, '2020-04-08', '2020-04-28', NULL),
(6, 15, 6, '2020-04-09', '2020-04-09', NULL),
(7, 14, 8, '2020-04-10', '2020-04-30', NULL),
(8, 13, 10, '2020-04-11', '2020-05-01', NULL),
(9, 12, 7, '2020-04-12', '2020-05-02', NULL),
(10, 11, 9, '2020-04-13', '2020-05-03', NULL),
(11, 10, 20, '2020-04-14', '2020-05-04', NULL),
(12, 9, 18, '2020-04-15', '2020-05-05', NULL),
(13, 8, 17, '2020-04-16', '2020-05-06', NULL),
(14, 7, 15, '2020-04-17', '2020-05-07', NULL),
(15, 6, 16, '2020-04-18', '2020-05-08', NULL),
(16, 5, 13, '2020-04-19', '2020-05-09', NULL),
(17, 4, 11, '2020-04-20', '2020-05-10', NULL),
(18, 3, 12, '2020-04-21', '2020-05-11', NULL),
(19, 2, 15, '2020-04-22', '2020-05-12', NULL),
(20, 1, 14, '2020-04-23', '2020-05-13', NULL),
(21, 2, 2, '2020-04-11', '2020-05-01', '2020-04-12'),
(22, 3, 3, '2020-04-13', '2020-05-03', '2020-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `Name`) VALUES
(1, 'History'),
(2, 'Children\'s'),
(3, 'Lifestyle'),
(4, 'Medicine'),
(5, 'Fiction'),
(6, 'Cooking'),
(7, 'Sociology'),
(8, 'Art'),
(9, 'Science Fiction'),
(10, 'Self-Help'),
(11, 'Thriller'),
(12, 'Memoir'),
(13, 'Crime');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT 'test@email.com',
  `FirstName` varchar(30) NOT NULL,
  `SecondName` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Postcode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `email`, `FirstName`, `SecondName`, `DOB`, `Postcode`) VALUES
(1, 'test1@email.com', 'Jenny', 'Smith', '1993-02-01', 'HP22 4LX'),
(2, 'test2@email.com', 'Rachel', 'Trello', '1979-09-06', 'HU9 3NB'),
(3, 'test3@email.com', 'Laura', 'Abraham', '1939-08-03', 'LE65 1BE'),
(4, 'test4@email.com', 'Flo', 'Mulcahy', '1939-09-04', 'IV55 8WQ'),
(5, 'test5@email.com', 'Jo', 'Lovett', '1952-08-31', 'RM7 1PA'),
(6, 'test6@email.com', 'Dalia', 'Rice', '1954-03-13', 'TA16 5RD'),
(7, 'test7@email.com', 'Pawel', 'Gaines', '1959-05-06', 'ZE3 9JW'),
(8, 'test8@email.com', 'Ralphie', 'Brownie', '1970-11-07', 'IP15 5DY'),
(9, 'test9@email.com', 'Arian', 'Huynh', '1972-03-26', 'M30 0QT'),
(10, 'test10@email.com', 'Archibald', 'Dale', '1974-11-03', 'IV15 9HA'),
(11, 'test11@email.com', 'Miriam', 'Wilkinson', '1975-06-07', 'GU7 8HJ'),
(12, 'test12@email.com', 'Tana', 'Holmes', '1977-07-08', 'BA8 2EL'),
(13, 'test13@email.com', 'Amy', 'Key', '1977-11-22', 'EX14 1RG'),
(14, 'test14@email.com', 'Aradhana', 'Butcher', '1978-07-11', 'PR61HL'),
(15, 'test15@email.com', 'Sue', 'Tate', '1983-08-30', 'TD9 7ER'),
(16, 'test16@email.com', 'Artur', 'Novak', '1986-10-26', 'CF62 3DW'),
(17, 'test17@email.com', 'Lyla', 'Espiritu', '1999-07-12', 'CF47 9BG'),
(18, 'test18@email.com', 'Rosemarie', 'Santos', '1966-05-22', 'NE65 7SX'),
(19, 'test19@email.com', 'Isabella', 'Mendoza', '1989-09-29', 'PA2 0PF'),
(20, 'test20@email.com', 'Christian', 'Crisologo', '1947-12-25', 'LL49 9HF');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `PublisherID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`PublisherID`, `Name`) VALUES
(1, 'Particular Books'),
(2, 'Harper Collins'),
(3, 'Michael Joseph'),
(4, 'Orion'),
(5, 'Pan'),
(6, 'Faber & Faber'),
(7, 'Vintage'),
(8, 'Hardie Grant Books'),
(9, 'Independently Publisher'),
(10, 'Penguin'),
(11, 'Bloomsbury Publishing'),
(12, 'Corsair'),
(13, 'Fourth Estate'),
(14, 'Heritage Press'),
(15, 'Mitchell Beazley'),
(16, 'Picador'),
(17, 'William Morrow Paperbacks'),
(18, 'Rachel Book');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`AuthorID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `Category` (`Category`),
  ADD KEY `Publisher` (`Publisher`),
  ADD KEY `Author` (`Author`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`BorrowID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `BookID` (`BookID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`PublisherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `AuthorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `BorrowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `PublisherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`Publisher`) REFERENCES `publisher` (`PublisherID`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`Author`) REFERENCES `author` (`AuthorID`);

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
