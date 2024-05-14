USE crs;

INSERT INTO location (location) VALUES ('Egypt'), ('UAE'), ('Saudi Arabic'), ('Lebanon');

INSERT INTO branch (branch_name, location) VALUES ('Cairo', 'Egypt'), ('Alexandria', 'Egypt');
INSERT INTO branch (branch_name, location) VALUES ('Dubai', 'UAE'), ('Abu Dhabi', 'UAE');
INSERT INTO branch (branch_name, location) VALUES ('Riyadh', 'Saudi Arabic'), ('Jeddah', 'Saudi Arabic');
INSERT INTO branch (branch_name, location) VALUES ('Beirut', 'Lebanon'), ('Tripoli', 'Lebanon');

--  cars for Egypt branches
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name, plate_id)
VALUES 
('Chevrolet Cruze', 2019, 'F', 130, 'red', 160, 'Auto', 'cruze.jpg', 'Cairo', 'EG-9876'),
('Ford Focus', 2020, 'F', 140, 'yellow', 170, 'Auto', 'focus.jpg', 'Cairo', 'EG-5432'),
('Volkswagen Jetta', 2018, 'F', 120, 'red', 150, 'Auto', 'jetta.jpg', 'Alexandria', 'EG-3344'),
('BMW 3 Series', 2017, 'F', 180, 'blue', 200, 'Auto', '3series.jpg', 'Alexandria', 'EG-5566');

--  cars for UAE branches
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name, plate_id)
VALUES 
('Mercedes-Benz C-Class', 2019, 'F', 200, 'silver', 220, 'Auto', 'cclass.jpg', 'Dubai', 'UAE-9876'),
('Audi A4', 2020, 'F', 210, 'black', 230, 'Auto', 'a4.jpg', 'Dubai', 'UAE-5432'),
('Lexus ES', 2018, 'F', 190, 'white', 210, 'Manual', 'es.jpg', 'Abu Dhabi', 'UAE-3344'),
('Infiniti Q50', 2017, 'F', 220, 'black', 240, 'Auto', 'q50.jpg', 'Abu Dhabi', 'UAE-5566');

--  cars for Saudi Arabic branches
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name, plate_id)
VALUES 
('Toyota Land Cruiser', 2019, 'F', 250, 'silver', 280, 'Auto', 'landcruiser.jpg', 'Riyadh', 'SA-9876'),
('Nissan Patrol', 2020, 'F', 260, 'white', 270, 'Auto', 'patrol.jpg', 'Riyadh', 'SA-5432'),
('Ford Explorer', 2018, 'F', 240, 'white', 260, 'Manual', 'explorer.jpg', 'Jeddah', 'SA-3344'),
('Chevrolet Tahoe', 2017, 'F', 270, 'red', 290, 'Auto', 'tahoe.jpg', 'Jeddah', 'SA-5566');

--  cars for Lebanon branches
INSERT INTO car (model, year, out_of_service, price, color, power, transmission, img, branch_name, plate_id)
VALUES 
('Kia Sportage', 2019, 'F', 140, 'blue', 160, 'Auto', 'sportage.jpg', 'Beirut', 'LB-9876'),
('Hyundai Santa Fe', 2020, 'F', 150, 'red', 170, 'Auto', 'santafe.jpg', 'Beirut', 'LB-5432'),
('Mazda CX-5', 2018, 'F', 130, 'silver', 150, 'Auto', 'cx5.jpg', 'Tripoli', 'LB-3344'),
('Jeep Cherokee', 2017, 'F', 160, 'white', 180, 'Auto', 'cherokee.jpg', 'Tripoli', 'LB-5566');


-- Insert sample users
INSERT INTO `user` (ssn, fname, lname, phone, email, password, sex, birthdate, is_admin)
VALUES 

('12345678901234', 'Jomana', 'Ehab', '123456789', 'jomana@gmail.com', '$2y$10$Ymu31ct.ECjKxFqq3NeRjuBDaLc9/WfeqDCJHQWRcVd3KKDVPC9s2', 'M', '1990-05-15', 'F'),
('23456789012345', 'Ranim', 'Mohareb', '987654321', 'ranim@gmail.com', '$2y$10$KSZCPA1EL3hTRDntLzLL3edKbQgPeX/FV7hYrKkcR/445E7lXw6jO', 'F', '1995-08-20', 'F'),
('34567890123456', 'Abdelrahman', 'Muhammad', '456123789', 'abdelrahman@gmail.com', '$2y$10$XijFItvvexzzNbqyLt9.E.ePOlOFw6ZibZpxkRhsqTILqQsHdv4fa', 'M', '1985-03-10', 'T');

-- Insert sample reservations
INSERT INTO reservation (car_id, ssn, reservation_time, pickup_time, return_time, is_paid, total_price)
VALUES 
(1, '12345678901234', '2024-05-15', '2024-05-20', '2024-05-25', 'T', 650),
(2, '23456789012345', '2024-05-16', '2024-05-21', '2024-05-26', 'T', 700),
(3, '34567890123456', '2024-05-17', '2024-05-22', '2024-05-27', 'T', 600);
