USE crs;

INSERT INTO location VALUES ('France');
INSERT INTO location VALUES ('Egypt');
INSERT INTO location VALUES ('England');
INSERT INTO location VALUES ('Russia');

INSERT INTO branch VALUES ('Paris', 'France');
INSERT INTO branch VALUES ('Lyon', 'France');
INSERT INTO branch VALUES ('Alexandria', 'Egypt');
INSERT INTO branch VALUES ('Cairo', 'Egypt');
INSERT INTO branch VALUES ('Liverpool', 'England');
INSERT INTO branch VALUES ('Manchester', 'England');
INSERT INTO branch VALUES ('Moscow', 'Russia');
INSERT INTO branch VALUES ('St. Petersburg', 'Russia');

INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('BMW 3-Series G20', 2020, 'Manual', 200, 'blue', 140, 'Auto', 'blueBMW.jpg', 'Paris');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Hyundai i20', 2019, 'Manual', 280, 'blue', 140, 'Auto', 'blueHyundai.jpg', 'Lyon');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Kia Rio', 2018, 'Manual', 100, 'white', 140, 'Auto', 'whiteKIA.jpg', 'Alexandria');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Nissan Sunny', 2017, 'Manual', 250, 'grey', 140, 'Manual', 'greyNissan.jpg', 'Cairo');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Toyota Yaris', 2016, 'Manual', 150, 'grey', 140, 'Manual', 'greyToyota.jpg', 'Liverpool');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Skoda Octavia', 2017, 'Manual', 230, 'white', 140, 'Manual', 'whiteSkoda.jpg', 'Manchester');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Fiat Tipo', 2018, 'Manual', 200, 'red', 140, 'Manual', 'redFIAT.jpg', 'Moscow');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Mercedes s6', 2019, 'Manual', 150, 'red', 140, 'Auto', 'redMercedes.jpg', 'Moscow');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Renault Megane', 2020, 'Manual', 250, 'yellow', 140, 'Auto', 'yellowRenault.jpg', 'Moscow');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Peugeot 508', 2021, 'Manual', 180, 'red', 140, 'Auto', 'redPeugeot.jpg', 'Moscow');
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name) VALUES ('Seat Leon', 2017, 'Manual', 170, 'red', 140, 'Auto', 'redSeat.jpg', 'Moscow');

INSERT INTO user VALUES ('12551289579122', 'Admin', 'Admin', '01223674874', 'admin@gmail.com', '698d51a19d8a121ce581499d7b701668', 'M', '1996-09-05', 'T');
INSERT INTO user VALUES ('15176891141235', 'Fady', 'Sameh', '01233547384', 'fady@gmail.com', '30dcd0487df76c49254f6644d08a1c01', 'M', '2000-04-12', 'F');
INSERT INTO user VALUES ('29673262853274', 'Sandra', 'Adel', '01248563857', 'sandra@gmail.com', '6df02b541a67198aff344875085f2336', 'F', '1996-11-03', 'F');
INSERT INTO user VALUES ('46634237494769', 'Amr', 'Mohamed', '01257673694', 'amr@gmail.com', '481c48991702d420efc19afb28c3f533', 'M', '2000-05-15', 'F');

INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (4, '15176891141235', '2022-01-15', '2022-02-10', '2022-02-11', 'T', 100);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (5, '15176891141235', '2022-01-16', '2022-02-05', '2022-02-06', 'T', 120);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (6, '15176891141235', '2022-01-17', '2022-02-12', '2022-02-12', 'T', 150);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (1, '29673262853274', '2022-01-18', '2022-02-12', '2022-02-15', 'F', 200);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (2, '29673262853274', '2022-01-19', '2022-02-16', '2022-02-16', 'F', 250);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (3, '29673262853274', '2022-01-20', '2022-02-18', '2022-02-20', 'T', 300);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (7, '29673262853274', '2022-01-21', '2022-02-21', '2022-02-22', 'F', 180);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (8, '46634237494769', '2022-01-22', '2022-01-27', '2022-01-29', 'T', 220);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (9, '46634237494769', '2022-01-23', '2022-01-30', '2022-01-31', 'F', 250);
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price) VALUES (10, '46634237494769', '2022-01-24', '2022-03-28', '2022-03-29', 'T', 300);
