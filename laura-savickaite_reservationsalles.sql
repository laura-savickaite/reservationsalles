-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 15 déc. 2021 à 13:30
-- Version du serveur : 5.5.68-MariaDB
-- Version de PHP : 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laura-savickaite_reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `type_activité` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`, `type_activité`) VALUES
(12, 'cours', 'cours de php', '2021-12-07 15:06:00', '2021-12-07 16:06:00', 1, 'scolaire'),
(13, 'rdv', 'rdv avec mon amie', '2021-12-07 18:32:00', '2021-12-07 19:00:00', 1, 'social'),
(14, 'yoga', 'petit cours yoga', '2021-12-07 16:09:23', '2021-12-07 17:09:23', 6, 'sport'),
(15, 'karaoke', 'session karaoke', '2021-12-08 16:22:31', '2021-12-08 17:22:31', 6, 'loisirs'),
(29, 'piano', 'cours de piano / chopin', '2021-12-09 11:05:50', '2021-12-09 12:05:50', 4, 'loisirs'),
(30, 'anniversaire', 'anniversaire avec les amis', '2021-12-08 12:40:08', '2021-12-08 13:40:08', 3, 'social'),
(31, 'cours', 'petit cours de php', '2021-12-14 10:35:00', '2021-12-14 11:35:00', 3, 'scolaire'),
(36, 'fête', 'fête de départ', '2021-12-17 18:16:00', '2021-12-17 19:16:00', 6, 'festivite'),
(37, 'piano', 'entrainement au piano', '2021-12-15 14:27:00', '2021-12-15 15:27:00', 6, 'loisirs'),
(38, 'yoga', 'yoga en groupe', '2021-12-16 17:31:00', '2021-12-16 18:32:00', 1, 'sport'),
(49, 'meeting', 'rdv avec le groupe design', '2021-12-17 12:06:00', '2021-12-17 13:06:00', 1, 'social');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `imgprofil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `imgprofil`) VALUES
(1, 'darklaura', 'test', '61b9c57a498473.42682192.jpg'),
(3, 'lightlaura', 'test', '61b773c5c0f177.26007998.jpeg'),
(4, 'chaoticlaura', 'laura', ''),
(5, 'neutralaura', 'test', ''),
(6, 'laura', 'laura', '61b8c7f443c598.69764537.jpeg'),
(7, 'lolo', 'lolo', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
