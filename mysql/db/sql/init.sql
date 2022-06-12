-- DROP TABLE IF EXISTS Members;
-- DROP TABLE IF EXISTS Schedules;
-- DROP TABLE IF EXISTS JoinableDays;

-- Circle Members
CREATE TABLE `Members` (
    `id` VARCHAR(20) NOT NULL PRIMARY KEY, -- id string to use for login
    `pass` VARCHAR(20) NOT NULL, -- password string to use for login
    `name` VARCHAR(20) NOT NULL, -- name
    `handle_name` VARCHAR(20) NOT NULL, -- handle name
    `grade` VARCHAR(3) NOT NULL, -- grade
    `authority` INT NOT NULL, -- access authority
    `position` VARCHAR(100) -- member position : split by ','
    `joinable_dayofweek` INT NOT NULL DEFAULT 0 -- joinable day of week
);

/*
joinable_dayofweek:
    SUN: 1
    MON: 2
    TUE: 4
    WED: 8
    THI: 16
    FRI: 32
    SAT: 64
*/

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

-- Joinable Days
CREATE TABLE `JoinableDays` (
    `date` TIMESTAMP NOT NULL PRIMARY KEY, -- the day
    `joinable` VARCHAR(200) NOT NULL, -- joinable members
    `maybe_joinable` VARCHAR(200) NOT NULL, -- maybe joinable members
    `notjoinable` VARCHAR(200) NOT NULL -- not joinable members
);

-- Menu
CREATE TABLE `Menu` (
    `filepath` VARCHAR(200) NOT NULL PRIMARY KEY, -- file path following 'menu/'
    `dirname` VARCHAR(200) NOT NULL, -- directory of the file
    `name` VARCHAR(200) NOT NULL, -- the displayed name of menu
    `rank_allowed` INT NOT NULL DEFAULT 1 -- authority rank allowed to access
);


---- Setting Default Values ----

-- Circle Members --
INSERT INTO Members VALUES ('admin', 'xF39zEc1', 'admin', 'admin', 'NON', 0, 'admin', 0);

-- Menu --
INSERT INTO Menu VALUES ('changeMembersProfile/index.php', 'changeMembersProfile', 1, 'メンバーのプロフィールを変更する');
INSERT INTO Menu VALUES ('changeMembersProfile/changeMPF.php', 'changeMembersProfile', 1, 'メンバーのプロフィールを直接変更する');
INSERT INTO Menu VALUES ('changeProfile/index.php', 'changeProfile', 2, 'プロフィールを変更する');
INSERT INTO Menu VALUES ('registJoinableActivities/index.php', 'registJoinableActivities', 2, '参加/非参加予定を登録する');
INSERT INTO Menu VALUES ('registJoinableDays/index.php', 'registJoinableDays', 2, '活動可能日を登録する');
INSERT INTO Menu VALUES ('registSchedules/index.php', 'registSchedules', 1, '予定を作成する');
INSERT INTO Menu VALUES ('registSchedules/convenience.php', 'registSchedules', 1, '各部員の都合');