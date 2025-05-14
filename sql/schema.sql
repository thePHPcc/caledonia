DROP DATABASE IF EXISTS caledonia;
DROP USER IF EXISTS test_fixture_manager@127.0.0.1;
DROP USER IF EXISTS event_writer@127.0.0.1;
DROP USER IF EXISTS event_reader@127.0.0.1;

CREATE DATABASE caledonia;
USE caledonia;

CREATE TABLE `event` (
  `id`             INTEGER UNSIGNED NOT NULL AUTO_INCREMENT INVISIBLE,
  `timestamp`      TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic`          VARCHAR(128)     NOT NULL,
  `event_id`       CHAR(36)         NOT NULL UNIQUE,
  `payload`        LONGTEXT         NOT NULL,

  PRIMARY KEY (`id`),
  INDEX       (`topic`)
) ENGINE=InnoDB;

CREATE TABLE `test` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE USER test_fixture_manager@127.0.0.1 IDENTIFIED BY 'test_fixture_manager_password';
GRANT ALL PRIVILEGES ON caledonia.* TO test_fixture_manager@127.0.0.1;

CREATE USER event_writer@127.0.0.1 IDENTIFIED BY 'event_writer_password';
GRANT INSERT ON caledonia.event TO event_writer@127.0.0.1;

CREATE USER event_reader@127.0.0.1 IDENTIFIED BY 'event_reader_password';
GRANT SELECT ON caledonia.event TO event_reader@127.0.0.1;
