-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2017 a las 01:07:00
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kernel9`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `group_name` varchar(50) NOT NULL,
  `group_genre` varchar(50) NOT NULL,
  `group_min_age` tinyint(4) NOT NULL,
  `group_max_age` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`group_name`, `group_genre`, `group_min_age`, `group_max_age`) VALUES
('Breakbeat Pals', 'Breakbeat', 14, 50),
('Jazz Lovers', 'Jazz', 35, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_grupales`
--

CREATE TABLE `mensajes_grupales` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_group` varchar(255) NOT NULL,
  `message_issue` varchar(50) NOT NULL,
  `message_body` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensajes_grupales`
--

INSERT INTO `mensajes_grupales` (`message_id`, `message_sender`, `message_group`, `message_issue`, `message_body`, `message_date`) VALUES
(1, 3, 'Jazz Lovers', 'Moby Dick', 'Now, inclusive of the occasional wide intervals between the revolving outer circles, and inclusive of the spaces between the various pods in any one of those circles, the entire area at this juncture, embraced by the whole multitude, must have contained at least two or three square miles. At any rateâ€”though indeed such a test at such a time might be deceptiveâ€”spoutings might be discovered from our low boat that seemed playing up almost from the rim of the horizon.', '2017-05-30 22:41:23'),
(2, 3, 'Jazz Lovers', 'Princess of Mars 3', '\"Dejah Thoris, I do not know how I have angered you. It was furtherest from my desire to hurt or offend you, whom I had hoped to protect and comfort. Have none of me if it is your will, but that you must aid me in effecting your escape, if such a thing be possible, is not my request, but my command. When you are safe once more at your father\'s court you may do with me as you please, but from now on until that day I am your master, and you must obey and aid me.\"', '2017-05-30 22:45:39'),
(3, 11, 'Jazz Lovers', 'Scarlet Plague 2', '\"Plague victims,\" he announced. \"That\'s the way they died everywhere in the last days. This must have been a family, running away from the contagion and perishing here on the Cliff House beach. Theyâ€”what are you doing, Edwin?\"', '2017-05-30 22:50:46'),
(4, 4, 'Breakbeat Pals', 'At the Earth\'s Core', 'Three times they wheeled about the interior of the oval chamber, to settle finally upon the damp, cold bowlders that fringe the outer edge of the pool. In the center of one side the largest rock was reserved for the queen, and here she took her place surrounded by her terrible guard.', '2017-05-30 22:57:27'),
(5, 4, 'Breakbeat Pals', 'War of the Worlds 4', 'Then it was as if an invisible yet intensely heated finger were drawn through the heather between me and the Martians, and all along a curving line beyond the sand pits the dark ground smoked and crackled. Something fell with a crash far away to the left where the road from Woking station opens out on the common. Forth-with the hissing and humming ceased, and the black, dome-like object sank slowly out of sight into the pit.', '2017-05-30 23:00:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_privados`
--

CREATE TABLE `mensajes_privados` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_receiver` int(11) NOT NULL,
  `message_issue` varchar(50) NOT NULL,
  `message_body` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `mensajes_privados`
--

INSERT INTO `mensajes_privados` (`message_id`, `message_sender`, `message_receiver`, `message_issue`, `message_body`, `message_date`) VALUES
(1, 3, 1, 'At the Earth\'s Core', '\"Well, Ja,\" I laughed, \"whether we be walking with our feet up or down, here we are, and the question of greatest importance is not so much where we came from as where we are going now. For my part I wish that you could guide me to Phutra where I may give myself up to the Mahars once more that my friends and I may work out the plan of escape which the Sagoths interrupted when they gathered us together and drove us to the arena to witness the punishment of the slaves who killed the guardsman.\"', '2017-05-30 22:40:34'),
(2, 3, 2, 'Princess of Mars', 'While I was allowing my fancy to run riot in wild conjecture on the possible explanation of the strange anomalies which I had so far met with on Mars, Sola returned bearing both food and drink. These she placed on the floor beside me, and seating herself a short ways off regarded me intently.', '2017-05-30 22:44:11'),
(3, 3, 4, 'Princess of Mars 2', 'It came, as I later discovered, not from an animal, as there is only one mammal on Mars and that one very rare indeed, but from a large plant which grows practically without water, but seems to distill its plentiful supply of milk from the products of the soil, the moisture of the air, and the rays of the sun. A single plant of this species will give eight or ten quarts of milk per day.', '2017-05-30 22:44:49'),
(4, 3, 11, 'War of the Worlds', 'And while the Martians behind me were thus preparing for their next sally, and in front of me Humanity gathered for the battle, I made my way with infinite pains and labour from the fire and smoke of burning Weybridge towards London.', '2017-05-30 22:45:20'),
(5, 11, 3, 'The Scarlet Plague', '\"I know you cannot count beyond ten, so I will tell you. Hold up your two hands. On both of them you have altogether ten fingers and thumbs. Very well. I now take this grain of sandâ€”you hold it, Hoo-Hoo.\" He dropped the grain of sand into the lad\'s palm and went on.', '2017-05-30 22:47:05'),
(6, 11, 5, 'The Scarlet Plague 2', 'And so on, laboriously, and with much reiteration, he strove to build up in their minds a crude conception of numbers. As the quantities increased, he had the boys holding different magnitudes in each of their hands. For still higher sums, he laid the symbols on the log of driftwood; and for symbols he was hard put, being compelled to use the teeth from the skulls for millions, and the crab-shells for billions.', '2017-05-30 22:48:04'),
(7, 11, 1, 'At the Earth\'s Core', 'The next time they appeared the other arm was gone, and then the breasts, and then a part of the faceâ€”it was awful. The poor creatures on the islands awaiting their fate tried to cover their eyes with their hands to hide the fearful sight, but now I saw that they too were under the hypnotic spell of the reptiles, so that they could only crouch in terror with their eyes fixed upon the terrible thing that was transpiring before them.', '2017-05-30 22:51:49'),
(8, 2, 3, 'Around the World in 80 Days', 'The locomotive, which was slowly approaching with deafening whistles, was that which, having been detached from the train, had continued its route with such terrific rapidity, carrying off the unconscious engineer and stoker. It had run several miles, when, the fire becoming low for want of fuel, the steam had slackened; and it had finally stopped an hour after, some twenty miles beyond Fort Kearney.', '2017-05-30 22:53:49'),
(9, 2, 3, 'Scarlet Plague 4', 'The boys were overwhelmed with delight at sight of the tears of senile disappointment that dribbled down the old man\'s cheeks. Then, unnoticed, Hoo-Hoo replaced the empty shell with a fresh-cooked crab. Already dismembered, from the cracked legs the white meat sent forth a small cloud of savory steam. This attracted the old man\'s nostrils, and he looked down in amazement.', '2017-05-30 22:54:12'),
(10, 4, 2, 'Princess of Mars ?', '\"No,\" she murmured, \"I am happy here. I do not know why it is that I should always be happy and contented when you, John Carter, a stranger, are with me; yet at such times it seems that I am safe and that, with you, I shall soon return to my father\'s court and feel his strong arms about me and my mother\'s tears and kisses on my cheek.\"', '2017-05-30 23:03:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_publicos`
--

CREATE TABLE `mensajes_publicos` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_issue` varchar(50) NOT NULL,
  `message_body` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensajes_publicos`
--

INSERT INTO `mensajes_publicos` (`message_id`, `message_sender`, `message_issue`, `message_body`, `message_date`) VALUES
(1, 3, 'About Moby Dick', 'I mention this circumstance, because, as if the cows and calves had been purposely locked up in this innermost fold; and as if the wide extent of the herd had hitherto prevented them from learning the precise cause of its stopping; or, possibly, being so young, unsophisticated, and every way innocent and inexperienced', '2017-05-30 22:42:13'),
(2, 2, 'War of the Worlds 2', '\"I lay still,\" he said, \"scared out of my wits, with the fore quarter of a horse atop of me. We\'d been wiped out. And the smell--good God! Like burnt meat! I was hurt across the back by the fall of the horse, and there I had to lie until I felt better. Just like parade it had been a minute before--then stumble, bang, swish!\"', '2017-05-30 22:55:14'),
(3, 4, 'War of the Worlds 3', 'It was sweeping round swiftly and steadily, this flaming death, this invisible, inevitable sword of heat. I perceived it coming towards me by the flashing bushes it touched, and was too astounded and stupefied to stir. I heard the crackle of fire in the sand pits and the sudden squeal of a horse that was as suddenly stilled. ', '2017-05-30 22:59:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_age` tinyint(4) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_genre` varchar(255) NOT NULL,
  `user_groups` varchar(200) NOT NULL,
  `user_isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_name`, `user_email`, `user_age`, `user_pass`, `user_genre`, `user_groups`, `user_isAdmin`) VALUES
(1, 'Alice', 'alice@coeurvert.com', 31, '$2y$10$uWJRlIEZoYVU.l6iylTEG./7b8Yidy0n9bXCkjmBVg5xgoKAQp25i', 'Electronic music', 'General', 0),
(2, 'Ederson', 'ederson@funes.com', 36, '$2y$10$DK75iMaZ93Kg4fYaeY5VP.tpR3SE7Mf8asxIUmLn2.znmmemrU..u', 'Hardstyle', 'General', 0),
(3, 'Lili', 'lili@traumhann.com', 40, '$2y$10$PVxc1ZVucHwm4F/.8WKItODOAUAZ4me0K2NC5dFrx2QNbq2ZE8fWy', 'Jazz', 'General,Jazz Lovers', 1),
(4, 'Karo', 'karmezina@karo.com', 28, '$2y$10$l6ZA3/RiAC0oY.6AePyyM.UjN/At.IyKv7gdypDWNUf5bFyF8l9Ju', 'Breakbeat', 'General,Breakbeat Pals', 0),
(5, 'Alexia', 'alexia@shyrose.com', 21, '$2y$10$7gRY7syo/CTZdyrjK8cNZO8d2aDLGjnQUPSvA2ICyNY/zXY.SkCUu', 'Pop', 'General', 0),
(11, 'Nila', 'nila@fortune.com', 44, '$2y$10$I7ppiY.Bg1GMONy0.oP0TOB80gu1rf.kuNqDRzc.StQaOiXPln3Qe', 'Jazz', 'General,Jazz Lovers', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`group_name`);

--
-- Indices de la tabla `mensajes_grupales`
--
ALTER TABLE `mensajes_grupales`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `emisor` (`message_sender`),
  ADD KEY `receptor` (`message_group`);

--
-- Indices de la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `emisor` (`message_sender`),
  ADD KEY `receptor` (`message_receiver`);

--
-- Indices de la tabla `mensajes_publicos`
--
ALTER TABLE `mensajes_publicos`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `emisor` (`message_sender`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes_grupales`
--
ALTER TABLE `mensajes_grupales`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `mensajes_publicos`
--
ALTER TABLE `mensajes_publicos`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes_grupales`
--
ALTER TABLE `mensajes_grupales`
  ADD CONSTRAINT `mensajes_grupales_ibfk_1` FOREIGN KEY (`message_sender`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  ADD CONSTRAINT `mensajes_privados_ibfk_1` FOREIGN KEY (`message_sender`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajes_privados_ibfk_2` FOREIGN KEY (`message_receiver`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes_publicos`
--
ALTER TABLE `mensajes_publicos`
  ADD CONSTRAINT `mensajes_publicos_ibfk_1` FOREIGN KEY (`message_sender`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
