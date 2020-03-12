-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : jeu. 12 mars 2020 à 08:09
-- Version du serveur :  10.4.12-MariaDB-1:10.4.12+maria~bionic
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `person`
--

-- --------------------------------------------------------

--
-- Structure de la table `boards`
--

CREATE TABLE `boards` (
  `id_board` int(11) NOT NULL,
  `Board_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `boards`
--

INSERT INTO `boards` (`id_board`, `Board_name`, `description`) VALUES
(1, 'Général', 'About all'),
(2, 'Développement', 'all about dévellopement'),
(3, 'Discussions', 'talking about '),
(4, 'smalltalks', 'gosipp sheets');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_comment`, `content`, `date`, `user_id`, `topic_id`) VALUES
(34, '#ooh', '2020-03-11 13:38:24', 2, 11),
(35, '#ooh', '2020-03-11 13:38:24', 2, 11),
(36, '❤️', '2020-03-11 13:39:04', 2, 11),
(37, '❤️', '2020-03-11 13:39:04', 2, 11),
(38, 'oj❤️', '2020-03-11 13:39:20', 2, 11),
(39, 'oj❤️', '2020-03-11 13:39:20', 2, 11),
(42, 'Bonjour', '2020-03-11 14:20:25', 3, 15),
(43, 'Bonjour', '2020-03-11 14:20:25', 3, 15),
(44, 'ojoju', '2020-03-11 14:27:21', 1, 14),
(45, 'ojoju', '2020-03-11 14:27:21', 1, 14),
(46, 'ojoju', '2020-03-11 14:27:41', 1, 14);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `id_topic` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_crea` datetime NOT NULL DEFAULT current_timestamp(),
  `date_up` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id_topic`, `title`, `content`, `date_crea`, `date_up`, `user_id`, `board_id`) VALUES
(11, 'test 1', 'voici le contenu', '2020-03-11 11:32:38', '2020-03-11 11:32:38', 1, 1),
(12, 'how to code finely', 'comment coder bien', '2020-03-11 13:55:52', '2020-03-11 13:55:52', 2, 2),
(13, 'jgfygu', 'fhf jgfjh', '2020-03-11 14:07:01', '2020-03-11 14:07:01', 2, 1),
(14, 'jgfygu', 'fhf jgfjh', '2020-03-11 14:08:58', '2020-03-11 14:08:58', 2, 1),
(15, 'jgfygu', 'fhf jgfjh', '2020-03-11 14:09:25', '2020-03-11 14:09:25', 2, 1),
(16, 'jgfygu', 'fhf jgfjh', '2020-03-11 14:14:14', '2020-03-11 14:14:14', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `pseudo`, `mail`, `password`, `signature`, `avatar`) VALUES
(1, 'Berthold', 'bertholddovi@gmail.com', '14dc2144ebfa4f5aa5d4d747c23be7e97ea20546', 'yes we love too much code', 'bertholddovi@gmail.com'),
(2, 'popo son', 'popo@gmail.com', 'f7c0ab2e8ebfe757385d947ee80b565c32e55364', 'yes we love too much code', 'popo@gmail.com'),
(3, 'Lily', 'lily@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Bonjour je suis nouvelle', 'lily@gmail.com'),
(4, 'berthold', 'koko@gmail.com', 'd1367f319cecc83b7dc758ef01882b72929f3de6', 'yes we love too much code', 'bertholddovi@gmail.com'),
(5, 'berthold', 'koko@gmail.com', 'd1367f319cecc83b7dc758ef01882b72929f3de6', 'yes we love too much code', 'bertholddovi@gmail.com'),
(6, 'berthold', 'koko@gmail.com', 'd1367f319cecc83b7dc758ef01882b72929f3de6', 'yes we love too much code', 'bertholddovi@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id_board`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id_topic`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `board_id` (`board_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boards`
--
ALTER TABLE `boards`
  MODIFY `id_board` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id_topic`);

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id_board`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
