-- Create the database
CREATE DATABASE IF NOT EXISTS patient_records;

-- Use the database
USE patient_records;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create the patients table
CREATE TABLE IF NOT EXISTS patients (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    case_number VARCHAR(30) NOT NULL UNIQUE,
    name VARCHAR(50) NOT NULL,
    age INT(3) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    diagnosis TEXT,
    treatment TEXT,
    log_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
