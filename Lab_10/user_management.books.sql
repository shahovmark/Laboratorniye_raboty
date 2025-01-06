CREATE DATABASE user_management_books;

USE user_management;

-- Таблица авторов
CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Таблица категорий (жанров книг)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Таблица книг
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT NOT NULL,
    category_id INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES authors(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Вставка примеров данных

-- Добавление авторов
INSERT INTO authors (name) VALUES ('Иван Иванов');
INSERT INTO authors (name) VALUES ('Петр Петров');
INSERT INTO authors (name) VALUES ('Александр Сидоров');

-- Добавление категорий (жанров)
INSERT INTO categories (name) VALUES ('Фантастика');
INSERT INTO categories (name) VALUES ('История');
INSERT INTO categories (name) VALUES ('Биография');

-- Добавление книг
INSERT INTO books (title, author_id, category_id, price, description, image) 
VALUES ('Книга 1', 1, 1, 1200.00, 'Описание книги 1', 'book1.jpg');
INSERT INTO books (title, author_id, category_id, price, description, image) 
VALUES ('Книга 2', 2, 2, 1500.00, 'Описание книги 2', 'book2.jpg');
INSERT INTO books (title, author_id, category_id, price, description, image) 
VALUES ('Книга 3', 3, 3, 900.00, 'Описание книги 3', 'book3.jpg');
