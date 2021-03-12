-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 03:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `name`, `email`) VALUES
(1, 'Test Owner', 'email@gmail.com'),
(30, 'Test Owner', 'new@email.hu'),
(31, 'just another owner', 'another@email.io'),
(32, 'Test Owner', 'test@owner.com'),
(33, 'Test Owner', 'test@test.io'),
(34, 'Test Owner', 'best@owner.com'),
(35, 'one more', 'one@more.in'),
(36, 'Test Owner', 'owner@test.io'),
(37, 'Test Owner', 'james@bohner.io');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Phasellus porttitor molestie erat. Mauris vulputate at arcu at elementum. Etiam faucibus varius porta. Donec in magna in lorem congue varius vel in elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed sit amet diam molestie, elementum mi dapibus, egestas libero. Duis sem lectus, laoreet quis semper nec, mattis eget ex. Integer ac lobortis tortor. Sed at varius ipsum. Cras eget lacus non turpis egestas faucibus. Morbi vel iaculis felis, sed lobortis nunc. Donec placerat magna id quam vestibulum accumsan.'),
(2, 'Pellentesque bibendum vehicula sapien, a molestie velit pharetra nec.', 'Donec eget neque nec eros interdum porta. Quisque quis tempor massa, et pellentesque dolor. Phasellus accumsan velit ut porttitor hendrerit. Donec sodales diam id vehicula aliquam. Praesent ut lorem quis neque aliquet tincidunt et a eros. Pellentesque non vulputate elit. Sed auctor neque id velit porttitor, vitae interdum turpis blandit. Nulla cursus eros accumsan justo aliquet, ut egestas diam mollis. Sed gravida orci nisl, quis tristique dui consectetur eget. Donec at nisl ac libero imperdiet tempor et ac diam. Phasellus vitae nibh sed tortor fringilla placerat id at lacus.'),
(3, 'Vestibulum sapien metus, feugiat non nunc sed, laoreet luctus dolor.', 'Vestibulum nibh urna, rutrum sit amet sem ut, rhoncus tristique lectus. Etiam laoreet efficitur tincidunt. In hac habitasse platea dictumst. Integer fringilla mi quam. Cras enim orci, pharetra eu blandit id, tincidunt at justo. Nunc sed leo a sapien laoreet pretium eleifend eget purus. Sed in sapien quis diam posuere pharetra quis vel sapien. Sed sed aliquet neque, in rhoncus ex. Aliquam posuere euismod magna, ut consequat nulla placerat vitae. Aenean fringilla, tellus sed aliquet molestie, nisi urna aliquet quam, et tincidunt mauris quam vitae ligula. Nullam tristique mattis pretium. Pellentesque vel ultricies elit. Maecenas elementum magna dignissim ex molestie, quis fringilla leo venenatis. Donec ut velit eget ex commodo volutpat vitae non arcu. Aenean finibus ullamcorper justo, nec ullamcorper magna ullamcorper nec.'),
(140, 'i ne accusam pertinacia, luptatum oporteat sea an.', '\r\nQuo et ferri regione alterum, graeci accusamus assueverit mea ad, mentitum insolens et mel. Eros scripta ea quo, tacimates accusata ne duo. Usu at congue lucilius quaerendum, in ferri malorum nostrum vel. Congue reprehendunt sed ne, sed amet intellegam no. Duis minim praesent nam no, lorem iriure qualisque eos an.\r\n'),
(141, 'et mel. Eros scripta ea quo, tacimates accusa', 'Lorem ipsum dolor sit amet, et platonem sententiae interesset quo. Sea ne amet postea appareat, fugit melius cu vim. Sumo omittam an pri, ut eum invidunt dignissim definiebas, stet putant molestiae qui an. Pri ne accusam pertinacia, luptatum oporteat sea an.'),
(142, 'eloquentiam ex. Duo quot tincidunt efficiantur et. Lab', 'ostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of E'),
(143, ' dissentiet. Graece dissentias nec id, eos cu aliquid persequeris.', 'Lorem ipsum dolor sit amet, malorum mediocrem vel ea. Ad vim pertinacia intellegam, ne modus liber offendit vix. Sed ipsum voluptaria definiebas ei. Mel ei perfecto praesent definiebas, id sale cetero reprehendunt mel. Nec sanctus sensibus ne, id eam odio assenti'),
(144, 'er honestatis ullamcorper. An eius imperdiet nec, eum dicit postulant eloquentiam', 'Lorem ipsum dolor sit amet, malorum mediocrem vel ea. Ad vim pertinacia intellegam, ne modus liber offendit vix. Sed ipsum voluptaria definiebas ei. Mel ei perfecto praesent definiebas, id sale cetero reprehendunt mel. Nec sanctus sensibus ne, id eam odio assentior\r\nUsu vide habeo mutat ad, dicit vocent vim'),
(145, ' aliquid persequeris. mo eirmod. Affert partem no eum, vix in viderer hones', 'Usu vide habeo mutat ad, dicit vocent vim ad, eum ne su dissentiet. Graece dissentias nec id, eos cu aliquid persequeris.\r\nmo eirmod. Affert partem no eum, vix in viderer honestatis ullamcorper. An eius imperdiet nec, eum dicit postulant eloquentiam ex. Duo quot tincidunt efficiantur et. Labore blandit detracto te sea, sed congue utroque moderatius i'),
(146, 'aliquid scriptorem cum an. Ne vim sumo facete. Pri at scaevola invenire.', 'Lorem ipsum dolor sit amet, zril saperet consequuntur cu vis, usu no semper evertitur. Te mea ludus nobis mentitum, summo dignissim eu duo. At aliquid sanctus vix, in usu tation doming. Id usu oportere pertinacia vituperata, an mea mollis conceptam, aliquid scriptorem cum an. Ne vim sumo facete. Pri at scaevola invenire.\r\n'),
(147, 'probo dicit no. Pri eirmod verterem gloriatur ea.', 'Lorem ipsum dolor sit amet, zril saperet consequuntur cu vis, usu no semper evertitur. Te mea ludus nobis mentitum, summo dignissim eu duo. At aliquid sanctus vix, in usu tation doming. Id usu oportere pertinacia vituperata, an mea mollis conceptam, aliquid scriptorem cum an. Ne vim sumo facete. Pri at scaevola invenire.\r\n\r\nHas at vide porro alterum, his an modo invenire tractatos. Ei equidem oporteat ius. Pri probo dicit no. Pri eirmod verterem gloriatur ea.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `project_owner_pivot`
--

CREATE TABLE `project_owner_pivot` (
  `project_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_owner_pivot`
--

INSERT INTO `project_owner_pivot` (`project_id`, `owner_id`) VALUES
(2, 1),
(3, 1),
(1, 1),
(140, 30),
(141, 31),
(142, 32),
(143, 33),
(144, 34),
(145, 35),
(146, 36),
(147, 37);

-- --------------------------------------------------------

--
-- Table structure for table `project_status_pivot`
--

CREATE TABLE `project_status_pivot` (
  `project_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_status_pivot`
--

INSERT INTO `project_status_pivot` (`project_id`, `status_id`) VALUES
(1, 1),
(143, 1),
(144, 1),
(2, 2),
(140, 2),
(145, 2),
(146, 2),
(147, 2),
(3, 3),
(141, 3),
(142, 3);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `key` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `key`, `name`) VALUES
(1, 'todo', 'Fejlesztésre vár'),
(2, 'in_progress', 'Folyamatban'),
(3, 'done', 'Kész');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `owner_email_UNIQUE` (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_owner_pivot`
--
ALTER TABLE `project_owner_pivot`
  ADD KEY `fk_project_owner_pivot_projects1_idx` (`project_id`),
  ADD KEY `fk_project_owner_pivot_owners1_idx` (`owner_id`);

--
-- Indexes for table `project_status_pivot`
--
ALTER TABLE `project_status_pivot`
  ADD UNIQUE KEY `project_id_UNIQUE` (`project_id`),
  ADD KEY `fk_project_status_pivot_statuses1_idx` (`status_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_owner_pivot`
--
ALTER TABLE `project_owner_pivot`
  ADD CONSTRAINT `fk_project_owner_pivot_owners1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_project_owner_pivot_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_status_pivot`
--
ALTER TABLE `project_status_pivot`
  ADD CONSTRAINT `fk_project_status_pivot_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_project_status_pivot_statuses1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
