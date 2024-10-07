-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 01:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotdogai`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_ created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_ created`) VALUES
(1, 'admin@gmail.com', '123', '2024-09-09 00:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `propmt`
--

CREATE TABLE `propmt` (
  `propmt_id` int(11) NOT NULL,
  `propmt_input` varchar(2000) NOT NULL,
  `propmt_output` varchar(2000) NOT NULL,
  `propmt_title_id` int(11) DEFAULT NULL,
  `propmt_user_id` int(11) DEFAULT NULL,
  `propmt_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propmt`
--

INSERT INTO `propmt` (`propmt_id`, `propmt_input`, `propmt_output`, `propmt_title_id`, `propmt_user_id`, `propmt_created`) VALUES
(1045, 'What is the gravity of the earth', 'The gravity of the Earth is not a single number, but rather a measure of its **gravitational acceleration**. Here\'s why:* **Gravitational acceleration** is the rate at which objects fall towards the Earth due to its gravitational pull. This value is **approximately 9.81 meters per second squared (m/s²) at the Earth\'s surface**.* **Gravity** itself is a force that attracts objects with mass towards each other. The strength of this force depends on the masses of the objects and the distance between them.**Important factors influencing gravitational acceleration:*** **Altitude:** The higher you are from the Earth\'s surface, the weaker the gravitational force becomes.* **Latitude:** The gravitational acceleration is slightly higher at the poles and lower at the equator due to the Earth\'s oblate shape.* **Local density variations:** Variations in the Earth\'s density can cause slight differences in gravitational acceleration at different locations.Therefore, the \"gravity of the Earth\" is often expressed as **standard gravity**, which is **9.80665 m/s²** and is a standard value used for calculations and comparisons. ', 9, 1007, '2024-09-28 01:02:24'),
(1046, 'tell me a joke', 'Why don\'t scientists trust atoms? Because they make up everything! ', 9, 1007, '2024-09-28 01:02:28'),
(1047, 'How many planet in the solar system and explain it 1 by 1', 'There are **eight** planets in our solar system:**1. Mercury:*** **Closest to the Sun:** Mercury is the smallest and fastest planet in our solar system.* **Rocky and cratered:** It has a heavily cratered surface, indicating a long history of impacts.* **No atmosphere:**  It has a very thin atmosphere, making it extremely hot during the day and extremely cold at night.**2. Venus:*** **Earth\'s \"twin\" in size:** Venus is similar in size and mass to Earth, but its surface is vastly different.* **Extremely hot and toxic:** Its atmosphere is incredibly dense, trapping heat and creating a runaway greenhouse effect, resulting in extremely high temperatures.* **Slow retrograde rotation:** Venus spins in the opposite direction to most other planets in the solar system.**3. Earth:*** **The only known planet with life:** Earth is the only planet in our solar system known to harbor life.* **Liquid water and atmosphere:** The presence of liquid water and a breathable atmosphere are crucial for life as we know it.* **Active geology:** Earth has active tectonic plates, volcanoes, and erosion, shaping its surface.**4. Mars:*** **The \"Red Planet\":** Mars gets its color from iron oxide in its soil.* **Thin atmosphere:**  It has a thin atmosphere, making it much colder than Earth.* **Evidence of past water:**  There is evidence suggesting that Mars once had liquid water on its surface.**5. Jupiter:*** **The largest planet:**  Jupiter is a gas giant with a diameter 11 times that of Earth.* **Great Red Spot:** A massive storm on Jupiter, larger than Earth, that has raged for centuries.* **Many moons:**  Jupiter has 79 known moons, the largest being Ganymede, which is even bigger than Mercury.**6. Saturn:*** **The ringed planet:** Saturn\'s iconic ring system is made up of ice and rock particles.* **Gas giant:**  Like Jupiter, Saturn is a gas giant composed mostly of hydrogen and helium.* **Many moons:**  Saturn has 82 known moons, including Titan, which has a thick atmosphere.**7. Uranus:', 9, 1007, '2024-09-28 01:02:40'),
(1048, 'How many planet in the solar system and explain it 1 by 1', 'There are **eight** planets in our solar system. Here\'s a breakdown of each:**1. Mercury:*** The smallest planet in our solar system.* Closest to the sun, making it very hot.* Rocky and cratered surface.* No moons.* Has a very thin atmosphere.**2. Venus:*** Often called Earth\'s \"twin\" because of its size and density.* Extremely hot due to a runaway greenhouse effect.* Has a dense, toxic atmosphere.* Rotates very slowly in the opposite direction to most planets.* No moons.**3. Earth:*** The only known planet to harbor life.* Has a diverse atmosphere and surface.* Contains liquid water, which is essential for life.* Has one moon.**4. Mars:*** Known as the \"Red Planet\" due to its rusty iron oxide surface.* Has a thin atmosphere and is much colder than Earth.* Evidence suggests that liquid water once flowed on its surface.* Has two tiny moons, Phobos and Deimos.**5. Jupiter:*** The largest planet in our solar system.* A gas giant, primarily composed of hydrogen and helium.* Has a faint ring system and a powerful magnetic field.* Hosts 79 known moons, including the four largest, called the Galilean moons.**6. Saturn:*** Known for its magnificent ring system, which is made of ice and rock.* A gas giant, primarily composed of hydrogen and helium.* Has a faint magnetic field.* Hosts 82 known moons, including Titan, which has a dense atmosphere.**7. Uranus:*** An ice giant, composed mostly of ice and rock.* Has a tilted axis, causing its seasons to be extreme.* Has faint rings and a weak magnetic field.* Hosts 27 known moons.**8. Neptune:*** The farthest planet from the sun.* Another ice giant, composed of ice and rock.* Has powerful winds and a strong magnetic field.* Hosts 14 known moons. ', 10, 1008, '2024-09-28 01:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `title_id` int(11) NOT NULL,
  `title_name` varchar(2000) NOT NULL,
  `title_user_name` varchar(255) NOT NULL,
  `title_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`title_id`, `title_name`, `title_user_name`, `title_created`) VALUES
(9, 'Hello World!', 'Cedrick Jasper R. Sarabia', '2024-09-28 01:02:17'),
(10, 'New', 'Ramon Rodriguez', '2024-09-28 01:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_created`) VALUES
(1007, 'Cedrick Jasper R. Sarabia', 'cedrickjaspersarabia@gmail.com', '$2y$10$QC8D2iuSwyg2HelxzGPSZuA.ABXtjTP1a21DY/3SHPqC2zHxNoUf6', '2024-09-28 01:02:01'),
(1008, 'Ramon Rodriguez', 'ramon091717171@gmail.com', '$2y$10$JDgWOdISd1Clq80x9Zy9Duznfl/fwjsMK1vQ4CdNIwdtrZvc4YtQC', '2024-09-28 01:04:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `propmt`
--
ALTER TABLE `propmt`
  ADD PRIMARY KEY (`propmt_id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `propmt`
--
ALTER TABLE `propmt`
  MODIFY `propmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1049;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
