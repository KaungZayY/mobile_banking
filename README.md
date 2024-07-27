# Mobile Banking
This project is a prototype of a mobile banking system developed by students. It features a user interface where customers can perform typical banking transactions such as viewing account balances, transferring funds, and applying for loans. Additionally, there is an admin panel for managing user accounts, monitoring transactions, and handling loan applications.

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [GettingStarted](#getting-started)
- [Conclusion](#conclusion)

## Introduction

A student-developed prototype designed to simulate a modern online banking system. This project serves as a learning tool for understanding the fundamental operations of mobile banking applications. Users can perform essential banking tasks such as viewing account balances, transferring funds, and applying for loans through an intuitive user interface. Additionally, the system includes an admin panel for administrative tasks such as managing user accounts and monitoring transactions. Built with HTML, CSS, and JavaScript for the frontend and PHP for the backend, and MySQL for the database, this project is also containerized using Docker to ensure seamless deployment and scalability.

## Features

### User Interface

1. **Account Management**
   - View account balance and transaction history
   - Update personal information

2. **Funds Transfer**
   - Transfer funds between accounts
   - Schedule recurring transfers

3. **Loan Management**
   - Apply for loans
   - View loan status and repayment schedule

4. **Bill Payments**
   - Pay utility bills
   - Schedule future payments

5. **Notifications**
   - Receive alerts for transactions
   - Get reminders for bill payments and loan dues

### Admin Panel

1. **User Management**
   - Create, update, and delete user accounts
   - View user transaction history

2. **Transaction Management**
   - Monitor and approve large transactions
   - Generate reports on transaction activities

3. **Loan Management**
   - Review and approve loan applications
   - Manage loan interest rates and terms

4. **System Settings**
   - Configure system settings and parameters
   - Manage security settings and access controls

### Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, Laravel
- **Database:** MySQL

## Getting Started

### Prerequisites
- **Docker:** installed on your system
- **Docker Compose:** installed on your system

### Step 1: Clone the Repository

Clone the repository on your local machine and `cd` to the Project.

```bash
cd mobile_banking
```

### Step 2: Add Nacessary Repositories

At the root of your project directory, create a new folder named images.

```bash
mkdir images
```

Inside the `images` folder, create three subfolders named `loans`, `nrcs` and `profiles`.

```bash
cd images
mkdir loans nrcs profiles
```

Your project directory structure should now look like this:

```
mobile_banking/
├── admins/
├── customers/
├── images/
│   ├── loans/
│   ├── nrcs/
│   └── profiles/
└── (other project files and folders)
```

### Step 3: Build the Docker Image

Build the docker image by using the following bash command.

```bash
docker-compose build --no-cache
```
### Step 4: Run the Docker Container

Run the Docker container in the detach mode.

```bash
docker-compose up -d
```

### Step 5: File Write Permission to User

Get all the containers that are currently running

```bash
docker ps
```

Copy the id of container named `mobile_banking-web`.

Execute the container

```bash
docker exec -it `image_id` bash
```

Inside the container, run the following commands

```bash
chown -R www-data:www-data /var/www/html/images
chmod -R 775 /var/www/html/images
```

Exit the container

```bash
exit
```

### Step 6: Import the database

Go to `http://localhost:8081/` to access phpmyadmin pannel and import the database /database/mobiile_banking.sql 

### Step 7: Restart the container

```bash
docker-compose down
docker-compose up -d
```

## Conclusion

This mobile banking website prototype demonstrates the essential functionalities of a typical banking system, providing a practical learning experience in web application development and financial technology. While it is not a full-scale application, it serves as a foundation for further development and enhancement into a more comprehensive banking solution.