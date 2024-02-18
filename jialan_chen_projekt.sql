-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Nov 2023 um 13:59
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `jialan_chen_projekt`
--
CREATE DATABASE IF NOT EXISTS `jialan_chen_projekt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jialan_chen_projekt`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `parent_id`, `comment`, `created_at`) VALUES
(1, 2, 0, '\r\nIch empfehle allen, nach Thailand zu reisen, denn die Preise sind wirklich günstig und die Einheimischen lächeln gerne.', '2023-11-15 21:09:03'),
(2, 3, 0, 'Im Sommer sollte man auf keinen Fall nach Ägypten reisen, denn die Temperaturen können bis zu vierzig Grad Celsius erreichen, und es besteht die Gefahr, sich wirklich zu überhitzen.', '2023-11-15 21:09:03'),
(3, 1, 0, 'Der Winter in Deutschland ist wirklich sehr kalt und kann die Stimmung beeinträchtigen. Wir brauchen einen Urlaub auf einer tropischen Insel.', '2023-11-15 21:11:06'),
(4, 4, 0, 'Ich habe Angst davor, in die USA zu reisen, weil ich Schießereien fürchte. Gibt es jemanden, der bereit ist, mit mir in die USA zu reisen?', '2023-11-15 21:11:06'),
(5, 1, 0, '\r\nIch habe immer davon geträumt, nach Island zu reisen, aber ich habe gehört, dass man im Winter das Nordlicht sehen kann. Allerdings ist das Selbstfahren sehr gefährlich, weil die Straßen vereist sind. Im Sommer ist das Wetter zwar gut, aber es gibt kein Nordlicht, und außerdem ist der Sommer die Hochsaison für Tourismus, was zu hohen Kosten führt.', '2023-11-15 21:13:57'),
(6, 1, 4, 'Ich würde auch gerne in die USA reisen. Wann planst du zu gehen? Ich beabsichtige, nach Los Angeles, New York und den Nationalparks im Westen zu reisen. Vielleicht könnten wir gemeinsam eine Selbstfahrt machen.', '2023-11-15 21:13:57'),
(7, 2, 0, '\r\nDie Preise in der Türkei sind wirklich immer höher geworden, und sie neigen dazu, Touristen viel Geld abzunehmen, was mir wirklich unangenehm ist. Obwohl Kappadokien wirklich wunderschön ist, muss ich ständig auf Betrüger aufpassen. Die Reiseerfahrung ist wirklich nicht so gut.\r\n\r\n\r\n\r\n\r\n\r\n', '2023-11-15 21:16:34'),
(8, 3, 1, 'Ich mag Thailand auch sehr, besonders Phuket. Es ist wirklich preiswert und die Produkte sind von guter Qualität.', '2023-11-15 21:16:34'),
(9, 4, 3, 'Ich verbringe einige Zeit im deutschen Winter an verschiedenen Orten. Manchmal besuche ich die Inseln Spaniens, manchmal Malaysia, Ägypten und andere Orte. Ich empfehle, Flugtickets im Voraus zu buchen, es kann wirklich viel Geld sparen.', '2023-11-16 11:44:28');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nachname` varchar(250) NOT NULL,
  `vorname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `portrait` varchar(250) DEFAULT 'dummy.jpg',
  `birthday` date DEFAULT NULL,
  `countries_number` int(11) DEFAULT NULL,
  `footprint` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `info` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `nachname`, `vorname`, `email`, `password`, `portrait`, `birthday`, `countries_number`, `footprint`, `title`, `info`, `created_at`, `updated_at`) VALUES
(1, 'Chen', 'Jialan', 'jialan@jialan.de', '$2y$10$6MsG6KuDp/NuKDpkZWgWrumTV9flh2RdoqzbH0wAQgT1VXkXha/K6', 'jialan.jpg', '1993-11-09', 30, 'Neuseeland, Israel, Finnland, Türkei, Japan,  Kroatien,  Estland, Thailand...', 'Reiseerfahrungen auf der Südinsel Neuseelands teilen', 'Meine Reise auf der Südinsel Neuseelands war atemberaubend. Die landschaftliche Vielfalt beeindruckte mich zutiefst. Von den majestätischen Southern Alps bis zu den malerischen Fjorden war jeder Anblick einfach fantastisch. Die freundlichen Einheimischen trugen ebenfalls zu meiner unvergesslichen Erfahrung bei. Ich erkundete das charmante Queenstown, genoss die Ruhe am Lake Tekapo und wanderte durch die üppigen Regenwälder am Fiordland-Nationalpark. Die malerischen Küsten, schroffen Berggipfel und glitzernden Seen schufen eine unvergleichliche Kulisse. Neuseeland ist ein Paradies für Naturliebhaber, und die Südinsel ist ein wahr gewordener Traum für Abenteuerlustige wie mich.', '2023-11-14 12:32:40', '2023-11-15 13:58:22'),
(2, 'Bladford', 'Tim', 'tim@tim.de', '$2y$10$EJ4Oww8UFd.37PO9i7Buju2Huk/Rcc2ZQSQ6In63cnUQZTLBgL68.', 'tim.jpg', '1988-07-13', 18, 'Deutschland, Frankreich, Spanien, Italien, Griechenland, Schweden, Norwegen, Dänemark...', 'Meine zehntägige Reise nach Hawaii', 'Meine Reise nach Hawaii war ein unvergessliches Abenteuer. Die atemberaubenden Strände, das türkisblaue Wasser und die entspannte Atmosphäre haben mich fasziniert. Ich erkundete die Vulkanlandschaft, bestieg den Mauna Kea, genoss farbenfrohe Sonnenuntergänge und erlebte die traditionelle hawaiianische Kultur. Die Aloha-Spirit der Einheimischen machte die Reise besonders herzlich. Ob Schnorcheln im klaren Wasser, Wandern durch üppige Dschungel oder Luau-Abende, Hawaii bot eine Vielzahl von Erlebnissen. Diese Inseln haben mein Herz erobert, und ich kehrte mit unvergesslichen Erinnerungen und einem Gefühl der inneren Ruhe zurück.', '2023-11-14 12:39:52', '2023-11-14 12:39:52'),
(3, 'Nolan', 'John', 'john@john.de', '$2y$10$EJ4Oww8UFd.37PO9i7Buju2Huk/Rcc2ZQSQ6In63cnUQZTLBgL68.', 'john.jpg', '1984-05-16', 25, 'Portugal, Niederlande, Belgien, Österreich, Schweiz, Polen, Tschechien, Ungarn.', 'Ich liebe die thailändische Küche', 'Meine kulinarische Entdeckungsreise in Thailand war einfach fantastisch. Die Vielfalt der Aromen und exotischen Gewürze hat meine Geschmacksknospen verzaubert. Von den würzigen Straßengerichten in Bangkok bis zu den frischen Meeresfrüchten auf den Inseln war jede Mahlzeit ein Fest für die Sinne. Der Duft von Kokosmilch, Zitronengras und Koriander begleitete mich überall. In den lokalen Märkten probierte ich Pad Thai, Som Tum und aromatische Currys. Die Gastfreundschaft der Menschen und die lebendige Atmosphäre machten das Essen zu einem kulturellen Erlebnis. Thailand hat nicht nur beeindruckende Landschaften, sondern auch eine köstliche Küche, die mich nachhaltig beeindruckt hat.', '2023-11-14 12:39:52', '2023-11-14 12:39:52'),
(4, 'Chou', 'Jay', 'jay@jay.de', '$2y$10$EJ4Oww8UFd.37PO9i7Buju2Huk/Rcc2ZQSQ6In63cnUQZTLBgL68.', 'jay.jpg', '1995-12-13', 39, ' China,  Indien, Japan, Südkorea,  Indonesien, Vietnam,  Saudi-Arabien...', 'Willkommen in Beijing für deine Reise', 'Die Verbindung von traditioneller Kultur und modernem Flair in Beijing,China ist beeindruckend. Die Verbotene Stadt, die Große Mauer und der Himmelstempel erzählen Geschichten aus der Vergangenheit. Das lebendige Treiben in den Hutongs vermittelt den Puls der Stadt. Die köstliche Pekingente und vielfältige Dim Sum sind kulinarische Höhepunkte. Die freundlichen Menschen und ihre Gastfreundschaft haben meinen Aufenthalt unvergesslich gemacht. Peking, mit seiner einzigartigen Mischung aus Geschichte und Gegenwart, ist ein wahrhaft inspirierendes Reiseziel.', '2023-11-14 12:44:48', '2023-11-14 12:44:48');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_von_users` (`user_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_id_von_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
