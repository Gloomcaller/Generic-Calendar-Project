# Calendar Web App

A responsive and interactive calendar web app built with **PHP**, **MySQL**, **JavaScript**, **HTML**, and **CSS**.
This calendar allows users to create, edit, and delete events with detailed descriptions and time ranges.

## Overview

This project is a simple and lightweight calendar web app built for managing events like meetings, appointments, or personal reminders.
It is designed for developers and students looking to learn or integrate a basic calendar system into their own projects.

## Features

- **Add, edit, and delete events** with titles, descriptions, dates, and time slots.
- **Responsive design** – works on both desktop and mobile devices.
- **Current date highlighting** for better navigation.
- **Navigation buttons** to move between months.
- **"Today" button** to quickly jump to the current month.
- **Live clock** displayed on the header.
- **Modal form** for event management.
- **Light, modern styling** with customizable CSS variables.

## Screenshots

**Main Calendar View**  
*(Will be added after style changes)*

**Add/Edit Event Modal**  
*(Will be added after style changes)*

## Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## Installation & Setup

### 1. Clone Repository
Clone this repository into your `htdocs` directory (XAMPP default path is `C:\xampp\htdocs`):
```bash
git clone https://github.com/Gloomcaller/Generic-Calendar-Project.git
```

### 2. Configure Database
- Create a new database `calendar_database` using **phpMyAdmin** or CLI.
- Import the SQL schema located in the `database` folder.

### 3. Start Server
Run the project locally using **XAMPP**, **WAMP**, or any PHP server:
```
http://localhost/Generic-Calendar-Project/index.php
```

## Usage

1. Open the calendar in your browser.
2. Navigate between months using the arrow buttons.
3. Click **Add** on a date to create an event.
4. Click **Edit** on an existing event to modify or delete it.
5. Use the **Today** button to return to the current month.

## Known Issues / To-Do

- Implement **year and month dropdown selectors** for faster navigation.
- Improve **mobile scaling** for very small devices (< 360px).
- Add a **dark mode** toggle.
- Optimize database queries for large event sets.

## License

This project is licensed under the **MIT License**.  
See the [LICENSE](LICENSE) file for more details.
