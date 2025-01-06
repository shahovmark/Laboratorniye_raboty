-- Создание базы данных
CREATE DATABASE bookshop;

-- Использование базы данных
USE bookshop;

-- Создание таблицы пользователей
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

-- Создание таблицы книг
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

-- Добавление пользователей (пароли должны быть хешированы)
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$J...hashedPassword...', 'admin'), -- Замените на хеш пароля
('user1', '$2y$10$J...hashedPassword...', 'user');  -- Замените на хеш пароля

-- Добавление книг
INSERT INTO books (title, author, description) VALUES
('Мастер и Маргарита', 'Михаил Булгаков', 'Роман о любви и борьбе добра и зла.'),
('1984', 'Джордж Оруэлл', 'Антиутопия о тоталитарном государстве.'),
('Унесённые ветром', 'Маргарет Митчелл', 'Эпический роман о жизни в США во время Гражданской войны.');