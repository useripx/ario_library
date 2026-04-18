# Ario Library

**Ario Library** is a modern library management system built with custom PHP Native (MVC), designed to provide a seamless experience for both administrators and members.

## 🚀 Features

### For Members (Front-end)
- **OPAC (Online Public Access Catalog)**: Search for books by title, author, category, or publisher.
- **Interactive PDF Viewer**: Read borrowed books directly in the browser using an integrated interactive viewer.
- **Member Dashboard**: Manage borrowing history, track due dates, and maintain a wishlist.
- **Online Renewal & Booking**: Extended flexibility for book borrowing.

### For Administrators (Back-end)
- **Multi-level Admin**: Separate dashboards for Super Admin and Branch Admins.
- **Inventory Management**: Full CRUD for books, categories, authors, and publishers.
- **Circulation Control**: Real-time management of loans, returns, and fines.
- **Google Drive Integration**: Efficient PDF storage using Google Drive links to optimize hosting space.

## 🛠️ Tech Stack
- **Language**: PHP 8.4.15 (Native MVC)
- **Database**: MySQL
- **Styling**: HTML5, CSS3, Vanilla JavaScript
- **Storage**: Local Database + Google Drive for digital assets
- **Library**: PDF.js for interactive reading

## 📂 Project Structure
```text
├── app/            # Application logic (Controllers, Models, Views)
├── core/           # Core framework classes
├── config/         # Configuration files
├── public/         # Public entry point (index.php, CSS, JS, Images)
├── docs/           # Project documentation
├── db/             # Database schemas and plans
└── request/        # Initial project requirements
```

## 📖 Documentation
Detailed documentation can be found in the [docs/](docs/) folder:
- [Setup Guide](docs/setup.md)
- [Architecture Overview](docs/architecture.md)

## 👤 Author
Developed by **useripx**

---
*Ario Library - Bridging knowledge and convenience.*
