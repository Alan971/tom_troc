-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mar. 23 juil. 2024 à 08:17
-- Version du serveur : 10.3.39-MariaDB-1:10.3.39+maria~ubu2004
-- Version de PHP : 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tom_troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `author` varchar(128) NOT NULL,
  `image` text NOT NULL,
  `comment` text NOT NULL,
  `exchange` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `id_user`, `title`, `author`, `image`, `comment`, `exchange`) VALUES
(2, 1, 'Esther', 'Alabaster', 'Esther.png', 'magnifique texte qui plonge dans les entrailles du lecteur comme un devin dans celle d\'un poulet', 1),
(3, 2, 'The Kinfolk Table', 'Nathan Williams', 'thekinfolktable.png', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 1),
(4, 3, 'Wabi Sabi', 'Beth Kempton', '15e08b27298fcd4023f5a784c912b71b.png', 'A lire avec un café à la main un dimanche pluvieux...', 1),
(5, 4, 'Milk & Honey', 'Rupi Kaur', 'milkhoney.png', 'vraimen j\'ai détesté. si quelqu\'un peut m\'expliquer comment on peut écrire un torchon pareil !?', 1),
(6, 4, 'Hygge', 'Meik Wiking', 'Hygge.png', 'eclectique et ectoplasme', 1),
(7, 5, 'Genèse', 'Dieu', 'genese.jpg', 'fabuleuse légende qui nous emmène au tout début de l\'écriture dans les coins reculé de l\'imaginaire humain. incroyablement scénarisé pour une époque si reculée le texte nous renvoie à l\'origine des temps dans un environnement que l\'on dirait écrit par nos contemporains pour notre génération.', 1),
(10, 5, 'PHP', 'pierre giraud', 'php-mysql-livre.png', 'tu vas enfin y comprendre quelque chose', 1),
(12, 5, 'le gros doudou', 'quipu', '9adc9320100ea1c7a563d50ff34f3d11.png', 'ne sent pas très bon', 1),
(13, 3, 'L\'histoire de magic sytem', 'Bio Graff', '3d9c6b3a74c38cb8eb11f65c2bd56a11.png', 'Encore de belle découverte sur les pratiques musicales post-baroqes que nomme chez les groupies de Jean-Sebastien Bach du bruit', 1),
(27, 5, 'Le dragon', 'toto', 'af5a95c5334f3e5e46fc853b10ec99ab.jpg', 'commentaire', 1),
(28, 12, 'blibli', 'blobl', '', 'comments ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `open_message` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_from`, `id_to`, `open_message`, `content`, `date`) VALUES
(1, 1, 5, 0, 'Bonjour toi comment ça va ?', '2024-07-01 00:00:00'),
(2, 2, 5, 0, 'salut beau gosse', '2024-07-03 00:00:00'),
(3, 5, 1, 0, 'bien,  bien ! on est au top bien que lire un livre prend du temps et que les enfants s\'en plaignent.', '2024-07-07 00:00:00'),
(4, 5, 2, 1, 'content et toi', '2024-07-14 00:00:00'),
(5, 5, 1, 0, 'tu sais déjà...', '2024-07-15 00:00:00'),
(7, 5, 2, 1, 'ca va gros !?', '2024-07-14 00:00:00'),
(8, 5, 1, 0, 'on se fait une bouffe ?', '2024-07-15 18:00:00'),
(10, 5, 1, 0, 'on se fait une bouffe a saindouxVille !!!', '2024-07-15 09:33:12'),
(11, 5, 2, 1, 'on se le refait? ', '2024-07-15 10:05:02'),
(16, 1, 5, 0, 'oki doki', '2024-07-15 21:02:36'),
(17, 5, 3, 0, 'le livre est il en bon état ?', '2024-07-15 21:45:04'),
(30, 5, 3, 0, 'si c\'est le cas je serais ravi', '2024-07-16 13:30:01'),
(31, 5, 1, 0, 'vers 8h ?', '2024-07-16 13:43:17'),
(32, 5, 3, 0, 'une réponse est souhaitée', '2024-07-16 13:43:48'),
(33, 5, 4, 1, 'le livre est il en bon état ?', '2024-07-16 13:44:36'),
(34, 3, 5, 0, 'il n\'y a pas d\'image à votre livre est ce normal ?', '2024-07-18 13:23:44'),
(35, 5, 1, 1, 'nouveu', '2024-07-22 17:07:57'),
(36, 10, 2, 1, 'teste', '2024-07-22 18:19:33'),
(37, 10, 2, 1, 'texte 2', '2024-07-22 18:50:41'),
(38, 10, 2, 1, '', '2024-07-22 18:50:45'),
(39, 12, 1, 1, 'test', '2024-07-22 22:15:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `icon` text NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `icon`, `creation_date`) VALUES
(1, 'CamilleClub.it', 'camille@gmail.com', '$2y$10$nMKVnXIdc0LbzLCtrQsNc.YjFyujBpsbYjqpB62Dw5D4gBLySYDj.', 'd13052a8bee33852c3e066eca8af0b4d.png', '2024-01-15'),
(2, 'Nathalire', 'Nathalie@gmail.com', '$2y$10$PR4Y9T5A8awBMO3seeg1Ee5eOsuoOYXsdCrsif8JU7/eaHXTy2bYa', '28405ee576aa615ca12ddc234e695995.jpg', '2022-07-07'),
(3, 'Alexlecture', 'alex@outlook.com', '$2y$10$cx.vHlqYCyUCGtbRbWm76.E2el5ieqLdud7ZGLgCTKj3SprS2btIG', '5b2b328e9b069a3d3d279d404f18eac9.png', '2020-08-12'),
(4, 'Hugo1990_12', 'hugo@pratt.com', '$2y$10$Wx.u/5oRophyVEoTNIrgBeRWchPy48Gzr2vftrJA88PBJJZRznXk6', '6be8192cb587ec3dfdbfc8ee87a09940.png', '2023-10-02'),
(5, 'Alan971', 'alanrouxel@hotmail.com', '$2y$10$cngVJrvIRtvTGNd4ZKNBbuKqa5NzObwTntINNPe/G4Re.biFepHgu', 'd7d070013a21eadd6aa31864aabd6b4c.png', '2024-07-09'),
(12, 'Gégé', 'gerard@bouchard.com', '$2y$10$WWDUzj95ZtF0IdRiQpNVOujvJJLHcgf.BatMVCKYnXtPf8Q/xpBO2', 'e43491f1804a225a5d47596ef7de80f9.png', '2024-07-22');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_ibfk_1` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
