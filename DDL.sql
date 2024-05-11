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
    FOREIGN KEY (location) REFERENCES `location` (location)
);

CREATE TABLE car
(
    plate_id       VARCHAR(255) PRIMARY KEY,
    model          VARCHAR(255) NOT NULL,
    year           INT          NOT NULL,
    out_of_service CHAR(1)      NOT NULL,
    price          FLOAT        NOT NULL,
    color          VARCHAR(255) NOT NULL,
    power          INT          NOT NULL,
    transmission VARCHAR(6)      NOT NULL,
    tank_capacity  FLOAT        NOT NULL,
    location            VARCHAR(255),
    img            TEXT         NOT NULL,
    branch_name    VARCHAR(255) NOT NULL,
    FOREIGN KEY (branch_name) REFERENCES `branch` (branch_name),
    FOREIGN KEY (location) REFERENCES `location` (location)
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
    plate_id           VARCHAR(255),
    ssn                VARCHAR(14),
    reservation_number INT UNIQUE NOT NULL AUTO_INCREMENT,
    reservation_time   DATE       NOT NULL,
    pickup_location    VARCHAR(255),
    return_location    VARCHAR(255),
    pickup_time        DATE       NOT NULL,
    return_time        DATE       NOT NULL,
    is_paid            CHAR(1)    NOT NULL,
    paid_at            DATE,
    FOREIGN KEY (plate_id) REFERENCES car (plate_id),
    FOREIGN KEY (ssn) REFERENCES `user` (ssn),
    FOREIGN KEY (pickup_location) REFERENCES branch (branch_name),
    FOREIGN KEY (return_location) REFERENCES branch (branch_name),
    PRIMARY KEY (plate_id, ssn)
);

