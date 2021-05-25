-- 2021-05-25
-- Adding a few columns to a user table for email verification and subscription features.
-- @author Kohei Koja
-- @email  koja@knights.ucf.edu

-- Modify email column (makes it unique)
ALTER TABLE `users`
    MODIFY `email` VARCHAR(50) DEFAULT NULL UNIQUE,

-- Add active column
    ADD COLUMN `active` BOOLEAN NOT NULL DEFAULT 0
        AFTER `email`,

-- Add hash column
    ADD COLUMN `hash` VARCHAR(32) DEFAULT NULL
        AFTER `active`,

-- Add post_sbsc column
    ADD COLUMN `post_sbsc` BOOLEAN NOT NULL DEFAULT 1
        AFTER `hash`,

-- Add reply_sbsc column
    ADD COLUMN `reply_sbsc` BOOLEAN NOT NULL DEFAULT 1
        AFTER `post_sbsc`;


-- Change values of existing records (making all the users active unless they have empty emails)
UPDATE `users`
    SET `active` = 1
    WHERE `email` IS NOT NULL;

