DROP DATABASE IF EXISTS caledonia;
DROP USER IF EXISTS test_fixture_manager@localhost;
DROP USER IF EXISTS event_writer@localhost;
DROP USER IF EXISTS event_reader@localhost;

CREATE DATABASE caledonia;
USE caledonia;

CREATE TABLE `event` (
  `id`             INTEGER UNSIGNED NOT NULL AUTO_INCREMENT INVISIBLE,
  `timestamp`      TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id`       CHAR(36)         NOT NULL UNIQUE,
  `correlation_id` CHAR(36),
  `topic`          VARCHAR(128)     NOT NULL,
  `payload`        LONGTEXT         NOT NULL,

  PRIMARY KEY (`id`),
  INDEX       (`correlation_id`),
  INDEX       (`topic`)
) ENGINE=InnoDB;

CREATE TABLE `test` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE USER test_fixture_manager@localhost IDENTIFIED BY 'test_fixture_manager_password';
GRANT ALL PRIVILEGES ON caledonia.* TO test_fixture_manager@localhost;

CREATE USER event_writer@localhost IDENTIFIED BY 'event_writer_password';
GRANT INSERT ON caledonia.event TO event_writer@localhost;

CREATE USER event_reader@localhost IDENTIFIED BY 'event_reader_password';
GRANT SELECT ON caledonia.event TO event_reader@localhost;
