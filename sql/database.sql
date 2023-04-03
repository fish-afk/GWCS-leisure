CREATE TABLE `SwimmingSessions`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `site_id` BIGINT NOT NULL,
    `Start` TIME NOT NULL,
    `End` TIME NOT NULL,
    `price` DOUBLE NOT NULL
);

CREATE TABLE `Reviews`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `site_id` BIGINT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `reviewText` TEXT NOT NULL,
    `rating` BIGINT NOT NULL
);

CREATE TABLE `Users`(
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `firstname` VARCHAR(255) NOT NULL,
    `surname` VARCHAR(255) NOT NULL,
    `DOB` DATE NOT NULL
);

CREATE TABLE `LocalAttractions`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `attraction_name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `milesFromSite` DOUBLE NOT NULL,
    `site_id` BIGINT NOT NULL,
    `image_url` VARCHAR(255) NOT NULL
);

CREATE TABLE `PitchBookings`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Pitch_id` BIGINT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `checkIn` DATETIME NOT NULL,
    `checkOut` DATETIME NOT NULL,
    `bookingDate` DATE NOT NULL
);

CREATE TABLE `SwimmingBookings`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `swimming_session_id` BIGINT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `bookingDate` DATE NOT NULL
);

CREATE TABLE `CampingSites`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `description` BIGINT NOT NULL,
    `image_url` VARCHAR(255) NOT NULL
);

CREATE TABLE `Pitches`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `site_id` BIGINT NOT NULL,
    `Pitch_Type` VARCHAR(255) NOT NULL,
    `price` DOUBLE NOT NULL
);

ALTER TABLE
    `SwimmingBookings` ADD CONSTRAINT `swimmingbookings_username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`);
ALTER TABLE
    `Pitches` ADD CONSTRAINT `pitches_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);
ALTER TABLE
    `Reviews` ADD CONSTRAINT `reviews_username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`);
ALTER TABLE
    `PitchBookings` ADD CONSTRAINT `pitchbookings_username_foreign` FOREIGN KEY(`username`) REFERENCES `Users`(`username`);
ALTER TABLE
    `Reviews` ADD CONSTRAINT `reviews_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);
ALTER TABLE
    `PitchBookings` ADD CONSTRAINT `pitchbookings_pitch_id_foreign` FOREIGN KEY(`Pitch_id`) REFERENCES `Pitches`(`id`);
ALTER TABLE
    `SwimmingBookings` ADD CONSTRAINT `swimmingbookings_swimming_session_id_foreign` FOREIGN KEY(`swimming_session_id`) REFERENCES `SwimmingSessions`(`id`);
ALTER TABLE
    `SwimmingSessions` ADD CONSTRAINT `swimmingsessions_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);
ALTER TABLE
    `LocalAttractions` ADD CONSTRAINT `localattractions_site_id_foreign` FOREIGN KEY(`site_id`) REFERENCES `CampingSites`(`id`);