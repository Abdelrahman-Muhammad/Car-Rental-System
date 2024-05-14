CREATE DATABASE crs;

USE crs;

CREATE TABLE `location`
(
    location VARCHAR(255) PRIMARY KEY
);

CREATE TABLE branch
(
    branch_name VARCHAR(255) PRIMARY KEY,
    location         VARCHAR(255),
    FOREIGN KEY (location) REFERENCES `location` (location) ON DELETE CASCADE
);

CREATE TABLE car
(
    car_id         INT PRIMARY KEY AUTO_INCREMENT,
    model          VARCHAR(255) NOT NULL,
    year           INT          NOT NULL,
    out_of_service CHAR(1)      NOT NULL,
    price          FLOAT        NOT NULL,
    color          VARCHAR(255) NOT NULL,
    power          INT          NOT NULL,
    transmission VARCHAR(6)      NOT NULL,
    img            TEXT         NOT NULL,
    branch_name    VARCHAR(255) NOT NULL,
    plate_id        VARCHAR(255) ,
    FOREIGN KEY (branch_name) REFERENCES `branch` (branch_name) ON DELETE CASCADE
);

CREATE TABLE `user`
(
    ssn       VARCHAR(14) PRIMARY KEY,
    fname     VARCHAR(30)        NOT NULL,
    lname     VARCHAR(30)        NOT NULL,
    phone     VARCHAR(15)        NOT NULL,
    email     VARCHAR(30) UNIQUE NOT NULL,
    password  TEXT               NOT NULL,
    sex       CHAR(1)            NOT NULL,
    birthdate Date               NOT NULL,
    is_admin  CHAR(1)            NOT NULL
);

CREATE TABLE reservation
(
    car_id             INT,
    ssn                VARCHAR(14),
    reservation_number INT        PRIMARY KEY  AUTO_INCREMENT,
    reservation_time   DATE       NOT NULL,
    pickup_time        DATE       NOT NULL,
    return_time        DATE       NOT NULL,
    is_paid            CHAR(1)    NOT NULL,
    total_price        INT        NOT NULL,
    FOREIGN KEY (car_id) REFERENCES car (car_id) ON DELETE CASCADE,
    FOREIGN KEY (ssn) REFERENCES `user` (ssn) ON DELETE CASCADE
);

