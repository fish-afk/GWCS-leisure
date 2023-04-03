CREATE TABLE IF NOT EXISTS `SwimmingSessions`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `site_id` BIGINT NOT NULL,
    `Start` TIME NOT NULL,
    `End` TIME NOT NULL,
    `price` DOUBLE NOT NULL
);

CREATE TABLE IF NOT EXISTS `Reviews`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `site_id` BIGINT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `reviewText` TEXT NOT NULL,
    `rating` BIGINT NOT NULL
);

CREATE TABLE IF NOT EXISTS `Users`(
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `firstname` VARCHAR(255) NOT NULL,
    `surname` VARCHAR(255) NOT NULL,
    `DOB` DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS `LocalAttractions`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `attraction_name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `milesFromSite` DOUBLE NOT NULL,
    `site_id` BIGINT NOT NULL,
    `image_url` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `PitchBookings`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `Pitch_id` BIGINT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `checkIn` DATETIME NOT NULL,
    `checkOut` DATETIME NOT NULL,
    `bookingDate` DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS `SwimmingBookings`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `swimming_session_id` BIGINT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `bookingDate` DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS `CampingSites`(
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `description` BIGINT NOT NULL,
    `image_url` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `Pitches`(
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



/* This is a set of SQL statements that create table IF NOT EXISTSs and establish foreign key constraints among them.

The first table, SwimmingSessions, has columns for session ID, site ID, start and end times, and price.

The second table, Reviews, has columns for review ID, site ID, username, review text, and rating.

The third table, Users, has columns for username, password, email, first name, surname, and date of birth.

The fourth table, LocalAttractions, has columns for attraction ID, attraction name, description, distance from site, site ID, and image URL.

The fifth table, PitchBookings, has columns for booking ID, pitch ID, username, check-in and check-out times, and booking date.

The sixth table, SwimmingBookings, has columns for booking ID, swimming session ID, username, and booking date.

The seventh table, CampingSites, has columns for site ID, name, location, description, and image URL.

The eighth table, Pitches, has columns for pitch ID, site ID, pitch type, and price.

The last section of SQL statements adds foreign key constraints to these tables, linking the appropriate columns to their corresponding primary key columns in other tables. */


