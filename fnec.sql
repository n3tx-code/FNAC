-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 19 nov. 2018 à 08:45
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fnec`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `number` varchar(256) NOT NULL,
  `street` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `address`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_adress` BEFORE INSERT ON `address` FOR EACH ROW begin
    declare msg varchar(128);
    if new.number < 0 THEN
        set msg = concat('Numéro de rue invalide');
        signal sqlstate '45000' set message_text = msg;
    end if;
    if new.zip_code < 0 THEN
    	set msg = concat('Code postal incorrect');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`, `description`) VALUES
(1, 'test', NULL, 'test'),
(2, 'coucou', 1, 'coucou');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `fidelity_card` int(11) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `phone` int(11) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `fidelity_card`, `name`, `first_name`, `phone`, `mail`, `password`) VALUES
(1, NULL, 'test', 'test', 0, 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

--
-- Déclencheurs `client`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_client` BEFORE INSERT ON `client` FOR EACH ROW begin
    declare msg varchar(128);
    if new.fidelity_card < 0 THEN
        set msg = concat('Numéro de carte de fidélité erroné');
        signal sqlstate '45000' set message_text = msg;
    end if;
    if new.phone < 0 THEN
    	set msg = concat('Numéro de téléphone incorrect');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

CREATE TABLE `command` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `command`
--
DELIMITER $$
CREATE TRIGGER `trg_command` BEFORE INSERT ON `command` FOR EACH ROW begin
    declare msg varchar(128);
    if new.price < 0 THEN
        set msg = concat('Prix commande incorrecte');
        signal sqlstate '45000' set message_text = msg;
    end if;
    if new.date < CURRENT_DATE THEN
    	set msg = concat('Date invalide');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `delivery`
--

CREATE TABLE `delivery` (
  `command` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `delivery`
--
DELIMITER $$
CREATE TRIGGER `trg_delivery` BEFORE INSERT ON `delivery` FOR EACH ROW begin
    declare msg varchar(128);
    if new.date < CURRENT_DATE THEN
    	set msg = concat('Date invalide');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `fidelity_card`
--

CREATE TABLE `fidelity_card` (
  `fc_number` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `fidelity_card`
--
DELIMITER $$
CREATE TRIGGER `trg_fidelity_card` BEFORE INSERT ON `fidelity_card` FOR EACH ROW begin
    declare msg varchar(128);
    if new.fc_number < 0 THEN
        set msg = concat('Numéro de carte de fidélité incorrecte');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_fidelity_card_pts` BEFORE UPDATE ON `fidelity_card` FOR EACH ROW begin
    declare msg varchar(128);
    if new.points < 0 THEN
        set msg = concat('Nombre de points non valide');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `reference` int(11) NOT NULL,
  `src` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`reference`, `src`) VALUES
(3, 'img/uploads/1542268433_heaphone_man.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `opinion`
--

CREATE TABLE `opinion` (
  `client` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `grade` smallint(6) NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `opinion`
--
DELIMITER $$
CREATE TRIGGER `trg_opinion` BEFORE INSERT ON `opinion` FOR EACH ROW begin
    declare msg varchar(128);
    if new.grade < 0 THEN
        set msg = concat('Note incorrecte');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `partner`
--

CREATE TABLE `partner` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `command` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

CREATE TABLE `promo` (
  `reference` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `percentage` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`reference`, `start_date`, `end_date`, `percentage`) VALUES
(3, '2018-11-22', '2018-11-21', 78),
(3, '2018-11-23', '2018-11-30', 90),
(3, '2018-11-29', '2018-12-06', 78);

--
-- Déclencheurs `promo`
--
DELIMITER $$
CREATE TRIGGER `trg_promo` BEFORE INSERT ON `promo` FOR EACH ROW begin
    declare msg varchar(128);
    if new.start_date < CURRENT_DATE THEN
        set msg = concat('Date de début non valide');
        signal sqlstate '45000' set message_text = msg;
    end if;
    if new.end_date <= CURRENT_DATE THEN
    	set msg = concat('Date de fin non valide');
        signal sqlstate '45000' set message_text = msg;
    end if;
    if new.percentage <= 0 THEN
    	set msg = concat('Pourcentage non valide');
        signal sqlstate '45000' set message_text = msg;
    end if;
    if new.end_date < new.start_date THEN
    	set msg = concat('Pourcentage non valide');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `partner` int(11) DEFAULT NULL,
  `ref_product` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reference`
--

INSERT INTO `reference` (`id`, `category`, `partner`, `ref_product`, `name`, `description`, `price`, `add_date`) VALUES
(3, 1, NULL, 'test', 'test', 'test', 32, '2018-11-15 08:53:53');

--
-- Déclencheurs `reference`
--
DELIMITER $$
CREATE TRIGGER `trg_reference` BEFORE INSERT ON `reference` FOR EACH ROW begin
    declare msg varchar(128);
    if new.price <= 0 THEN
    	set msg = concat('Prix invalide');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `shop`
--

CREATE TABLE `shop` (
  `identifiant` varchar(255) NOT NULL,
  `street_number` int(11) NOT NULL,
  `street` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `shop`
--

INSERT INTO `shop` (`identifiant`, `street_number`, `street`, `city`, `zip_code`) VALUES
('test', 1, 'test', 'Test', 3178);

--
-- Déclencheurs `shop`
--
DELIMITER $$
CREATE TRIGGER `trg_shop` BEFORE INSERT ON `shop` FOR EACH ROW begin
    declare msg varchar(128);
    if new.street_number < 0 THEN
    	set msg = concat('Numéro de rue non valide');
        signal sqlstate '45000' set message_text = msg;
    end if;
    if new.zip_code < 0 THEN
    	set msg = concat('Code postal non valide');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `shop` varchar(255) NOT NULL,
  `reference` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `stock`
--
DELIMITER $$
CREATE TRIGGER `trg_stock_insert` BEFORE INSERT ON `stock` FOR EACH ROW begin
    declare msg varchar(128);
    if new.quantity < 0 THEN
    	set msg = concat('Quantité erronée');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_stock_update` BEFORE UPDATE ON `stock` FOR EACH ROW begin
    declare msg varchar(128);
    if new.quantity < 0 THEN
    	set msg = concat('Quantité erronée');
        signal sqlstate '45000' set message_text = msg;
    end if;
end
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client` (`client`),
  ADD KEY `id` (`id`,`client`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`),
  ADD KEY `id` (`id`,`name`(255));

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fidelity_card` (`fidelity_card`),
  ADD KEY `id` (`id`,`mail`(255),`password`(255));

--
-- Index pour la table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client` (`client`),
  ADD KEY `id` (`id`,`client`,`add_date`,`price`);

--
-- Index pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`command`),
  ADD KEY `address` (`address`),
  ADD KEY `command` (`command`,`address`);

--
-- Index pour la table `fidelity_card`
--
ALTER TABLE `fidelity_card`
  ADD PRIMARY KEY (`fc_number`),
  ADD KEY `fc_number` (`fc_number`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD KEY `reference` (`reference`),
  ADD KEY `reference_2` (`reference`);

--
-- Index pour la table `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`client`,`reference`),
  ADD KEY `reference` (`reference`),
  ADD KEY `client` (`client`,`reference`,`grade`);

--
-- Index pour la table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`name`(255));

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `command` (`command`),
  ADD KEY `reference` (`reference`,`command`);

--
-- Index pour la table `promo`
--
ALTER TABLE `promo`
  ADD KEY `reference` (`reference`),
  ADD KEY `reference_2` (`reference`,`start_date`,`end_date`,`percentage`);

--
-- Index pour la table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `partner` (`partner`),
  ADD KEY `id` (`id`,`category`,`partner`,`ref_product`(255),`name`(255),`price`);

--
-- Index pour la table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`identifiant`),
  ADD KEY `identifiant` (`identifiant`,`city`(255));

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`shop`,`reference`),
  ADD KEY `reference` (`reference`),
  ADD KEY `shop` (`shop`,`reference`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`fidelity_card`) REFERENCES `fidelity_card` (`fc_number`);

--
-- Contraintes pour la table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`command`) REFERENCES `command` (`id`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`command`) REFERENCES `command` (`id`),
  ADD CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`command`) REFERENCES `command` (`id`),
  ADD CONSTRAINT `delivery_ibfk_4` FOREIGN KEY (`command`) REFERENCES `command` (`id`),
  ADD CONSTRAINT `delivery_ibfk_5` FOREIGN KEY (`address`) REFERENCES `address` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`);

--
-- Contraintes pour la table `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `opinion_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `opinion_ibfk_2` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`command`) REFERENCES `command` (`id`);

--
-- Contraintes pour la table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`);

--
-- Contraintes pour la table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `reference_ibfk_2` FOREIGN KEY (`partner`) REFERENCES `partner` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`shop`) REFERENCES `shop` (`identifiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
