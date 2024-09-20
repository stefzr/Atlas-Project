-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 17 Φεβ 2023 στις 22:21:44
-- Έκδοση διακομιστή: 10.4.27-MariaDB
-- Έκδοση PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `sdi1900076`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `status` enum('temporarily_saved','pending','approved','rejected') NOT NULL,
  `performance_report` varchar(150) DEFAULT NULL,
  `interest_description` text DEFAULT NULL,
  `rejection_message` text DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `internship_posting_id` int(11) NOT NULL,
  `date_of_modification` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `application`
--

INSERT INTO `application` (`id`, `status`, `performance_report`, `interest_description`, `rejection_message`, `student_id`, `internship_posting_id`, `date_of_modification`) VALUES
(2, 'pending', '32_4_YS08-EAM_2022-2023_Ergasia_Askisi3_Ekfonisi.pdf', 'Στέφανος Καρέγλης', 'Η θέση έχει καλυφθεί', 32, 4, '2023-01-22 16:26:42'),
(9, 'approved', '33_3_README.pdf', 'Software Engineer - Αλέξανδρος Ντιβέρης', 'Έλλειψη γνώσεων που σχετίζονται με τον κλάδο.', 33, 3, '2023-01-23 06:56:51'),
(10, 'pending', '1_5_YS08-EAM_2022-2023_Ergasia_Askisi3_Ekfonisi (1).pdf', 'Έχοντας αφιερώσει χρόνο ως αρχάριος στον τομέα του web development, παραθέτω το προσωπικό GitHub λογαριασμο: github.com/nick_pap, που περιλαμβάνει διάφορα Projects τα οποία έχουν εφαρμογές και στον πραγματικό κόσμο. Επιπλέον, παραθέτω και το Linkedin προφίλ μου, στο οποίο απεικονίζεται η βεβαίωση συμμετοχής που έλαβα σε Google Bootcamp με θεματικό άξονα το web development: gr.linkedin.com/in/nick-papadopoulos. Τέλος, θεωρώ ότι χαρακτηρίζομαι από ομαδικό πνεύμα, καθώς έχω συμμετάσχει σε άρκετα ομαδικά projects στα πλαίσια των προπτυχιακών σπουδών μου, ακόμη και με ομάδες προγραμματιστών του εξωτερικού.', 'Χαμηλές επιδόσεις σε μαθήματα που θεωρούνται απαραίτητα για τη θέση.', 1, 5, '2023-01-23 02:09:11');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `internship_posting`
--

CREATE TABLE `internship_posting` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `duration` enum('3-Months','6-Months') NOT NULL,
  `wage` int(11) NOT NULL,
  `employment_type` enum('Part-Time','Full-Time') NOT NULL,
  `location` varchar(45) NOT NULL,
  `start_date_of_internship` date NOT NULL,
  `internship_provider_id` int(11) NOT NULL,
  `status` enum('temporarily_saved','submitted','completed') NOT NULL,
  `description` text DEFAULT NULL,
  `date_of_modification` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `internship_posting`
--

INSERT INTO `internship_posting` (`id`, `title`, `duration`, `wage`, `employment_type`, `location`, `start_date_of_internship`, `internship_provider_id`, `status`, `description`, `date_of_modification`) VALUES
(3, 'Software Engineer', '6-Months', 890, 'Part-Time', 'Αθήνα - Κέντρο', '2023-02-10', 12, 'completed', 'Άρτιος χειρισμός γραπτού και προφορικού λόγου\nΙκανότητα για ανάληψη ευθυνών και πρωτοβουλιών\nΟμαδικό πνεύμα στο χώρο εργασίας\nΆριστη γνώση αγγλικών για την επικοινωνία με άλλους κλάδους της επιχείρησης', '2023-01-23 06:56:51'),
(4, 'Web Developer', '3-Months', 750, 'Full-Time', 'Θεσσαλονίκη - Κέντρο', '2023-03-10', 12, 'submitted', 'Ως Full stack web developer, θα ενταχθείς στην ομάδα για την ανάπτυξη Full Stack Java Web applications. Θα αναφέρεσαι στον Team Leader, και θα συμμετέχεις στην ανάπτυξη τμημάτων ή και ολόκληρων εφαρμογών. Επιπλέον θα συμμετέχεις στον σχεδιασμό και την ανάλυση Java εφαρμογών (tailor made) ή στην ανάπτυξη προϊόντων και λύσεων. Ως full stack developer θα είσαι υπεύθυνος για την ανάπτυξη Web εφαρμογών και βιβλιοθηκών, αυτόνομα ή σε ομάδα. Στο πλαίσιο των καθηκόντων σου θα περιλαμβάνονται code reviews, code assignments και task delegation, συμμετοχή στην ανάπτυξη test cases, καταγραφή απαιτήσεων και μεταφορά στην ομάδα ανάπτυξης.', '2023-01-22 16:26:42'),
(5, 'Backend Developer', '6-Months', 908, 'Part-Time', 'Θεσσαλονίκη - Άνω Τούμπα', '2023-01-29', 29, 'submitted', 'Συνεχής εκπαίδευση σε νέες τεχνολογίες του κλάδου\nΑνταγωνιστικός χώρος εργασίας, με παρακολούθηση από προσωπικό μέντορα\nΧρηματικό μπόνους για την επίτευξη υψηλών επιδόσεων\nΠροοπτική μονιμοποίησης με το πέρας της πρακτικής άσκησης', '2023-01-23 02:09:11');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `internship_posting_has_university_departments`
--

CREATE TABLE `internship_posting_has_university_departments` (
  `internship_posting_id` int(11) NOT NULL,
  `university_department` varchar(90) NOT NULL,
  `university_name` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `internship_posting_has_university_departments`
--

INSERT INTO `internship_posting_has_university_departments` (`internship_posting_id`, `university_department`, `university_name`) VALUES
(3, 'Πληροφορικής και Τηλεπικοινωνιών', 'Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών'),
(4, 'Πληροφορικής', 'Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης'),
(5, 'Πληροφορικής', 'Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `date_of_modification` datetime NOT NULL,
  `read_by_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `notification`
--

INSERT INTO `notification` (`id`, `student_id`, `application_id`, `date_of_modification`, `read_by_user`) VALUES
(2, 33, 9, '2023-01-23 06:46:00', 1),
(3, 33, 9, '2023-01-23 06:48:52', 1),
(4, 33, 9, '2023-01-23 06:56:51', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `university`
--

CREATE TABLE `university` (
  `name` varchar(90) NOT NULL,
  `name_abbreviation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `university`
--

INSERT INTO `university` (`name`, `name_abbreviation`) VALUES
('Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης', 'ΑΠΘ'),
('Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών', 'ΕΚΠΑ'),
('Πανεπιστήμιο Πειραιώς', 'ΠΑΠΕΙ');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `university_department`
--

CREATE TABLE `university_department` (
  `name` varchar(90) NOT NULL,
  `university_name` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `university_department`
--

INSERT INTO `university_department` (`name`, `university_name`) VALUES
('Μαθηματικό', 'Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης'),
('Μαθηματικό', 'Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών'),
('Οργάνωσης και Διοίκησης Επιχειρήσεων ', 'Πανεπιστήμιο Πειραιώς'),
('Πληροφορικής', 'Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης'),
('Πληροφορικής και Τηλεπικοινωνιών', 'Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών'),
('Φυσικής', 'Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `student_id` varchar(13) DEFAULT NULL,
  `university_name` varchar(90) DEFAULT NULL,
  `university_department` varchar(90) DEFAULT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `user_type` enum('student','internship_provider') NOT NULL,
  `tax_id` varchar(9) DEFAULT NULL,
  `company_name` varchar(60) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `user`
--

INSERT INTO `user` (`id`, `student_id`, `university_name`, `university_department`, `first_name`, `last_name`, `user_type`, `tax_id`, `company_name`, `email`, `password`) VALUES
(1, '1115202200555', 'Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης', 'Πληροφορικής', 'Νίκος', 'Παπαδόπουλος', 'student', NULL, NULL, 'nick_pap@gmail.com', 'password'),
(12, NULL, NULL, NULL, 'Jod', 'Doj', 'internship_provider', '123456789', 'Google', 'google@gmail.com', 'password'),
(29, NULL, NULL, NULL, 'Joe', 'Doe', 'internship_provider', '123456780', 'Microsoft', 'microsoft@outlook.com', 'password'),
(32, '1115201900076', 'Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών', 'Πληροφορικής και Τηλεπικοινωνιών', 'Στέφανος', 'Καρέγλης', 'student', NULL, NULL, 'sdi1900076@di.uoa.gr', 'password'),
(33, '1115201900136', 'Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών', 'Πληροφορικής και Τηλεπικοινωνιών', 'Αλέξανδρος', 'Ντιβέρης', 'student', NULL, NULL, 'sdi1900136@di.uoa.gr', 'password');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `internship_posting_id` (`internship_posting_id`);

--
-- Ευρετήρια για πίνακα `internship_posting`
--
ALTER TABLE `internship_posting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internship_provider_constraint` (`internship_provider_id`);

--
-- Ευρετήρια για πίνακα `internship_posting_has_university_departments`
--
ALTER TABLE `internship_posting_has_university_departments`
  ADD PRIMARY KEY (`internship_posting_id`,`university_department`,`university_name`);

--
-- Ευρετήρια για πίνακα `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stud` (`student_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Ευρετήρια για πίνακα `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`name`);

--
-- Ευρετήρια για πίνακα `university_department`
--
ALTER TABLE `university_department`
  ADD PRIMARY KEY (`name`,`university_name`),
  ADD KEY `uni_name` (`university_name`);

--
-- Ευρετήρια για πίνακα `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `university_name` (`university_name`,`university_department`),
  ADD KEY `uni_constraints` (`university_department`,`university_name`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT για πίνακα `internship_posting`
--
ALTER TABLE `internship_posting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT για πίνακα `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `internship_posting_id` FOREIGN KEY (`internship_posting_id`) REFERENCES `internship_posting` (`id`),
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);

--
-- Περιορισμοί για πίνακα `internship_posting`
--
ALTER TABLE `internship_posting`
  ADD CONSTRAINT `internship_provider_constraint` FOREIGN KEY (`internship_provider_id`) REFERENCES `user` (`id`);

--
-- Περιορισμοί για πίνακα `internship_posting_has_university_departments`
--
ALTER TABLE `internship_posting_has_university_departments`
  ADD CONSTRAINT `internship_posting_constraint` FOREIGN KEY (`internship_posting_id`) REFERENCES `internship_posting` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `application_id` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`),
  ADD CONSTRAINT `stud` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);

--
-- Περιορισμοί για πίνακα `university_department`
--
ALTER TABLE `university_department`
  ADD CONSTRAINT `uni_name` FOREIGN KEY (`university_name`) REFERENCES `university` (`name`);

--
-- Περιορισμοί για πίνακα `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `uni_constraints` FOREIGN KEY (`university_department`,`university_name`) REFERENCES `university_department` (`name`, `university_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
