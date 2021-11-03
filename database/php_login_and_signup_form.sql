CREATE TABLE Users (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
  username VARCHAR(15) NOT NULL COMMENT 'Username',
  email VARCHAR(255) NOT NULL COMMENT 'Email Address',
  password VARCHAR(255) NOT NULL COMMENT 'Password',
  role ENUM('ADMIN', 'MEMBER') NOT NULL DEFAULT 'MEMBER' COMMENT 'Role',
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create Time'
) ENGINE='InnoDB';

INSERT INTO Users (username, email, password, role)
VALUES
  ('admin', 'admin@admin.admin', '$2a$12$JEZrZ1tLIxsOCUg3Lvgc..2GlLoD18dzInmWct883kh6BXmW8h6/a', 'ADMIN')
  ('adiaryasuta', 'adiaryasuta@gmail.com', '$2a$12$uB4chSnRHTF.xKzQqeFYhOmad3as4jo3AnLbUriiZZisdl65gTQCK', 'MEMBER');

SELECT * FROM users;

ALTER TABLE Users AUTO_INCREMENT = 3;