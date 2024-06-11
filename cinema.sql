-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 14 Ιαν 2024 στις 11:40:11
-- Έκδοση διακομιστή: 10.4.28-MariaDB
-- Έκδοση PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `cinema`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `movies`
--

INSERT INTO `movies` (`id`, `name`, `image`) VALUES
(17, 'Sherlock Holmes', 'https://c4.wallpaperflare.com/wallpaper/714/457/193/sherlock-holmes-sherlock-holmes-movie-poster-wallpaper-preview.jpg'),
(18, 'Lord Of The Rings', 'https://wallpapers.com/images/featured-full/lord-of-the-rings-xkk6fx6q0v4ykcr6.jpg'),
(19, 'Game Of Thrones', 'https://wallpapers.com/images/featured-full/game-of-thrones-92acb30ilmkjbmu9.jpg'),
(20, 'interstellar', 'https://w0.peakpx.com/wallpaper/407/697/HD-wallpaper-interstellar-movie-wide-interstellar-movies.jpg'),
(21, 'Oppenheimer', 'https://m.media-amazon.com/images/M/MV5BMDBmYTZjNjUtN2M1MS00MTQ2LTk2ODgtNzc2M2QyZGE5NTVjXkEyXkFqcGdeQXVyNzAwMjU2MTY@._V1_.jpg'),
(22, 'Inception', 'https://m.media-amazon.com/images/M/MV5BMjExMjkwNTQ0Nl5BMl5BanBnXkFtZTcwNTY0OTk1Mw@@._V1_.jpg'),
(23, 'Gladiator', 'https://c4.wallpaperflare.com/wallpaper/33/658/347/gladiator-movie-movies-wallpaper-preview.jpg'),
(24, 'Mission Impossible', 'https://images5.alphacoders.com/131/1317575.jpeg');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `status` enum('pending','refused','approved') NOT NULL,
  `user_id` int(11) NOT NULL,
  `views_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `requests`
--

INSERT INTO `requests` (`id`, `status`, `user_id`, `views_id`) VALUES
(1, 'refused', 5, 4),
(2, 'approved', 5, 6),
(3, 'approved', 5, 5),
(4, 'refused', 6, 4),
(5, 'refused', 6, 5),
(6, 'refused', 6, 7),
(7, 'approved', 6, 8),
(8, 'approved', 6, 9),
(9, 'refused', 6, 4),
(10, 'pending', 5, 10),
(13, 'pending', 5, 10),
(14, 'pending', 5, 9),
(15, 'approved', 5, 7),
(16, 'pending', 2, 5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `usertype`) VALUES
(2, 'admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@admin.com', 'admin'),
(3, 'customerone', 'customer1', '81dc9bdb52d04dc20036dbd8313ed055', 'cust1@test.com', 'customer'),
(4, 'customertwo', 'customer2', '81dc9bdb52d04dc20036dbd8313ed055', 'cust2@test.com', 'customer'),
(5, 'customer3', 'cust3', '81dc9bdb52d04dc20036dbd8313ed055', 'cust3@movie.com', 'customer'),
(6, 'anna', 'anna97', '81dc9bdb52d04dc20036dbd8313ed055', 'annamur@hotmail.gr', 'customer');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `seats` int(50) NOT NULL,
  `lobby` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `movieFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `views`
--

INSERT INTO `views` (`id`, `seats`, `lobby`, `date`, `movieFK`) VALUES
(1, 100, 'B', '25/12/23', 18),
(2, 2, 'A', '24/12/24', 18),
(3, 90, 'F', '25/12/24 12:00 AM', 19),
(4, 74, 'B', '08/11/24', 18),
(5, 39, 'G', '09/12/99', 17),
(6, 13, 'D', '12/01/2024', 21),
(7, 14, 'F', '04/01/24', 21),
(8, 40, 'C', '10/04/24', 23),
(9, 99, 'F', '04/04/24', 22),
(10, 100, 'C', '05/05/24', 20),
(11, 100, 'A', '14/03/24', 24),
(12, 50, 'B', '25/02/2024', 24);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ForeignKey` (`movieFK`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT για πίνακα `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT για πίνακα `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `ForeignKey` FOREIGN KEY (`movieFK`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
