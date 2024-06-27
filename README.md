# Patient Record Management System

Welcome to the Patient Record Management System! This robust and efficient application is designed to streamline the management of patient information in healthcare settings. Leveraging the power of PHP for server-side scripting and MySQL for database management, it ensures data integrity and security.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Screenshots](#screenshots)
- Will update more soon...

## Features

- **User Authentication**: Secure login and registration system for administrators and healthcare providers.
- **Patient Records**: Add, update, delete, and view patient records efficiently.
- **Medical History**: Track and manage patient medical history.
- **Secure Data**: Ensure patient data security and integrity.

## Installation

### Prerequisites

- PHP >= 7.4
- MySQL >= 5.7
- Apache or Nginx web server
- Composer (for dependency management)

### Steps

1. **Clone the Repository**

    ```bash
    git clone https://github.com/vraval13/patient-record-management.git
    cd patient-record-management
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Create a MySQL Database**

    ```sql
    CREATE DATABASE patient_records;
    ```

4. **Import Database Schema**

    Import the provided SQL file to set up the database schema.

    ```bash
    mysql -u username -p patient_records < database/schema.sql
    ```

5. **Configure Environment Variables**

    Create a `.env` file in the root directory and configure your database and other settings.

    ```ini
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=patient_records
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
6. **Start the Server**

    Ensure your web server is configured to serve the application. For development, you can use PHP's built-in server:

    ```bash
    php -S localhost:8000
    ```

## Screenshots

### Initial Window :-
![image](https://github.com/vraval13/Patient_Record_Management/assets/125266587/676b168d-2e89-455d-a10b-ce9236215f3a)

### Admin Panel :-
![image](https://github.com/vraval13/Patient_Record_Management/assets/125266587/2516d098-ca3b-47f5-88b1-1a63faafc2b1)

### Dashboard :-
![image](https://github.com/vraval13/Patient_Record_Management/assets/125266587/0d9327e8-0717-4924-b802-63ad54b3dc7e)
