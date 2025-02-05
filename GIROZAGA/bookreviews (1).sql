-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 01:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookreviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `booksinfo`
--

CREATE TABLE `booksinfo` (
  `book_ID` int(11) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `date_released` date NOT NULL,
  `synopsis` text DEFAULT NULL,
  `reviews` text DEFAULT NULL,
  `cover_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booksinfo`
--

INSERT INTO `booksinfo` (`book_ID`, `book_name`, `genre`, `date_released`, `synopsis`, `reviews`, `cover_image`) VALUES
(4, 'Ruination by Anthony Reynolds', 'Fantasy Fiction', '2022-10-06', 'Camavor is a brutal land with a bloody legacy. Where the empire\'s knights go, slaughter follows. Kalista seeks to change that. When her young and narcissistic uncle, Viego, becomes king, she vows to temper his destructive instincts, as his loyal confidant, advisor, and military general.', 'Amazing read. Very captivating story and very detailed. After keeping up with these characters over the years of playing League, this book really did them justice in a beautiful way. Highly recommend.', 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1647894225l/60382749.jpg'),
(6, 'Garen: First Shield by Anthony Reynolds', 'Fantasy Fiction', '2020-12-08', 'The King is dead. Demacia is mourning. And in the eyes of Garen Crownguard, it’s his fault.\r\n\r\nBut can he rise to the challenge when Demacia needs him again?\r\n\r\nWhile on a peacetime expedition beyond the borders of Demacia, Garen, Quinn, and the Dauntless Vanguard uncover a plot that threatens to destroy long-standing alliances. As the knight-ranger Quinn tries to get word back to Demacia, Garen and his comrades make a desperate last stand. How long can they last, and at what cost?', 'Even if it was short, it was enjoyable.\r\nI never read much into Demacia’s lore (sorry not sorry, ain’t my fav faction of Runeterra), so it definitely gave me an interesting and powerful aura to connect to Garen and Quinn (she was pretty badass ngl, you go bird lady).\r\nFuck them Noxians (not you Samira, I love you)', 'https://universe.leagueoflegends.com/esimages/garen_first_shield_cover_en_us__29uZt.jpg'),
(7, 'Realms of Runeterra by Riot Games', 'Fantasy Fiction', '2019-11-05', 'Unlock the mysteries and magic within League of Legends, one of the world\'s most popular video games, in this encyclopedic and collectible companion book that explores the game\'s epic lore.', 'An absolute must-have for any player of the game or fan of the universe. Art and stories included are impeccable, though some regions get left on the wayside in favour of others', 'https://static.wixstatic.com/media/84088f_bb0f9d0224394c4baf004b4d965ed4f4~mv2.png/v1/fill/w_647,h_1000,al_c,q_90,usm_0.66_1.00_0.01/84088f_bb0f9d0224394c4baf004b4d965ed4f4~mv2.png'),
(16, 'Haunting Adeline by H.D Carlton', 'Romance, Thriller, Suspence', '2021-07-12', 'In \"Haunting Adeline,\" the story revolves around Adeline Reilly, a young writer who relocates to her family\'s house in Washington state following her grandmother\'s passing. She becomes the target of Zade Meadows, the leader of an underground organization dedicated to combating human trafficking.', '\"Haunting Adeline\" by H.D. Carlton is a masterful blend of dark romance and psychological suspense that grips you from the first page and doesn\'t let go until long after you\'ve finished. Carlton\'s storytelling prowess is evident as she crafts a chilling yet enthralling narrative that delves into the deepest corners of obsession, fear, and forbidden desire.', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1628900532i/58763686.jpg'),
(17, 'All I Need by E. Salvador', 'Fiction', '2024-03-26', 'Meeting during senior week on the day of their birthdays was pure coincidence.\r\n\r\nIt was supposed to be nothing more for Lola Larson and TJ Kingston than three days of fake dating before going back to their everyday lives. Not thinking they will see each other again, they part ways without getting each other’s last names or phone numbers.\r\n\r\nTwo years later, they’re in college, where they meet again. However, their priorities are different from the last time they saw each other.\r\n\r\nTJ wants nothing more than to enter the draft and play for the NBA. It’s all he’s worked hard for, and has made sure that nothing and no one hinders him from achieving his dream. That is until he sees Lola again, and realizes that basketball is no longer his sole priority when he finds out he has a kid.', 'i am severely disappointed. i felt so disconnected characters. there was a lot of telling and not showing.\r\nphoenix felt like a side character. heck even Saint was more of a MC than him and that’s not ok….\r\ntheir story had so much potential but i just don’t think it was delivered well.\r\nwould love to read Daisy’s and Saints book tho.', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1704900016i/200320170.jpg'),
(18, 'The Ritual by Shantel Tessier', 'Romance', '2021-11-19', 'Barrington University is home of the Lords, a secret society that requires their blood in payment. They are above all—the most powerful men in the world. They devote their lives to violence in exchange for power. And during their senior year, they are offered a chosen one.', 'as a kid, i remember accidentally spraying perfume in my eyes. it was really painful. today, i experienced the same while reading this book.', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1636922541i/58941251.jpg'),
(19, 'To Kill a Mockingbird by Harper Lee', 'Domestic Fiction, Thriller', '1960-07-11', 'To Kill a Mockingbird is a 1961 novel by Harper Lee. Set in small-town Alabama, the novel is a bildungsroman, or coming-of-age story, and chronicles the childhood of Scout and Jem Finch as their father Atticus defends a Black man falsely accused of rape. Scout and Jem are mocked by classmates for this.', 'It is one of the best books that I read. Initially, when I was reading this novel, I did not like this novel.  But as soon as I read it, I started getting interested in this novel. if you understand its symbolic meaning and the depth of its themes. You have to look deep to realize that every letter in this book is placed with a purpose and cherish its developed characters.It\'s a story that revolves around a sibling which are Scout and Jem and their lives.', 'https://upload.wikimedia.org/wikipedia/commons/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg'),
(23, 'We Should all be Feminists by Chimamanda Ngozi Adi', 'Essay, Biography', '2014-07-19', 'We Should All Be Feminists is a book-length essay by the Nigerian author Chimamanda Ngozi Adichie. First published in 2014 by Fourth Estate, it talks about the definition of feminism for the 21st century.', 'I support Feminism, I think we should all be feminist, 6\'5 btw aha', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1430821222i/22738563.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booksinfo`
--
ALTER TABLE `booksinfo`
  ADD PRIMARY KEY (`book_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booksinfo`
--
ALTER TABLE `booksinfo`
  MODIFY `book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
