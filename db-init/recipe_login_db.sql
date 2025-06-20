-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 20, 2025 at 12:30 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `ingredients` text,
  `directions` text,
  `servings` int(11) DEFAULT NULL,
  `cooking_time` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `user_id`, `title`, `description`, `ingredients`, `directions`, `servings`, `cooking_time`, `category`, `location`, `image_url`) VALUES
(1, 10, 'Spring Rolls', 'Delicious and crispy spring rolls filled with vegetables and served with sweet chili sauce.', 'Spring roll wrappers, carrots, cabbage, bean sprouts, tofu, soy sauce, garlic, ginger, vegetable oil, sweet chili sauce\'', '1. Prepare the filling by sautéing carrots, cabbage, bean sprouts, and tofu with soy sauce, garlic, and ginger. 2. Roll the filling in spring roll wrappers and fry until crispy. 3. Serve with sweet chili sauce.', 4, 30, 'Appetizers', 'Asia', 'assets/images/springrolls.jpg'),
(2, 10, 'Pad Thai', 'Classic Thai stir-fried noodles with tofu, peanuts, and bean sprouts in a tangy sauce.', 'Rice noodles, tofu, peanuts, bean sprouts, eggs, garlic, shallots, tamarind paste, fish sauce, sugar, chili flakes, lime', '1. Soak rice noodles in hot water until softened. 2. Stir-fry tofu, garlic, and shallots. 3. Add noodles, tamarind paste, fish sauce, sugar, and chili flakes. 4. Stir in bean sprouts, eggs, and peanuts. 5. Serve with lime wedges.', 4, 25, 'Main dish', 'Asia', 'assets/images/padthai.jpg'),
(4, 10, 'Caprese Salad', 'Classic Italian salad made with fresh tomatoes, mozzarella cheese, basil, and balsamic glaze.', 'Tomatoes, fresh mozzarella cheese, fresh basil leaves, balsamic glaze, olive oil, salt, pepper.', '1. Slice tomatoes and mozzarella cheese. 2. Arrange tomato and mozzarella slices on a plate, alternating with fresh basil leaves. 3. Drizzle with balsamic glaze and olive oil. 4. Season with salt and pepper.', 2, 15, 'Appetizers', 'Europe', 'assets/images/capressesalad.jpg'),
(5, 10, 'Spaghetti Carbonara', 'Classic Italian pasta dish made with spaghetti, pancetta, eggs, Parmesan cheese, and black pepper.', 'Spaghetti, pancetta, eggs, Parmesan cheese, black pepper, garlic, olive oil.', '1. Cook spaghetti according to package instructions. 2. Sauté pancetta and garlic in olive oil until crispy. 3. Beat eggs with Parmesan cheese and black pepper. 4. Toss cooked spaghetti with pancetta mixture and egg mixture. 5. Serve immediately.', 4, 25, 'Main dish', 'Europe', 'assets/images/SpaghettiCarbonara.jpg'),
(6, 10, 'Jollof Rice', 'Popular West African dish made with rice, tomatoes, onions, and spices.', 'Rice, tomatoes, onions, bell peppers, scotch bonnet peppers, garlic, ginger, tomato paste, spices (thyme, curry powder, paprika), vegetable oil.', '1. Sauté onions, bell peppers, and scotch bonnet peppers in vegetable oil. 2. Add garlic, ginger, and tomato paste. 3. Stir in rice and spices. 4. Cook until rice is tender and flavored with tomato sauce. 5. Serve hot.', 6, 40, 'Main dish', 'Africa', 'assets/images/Jollof Rice.jpg'),
(7, 7, 'Tiramisu', 'Classic Italian dessert made with layers of coffee-soaked ladyfingers, mascarpone cheese, and cocoa powder.', 'Ladyfingers, espresso coffee, mascarpone cheese, eggs, sugar, cocoa powder.', '1. Dip ladyfingers in espresso coffee and arrange them in a dish. 2. Beat together mascarpone cheese, eggs, and sugar until creamy. 3. Spread half of the mascarpone mixture over the ladyfingers. 4. Repeat layers. 5. Chill in the refrigerator for several hours. 6. Dust with cocoa powder before serving.', 6, 45, 'Desserts', 'Europe', 'assets/images/tirimasu.jpg'),
(8, 7, 'Guacamole', 'Classic Mexican dip made with ripe avocados, tomatoes, onions, cilantro, lime juice, and spices.', 'Ripe avocados, tomatoes, onions, cilantro, lime juice, salt, pepper, garlic powder, cumin.', '1. Mash avocados in a bowl. 2. Stir in chopped tomatoes, onions, and cilantro. 3. Add lime juice, salt, pepper, garlic powder, and cumin. 4. Mix until well combined. 5. Serve with tortilla chips.', 6, 15, 'Appetizers', 'North America', 'assets/images/guacamole.jpg'),
(9, 7, 'BBQ Ribs', 'Tender and juicy barbecue ribs marinated in a flavorful BBQ sauce and slow-cooked to perfection.', 'Pork ribs, BBQ sauce, brown sugar, garlic powder, onion powder, paprika, salt, pepper.', '1. Rub ribs with a mixture of brown sugar, garlic powder, onion powder, paprika, salt, and pepper. 2. Grill or bake ribs until cooked through. 3. Brush with BBQ sauce and continue cooking until caramelized. 4. Serve hot with extra BBQ sauce on the side.', 4, 180, 'Main dish', 'North America', 'assets/images/bbqribs.jpg'),
(11, 7, 'Chicken Satay', 'Grilled marinated chicken skewers served with peanut sauce.', 'Chicken breast, soy sauce, garlic, ginger, brown sugar, lime juice, coconut milk, peanut butter, soy sauce, honey, chili flakes, skewers.', '1. Marinate chicken in a mixture of soy sauce, garlic, ginger, brown sugar, and lime juice. 2. Thread chicken onto skewers and grill until cooked through. 3. Prepare peanut sauce by combining coconut milk, peanut butter, soy sauce, honey, and chili flakes. 4. Serve chicken skewers with peanut sauce.', 4, 25, 'Appetizers', 'Asia', 'assets/images/chickensatay.jpg'),
(12, 7, 'Sushi Rolls', 'Japanese rice and seafood rolls wrapped in seaweed and served with soy sauce and wasabi.', 'Sushi rice, nori (seaweed), sushi-grade fish (such as tuna or salmon), avocado, cucumber, rice vinegar, sugar, salt, soy sauce, wasabi', '1. Prepare sushi rice by seasoning cooked rice with rice vinegar, sugar, and salt. 2. Lay out a sheet of nori and spread rice evenly over it. 3. Arrange sliced fish, avocado, and cucumber on the rice. 4. Roll the nori tightly around the fillings. 5. Slice into pieces and serve with soy sauce and wasabi.', 4, 40, 'Main dish', 'Asia', 'assets/images/sushirolls.jpg'),
(13, 7, 'Lasagna', '\'Classic Italian pasta dish made with layers of pasta, meat sauce, béchamel sauce, and cheese.', 'Lasagna noodles, ground beef, onion, garlic, tomato sauce, Italian seasoning, ricotta cheese, mozzarella cheese, Parmesan cheese, eggs.', '1. Cook lasagna noodles according to package instructions. 2. Sauté ground beef, onion, and garlic. 3. Add tomato sauce and Italian seasoning. 4. Layer lasagna noodles, meat sauce, ricotta cheese, and mozzarella cheese in a baking dish. 5. Repeat layers. 6. Top with béchamel sauce and Parmesan cheese. 7. Bake until bubbly and golden brown.', 6, 60, 'Main dish', 'Europe', 'assets/images/Lasagna.jpg'),
(14, 7, 'Mochi Ice Cream', 'Japanese dessert made with sweetened rice dough filled with ice cream.', 'Sweet rice flour, sugar, water, ice cream (various flavors)', '1. Mix sweet rice flour, sugar, and water to form a dough. 2. Flatten the dough and wrap it around small scoops of ice cream. 3. Freeze until firm. 4. Serve as a refreshing and chewy dessert.', 8, 60, 'Desserts', 'Asia', 'assets/images/mochiicecream.jpg'),
(15, 10, 'Samosas', 'Spiced potato and pea filling wrapped in a crispy pastry shell, served with mint chutney.', 'Potatoes, peas, onions, garlic, ginger, spices (cumin, coriander, turmeric, garam masala), pastry dough, mint chutney', '1. Boil potatoes and peas until tender. 2. Sauté onions, garlic, and ginger with spices. 3. Add boiled potatoes and peas, then mash lightly. 4. Fill pastry dough with potato-pea mixture and seal into triangles. 5. Fry until golden brown. 6. Serve with mint chutney.', 4, 25, 'Appetizers', 'Africa', 'assets/images/samosas.jpg'),
(19, 9, 'Creme Brulee', 'French dessert made with rich custard topped with caramelized sugar.', 'Heavy cream, egg yolks, sugar, vanilla extract', '1. Heat cream until hot but not boiling. 2. Whisk together egg yolks, sugar, and vanilla extract. 3. Gradually pour hot cream into egg mixture while whisking. 4. Strain mixture and pour into ramekins. 5. Bake in a water bath until set. 6. Chill in the refrigerator. 7. Sprinkle sugar on top and caramelize with a torch.', 4, 45, 'Desserts', 'Europe', 'assets/images/Creme Brulee.jpg'),
(20, 9, 'Hamburger', 'Classic American sandwich made with a beef patty, lettuce, tomato, onion, pickles, and condiments.', 'Ground beef, hamburger buns, lettuce, tomato, onion, pickles, ketchup, mustard, mayonnaise. ', '1. Form ground beef into patties and grill until cooked to desired doneness. 2. Toast hamburger buns. 3. Assemble burgers with lettuce, tomato, onion, pickles, and condiments.', 4, 30, 'Main dish', 'North America', 'assets/images/Hamburger.jpg'),
(21, 8, 'Nachos', 'Tex-Mex appetizer made with tortilla chips topped with melted cheese, beans, jalapenos, and sour cream.', 'Tortilla chips, shredded cheese, black beans, jalapenos, sour cream, salsa, guacamole', '1. Spread tortilla chips on a baking sheet. 2. Sprinkle shredded cheese and black beans over the chips. 3. Bake until cheese is melted and bubbly. 4. Top with sliced jalapenos, sour cream, salsa, and guacamole.', 6, 20, 'Appetizers', 'North America', 'assets/images/Nachos.jpg'),
(22, 8, 'Chocolate Chip Cookies', 'Classic American cookies made with butter, sugar, flour, chocolate chips, and vanilla extract.', 'Butter, sugar, brown sugar, eggs, vanilla extract, flour, baking soda, salt, and chocolate chips.', '1. Cream together butter, sugar, and brown sugar. 2. Beat in eggs and vanilla extract. 3. Mix in flour, baking soda, and salt. 4. Stir in chocolate chips. 5. Drop dough onto baking sheets and bake until golden brown.', 12, 15, 'Desserts', 'North America', 'assets/images/Chocolate Chip Cookies.jpg'),
(23, 8, 'Ful Medames', 'Traditional Egyptian dish made with fava beans, garlic, lemon juice, and olive oil, served with pita bread.', 'Fava beans, garlic, lemon juice, olive oil, cumin, salt, pepper, pita bread. ', '1. Cook fava beans until tender. 2. Mash beans with garlic, lemon juice, olive oil, cumin, salt, and pepper. 3. Serve warm with pita bread.', 4, 30, 'Appetizers', 'Africa', 'assets/images/Ful Medames.jpeg'),
(24, 8, 'Bobotie', 'South African dish made with spiced minced meat topped with an egg custard.', 'Ground beef, onions, curry powder, chutney, bread, milk, eggs, bay leaves. ', '1. Sauté onions and curry powder. 2. Add ground beef and cook until browned. 3. Stir in chutney and bread soaked in milk. 4. Transfer mixture to a baking dish. 5. Top with beaten eggs and bay leaves. 6. Bake until set and golden brown.', 6, 45, 'Main dish', 'Africa', 'assets/images/Bobotie.jpeg'),
(25, 8, 'Malva Pudding', 'South African dessert made with sponge cake soaked in a sweet and sticky caramel sauce.', 'Butter, sugar, eggs, apricot jam, vinegar, flour, baking soda, milk, vanilla extract, cream, sugar, butter.', '1. Cream together butter and sugar. 2. Beat in eggs and apricot jam. 3. Mix in vinegar, flour, and baking soda. 4. Pour batter into a baking dish and bake until golden brown. 5. Prepare sauce with milk, sugar, and butter. 6. Pour sauce over hot pudding and let it soak in', 8, 60, 'Desserts', 'Africa', 'assets/images/Malva Pudding.jpg'),
(26, 9, 'Bruschetta', 'Italian appetizer made with toasted bread topped with diced tomatoes, basil, garlic, and olive oil.', 'Baguette, tomatoes, garlic, fresh basil, olive oil, balsamic vinegar, salt, pepper.', '1. Slice baguette and toast until crispy. 2. Rub toasted bread with garlic. 3. Top with diced tomatoes, chopped basil, olive oil, and balsamic vinegar. 4. Season with salt and pepper.', 4, 20, 'Appetizers', 'Europe', 'assets/images/Bruschetta.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `saved_recipes`
--

CREATE TABLE `saved_recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `saved_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved_recipes`
--

INSERT INTO `saved_recipes` (`id`, `user_id`, `recipe_id`, `saved_at`) VALUES
(2, 6, 4, '2024-04-09 18:58:52'),
(3, 6, 6, '2024-04-09 19:01:13'),
(4, 7, 21, '2024-04-11 04:33:07'),
(5, 10, 2, '2024-04-11 05:26:32'),
(6, 4, 4, '2024-04-11 06:32:24'),
(8, 7, 15, '2024-04-11 10:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('recipe_seeker','cook_chef','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`) VALUES
(1, 'Lebara', 'lebara@gmail.com', '$2y$10$FeCdtWwMlTpr3PAiDnQTiOU/e0m2sCYV3CmJ1k3Wxqs6kHamF9RMy', 'recipe_seeker'),
(2, 'Eo', 'eo@gmail.com', '$2y$10$MnikKa7wMcKRc1lkHcjVtuQa8kOl5W.iKXOyUJo7GrJHiaqat2rCW', 'recipe_seeker'),
(3, 'Canton', 'canton@gmail.com', '$2y$10$QQ.UEuPsjsdVXQ41T1X6NeV/SUqqseN9pcwEl0vVnLKYdNF/lmhxO', 'recipe_seeker'),
(4, 'melisa', 'melisa@gmail.com', '$2y$10$JR1K/28ETMLiK7qnt0Ui/ub76UpDYeIyZXR7yTTWYZnWOyv9XnL5e', 'recipe_seeker'),
(5, 'malton', 'malton@gmail.com', '$2y$10$oMaEDVhbg4W05YRFrRrpSu6J7/P5gcs8asQ8Pkbg9cEfauIVl8rfq', 'cook_chef'),
(6, 'Jamie Oliver', 'jamie@gmail.com', '$2y$10$uXi.12WfP7Bylb7FYs7D6eOgna9PCnQRndLxBTm3mKim59MTBYyeG', 'cook_chef'),
(7, 'Gordon Ramsey', 'gordon12@gmail.com', '$2y$10$6eT9FHiW4Rl3qX96cK4ra.RZo0zkKn46YCDFH2YOPCybNPSCHgNvq', 'cook_chef'),
(8, 'Nigella Lawson', 'nigella@gmail.com', '$2y$10$veQtr7GByBkZ7Yrymz3Aveodl341ymkPpOl21FUyVghjiBoUfkkLS', 'cook_chef'),
(9, 'Bobby Flay', 'bobby@gmail.com', '$2y$10$obYId/jSuA/zlmnt7HlPaORjJJZktGVr874ytVK3vmZLTI4sITFWm', 'cook_chef'),
(10, 'Julia Child', 'julia@gmail.com', '$2y$10$9./RycZelhkEHibj9DCdL.crKLEH0r1M3h/NtpXOLn5InJJQi3ePi', 'cook_chef'),
(14, 'Savor Palette', 'savorpalette001@gmail.com', '$2y$10$OKUv0jR./ubOukQ430hTr.99MaK8EQHRL77I.vuT/PtVBb0w1XcHO', 'admin'),
(15, 'kiery', 'virgev1213@gmail.com', '$2y$10$EdTSYvRiP1PPQlCiS4elPuXomSXiLtDS/ML18m9ho8i1VXh7OTRQK', 'cook_chef'),
(16, 'bright29', 'bright29@gmail.com', '$2y$10$LX9E3kGbI5NWQ.IzsDy19uK4N8CBvq71dJIhP1.gnWqbNER.IKiQi', 'cook_chef'),
(17, 'Pimpim', 'pimpim@gmail.com', '$2y$10$wuhY.44HDUqEw4tOT1yB7O8UTJs9Z6yFuKshwbu9AcJ1Ejf5AVMzm', 'cook_chef'),
(18, 'vijay', 'vijay@gmail.com', '$2y$10$AsuHgs4z654Hl5DicOQUI.2bnOhv1S.DO4Qyp1g3LyN9lBaY6o0Yq', 'cook_chef');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `saved_recipes`
--
ALTER TABLE `saved_recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name_2` (`username`),
  ADD UNIQUE KEY `name_3` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `saved_recipes`
--
ALTER TABLE `saved_recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `saved_recipes`
--
ALTER TABLE `saved_recipes`
  ADD CONSTRAINT `saved_recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `saved_recipes_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
