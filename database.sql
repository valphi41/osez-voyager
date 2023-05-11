-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure de la table `Amérique`
--
CREATE TABLE `amerique` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `country` varchar(55) NOT NULL,
  `content` TEXT NOT NULL,
  `danger` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure de la table `Asie`
--
CREATE TABLE `asie` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `country` varchar(55) NOT NULL,
  `content` TEXT NOT NULL,
  `danger` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure de la table `Europe`
--
CREATE TABLE `europe` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `country` varchar(55) NOT NULL,
  `content` TEXT NOT NULL,
  `danger` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', '$2y$10$aHYhtkBtopx0zPoFD8zu2.pw1nZE9tjV6InEJoM.NsKt4GgiIwWCK');
--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `title`) VALUES
(1, 'Stuff'),
(2, 'Doodads');

--
-- Contenu de la table `amérique`
--
INSERT INTO `amerique` (`title`,`country`, `content`, `danger`) VALUES
('La vallée de la mort','Etats-Unis','Elle a été appelée Death Valley par des prospecteurs et d’autres qui cherchaient à traverser la vallée,
 sur leur chemin vers les champs aurifères. Piégés pendant plusieurs mois dans une vallée sèche et presque dépourvue de toute vie animale ou végétale,
  ils lui donnèrent le nom de Death Valley : La vallée de la Mort.', 9 ),
  ('Ile de Queimada Grande', 'Brésil', 'L’Île de Queimada Grande, au large des côtes brésiliennes, est l’un des endroits les plus dangereux au monde,
   infestée de Jararaca-ilhoa, la vipère la plus venimeuse. Le venin de ces serpents dissout la chair humaine. Avec une densité d’un serpent par mètre carré,
   il est impossible d’éviter un face-à-face avec ces serpents mortels.
   À moins d’être un biologiste renommé, fouler cette île est strictement interdit.', 8);
--
-- Contenu de la table `asie`
--
INSERT INTO `asie` (`title`,`country`, `content`, `danger`) VALUES
('Forêt Aokigahara','Japon','
La forêt d’Aokigahara, située au pied du Mont Fuji au Japon, est connue pour être l’un des endroits les plus effrayants au monde.
 Aussi appelée la "Forêt des Suicides", elle est tristement célèbre pour être le lieu de nombreux suicides chaque année.
  Les arbres denses et les formations rocheuses cachent des corps en décomposition et des ossements blanchis,
   créant une atmosphère macabre et sinistre. Les visiteurs qui se sont aventurés dans cette forêt ont signalé des sensations étranges,
    des voix et des apparitions de fantômes, ce qui a renforcé sa réputation de lieu hanté.', 5 ),
('North Sentinel Island', 'Inde', 'North Sentinel Island est une petite île située dans l’océan Indien. Les habitants de l’île sont connus pour être l’un des peuples les plus isolés du monde.
En raison de leur isolement, peu de choses sont connues sur leur mode de vie et leurs croyances, mais il est dit qu’ils pratiquent une forme de cannibalisme
 et qu’ils ne sont pas immunisés contre les maladies courantes, ce qui signifie que toute interaction avec eux pourrait être mortelle pour eux.
North Sentinel Island est considérée comme l’un des endroits les plus effrayants et dangereux de la planète, et de nombreuses personnes considèrent
 qu’il est préférable de la laisser tranquille, afin de ne pas déclencher de nouvelles violences.', 10);

--
-- Contenu de la table `europe`
--
INSERT INTO `europe` (`title`,`country`, `content`, `danger`) VALUES
('Pripyat','Ukraine','Prypiat est une ville fantôme située en Ukraine, à quelques kilomètres de la centrale nucléaire de Tchernobyl.
 La ville était autrefois le foyer de milliers de personnes, mais a été évacuée en 1986 après l\'explosion de la centrale nucléaire.
  Aujourd\'hui, la ville est laissée à l\'abandon et est devenue un lieu de pèlerinage pour les amateurs d\'urbex et les touristes intrépides.
  En se promenant dans les rues silencieuses de Prypiat, on peut sentir une présence oppressante et étouffante. La ville est devenue un véritable labyrinthe,
   avec des bâtiments abandonnés et des routes en ruine. Les nombreux signes de danger radioactif rappellent que la ville est un endroit extrêmement dangereux pour la vie humaine.', 10 ),
   ('Iakoustk', 'Russie', 'Voici maintenant la ville la plus froide du monde. Autant vous dire qu’on ne va pas là-bas pour un voyage de noces ou des vacances reposantes.
    Dès que vous mettez un pied en dehors de l’avion, vous êtes accueillis par un thermomètre à -50 degrés !
    En fait, il suffit d’imaginer tout un monde construit dans votre congélateur. Même pire ! L’air brûle, le froid entaille,
     les mâchoires s’immobilisent, le paysage entier est figé dans la glace, rien n’est enterré à cause d’un sol gelé jusqu’à deux cent-cinquante mètre de profondeur.
      Néanmoins, si vous êtes un tantinet agoraphobe, en préparation pour l’Everest ou passionné·e de paysages vierges, nul doute que vous adorerez ce dernier des lieux dangereux.', 5);


--
-- Index pour les tables exportées
--

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
