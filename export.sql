-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2020 at 11:17 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `disc_name` varchar(100) NOT NULL,
  `disc_year` varchar(100) NOT NULL,
  `disc_label` varchar(255) NOT NULL,
  `disc_genre` varchar(255) NOT NULL,
  `disc_prix` varchar(4) NOT NULL,
  `disc_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `disc_name`, `disc_year`, `disc_label`, `disc_genre`, `disc_prix`, `disc_image`) VALUES
(314, 'Hatez', '2006', 'Nuclear Blast', 'Deathcore', '19', 'assets/img/local/Hatez.jpg'),
(315, 'Restoring Force', '2011', 'Independant', 'Metalcore', '20', 'assets/img/local/Restoring Force.jpg'),
(316, 'Hexada', '2014', 'Ghostemane', 'Trap metal', '5', 'assets/img/local/Hexada.jpg'),
(317, 'Infinity', '2018', 'AWA', 'Trap metal', '29', 'assets/img/local/Infinity.jpg'),
(318, 'Projet Blue Beam', '2018', 'Independant', 'Trap', '15', 'assets/img/local/Projet Blue Beam.jpg'),
(319, 'La zone en personne', '2019', 'Or et de platine', 'Hip-Hop', '1', 'assets/img/local/La zone en personne.jpg'),
(320, 'Fury', '2020', 'Bvdlvd', 'Trap metal', '19', 'assets/img/local/Fury.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;
