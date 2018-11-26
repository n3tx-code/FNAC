-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 26 Novembre 2018 à 19:31
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `description` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `address`
--

INSERT INTO `address` (`id`, `client`, `number`, `street`, `city`, `zip_code`, `description`) VALUES
(1, 9, '1', 'rezrz', 'test@test.net', 68, NULL),
(2, 1, '1', 'test', 'test', 78931, 'test');

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
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`, `description`) VALUES
(1, 'test', NULL, 'test'),
(2, 'coucou', 1, 'coucou'),
(3, 'pas de fils', NULL, 'ne peut pas avoir de fils de pute');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `phone` int(11) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `name`, `first_name`, `phone`, `mail`, `password`) VALUES
(1, 'test', 'test', 0, 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(9, 'test@test.net', 'test@test.net', 687, 'test@test.net', '79fc33f9048c6436f353360155168c76f0d90083'),
(10, 'test@test.net', 'test@test.net', 687, 'test@test.net', '79fc33f9048c6436f353360155168c76f0d90083'),
(11, 'Mia', 'Hendricks', 606050995, 'auctor.nunc.nulla@aliquamadipiscinglacus.co.uk', 'IKX73OUV3DC'),
(12, 'Seth', 'Singleton', 605010992, 'eu.neque@InfaucibusMorbi.net', 'VIG59OAR7PE'),
(13, 'Wyoming', 'Sanchez', 688328974, 'ligula.Aenean.gravida@laciniaorciconsectetuer.net', 'LFZ93FSJ0EW'),
(14, 'Leandra', 'Pruitt', 680984814, 'tincidunt.congue@felis.edu', 'DEX56VLG5UN'),
(15, 'Anne', 'Mclean', 791839851, 'Quisque.nonummy.ipsum@ornareelit.ca', 'ISZ30HAZ7FW'),
(16, 'Uta', 'Harrell', 696298765, 'pede.et.risus@eudui.net', 'ZVL59ALM6JI'),
(17, 'Illana', 'Austin', 717815371, 'dictum@loremluctusut.edu', 'LYP04YAL6CZ'),
(18, 'Leilani', 'Cervantes', 675125983, 'id@quisdiam.com', 'LST88NIZ7ZH'),
(19, 'Chandler', 'Wooten', 790416646, 'ligula.tortor@felisegetvarius.edu', 'MCX89HFI8MA'),
(20, 'Jillian', 'Stephens', 715556154, 'sed.dolor.Fusce@odiosemper.ca', 'ELQ24ARO1GC'),
(21, 'Kaitlin', 'Welch', 604113136, 'quam@viverraDonectempus.com', 'AXV82GAL9MG'),
(22, 'Laurel', 'Merrill', 761042295, 'ullamcorper.nisl.arcu@arcuet.edu', 'UID34POD8CF'),
(23, 'Melyssa', 'Langley', 724677236, 'Quisque.ornare.tortor@eu.co.uk', 'WTA50FVI6NU'),
(24, 'Alice', 'Jones', 673566090, 'nunc.est@odioAliquamvulputate.ca', 'KFO64IXU1IS'),
(25, 'Colin', 'Fry', 757701506, 'vel.sapien@ipsum.co.uk', 'SPU64SCV8UO'),
(26, 'Karly', 'Cash', 770126266, 'Nullam@hendrerit.ca', 'FWT87ZWR1EX'),
(27, 'Eden', 'Burnett', 726881041, 'ornare.In.faucibus@quisdiam.org', 'YAO61ABC0SK'),
(28, 'Graham', 'Reeves', 722501132, 'ac.libero.nec@enimCurabiturmassa.edu', 'ZEC80CJS7YF'),
(29, 'Lois', 'Hebert', 748519748, 'eget.mollis@massa.com', 'TML97ODU3JH'),
(30, 'Plato', 'Juarez', 703642861, 'massa@lobortisquis.com', 'YHF55RLT1EU'),
(31, 'Alan', 'Dejesus', 618723382, 'rutrum@fermentumvelmauris.edu', 'BDB59HTQ3ZM'),
(32, 'Brennan', 'Pugh', 686279510, 'sem@feugiatmetussit.com', 'QYN46PNX6MJ'),
(33, 'Jasper', 'Riggs', 642732448, 'vitae.aliquet@tempuseu.net', 'QVS73YTE1RC'),
(34, 'Karen', 'Manning', 638281742, 'erat.vel@risusDonec.edu', 'KWF61YXK3FK'),
(35, 'Brenden', 'Pratt', 603577280, 'placerat.orci@liberoDonec.ca', 'NAG91QZA5NY'),
(36, 'Molly', 'Mcgee', 649053233, 'eu@adipiscing.ca', 'CTL71EON4GM'),
(37, 'Rinah', 'Chen', 742858321, 'erat.Sed@odio.org', 'SCS68CFU6XW'),
(38, 'Megan', 'Buck', 784691071, 'magna.Praesent.interdum@luctus.org', 'GNT49DTL4TS'),
(39, 'Adrienne', 'Craig', 712359427, 'arcu.eu@Nunclectus.net', 'BSO29SCW3VD'),
(40, 'Clinton', 'Valdez', 741481456, 'elementum.at.egestas@Classaptenttaciti.edu', 'RWV37HAG4WY'),
(41, 'Iona', 'Joyce', 649023174, 'Duis.sit.amet@nibhsitamet.net', 'OZF10FGL4BB'),
(42, 'Eve', 'Finch', 621434366, 'lacus@sapienimperdiet.ca', 'NMI79BSO2CH'),
(43, 'Kim', 'Horn', 779214351, 'Integer@egestasAliquamnec.org', 'OYC64SJL0WV'),
(44, 'Allistair', 'Jordan', 660575444, 'elit.erat.vitae@mollisDuissit.edu', 'VTL87HEO4YE'),
(45, 'Donovan', 'Bradshaw', 657317529, 'tincidunt.dui@purus.com', 'UYG35IMZ7ZX'),
(46, 'Clare', 'Mckay', 712383494, 'elit.fermentum.risus@cursus.co.uk', 'CGH94PNO1US'),
(47, 'Jescie', 'Schroeder', 723305725, 'Aenean.eget.magna@maurisut.net', 'VNS36CJE4LG'),
(48, 'Raven', 'Porter', 679592878, 'massa.non.ante@tristique.net', 'VNF27WMF9HY'),
(49, 'Colin', 'Pruitt', 780487901, 'erat@lorem.net', 'ZEU91SQK1MV'),
(50, 'McKenzie', 'Morrow', 693106038, 'arcu@ligula.ca', 'MBF17TWF2QO'),
(51, 'Yoko', 'Mckinney', 609233501, 'nec@venenatislacus.ca', 'YGA59SXS2TI'),
(52, 'Branden', 'Flores', 736202617, 'euismod.ac@porttitor.co.uk', 'HGP25CQI5TM'),
(53, 'Ocean', 'Slater', 758865046, 'nonummy.ultricies@acfermentum.ca', 'CTF78BDJ6WD'),
(54, 'Abdul', 'Griffith', 642981345, 'vel.lectus@cursuset.co.uk', 'GZA65XDV7JS'),
(55, 'Rachel', 'Ingram', 605985487, 'elementum.at@in.net', 'ILM49MYO8SU'),
(56, 'Jerry', 'Estes', 648942452, 'nulla.vulputate@aultriciesadipiscing.com', 'KLD69JDZ8UY'),
(57, 'Roth', 'Raymond', 687062309, 'arcu.Sed@vehiculaPellentesquetincidunt.co.uk', 'HJD22SMC6NM'),
(58, 'Selma', 'Charles', 735413194, 'magnis@urna.com', 'VWG65KIP3WZ'),
(59, 'Gail', 'Sweet', 616176014, 'pede@nasceturridiculus.co.uk', 'QFE82QPM1WG'),
(60, 'Desirae', 'Terry', 670140383, 'elit.erat.vitae@Vestibulumuteros.net', 'PAB59DZW3RY'),
(61, 'Erica', 'Rocha', 746427630, 'egestas.ligula@felisorciadipiscing.edu', 'ZKS47FZL6MV'),
(62, 'Odessa', 'Hardin', 705183053, 'Lorem@interdumligulaeu.net', 'ABT68AJD7MO'),
(63, 'Desirae', 'Colon', 769603140, 'Ut.sagittis@Sedeget.com', 'MYL39PLQ8JA'),
(64, 'Rose', 'Foster', 735522884, 'risus@CuraeDonec.com', 'SKG07HBL4YY'),
(65, 'Whitney', 'Gill', 719704296, 'consectetuer.adipiscing@molestiearcuSed.co.uk', 'WJP78QVG7UA'),
(66, 'Benedict', 'Bean', 789819944, 'malesuada.Integer@placerat.com', 'KBI77SYR8AN'),
(67, 'Shelby', 'Dorsey', 698537871, 'ut.pellentesque@Pellentesque.ca', 'LIT39NXH3QF'),
(68, 'Venus', 'Doyle', 677934209, 'non.lacinia@a.co.uk', 'ZSX09LSI4II'),
(69, 'Yardley', 'Hodges', 748377408, 'Nulla.tempor.augue@euismodet.org', 'QLZ78UKH6UI'),
(70, 'Nina', 'Mccarty', 794188085, 'Mauris.ut@Uttinciduntorci.co.uk', 'ZQH21JGG5UO'),
(71, 'Lila', 'Pate', 702942689, 'metus.facilisis.lorem@Proin.com', 'VRM31NVZ5ZL'),
(72, 'Oprah', 'Sweet', 782688392, 'mauris.erat@velit.ca', 'VDK83HUF5QY'),
(73, 'Hanna', 'Walter', 790992579, 'Quisque@interdum.net', 'WTL46VPV6KR'),
(74, 'Lareina', 'Molina', 704728506, 'rutrum@turpis.net', 'MXG87MBD5YZ'),
(75, 'Byron', 'Chase', 626103063, 'at@Aliquamvulputateullamcorper.net', 'FEP31WEK7UD'),
(76, 'Phyllis', 'Munoz', 747835589, 'vestibulum.Mauris.magna@convallisest.com', 'DNZ64TNC4SL'),
(77, 'Hedda', 'Tanner', 699800087, 'non@cursus.ca', 'RAZ03XLZ6FT'),
(78, 'Cara', 'Huber', 697337365, 'Fusce@Nuncmauris.edu', 'FCF49IJO1RV'),
(79, 'Lucas', 'Rich', 798790954, 'iaculis.quis.pede@arcuSedeu.com', 'RHI69HCI1RF'),
(80, 'Cara', 'Wilkinson', 701699987, 'Nunc.laoreet.lectus@semper.net', 'FAB59FNS7LH'),
(81, 'Jacob', 'Michael', 641892864, 'orci.Ut.semper@gravidanunc.edu', 'QYQ69TKK6SZ'),
(82, 'Shad', 'Clements', 707576296, 'est@adipiscingfringillaporttitor.edu', 'LCU12JZN0GT'),
(83, 'Natalie', 'Oneil', 742561173, 'tellus.Suspendisse@tristiquealiquet.edu', 'BLI11KYI0CL'),
(84, 'Signe', 'Mooney', 723723319, 'tellus@pellentesque.org', 'DEM57IGL9OC'),
(85, 'Kylan', 'Stewart', 735359064, 'malesuada.Integer@malesuadavelconvallis.net', 'QQA79IFE7BC'),
(86, 'Paki', 'Bradshaw', 692258756, 'In@Utsagittis.edu', 'EHI88JFH4TQ'),
(87, 'Yoshi', 'Wilcox', 688910250, 'condimentum.Donec.at@ultricesposuere.edu', 'YBT06ZAI8KC'),
(88, 'Leandra', 'Lamb', 762443120, 'dolor.sit@tincidunt.ca', 'XCL15BTR8OY'),
(89, 'Chaim', 'Barker', 656372492, 'Phasellus@elitfermentumrisus.co.uk', 'VUT16DZY2WB'),
(90, 'Sawyer', 'Thomas', 742166201, 'arcu.Morbi.sit@dolor.co.uk', 'CIO67TWA4UE'),
(91, 'Prescott', 'Walls', 729442990, 'ac.libero.nec@vitae.co.uk', 'ATI27MCL6YD'),
(92, 'Jael', 'Farmer', 750543572, 'justo.Praesent@nectempus.com', 'NFF68LXH2LJ'),
(93, 'Nichole', 'Pruitt', 648686334, 'at.velit@apurus.ca', 'NRG44WEI3MD'),
(94, 'Raja', 'Yates', 778173582, 'semper.Nam.tempor@interdum.org', 'DCL36EIC9QJ'),
(95, 'Colin', 'Boone', 747850941, 'arcu.Morbi.sit@asollicitudin.org', 'UNJ00FEH5BB'),
(96, 'Carlos', 'Pickett', 606202205, 'natoque.penatibus.et@posuere.edu', 'WCE46ICB2UQ'),
(97, 'Shelly', 'Dillard', 642641005, 'blandit.viverra@egestas.com', 'SSO19XPT2PA'),
(98, 'Fletcher', 'Alston', 604437007, 'arcu@Phasellus.edu', 'BHX95BEK7MJ'),
(99, 'Darius', 'Peters', 601318096, 'non.arcu@molestie.net', 'CHL29MWM1FO'),
(100, 'Myles', 'Jarvis', 789250506, 'nunc@lectuspedeultrices.co.uk', 'NNM99WJA0ZV'),
(101, 'Skyler', 'Chaney', 651684166, 'Nunc.sollicitudin.commodo@pede.com', 'EJM03PNE6IW'),
(102, 'Taylor', 'Clark', 666696632, 'Cum@auctor.ca', 'BJZ69ZIM9VW'),
(103, 'Lana', 'Rutledge', 620144542, 'massa@lorem.edu', 'SGT48WTU3KN'),
(104, 'Ulric', 'Perez', 695889126, 'neque.pellentesque@natoquepenatibuset.co.uk', 'LTJ09UTV6VS'),
(105, 'Mia', 'Boyd', 678515445, 'ligula.elit.pretium@Quisque.net', 'PAA30ZPF9DH'),
(106, 'Tobias', 'Adams', 732122353, 'ac@nonantebibendum.co.uk', 'WLE94RHH0AH'),
(107, 'Sasha', 'Vazquez', 649675570, 'Curabitur@nec.edu', 'AAA14FKN8RR'),
(108, 'Elmo', 'Mills', 666158206, 'Nunc.mauris@Quisquefringillaeuismod.org', 'VMF96FWJ7HA'),
(109, 'Kermit', 'Cameron', 726193347, 'feugiat@fermentum.net', 'ZWB32IRL8CD'),
(110, 'Raymond', 'Nash', 799230821, 'fermentum.vel.mauris@Aliquamadipiscinglobortis.com', 'OIN32EEJ7TJ');

--
-- Déclencheurs `client`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_client` BEFORE INSERT ON `client` FOR EACH ROW begin
    declare msg varchar(128);
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
-- Contenu de la table `command`
--

INSERT INTO `command` (`id`, `client`, `add_date`, `price`) VALUES
(3, 1, '2018-11-22 18:44:50', 471.68),
(4, 1, '2018-11-22 18:45:14', 471.68),
(6, 1, '2018-11-22 18:46:15', 471.68),
(7, 1, '2018-11-22 18:46:26', 471.68),
(8, 1, '2018-11-22 18:47:13', 471.68),
(9, 1, '2018-11-22 18:47:48', 471.68),
(10, 1, '2018-11-22 18:48:03', 471.68),
(11, 1, '2018-11-22 18:49:16', 471.68),
(12, 1, '2018-11-22 18:49:24', 471.68),
(13, 1, '2018-11-22 18:49:32', 471.68),
(14, 1, '2018-11-22 18:50:04', 471.68),
(15, 1, '2018-11-22 18:50:11', 471.68),
(16, 1, '2018-11-22 18:50:32', 471.68),
(17, 1, '2018-11-22 18:50:47', 471.68),
(18, 1, '2018-11-22 18:50:56', 471.68),
(19, 1, '2018-11-22 18:51:30', 471.68),
(20, 1, '2018-11-22 18:56:38', 471.68),
(21, 1, '2018-11-22 18:57:42', 1139),
(22, 1, '2018-11-22 18:58:02', 1139),
(24, 1, '2018-11-22 18:59:49', 112.64),
(25, 1, '2018-11-22 19:00:53', 176),
(28, 1, '2018-11-26 19:57:22', 161.92);

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
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `delivery`
--

INSERT INTO `delivery` (`command`, `address`, `add_date`, `status`) VALUES
(28, 2, '2018-11-26 19:57:23', 'Pending');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `reference` int(11) NOT NULL,
  `src` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`reference`, `src`) VALUES
(3, '/img/uploads/1542268433_heaphone_man.jpg'),
(4, '/img/uploads/1542622484_420.jpg'),
(5, '/img/uploads/1542623443_feu.jpg');

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
-- Contenu de la table `opinion`
--

INSERT INTO `opinion` (`client`, `reference`, `grade`, `comment`) VALUES
(10, 3, 1, 'semper, dui lectus rutrum urna,'),
(10, 5, 2, 'neque non quam. Pellentesque habitant morbi tristique senectus'),
(11, 3, 3, 'lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum'),
(13, 4, 5, 'vehicula et, rutrum eu, ultrices sit amet, risus. Donec nibh'),
(14, 4, 2, 'ut dolor dapibus gravida. Aliquam tincidunt, nunc ac'),
(14, 5, 4, 'lacinia at, iaculis quis, pede. Praesent eu dui. Cum'),
(15, 4, 5, 'quam, elementum'),
(16, 3, 5, 'eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur dictum. Phasellus'),
(17, 5, 1, 'Nulla tincidunt, neque vitae semper egestas, urna justo faucibus'),
(22, 4, 2, 'fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna nec quam. Curabitur'),
(28, 3, 5, 'Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit.'),
(31, 5, 3, 'Vestibulum ante'),
(33, 3, 2, 'urna convallis erat,'),
(37, 5, 4, 'est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante'),
(38, 3, 5, 'erat neque'),
(43, 5, 3, 'Proin ultrices. Duis volutpat'),
(46, 3, 3, 'in felis. Nulla'),
(46, 4, 2, 'posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet'),
(47, 5, 4, 'malesuada fames ac turpis egestas. Aliquam fringilla cursus purus.'),
(51, 3, 2, 'sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet'),
(51, 4, 3, 'eget mollis lectus pede et risus. Quisque libero lacus, varius et, euismod et,'),
(58, 5, 1, 'Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla.'),
(64, 4, 3, 'euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non'),
(66, 3, 5, 'ullamcorper magna. Sed eu eros. Nam consequat dolor'),
(66, 5, 1, 'Donec'),
(76, 4, 3, 'iaculis odio. Nam interdum enim'),
(76, 5, 3, 'in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla'),
(78, 4, 1, 'hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna.'),
(81, 4, 2, 'libero. Proin mi. Aliquam gravida mauris ut mi. Duis risus odio, auctor'),
(87, 4, 1, 'lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non'),
(87, 5, 1, 'elementum sem, vitae aliquam eros turpis non'),
(90, 4, 5, 'Vivamus non lorem vitae'),
(96, 5, 1, 'vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra,'),
(100, 5, 4, 'ac mattis semper, dui lectus rutrum urna,'),
(105, 5, 1, 'Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac');

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

--
-- Contenu de la table `partner`
--

INSERT INTO `partner` (`id`, `name`, `description`, `website`) VALUES
(1, 'Boeing', 'Petite entreprise dâ€™aÃ©ronautique d\'amÃ©rique du nord ', 'htttp://www.boeing.com');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `command` int(11) NOT NULL,
  `shop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `reference`, `command`, `shop`) VALUES
(1, 3, 25, 'test'),
(2, 3, 25, 'test'),
(3, 3, 25, 'test'),
(4, 3, 25, 'test'),
(5, 3, 25, 'test'),
(6, 3, 25, 'test'),
(7, 3, 25, 'test'),
(8, 3, 25, 'test'),
(9, 3, 25, 'test'),
(10, 3, 25, 'test'),
(11, 3, 25, 'test'),
(12, 3, 25, 'test'),
(13, 3, 25, 'test'),
(14, 3, 25, 'test'),
(15, 3, 25, 'test'),
(16, 3, 25, 'test'),
(17, 3, 25, 'test'),
(18, 3, 25, 'test'),
(19, 3, 25, 'test'),
(20, 3, 25, 'test'),
(21, 3, 25, 'test'),
(22, 3, 25, 'test'),
(23, 3, 25, 'test'),
(24, 3, 25, 'test'),
(25, 3, 25, 'test'),
(72, 3, 28, 'test'),
(73, 3, 28, 'test'),
(74, 3, 28, 'test'),
(75, 3, 28, 'test'),
(76, 3, 28, 'test'),
(77, 3, 28, 'test'),
(78, 3, 28, 'test'),
(79, 3, 28, 'test'),
(80, 3, 28, 'test'),
(81, 3, 28, 'test'),
(82, 3, 28, 'test'),
(83, 3, 28, 'test'),
(84, 3, 28, 'test'),
(85, 3, 28, 'test'),
(86, 3, 28, 'test'),
(87, 3, 28, 'test'),
(88, 3, 28, 'test'),
(89, 3, 28, 'test'),
(90, 3, 28, 'test'),
(91, 3, 28, 'test'),
(92, 3, 28, 'test'),
(93, 3, 28, 'test'),
(94, 3, 28, 'test');

--
-- Déclencheurs `product`
--
DELIMITER $$
CREATE TRIGGER `trg_product_stock` BEFORE INSERT ON `product` FOR EACH ROW begin
    declare msg varchar(128);
    declare stock integer(11);
    SELECT quantity INTO @stock FROM stock WHERE reference = new.reference AND shop = new.shop;
    IF @stock < 1 THEN
    	set msg = concat('Stock insuffisant');
        signal sqlstate '45000' set message_text = msg;
    ELSE
    	UPDATE stock SET quantity = (@stock-1) WHERE reference = new.reference AND shop = new.shop;
        end if;
END
$$
DELIMITER ;

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
-- Contenu de la table `promo`
--

INSERT INTO `promo` (`reference`, `start_date`, `end_date`, `percentage`) VALUES
(3, '2018-11-29', '2018-12-06', 78),
(4, '2018-11-22', '2018-11-23', 54),
(4, '2018-11-23', '2018-11-25', 10);

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
-- Contenu de la table `reference`
--

INSERT INTO `reference` (`id`, `category`, `partner`, `ref_product`, `name`, `description`, `price`, `add_date`) VALUES
(3, 2, NULL, 'test', 'test', 'test', 32, '2018-11-15 08:53:53'),
(4, 2, NULL, 'taezt', 'oiutoaezt', 'reazazte aze tzaet azeta yza e(talkrara re ajre jlae jrlaj r:ka hzkr ahjezr', 68, '2018-11-19 11:14:44'),
(5, 1, NULL, 'teazet', 'dpoezak', 'fazefij lka feafez', 67, '2018-11-19 11:30:43');

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
-- Contenu de la table `shop`
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
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`shop`, `reference`, `quantity`) VALUES
('test', 3, 2),
('test', 4, 525),
('test', 5, 1);

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
-- Index pour les tables exportées
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
  ADD KEY `reference` (`reference`,`command`),
  ADD KEY `shop_ibfk_1` (`shop`);

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
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT pour la table `command`
--
ALTER TABLE `command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT pour la table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`command`) REFERENCES `command` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`command`) REFERENCES `command` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`command`) REFERENCES `command` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_4` FOREIGN KEY (`command`) REFERENCES `command` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_5` FOREIGN KEY (`address`) REFERENCES `address` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `opinion_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `opinion_ibfk_2` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`command`) REFERENCES `command` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`shop`) REFERENCES `shop` (`identifiant`) ON DELETE CASCADE;

--
-- Contraintes pour la table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reference_ibfk_2` FOREIGN KEY (`partner`) REFERENCES `partner` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`reference`) REFERENCES `reference` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`shop`) REFERENCES `shop` (`identifiant`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
