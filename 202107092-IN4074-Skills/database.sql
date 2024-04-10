-- Drop the database if it already exists
DROP DATABASE IF EXISTS restaurant_db;

-- Create the database
CREATE DATABASE restaurant_db;

-- Switch to the created database
USE restaurant_db;

-- Create the menu_items table
CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(8, 2) NOT NULL
);

