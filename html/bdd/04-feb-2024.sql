CREATE DATABASE IF NOT EXISTS ecv_m1_eval;

USE ecv_m1_eval;
CREATE TABLE user
(
    id       INTEGER      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email    VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);