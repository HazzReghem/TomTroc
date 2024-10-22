-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 22, 2024 at 08:26 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tom_troc`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `availability_status` enum('Disponible','Pas disponible') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Disponible',
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `image`, `description`, `availability_status`, `date_creation`, `user_id`) VALUES
(1, 'lait et miel', 'Rupi Kaur', 'laitmiel.webp', 'Le premier livre de Rupi Kaur, Lait et miel, est un recueil poétique que toutes les femmes devraient avoir sur leur table de nuit ou la table basse de leur salon. Accompagnés de ses propres dessins, ses poèmes, d\'une honnêteté et d\'une authenticité rares, se lisent comme les expériences collectives et quotidiennes d\'une femme du XXIe siècle.', 'Disponible', '2024-08-13 10:18:15', 1),
(2, 'Wabi-Sabi: Le bonheur est dans l\'imperfection', 'Beth Kempton', 'wabi.webp', 'Dans un monde gouverné par la quête perpétuelle de la perfection, l\'accélération du temps et la performance en tout, le wabi sabi se présente comme une faille salvatrice. Ce fascinant concept japonais, intraduisible dans notre culture occidentale, est une invitation à nous accepter tels que nous sommes. Il nous donne les outils nécessaires pour échapper aux pressions de la vie moderne en nous aidant à nous contenter de moins. Grâce à des applications concrètes des principes du wabi sabi (honorer les rythmes de la nature, aménager son intérieur, s\'intéresser aux détails du quotidien...), ce livre révèle comment cultiver le plaisir et multiplier les moments parfaits dans un monde imparfait', 'Pas disponible', '2024-08-13 10:20:25', 2),
(3, 'The Kinfolk table', 'Nathan Williams', 'kinfold.webp', 'Kinfolk Table est un troisième livre de cuisine, un troisième récit et un troisième événement international. Plusieurs des chefs les plus créatifs du monde partagent leurs histoires culinaires. La première section est un livre de cuisine rempli de recettes de plats classiques et créatifs, ce qui en fait un plaisir de réunir amis et famille autour de la table du dîner.', 'Disponible', '2024-08-13 10:25:27', 3),
(4, 'Le livre d\'Esther', 'Alabaster', 'esther.jpg', 'Le livre d\'Esther : un livre curieux et passionnant sur l\'expérience de Dieu à l\'œuvre au milieu des rencontres fortuites, du destin et de la providence divine', 'Disponible', '2024-08-13 10:25:27', 4),
(5, 'Gargantua', 'François Rabelais', 'gargantua.jpg', 'Le troisième jour de février ? Gargantua naît de l’oreille de sa mère. Immédiatement, le nouveau-né assoiffé réclame à boire. Fils de Grandgousier et père de Pantagruel, le géant Gargantua est élevé librement. Il développe sa connaissance des textes anciens et de la nature. Puis vient la guerre avec Picrochole, Gargantua doit à tout prix protéger le royaume…', 'Pas disponible', '2024-08-14 09:36:49', 1),
(6, 'Le Seigneur des anneaux : La communauté de l\'anneau', 'J.R.R Tolkien', 'lotr.webp', 'Dans les vertes prairies de la Comté, les Hobbits, ou Semi-hommes, vivaient en paix¿ Jusqu\'au jour fatal où l\'un d\'entre eux, au cours de ses voyages, entra en possession de l\'Anneau Unique aux immenses pouvoirs. Pour le reconquérir, Sauron, le seigneur ténébreux, va déchaîner toutes les forces du Mal. Frodon, le Porteur de l\'Anneau, Gandalf, le magicien, et leurs intrépides compagnons réussiront-ils à écarter la menace qui pèse sur la Terre du Milieu ?', 'Pas disponible', '2024-08-14 09:36:49', 4),
(7, 'Mémoire d\'une geisha', 'Inoue Yuki', '66ea9ba2f07fa_geishacover.jpg', 'Née en 1892, vendue à l\'âge de huit ans, Kinu Yamaguchi fera l\'apprentissage du dur métier de geisha. C\'est l\'envers du décor qu\'elle raconte: avant de porter le kimono de soie, il lui faudra étudier tous les arts de divertissement et endurer pour cela privations et exercices physiques traumatisants.', 'Disponible', '2024-08-14 09:41:53', 2),
(8, 'Vinci et l\'ange brisé', 'Didier Convard', 'vinci.jpg', 'En 1519, François Ier confie aux moines de l\'abbaye de Vauluisant un mystérieux tableau peint par Léonard de Vinci, dérangeant à un point tel que plus personne ne devra le regarder. Cette œuvre semble liée à une série de meurtres ayant eu lieu en 1494 à Milan et commis par un tueur surnommé le Voleur de visages. Thriller adapté de la bande dessinée«Vinci», dont le premier volume parut en 2008. ', 'Disponible', '2024-08-14 09:41:53', 5),
(9, 'Le chevalier au bouclier vert', 'Odile Weulersse', 'greenknight.jpg', 'Pour avoir sauvé des brigands la fille du comte de Blois, l\'écuyer Thibaut de Sauvigny est adoubé chevalier. Amoureux de la belle, sa pauvreté ne lui permet pas de l\'épouser. Mais une nouvelle menace guette : Eléonore comprend que sa propre soeur veut sa mort ! cette fois, la seule alliée des jeunes gens sera la fée Hadelize. S\'ils la trouvent à temps...', 'Disponible', '2024-08-14 09:47:24', 5),
(10, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'petitprince.png', '\"Le premier soir, je me suis donc endormi sur le sable à mille milles de toute terre habitée. J\'étais bien plus isolé qu\'un naufragé sur un radeau au milieu de l\'océan. Alors, vous imaginez ma surprise, au lever du jour, quand une drôle de petite voix m\'a réveillé. Elle disait : “S\'il vous plaît... dessine-moi un mouton !” J\'ai bien regardé. Et j\'ai vu ce petit bonhomme tout à fait extraordinaire qui me considérait gravement...\"', 'Disponible', '2024-08-14 09:47:24', 6),
(11, 'Les Misérables', 'Victor Hugo', 'misérables.jpg', 'Les Misérables décrit la vie de pauvres gens dans Paris et la France provinciale du premier tiers du XIXe siècle, l’auteur s\'attachant plus particulièrement au destin du bagnard Jean Valjean ; il a donné lieu à de nombreuses adaptations, au cinéma et sur d’autres supports.\r\n\r\nC\'est un roman historique, social et philosophique dans lequel on retrouve les idéaux du romantisme et ceux de Victor Hugo concernant la nature humaine. La préface résume clairement les intentions de l\'auteur : « Tant que les trois problèmes du siècle, la dégradation de l’homme par le prolétariat, la déchéance de la femme par la faim, l’atrophie de l\'enfant par la nuit, ne seront pas résolus ; en d’autres termes, et à un point de vue plus étendu encore, tant qu’il y aura sur la terre ignorance et misère, des livres de la nature de celui-ci pourront ne pas être inutiles ». ', 'Pas disponible', '2024-08-23 10:04:09', 2),
(12, 'Les Yeux de Mona', 'Thomas Schlesser', 'yeuxmona.webp', 'Cinquante-deux semaines : c\'est le temps qu\'il reste à Mona pour découvrir toute la beauté du monde.C\'est le temps que s\'est donné son grand-père, un homme érudit et fantasque, pour l\'initier, chaque mercredi après l\'école, à une oeuvre d\'art, avant qu\'elle ne perde, peut-être pour toujours, l\'usage de ses yeux. Ensemble, ils vont sillonner le Louvre, Orsay et Beaubourg. Ensemble, ils vont s\'émerveiller, s\'émouvoir, s\'interroger, happés par le spectacle d\'un tableau ou d\'une sculpture. ', 'Disponible', '2024-08-23 10:13:10', 2),
(19, 'Les Yeux de Mona', 'Thomas Schlesser', 'yeuxmona.webp', 'Cinquante-deux semaines : c\'est le temps qu\'il reste à Mona pour découvrir toute la beauté du monde.C\'est le temps que s\'est donné son grand-père, un homme érudit et fantasque, pour l\'initier, chaque mercredi après l\'école, à une oeuvre d\'art, avant qu\'elle ne perde, peut-être pour toujours, l\'usage de ses yeux. Ensemble, ils vont sillonner le Louvre, Orsay et Beaubourg. Ensemble, ils vont s\'émerveiller, s\'émouvoir, s\'interroger, happés par le spectacle d\'un tableau ou d\'une sculpture. ', 'Disponible', '2024-08-23 10:13:10', 13);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user1` (`user1_id`),
  KEY `fk_user2` (`user2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user1_id`, `user2_id`, `created_at`) VALUES
(1, 2, 1, '2024-09-25 08:12:06'),
(3, 2, 6, '2024-10-02 07:55:02'),
(5, 2, 4, '2024-10-11 08:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `conversation_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_conversation` (`conversation_id`),
  KEY `fk_sender` (`sender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `message`, `sent_at`) VALUES
(1, 1, 2, 'Salut !', '2024-09-25 08:14:39'),
(5, 1, 1, 'Bonjour, es-tu intéressé par un de mes livres ? ', '2024-09-27 10:02:10'),
(7, 3, 2, 'Hey !', '2024-10-02 08:15:00'),
(8, 3, 2, 'Yosh', '2024-10-02 08:26:30'),
(9, 1, 2, 'Oui ! J\'aimerais savoir si \"lait et miel\" est dispo ', '2024-10-02 09:28:16'),
(10, 1, 2, 'aizdjiauzdazd', '2024-10-04 07:55:23'),
(11, 1, 2, 'Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor ', '2024-10-04 10:00:36'),
(12, 1, 2, 'azaze', '2024-10-08 07:28:35'),
(13, 1, 2, 'aaaaaaaaaa', '2024-10-11 07:57:22'),
(14, 1, 2, 'aeeeeeeeeeee', '2024-10-11 07:57:25'),
(15, 1, 2, 'azdeaze', '2024-10-11 08:14:20'),
(16, 5, 2, 'Bonjour\r\n', '2024-10-11 08:41:04'),
(17, 1, 2, 'zz', '2024-10-22 08:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE,
  KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `profile_picture`, `password`, `created_at`) VALUES
(1, 'Hazz', 'hazz@mail.com', '66deb6fcb6794_Offrir-livre-homme-1140x641.jpg', '$2y$10$W7hxnRp4eqI8RT6UvXYFbOfFp9hlIJO5VTL8QiODYLVR75aWu8Uty', '2024-08-23 08:58:44'),
(2, 'Althea', 'althea@mail.com', '66e160c835bbe_femme-livre.jpg', '$2y$10$o9nIsRMQ0JhiABPsEvRdv.WgnXd8qZUQ.2YD58o0WSpMT.xWn4LD6', '2024-08-23 09:57:19'),
(3, 'Filia', 'minfilia@mail.com', NULL, '$2y$10$lB55EzUVZ1CfR19YDpdOJuVKy8WBV/UY1QxdGEBPmKw13YICnBDsO', '2024-08-26 08:32:37'),
(4, 'Luna', 'luna@mail.com', NULL, '$2y$10$z6JxoMQCkHcveBxPT1l6TOfD8hPavPahSFlD3Sf9eRpGBWXmICp2a', '2024-09-02 07:41:37'),
(5, 'Zelda', 'zelda@mail.com', NULL, '$2y$10$rnG9mHuRI7h7QIL7Dm8PTOlEZs5ASUNsHb7.3EakM6YuShgafLc2.', '2024-09-02 07:46:39'),
(6, 'nathalivre', 'nathalire@mail.com', '66d57ad54fa66_nathalire.jpg', '$2y$10$x4I/u715c/vhFZh7dQJHo.g2hfJo29kUzMuSQ.lryBiUWzKTqMJc2', '2024-09-02 08:10:24'),
(13, 'malenia', 'malenia@mail.com', NULL, '$2y$10$q8uX2072klApy39zRMF74.ubYQIjP1gmHkVI3bbx/SOv5dcux7EBS', '2024-10-11 09:03:57');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `fk_user1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sender` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
