-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 05 Gru 2019, 18:58
-- Wersja serwera: 10.1.26-MariaDB-0+deb9u1
-- Wersja PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `azyl`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `azyl_posty`
--

CREATE TABLE `azyl_posty` (
  `id` int(11) NOT NULL,
  `id_k` int(50) NOT NULL,
  `tytul_postu` varchar(40) NOT NULL,
  `wlasciciel` varchar(50) NOT NULL,
  `tresc` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `azyl_posty`
--

INSERT INTO `azyl_posty` (`id`, `id_k`, `tytul_postu`, `wlasciciel`, `tresc`, `data`) VALUES
(40, 1, 'Lorem ipsum', 'admin', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03'),
(41, 2, 'Lorem ipsum', 'admin', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03'),
(42, 3, 'Lorem ipsum', 'admin', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03'),
(43, 4, 'Lorem ipsum', 'admin', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `azyl_zapytania`
--

CREATE TABLE `azyl_zapytania` (
  `id` int(40) NOT NULL,
  `imie_i_nazwisko` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `temat` varchar(40) NOT NULL,
  `tresc_wiadomosci` varchar(40) NOT NULL,
  `data` date NOT NULL,
  `odp` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `azyl_zapytania`
--

INSERT INTO `azyl_zapytania` (`id`, `imie_i_nazwisko`, `email`, `temat`, `tresc_wiadomosci`, `data`, `odp`) VALUES
(2, 'Aleksander Kowalski', 'mrhdolek14@gmail.com', 'test', 'test', '2019-03-01', 1),
(3, 'Aleksander Kowalski', 'mrhdolek14@gmail.com', 'test2', 'test2', '2019-03-01', 1),
(11, '', '', '', '', '2019-06-10', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `forum_kateg`
--

CREATE TABLE `forum_kateg` (
  `id_k` int(40) NOT NULL,
  `nazwa` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `forum_kateg`
--

INSERT INTO `forum_kateg` (`id_k`, `nazwa`) VALUES
(1, 'Regulamin'),
(2, 'Pomoc'),
(3, 'Pytania związane z ts'),
(4, 'Informacje o przerwach serwisowych');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `forum_odpowiedzi`
--

CREATE TABLE `forum_odpowiedzi` (
  `id` int(50) NOT NULL,
  `id_p` int(50) NOT NULL,
  `id_k` int(50) NOT NULL,
  `id_u` int(50) NOT NULL,
  `tresc` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `forum_odpowiedzi`
--

INSERT INTO `forum_odpowiedzi` (`id`, `id_p`, `id_k`, `id_u`, `tresc`, `data`) VALUES
(48, 41, 2, 49, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03'),
(49, 40, 1, 49, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03'),
(50, 40, 1, 49, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03'),
(51, 42, 3, 49, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03'),
(52, 43, 4, 49, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-05-03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(50) NOT NULL,
  `tytul` tinytext NOT NULL,
  `tresc` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `tytul`, `tresc`, `data`) VALUES
(2, '<h3>Lorem ipsum</h3>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-03-25'),
(32, '', '', '2019-06-17'),
(33, '', '', '2019-06-17'),
(34, '', '', '2019-06-23'),
(35, '', '', '2019-06-23'),
(36, '', '', '2019-06-23'),
(37, '', '', '2019-08-12'),
(38, '', '', '2019-10-07');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ranga`
--

CREATE TABLE `ranga` (
  `id_r` int(40) NOT NULL,
  `nazwa` varchar(40) NOT NULL,
  `opis` varchar(100) NOT NULL,
  `value` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ranga`
--

INSERT INTO `ranga` (`id_r`, `nazwa`, `opis`, `value`) VALUES
(1, 'Admin', 'Administrator całej strony', 101),
(2, 'Moderator', 'Dodawanie i edycja postów na forum ', 75),
(3, 'Użytkownik', 'Może tylko dodawać,edytować swoja posty i odpowiadać na inne zapytania na forum', 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_bans`
--

CREATE TABLE `user_bans` (
  `id` int(40) NOT NULL,
  `id_u` int(40) NOT NULL,
  `ban_time` int(40) NOT NULL,
  `powod` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_login`
--

CREATE TABLE `user_login` (
  `id` int(10) NOT NULL,
  `nick` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `haslo` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_login`
--

INSERT INTO `user_login` (`id`, `nick`, `email`, `haslo`, `data`) VALUES
(49, 'admin', 'admin@admin.pl', 'f26ec452f20376f8c59122a9d39f8eeb740e4b3f', '2019-01-14'),
(65, 'test2', 'juzef123456@interia.pl', 'ea45ca077cce276e3d53be6e30c2a5aac6df02a2', '2019-03-16'),
(66, 'test_mod', 'test@testmod.pl', 'f26ec452f20376f8c59122a9d39f8eeb740e4b3f', '2019-03-19'),
(67, 'moderator', 'moderator@moderator', 'f26ec452f20376f8c59122a9d39f8eeb740e4b3f', '2019-04-09'),
(68, 'jhgjhg', 'jhgjhg@ww.pl', 'f86e71ceefd9440edf592a58da16a7481259b19a', '2019-06-20'),
(70, 'test', '10.1.26-MariaDB-0+deb9u1', 'djdhd', '0000-00-00'),
(71, 'test', '10.1.26-MariaDB-0+deb9u1', 'djdhd', '0000-00-00'),
(72, 'test1’,’test1’,(select password from mys', 'kjhjklhk@qp.pl', 'd0b53de0b87d9dc90b88e2931d6617058c6cb038', '2019-06-20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_ranga`
--

CREATE TABLE `user_ranga` (
  `id` int(30) NOT NULL,
  `id_u` int(40) NOT NULL,
  `id_r` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_ranga`
--

INSERT INTO `user_ranga` (`id`, `id_u`, `id_r`) VALUES
(3, 49, 1),
(14, 65, 3),
(15, 66, 1),
(16, 67, 2),
(17, 68, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_time`
--

CREATE TABLE `user_time` (
  `id` int(10) NOT NULL,
  `nick` varchar(40) DEFAULT NULL,
  `czas` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `azyl_posty`
--
ALTER TABLE `azyl_posty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_k` (`id_k`);

--
-- Indexes for table `azyl_zapytania`
--
ALTER TABLE `azyl_zapytania`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_kateg`
--
ALTER TABLE `forum_kateg`
  ADD PRIMARY KEY (`id_k`);

--
-- Indexes for table `forum_odpowiedzi`
--
ALTER TABLE `forum_odpowiedzi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_p` (`id_p`,`id_k`,`id_u`),
  ADD KEY `id_k` (`id_k`),
  ADD KEY `id_u` (`id_u`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranga`
--
ALTER TABLE `ranga`
  ADD PRIMARY KEY (`id_r`);

--
-- Indexes for table `user_bans`
--
ALTER TABLE `user_bans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_u` (`id_u`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nick` (`nick`);

--
-- Indexes for table `user_ranga`
--
ALTER TABLE `user_ranga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_u` (`id_u`),
  ADD KEY `id_r` (`id_r`),
  ADD KEY `id_u_2` (`id_u`);

--
-- Indexes for table `user_time`
--
ALTER TABLE `user_time`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `azyl_posty`
--
ALTER TABLE `azyl_posty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT dla tabeli `azyl_zapytania`
--
ALTER TABLE `azyl_zapytania`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `forum_kateg`
--
ALTER TABLE `forum_kateg`
  MODIFY `id_k` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `forum_odpowiedzi`
--
ALTER TABLE `forum_odpowiedzi`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT dla tabeli `ranga`
--
ALTER TABLE `ranga`
  MODIFY `id_r` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT dla tabeli `user_ranga`
--
ALTER TABLE `user_ranga`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT dla tabeli `user_time`
--
ALTER TABLE `user_time`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `azyl_posty`
--
ALTER TABLE `azyl_posty`
  ADD CONSTRAINT `azyl_posty_ibfk_1` FOREIGN KEY (`id_k`) REFERENCES `forum_kateg` (`id_k`);

--
-- Ograniczenia dla tabeli `forum_odpowiedzi`
--
ALTER TABLE `forum_odpowiedzi`
  ADD CONSTRAINT `forum_odpowiedzi_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `azyl_posty` (`id`),
  ADD CONSTRAINT `forum_odpowiedzi_ibfk_2` FOREIGN KEY (`id_k`) REFERENCES `azyl_posty` (`id_k`),
  ADD CONSTRAINT `forum_odpowiedzi_ibfk_3` FOREIGN KEY (`id_u`) REFERENCES `user_login` (`id`);

--
-- Ograniczenia dla tabeli `user_bans`
--
ALTER TABLE `user_bans`
  ADD CONSTRAINT `user_bans_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `user_login` (`id`);

--
-- Ograniczenia dla tabeli `user_ranga`
--
ALTER TABLE `user_ranga`
  ADD CONSTRAINT `user_ranga_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `user_login` (`id`),
  ADD CONSTRAINT `user_ranga_ibfk_2` FOREIGN KEY (`id_r`) REFERENCES `ranga` (`id_r`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
