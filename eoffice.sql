CREATE DATABASE IF NOT EXISTS eoffice_db;
USE eoffice_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('Admin','Supervisor','Employee') DEFAULT 'Employee'
);

INSERT IGNORE INTO users (username, password, role)
VALUES ('admin', 'admin', 'Admin');

CREATE TABLE IF NOT EXISTS documents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  dept VARCHAR(100),
  file_name VARCHAR(255),
  uploaded_by INT,
  status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
  uploaded_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_name VARCHAR(255),
  status ENUM('Pending','In Progress','Completed') DEFAULT 'Pending',
  progress INT DEFAULT 0,
  priority VARCHAR(20) DEFAULT 'Normal'
);
