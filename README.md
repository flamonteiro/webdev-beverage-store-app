# 🍻 Beverage Distributor Management System

A web-based beverage distribution management system developed in **PHP** using the **MVC architecture**. The application allows commercial customers to purchase beverages while providing administrators with complete control over inventory, freight rates, cities, and sales management.

> Developed as a practical project for the **Web Systems Development** course at the Federal University of Espírito Santo (UFES).

---

## ✨ Features

### Administrator
- Beverage management (Create, Read, Update and Delete)
- Inventory control and stock updates
- City registration and freight management
- Sales history
- Administrative dashboard

### Customer
- Secure authentication
- Browse available beverages
- Shopping cart
- Stock validation before checkout
- Automatic freight calculation based on destination city
- Order confirmation

### Authentication
- Login system
- Session persistence using PHP Sessions/Cookies
- Automatic authentication for previously logged-in users

---

## 📦 Business Rules

- Customers can only purchase quantities available in stock.
- Each order consists of one or more beverages with their respective quantities.
- Freight is calculated using the following formula:

```text
Freight = City Freight Rate × Total Value of Ordered Products
```

- The final sale value is calculated as:

```text
Total Sale = Products Total + Freight
```

---

## 🛠 Technologies

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- PDO
- MVC Architecture

---

## 📁 Project Structure

```text
/distribuidora/
│
├── config/
│   └── database.php          # PDO database connection
│
├── models/                   # Database models
│   ├── Bebida.php
│   ├── Cidade.php
│   ├── Cliente.php
│   └── Pedido.php
│
├── controllers/              # Business logic
│   ├── AuthController.php
│   ├── BebidaController.php
│   ├── CidadeController.php
│   └── PedidoController.php
│
├── views/
│   ├── layouts/
│   ├── auth/
│   ├── admin/
│   ├── cliente/
│   └── shared/
│
├── public/
│   ├── css/
│   ├── js/
│   └── img/
│
├── helpers/
│   └── session.php
│
└── index.php                 # Application entry point
```

---

## 🚀 Getting Started

### Requirements

- PHP 8+
- MySQL
- Apache (XAMPP, WAMP or Laragon)

### Installation

1. Clone the repository

```bash
git clone https://github.com/your-username/distribuidora.git
```

2. Import the provided database into MySQL.

3. Configure the database credentials in:

```text
config/database.php
```

4. Place the project inside your web server directory (e.g. `htdocs`).

5. Start Apache and MySQL.

6. Access the application:

```text
http://localhost/distribuidora
```

---

## 📚 Architecture

The project follows the **Model-View-Controller (MVC)** design pattern:

- **Models** handle database operations.
- **Controllers** implement business rules.
- **Views** render the user interface.
- **Helpers** provide reusable utilities.
- **Config** stores application configuration.

---

## 📖 Academic Project

This project was developed as part of the **Web Systems Development** course at **Federal University of Espírito Santo (UFES)**, following the requirements proposed by the instructor for the beverage distributor management system.

---

## 👥 Contributors

- Flávio Monteiro
- Lara Tidesco
- Bryan Cantanheides
- Hiago Lopes

---

## 📄 License

This project was developed for academic purposes.
