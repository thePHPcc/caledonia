DROP DATABASE IF EXISTS caledonia;
DROP USER IF EXISTS event_writer@localhost;
DROP USER IF EXISTS event_reader@localhost;

CREATE DATABASE caledonia;
USE caledonia;

CREATE TABLE `event` (
  `id`             INTEGER UNSIGNED NOT NULL AUTO_INCREMENT INVISIBLE,
  `event_id`       CHAR(36)         NOT NULL UNIQUE,
  `timestamp`      TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `correlation_id` CHAR(36)         NOT NULL,
  `payload`        LONGTEXT         NOT NULL,

  PRIMARY KEY (`id`),
  INDEX       (`correlation_id`)
) ENGINE=InnoDB;

CREATE USER event_writer@localhost IDENTIFIED BY 'event_writer_password';
GRANT INSERT ON caledonia.event TO event_writer@localhost;

CREATE USER event_reader@localhost IDENTIFIED BY 'event_reader_password';
GRANT SELECT ON caledonia.event TO event_reader@localhost;
