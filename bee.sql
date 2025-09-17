-- bee.sql (Final Version: filenames only for product images)
CREATE DATABASE IF NOT EXISTS bee CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bee;

-- Drop old tables if they exist
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

-- Users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  category VARCHAR(50),
  color VARCHAR(50),
  price DECIMAL(10,2),
  image VARCHAR(255)
);

-- Orders table
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(100),
  user_email VARCHAR(100),
  address TEXT,
  total_price DECIMAL(10,2),
  status VARCHAR(20) DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Order items table
CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT,
  quantity INT,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Sample Products (filenames only, PHP adds 'images/')
INSERT INTO products (name, category, color, price, image) VALUES
('Heat Bottle', 'Accessories','Black',15.00,'Heat bottle (Recent product 3).jpg'),
('Neon Shoe', 'Men','Neon',120.00,'Neon Shoe (Recent product 2).jpg'),
('Fit Cap', 'Accessories','Black',18.00,'Fit Cap (Accessories).jpg'),
('Women''s Track Shoe Air 2', 'Women','Black/Yellow',95.00,'Whisk_c049dcac4c.jpg'),
('Women Track Bottom Fit', 'Women','Black',35.00,'Whisk_578fcc2beb.jpg'),
('Men Running Shoe Air', 'Men','Black',110.00,'Whisk_b9590d254e.jpg');
