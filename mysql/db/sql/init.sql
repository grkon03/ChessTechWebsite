DROP TABLE IF EXISTS Members;
DROP TABLE IF EXISTS Schedules;

-- Circle Members
CREATE TABLE `Members` (
    `id` VARCHAR(20) NOT NULL PRIMARY KEY, -- id string to use for login
    `pass` VARCHAR(20) NOT NULL, -- password string to use for login
    `name` VARCHAR(20) NOT NULL, -- name
    `handle_name` VARCHAR(20) NOT NULL, -- handle name
    `grade` VARCHAR(3) NOT NULL, -- grade
    `authority` INT NOT NULL, -- access authority
    `position` VARCHAR(100) -- member position : split by ','
);

-- Activity Plan
CREATE TABLE `Schedules` (
    `id` INT NOT NULL PRIMARY KEY, -- schedule integer id
    `name` VARCHAR(30) NOT NULL, -- acitivity name
    `date_start` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, -- date of start of the event
    `date_end` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, -- date of end of the event 
    `detail` VARCHAR(200) NOT NULL, -- activity detail
    `members_join` VARCHAR(200) NOT NULL, -- Members.id who plan to join : split by ','
    `members_notjoin` VARCHAR(200) NOT NULL -- Members.id who plan not to join : split by ','
);