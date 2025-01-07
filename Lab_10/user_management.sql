
CREATE DATABASE bookshop;


USE bookshop;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);


CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);


CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);


INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$J...hashedPassword...', 'admin'), 
('user1', '$2y$10$J...hashedPassword...', 'user');  

-- Добавление книг
INSERT INTO books (title, author, description) VALUES
('Мастер и Маргарита', 'Михаил Булгаков', 'Роман о любви и борьбе добра и зла.'),
('1984', 'Джордж Оруэлл', 'Антиутопия о тоталитарном государстве.'),
('Унесённые ветром', 'Маргарет Митчелл', 'Эпический роман о жизни в США во время Гражданской войны.');
