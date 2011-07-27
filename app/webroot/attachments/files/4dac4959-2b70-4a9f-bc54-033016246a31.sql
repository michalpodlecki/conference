-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 03 Kwi 2011, 16:35
-- Wersja serwera: 5.5.8
-- Wersja PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `nppppl_conference`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` char(36) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deadline` datetime NOT NULL,
  `status_id` tinyint(2) unsigned NOT NULL,
  `abstract` text COLLATE utf8_bin NOT NULL,
  `keywords` varchar(128) COLLATE utf8_bin NOT NULL,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `article_file_path` varchar(64) COLLATE utf8_bin NOT NULL,
  `article_file_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `article_file_size` int(11) NOT NULL,
  `article_content_type` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `articles`
--

