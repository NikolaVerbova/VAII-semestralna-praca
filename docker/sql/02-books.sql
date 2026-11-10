-- Kniha patrí do jednej miestnosti (1:N). Pri zmazaní miestnosti ostane kniha bez miestnosti.
CREATE TABLE `books`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `title`       VARCHAR(150) NOT NULL,
    `author`      VARCHAR(100) NOT NULL,
    `publishYear` INT          NULL,
    `shelf`       VARCHAR(30)  NULL,
    `isAvailable` TINYINT(1)   NOT NULL DEFAULT 1,
    `roomId`      INT          NULL,
    CONSTRAINT `fk_books_room` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`id`)
        ON DELETE SET NULL ON UPDATE CASCADE
) DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT INTO `books` (`title`, `author`, `publishYear`, `shelf`, `isAvailable`, `roomId`)
SELECT 'Malý princ', 'Antoine de Saint-Exupéry', 1943, 'Polica A1', 1, `id` FROM `rooms` WHERE `name` = 'Obývačka';
INSERT INTO `books` (`title`, `author`, `publishYear`, `shelf`, `isAvailable`, `roomId`)
SELECT 'Harry Potter a Kameň mudrcov', 'J. K. Rowlingová', 1997, 'Polica B2', 0, `id` FROM `rooms` WHERE `name` = 'Detská izba';
INSERT INTO `books` (`title`, `author`, `publishYear`, `shelf`, `isAvailable`, `roomId`)
SELECT 'Hobit', 'J. R. R. Tolkien', 1937, 'Polica A2', 1, `id` FROM `rooms` WHERE `name` = 'Obývačka';
INSERT INTO `books` (`title`, `author`, `publishYear`, `shelf`, `isAvailable`, `roomId`)
SELECT '1984', 'George Orwell', 1949, 'Polica C1', 1, `id` FROM `rooms` WHERE `name` = 'Pracovňa';
INSERT INTO `books` (`title`, `author`, `publishYear`, `shelf`, `isAvailable`, `roomId`)
SELECT 'Pýcha a predsudok', 'Jane Austenová', 1813, 'Polica D1', 0, `id` FROM `rooms` WHERE `name` = 'Spálňa';
INSERT INTO `books` (`title`, `author`, `publishYear`, `shelf`, `isAvailable`, `roomId`)
SELECT 'Alchymista', 'Paulo Coelho', 1988, 'Polica C2', 1, `id` FROM `rooms` WHERE `name` = 'Pracovňa';
