CREATE TABLE `rooms`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `name`        VARCHAR(100) NOT NULL,
    `description` VARCHAR(255) NULL,
    `floorNumber` INT          NOT NULL DEFAULT 0
) DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT INTO `rooms` (`name`, `description`, `floorNumber`)
VALUES ('Obývačka', 'Hlavná knižnica s románmi a detektívkami', 0),
       ('Detská izba', 'Rozprávky a knihy pre deti', 1),
       ('Pracovňa', 'Odborná literatúra a sci-fi', 0),
       ('Spálňa', 'Knihy na čítanie pred spaním', 1);
