INSERT INTO `CampingSites` (`name`, `location`, `description`, `image_url`)
VALUES ('Campsite A', 'Somewhere in the countryside', 'A peaceful retreat in the heart of nature', 'https://example.com/campsite-a.jpg'),
       ('Campsite B', 'By the beach', 'Enjoy the sun, sand, and surf', 'https://example.com/campsite-b.jpg'),
       ('Campsite C', 'In the mountains', 'Get away from it all and enjoy stunning views', 'https://example.com/campsite-c.jpg');

INSERT INTO `Pitches` (`site_id`, `Pitch_Type`, `price`)
VALUES (1, 'Tent pitch', 20.00),
       (1, 'Caravan pitch', 25.00),
       (2, 'Beachfront pitch', 35.00),
       (2, 'Standard pitch', 30.00),
       (3, 'Mountain view pitch', 40.00),
       (3, 'Forest pitch', 35.00);


INSERT INTO `SwimmingSessions` (`site_id`, `Start`, `End`, `price`)
VALUES (2, '09:00:00', '10:00:00', 5.00),
       (2, '14:00:00', '15:00:00', 5.00),
       (2, '18:00:00', '19:00:00', 5.00),
       (3, '10:00:00', '11:00:00', 3.00),
       (3, '16:00:00', '17:00:00', 3.00),
       (3, '20:00:00', '21:00:00', 3.00);


INSERT INTO `SwimmingBookings` (`swimming_session_id`, `username`, `bookingDate`)
VALUES (1, 'johndoe', '2023-04-05'),
       (1, 'janedoe', '2023-04-06'),
       (2, 'janedoe', '2023-04-05'),
       (3, 'johndoe', '2023-04-06'),
       (4, 'johndoe', '2023-04-06'),
       (5, 'janedoe', '2023-04-07');


INSERT INTO `Reviews` (`site_id`, `username`, `reviewText`, `rating`)
VALUES (1, 'johndoe', 'Great location and facilities', 4),
       (1, 'janedoe', 'Clean and tidy site, friendly staff', 5),
       (2, 'janedoe', 'Beautiful beach, lovely weather', 4),
       (2, 'johndoe', 'Noisy neighbors, but otherwise enjoyable', 3),
       (3, 'johndoe', 'Spectacular views, great hiking trails', 5),
       (3, 'janedoe', 'Too many bugs and mosquitoes', 2);


INSERT INTO `Users`(username, password, email, firstname, surname, DOB) VALUES
('user1', 'password1', 'user1@gmail.com', 'John', 'Doe', '1990-01-01'),
('user2', 'password2', 'user2@gmail.com', 'Jane', 'Doe', '1995-02-02'),
('user3', 'password3', 'user3@gmail.com', 'Alice', 'Smith', '1988-03-03'),
('user4', 'password4', 'user4@gmail.com', 'Bob', 'Johnson', '1992-04-04'),
('user5', 'password5', 'user5@gmail.com', 'Emma', 'Wilson', '1997-05-05'),
('user6', 'password6', 'user6@gmail.com', 'David', 'Brown', '1994-06-06');

INSERT INTO `LocalAttractions` (attraction_name, description, milesFromSite, site_id, image_url) VALUES
('Beach', 'Beautiful sandy beach with crystal clear water.', 0.5, 1, 'https://example.com/beach.jpg'),
('Hiking Trail', 'Scenic hiking trail through the mountains.', 2.5, 1, 'https://example.com/hiking-trail.jpg'),
('Historic Landmark', 'Historic building with interesting architecture.', 1, 2, 'https://example.com/historic-landmark.jpg'),
('Zoo', 'Zoo with a variety of animals from around the world.', 5, 2, 'https://example.com/zoo.jpg'),
('Theme Park', 'Amusement park with roller coasters and other attractions.', 10, 3, 'https://example.com/theme-park.jpg'),
('Museum', 'Art museum with a collection of modern and contemporary art.', 2, 3, 'https://example.com/museum.jpg');

INSERT INTO `SwimmingBookings` (`swimming_session_id`, `username`, `bookingDate`) VALUES (1, 'john_doe', '2023-04-05');
INSERT INTO `SwimmingBookings` (`swimming_session_id`, `username`, `bookingDate`) VALUES (2, 'jane_doe', '2023-04-06');
INSERT INTO `SwimmingBookings` (`swimming_session_id`, `username`, `bookingDate`) VALUES (3, 'bob_smith', '2023-04-07');
INSERT INTO `SwimmingBookings` (`swimming_session_id`, `username`, `bookingDate`) VALUES (4, 'alice_smith', '2023-04-08');
