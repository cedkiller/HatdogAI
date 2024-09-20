-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 02:46 PM
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
  `propmt_title` varchar(2000) DEFAULT NULL,
  `propmt_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propmt`
--

INSERT INTO `propmt` (`propmt_id`, `propmt_input`, `propmt_output`, `propmt_title`, `propmt_created`) VALUES
(1002, 'How many planet in the solar system and explain it 1 by 1', 'There are **eight** planets in our solar system:**1. Mercury**- **Closest to the Sun.**- Smallest planet.- No moons.- Rocky, cratered surface with very little atmosphere.- Extreme temperature swings between day and night.**2. Venus**- **Second closest to the Sun.**- Very hot and has a thick, toxic atmosphere of carbon dioxide, creating a runaway greenhouse effect.- Often called \"Earth\'s twin\" due to similar size and mass, but very different environment.- No moons.**3. Earth**- **Third planet from the Sun.**- Only known planet with life.- Has a thin atmosphere, liquid water, and a diverse biosphere.- Has one moon.**4. Mars**- **Fourth planet from the Sun.**- Known as the \"Red Planet\" due to the iron oxide (rust) on its surface.- Thin atmosphere, cold temperatures, and evidence of past liquid water.- Two small moons, Phobos and Deimos.**5. Jupiter**- **Largest planet in the solar system.**- A gas giant, primarily composed of hydrogen and helium.- Has a Great Red Spot, a massive storm that has raged for centuries.- 79 known moons, including the four largest (Io, Europa, Ganymede, and Callisto).**6. Saturn**- **Second largest planet.**- Famous for its prominent ring system, composed of ice and rock particles.- Also a gas giant, primarily composed of hydrogen and helium.- 82 known moons.**7. Uranus**- **Third largest planet.**- An ice giant, composed of mostly water, methane, and ammonia.- Rotates on its side, tilted at an angle of 98 degrees.- Has 27 known moons.**8. Neptune**- **Fourth largest planet.**- Another ice giant, with a similar composition to Uranus.- Has the strongest winds in the solar system.- 14 known moons.These eight planets are all in orbit around the Sun and are categorized based on their physical and chemical characteristics. They represent the diverse and fascinating objects that make up our solar system. ', NULL, '2024-09-20 11:14:20'),
(1003, 'what is sun', 'The Sun is a **star**, the closest one to Earth. It\'s a giant ball of hot, glowing gas, mostly hydrogen and helium, held together by its own gravity.Here\'s a breakdown of what makes the Sun so special:**Key Features:*** **Energy Source:** The Sun generates energy through nuclear fusion, where hydrogen atoms fuse together to form helium, releasing tremendous amounts of energy.* **Temperature:** The Sun\'s core reaches temperatures of around 27 million degrees Fahrenheit (15 million degrees Celsius). Its surface temperature is about 10,000 degrees Fahrenheit (5,500 degrees Celsius).* **Light and Heat:** The Sun emits light and heat that sustain life on Earth.* **Gravity:** The Sun\'s immense gravity holds the Earth and other planets in orbit around it.* **Magnetic Field:** The Sun has a powerful magnetic field that influences the solar system and can cause solar flares and coronal mass ejections.* **Solar Activity:** The Sun goes through cycles of activity, with periods of increased and decreased sunspot activity.**Importance to Earth:*** **Life:** The Sun is the ultimate source of energy for life on Earth. Its light provides energy for photosynthesis in plants, which form the basis of the food chain.* **Climate:** The Sun\'s heat drives Earth\'s climate system, influencing weather patterns and ocean currents.* **Day and Night:** The Earth\'s rotation around its axis causes the cycle of day and night, as different parts of the planet face the Sun.**Interesting Facts:*** The Sun is about 109 times wider than Earth.* It takes light from the Sun about 8 minutes to reach Earth.* The Sun will eventually run out of fuel and become a red giant star.The Sun is a fascinating object that plays a crucial role in our solar system. Its study helps us understand the universe and our place within it. ', NULL, '2024-09-20 11:20:45'),
(1004, 'How come that people can live in mars', 'Currently, people cannot live on Mars. While there are plans and ambitions for future human exploration and potential colonization of Mars, there are many significant challenges that need to be overcome before it becomes a habitable place for humans. Here are some of the major obstacles:**1. Atmosphere:*** **Thin Atmosphere:** The Martian atmosphere is extremely thin, about 100 times thinner than Earth\'s, making it impossible to breathe without a spacesuit. * **Lack of Oxygen:** The Martian atmosphere is primarily composed of carbon dioxide, with only trace amounts of oxygen.* **Harmful Radiation:** Mars\' thin atmosphere offers little protection from the Sun\'s harmful radiation, which can lead to cancer and other health problems.**2. Temperature:*** **Extreme Cold:** Mars experiences very cold temperatures, averaging around -63°C (-81°F). This requires special housing and clothing for human survival.**3. Water:*** **Limited Water:** While there is evidence of water ice on Mars, accessing and utilizing it for drinking and other purposes is a major challenge.* **Lack of Liquid Water:**  The surface of Mars is too cold for liquid water to exist in large quantities.**4. Gravity:*** **Low Gravity:** Mars\' gravity is only about 38% of Earth\'s gravity. This can have negative health effects on humans in the long term, including bone density loss and muscle atrophy.**5. Food and Resources:*** **Limited Food Sources:** Growing food on Mars would require significant technological advancements and resource utilization.* **Lack of Natural Resources:**  Mars is resource-poor compared to Earth, making it difficult to sustain a permanent colony.**6. Transportation:*** **Long Travel Time:** The journey to Mars takes months, requiring advanced spacecraft and life-support systems.* **Returning from Mars:**  The journey back to Earth is also long and expensive.**7. Psychological Challenges:*** **Isolation:**  Living in a confined space on a foreign planet can lead to psychological stre', NULL, '2024-09-20 12:15:31'),
(1005, 'tell me a joke', 'Why don\'t scientists trust atoms?Because they make up everything! ', NULL, '2024-09-20 12:19:52'),
(1006, 'another joke', 'Why don\'t scientists trust atoms?Because they make up everything! ', NULL, '2024-09-20 12:20:05'),
(1007, 'tell me another joke', 'Why don\'t scientists trust atoms? Because they make up everything! ', NULL, '2024-09-20 12:20:45'),
(1008, 'another joke', 'Why don\'t scientists trust atoms?Because they make up everything! ', NULL, '2024-09-20 12:21:05'),
(1009, 'tell me another joke', 'Why don\'t scientists trust atoms? Because they make up everything! ', NULL, '2024-09-20 12:21:14'),
(1010, 'Tell me a joke', 'Why don\'t scientists trust atoms? Because they make up everything! ', NULL, '2024-09-20 12:22:49'),
(1011, 'who is cedrick jasper sarabia', 'I do not have access to real-time information, including personal details about individuals like Cedrick Jasper Sarabia. To find information about a specific person, you could try:* **Searching online:** Use a search engine like Google and include their full name and any other relevant details you know (like location, profession, etc.).* **Social media:** Check platforms like Facebook, LinkedIn, or Instagram for profiles under that name.* **Public records:** If you are looking for information like court records or property ownership, you might find it on government websites or specialized databases. Remember to be respectful of people\'s privacy and avoid sharing personal information without their consent. ', NULL, '2024-09-20 12:23:15'),
(1012, 'tell me a joke', 'Why don\'t scientists trust atoms?Because they make up everything! ', NULL, '2024-09-20 12:25:08'),
(1013, 'what is data visualization', 'Data visualization is the process of **representing data visually** using charts, graphs, maps, and other visual elements. It\'s about **transforming raw data into meaningful insights** that are easy to understand and interpret. Here\'s a breakdown of what data visualization is about:**Purpose:*** **Understanding complex data:**  Visuals can help reveal patterns, trends, and relationships that might be hidden in raw data.* **Communicating insights effectively:** Visuals are more engaging and easier to understand than tables of numbers.* **Making data-driven decisions:**  Visualizing data can support better decision-making by providing a clear picture of the situation.**Methods:*** **Charts and graphs:** Bar charts, pie charts, line graphs, scatter plots, histograms, etc.* **Maps:** Geographic data can be visualized to show spatial relationships and distribution.* **Infographics:** Combining visuals with text to tell a story about the data.* **Dashboards:** Interactive interfaces that allow users to explore and manipulate data visually.**Benefits:*** **Increased understanding:** Visualizations make it easier for people to grasp complex data.* **Improved communication:** Data can be communicated more effectively to a wider audience.* **Enhanced decision-making:**  Visuals can provide the insights needed to make informed decisions.* **Data exploration:**  Visualizations can be used to discover hidden patterns and relationships in data.**Examples:*** **A bar chart showing the sales performance of different products.*** **A map displaying the distribution of population across a country.*** **An infographic summarizing the key findings of a research study.*** **A dashboard showing real-time performance metrics for a business.****In summary:** Data visualization is a powerful tool for exploring, understanding, and communicating data. It plays a crucial role in helping people make sense of the world around them and make better decisions.', NULL, '2024-09-20 12:42:49'),
(1014, 'give me a formula on how to compute a mean in chapter 4 of thesis', 'The formula for computing the mean in Chapter 4 of your thesis depends on the type of data you are working with:**1.  For a sample of numerical data:**```Mean (x̄) = Σx / n```Where:* **x̄** represents the sample mean* **Σx** is the sum of all data points in the sample* **n** is the number of data points in the sample**2.  For a population of numerical data:**```Mean (μ) = Σx / N```Where:* **μ** represents the population mean* **Σx** is the sum of all data points in the population* **N** is the number of data points in the population**3.  For grouped data:**```Mean (x̄) = Σ(f * x) / Σf```Where:* **x̄** represents the sample mean* **f** is the frequency of each data point* **x** is the midpoint of each data group* **Σ(f * x)** is the sum of the products of frequency and midpoint for each group* **Σf** is the total frequency**Example of using the formula in your Chapter 4:**\"The mean age of participants in the study was calculated using the formula x̄ = Σx / n. The sum of all participants\' ages (Σx) was 1234, and the total number of participants (n) was 30. Therefore, the mean age was 1234 / 30 = 41.13 years.\"**Additional points to consider:*** **Specify the type of mean you are calculating:**  Make it clear whether you are calculating the sample mean (x̄) or the population mean (μ).* **State the units of measurement:** For example, if your data is in years, make sure to include \"years\" in your result.* **Present the mean with appropriate significant figures:** This will depend on the precision of your data.* **Provide a clear and concise explanation of how you calculated the mean:**  This will help your readers understand your results.Remember to adjust the formula and explanation according to the specific data and context of your research. ', NULL, '2024-09-20 12:45:16');

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
(1000, 'Cedrick Jasper R. Sarabia', 'cedrickjaspersarabia@gmail.com', '$2y$10$gy/heLPdyxz.BxPKhztssuNB/bZr/SpVqMcczR/AxiNaMUwKsNmcS', '2024-09-09 22:49:18'),
(1002, 'Ramon Rodriguez', 'ramon091717171@gmail.com', '$2y$10$JpNUxk20ey.8g0HhGhRCt.Xr35qsDAcb6TBcARHe4Y96rPvUV56b.', '2024-09-19 00:54:58');

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
  MODIFY `propmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
