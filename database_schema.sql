-- Database: object_haven_db

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table structure for table `objects`
CREATE TABLE `objects` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10, 2) NOT NULL,
  `image_url` VARCHAR(255),
  `category_id` INT(11) UNSIGNED,
  `is_featured` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table structure for table `categories`
CREATE TABLE `categories` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE
);

-- Table structure for table `orders`
CREATE TABLE `orders` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `order_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `total_amount` DECIMAL(10, 2) NOT NULL,
  `shipping_address` TEXT NOT NULL
);

-- Table structure for table `order_items`
CREATE TABLE `order_items` (
  `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT(11) UNSIGNED NOT NULL,
  `object_id` INT(11) UNSIGNED NOT NULL,
  `quantity` INT(11) NOT NULL,
  `item_price` DECIMAL(10, 2) NOT NULL
);

-- Foreign key constraints (example)
ALTER TABLE `objects` ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`);
ALTER TABLE `orders` ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `order_items` ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`);
ALTER TABLE `order_items` ADD CONSTRAINT `fk_object` FOREIGN KEY (`object_id`) REFERENCES `objects`(`id`);