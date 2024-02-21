CREATE DATABASE IF NOT EXISTS city_database;

USE city_database;

CREATE TABLE IF NOT EXISTS cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO cities (name) VALUES ('New York');
INSERT INTO cities (name) VALUES ('Paris');
INSERT INTO cities (name) VALUES ('Tokyo');
