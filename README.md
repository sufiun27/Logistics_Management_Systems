## Logistics Management Systems

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Contract for more information
- Email: abusufiun27@gmail.com
- Phone: +880 1878 000 675

## Installation

1. **Clone the Repository**: 
   ```bash
   git clone https://github.com/sufiun27/Logistics_Management_Systems.git
   ```

2. **Install Composer Dependencies**: 
   ```bash
   composer install
   ```

3. **Create `.env` File**: 
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**: 
   ```bash
   php artisan key:generate
   ```

5. **Set Up Database**: 
   - Configure your database connection details in the `.env` file.
   - Update the following variables with your database information:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```

6. **Run Migrations and Seeders**  
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Serve the Application**: 
   ```bash
   php artisan serve
   ```
<hr>

## Brief Overview

## Login
To access the system, use your email and password.

![Login](image.png)

## Features
Once logged in, you can manage the logistics system with the following features:

### Export Forms Management
You can manage:
- Exporter
- Destination Country
- Consignee
- Transport
- TT Information
- Export Form

![Export Forms](image-1.png)

#### Exporter Management
You can add and modify exporters:

![Add Exporter](image-2.png)
![Modify Exporter](image-3.png)

#### Destination Country, Consignee, Transport, TT Information, and Export Form Management
Similarly, you can add and modify details for Destination Country, Consignee, Transport, TT Information, and Export Form.

### TT Information
In TT Information, you can manage the following details. The system is configured with Yajra Datatables, providing pagination, search functionality, and the ability to export data in Excel and PDF formats. It can handle thousands of records with server-side processing.

![TT Information](image-4.png)

### Export Form
You can manage the Export Form details with live data updates via AJAX. Yajra Datatables enable pagination and search functionality.

![Export Form](image-5.png)

### Shipping Information
Manage shipping information:

![Shipping Information](image-6.png)

### Audit Management
Handle audits with Yajra Datatables:

![Audit](image-7.png)

### Billing Details
Manage billing details:

![Billing Details](image-8.png)

### Logistic Details
Manage logistic details:

![Logistic Details](image-9.png)

### Employee Authentication and Authorization
The system supports employee authentication and authorization with specific roles. You can activate or deactivate users and handle password reset functionality. You can also assign specific roles and permissions to users.

![Employee Roles](image-10.png)

You can activate or deactivate specific roles and permissions as well.

![Role Management](image-11.png)

### Reports
In the report section, you can view various reports with detailed information.

---

This README provides an overview of the features and capabilities of the Logistics Management System. For more detailed instructions on how to use each feature, refer to the respective sections above.

```
