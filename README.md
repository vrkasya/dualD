# Campus Event Management Web Application

This is a simple web application for campus organizations to manage events such as seminars, workshops, and competitions.

## Features

- Landing page with a list of upcoming events
- User registration and login
- Event registration form for participants
- Admin dashboard for CRUD operations on events
- Data storage using MySQL
- Success notifications after registration
- Modular folder structure suitable for XAMPP and GitHub

## Project Structure

```
project-name/
├── index.php
├── assets/
│   ├── css/
│   ├── js/
│   └── img/
├── includes/
├── pages/
├── admin/
├── actions/
├── config/
└── database/
```

## Setup Instructions

1. Import the database schema from `database/init.sql` into your MySQL server.
2. Configure your database connection in `config/db.php`.
3. Place the project folder inside your XAMPP `htdocs` directory.
4. Start Apache and MySQL services in XAMPP.
5. Access the application via `http://localhost/project-name/index.php`.

## Notes

- This project is intended for educational purposes.
- Passwords are hashed using PHP's `password_hash` function.
- Admin authentication is basic and can be extended.

## License

MIT License
