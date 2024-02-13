CREATE TABLE `Feeds`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `feed_name` VARCHAR(255) NOT NULL
);
CREATE TABLE `Animals`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `feed_id` BIGINT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `age` INT NOT NULL,
    `birthdatebigint` DATE NOT NULL
);
CREATE TABLE `Employees`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `animal_id` BIGINT NOT NULL,
    `name` BIGINT NOT NULL,
    `age` INT NOT NULL,
    `home_address` VARCHAR(255) NOT NULL,
    `date_start_work` DATE NOT NULL
);
ALTER TABLE
    `Employees` ADD CONSTRAINT `employees_animal_id_foreign` FOREIGN KEY(`animal_id`) REFERENCES `Animals`(`id`);
ALTER TABLE
    `Animals` ADD CONSTRAINT `animals_feed_id_foreign` FOREIGN KEY(`feed_id`) REFERENCES `Feeds`(`id`);