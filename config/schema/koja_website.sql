# Tables required for my website.
# @author Kohei Koja
# @email  koja@knights.ucf.edu
#
#
# If the database is not created, use following command.
# CREATE DATABASE IF NOT EXISTS `koja_website`
#     CHARACTER SET utf8
#     COLLATE = utf8_general_ci;

USE `koja_website`;

# A singleton pattern for `site_infos`.
# i.e.) There is one-and-only row in this table.
CREATE TABLE IF NOT EXISTS `site_infos` (
    `only_id` ENUM('only') NOT NULL DEFAULT 'only' UNIQUE,
    `visit_count` INT unsigned NOT NULL DEFAULT 0,
    `created` datetime DEFAULT CURRENT_TIMESTAMP, -- optional, requires MySQL 5.6.5+
    `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- optional, requires MySQL 5.6.5+
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT unsigned NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(32) NOT NULL DEFAULT '',
    `password` VARCHAR(255) NOT NULL DEFAULT '',
    `role` ENUM('admin', 'guest') NOT NULL DEFAULT 'guest',
    `email` VARCHAR(50) DEFAULT NULL,
    `created` datetime DEFAULT CURRENT_TIMESTAMP, -- optional, requires MySQL 5.6.5+
    `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- optional, requires MySQL 5.6.5+
    PRIMARY KEY (`id`),
    UNIQUE (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `posts` (
    `id` INT unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL DEFAULT '',
    `slug` VARCHAR(255) NOT NULL DEFAULT '',
    `body` MEDIUMTEXT NOT NULL DEFAULT '',
    `view_count` INT unsigned NOT NULL DEFAULT 0,
    `created` datetime DEFAULT CURRENT_TIMESTAMP, -- optional, requires MySQL 5.6.5+
    `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- optional, requires MySQL 5.6.5+
    PRIMARY KEY(`id`),
    UNIQUE (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT unsigned NOT NULL AUTO_INCREMENT,
    `post_id` INT unsigned DEFAULT NULL,
    `user_id` INT unsigned DEFAULT NULL,
    `parent_id` INT unsigned DEFAULT NULL,
    `guestname` VARCHAR(32) NOT NULL DEFAULT '',
    `content` TEXT NOT NULL DEFAULT '',
    `created` datetime DEFAULT CURRENT_TIMESTAMP, -- optional, requires MySQL 5.6.5+
    `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- optional, requires MySQL 5.6.5+
    PRIMARY KEY (`id`),
    FOREIGN KEY post_key (`post_id`) REFERENCES posts(`id`) ON DELETE CASCADE,
    FOREIGN KEY user_key (`user_id`) REFERENCES users(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT IGNORE INTO `users`
SET `username` = 'root',
`password` = 'root',
`role` = 'admin';

INSERT IGNORE INTO `site_infos`
SET `only_id` = 'only';