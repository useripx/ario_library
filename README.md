<div align="center">
  <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg" alt="PHP Logo" width="160" />

  <h1>Ario Library</h1>

  <p><strong>A Modern Library Management System Built with Native PHP MVC</strong></p>

  <!-- Tech Stack Badges -->
  <p>
    <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
    <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
    <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap" />
    <img src="https://img.shields.io/badge/Google_Drive-4285F4?style=for-the-badge&logo=googledrive&logoColor=white" alt="Google Drive API" />
  </p>

  <!-- Repo Stats Badges -->
  <p>
    <a href="https://github.com/useripx/ario_library/stargazers"><img src="https://img.shields.io/github/stars/useripx/ario_library?style=flat-square&logo=github&color=black" alt="Stars" /></a>
    <a href="https://github.com/useripx/ario_library/network/members"><img src="https://img.shields.io/github/forks/useripx/ario_library?style=flat-square&logo=github&color=black" alt="Forks" /></a>
    <a href="https://github.com/useripx/ario_library/issues"><img src="https://img.shields.io/github/issues/useripx/ario_library?style=flat-square&color=e25858" alt="Issues" /></a>
    <a href="https://github.com/useripx/ario_library/pulls"><img src="https://img.shields.io/github/issues-pr/useripx/ario_library?style=flat-square&color=007ec6" alt="Pull Requests" /></a>
    <a href="https://github.com/useripx/ario_library/commits"><img src="https://img.shields.io/github/last-commit/useripx/ario_library?style=flat-square&color=4c1" alt="Last Commit" /></a>
    <img src="https://img.shields.io/github/repo-size/useripx/ario_library?style=flat-square&color=d87a32" alt="Repo Size" />
    <img src="https://img.shields.io/github/license/useripx/ario_library?style=flat-square&color=c7b727" alt="License" />
  </p>
</div>

<br>

## 🚀 Features

### For Members (Front-end)
- **OPAC (Online Public Access Catalog)**: Search for books by title, author, category, or publisher with clean pagination and custom limits.
- **Interactive Secure Reader**: Read borrowed PDF books directly in the browser. Features advanced security including right-click and Inspect Element protection.
- **Wishlist & Favorites**: Save books you want to read later into your personal wishlist.
- **Member Dashboard**: Manage borrowing history, track due dates, and explore curated books.
- **Automated Book Returns**: Books are automatically returned by the system if overdue for more than 15 days, with instant alert notifications for the user.

### For Administrators (Back-end)
- **Multi-level Admin**: Separate dashboards for Super Admin and Branch Admins.
- **Inventory Management**: Full CRUD operations for books, categories, authors, and publishers.
- **Google Drive Auto-Sync**: Efficient PDF storage. Sync new books directly from Google Drive to the website using Webhooks and Google Apps Script.
- **Advanced Download Lock**: Automatically block viewers from downloading, printing, or copying PDFs via the Google Drive API.
- **Circulation Control**: Real-time management of loans, returns, and automatic foreign key constraints handling.

## 🛠️ Tech Stack
- **Language**: PHP 8.4 (Native MVC)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, Bootstrap, Vanilla JavaScript, SweetAlert2
- **Storage**: Local Database + Google Drive API
- **Automation**: Google Apps Script (GAS) + Webhook (Ngrok)

## 📂 Project Structure
```text
├── app/            # Application logic (Controllers, Models, Views)
├── core/           # Core framework classes
├── config/         # Configuration files
├── public/         # Public entry point (index.php, CSS, JS, Images)
├── docs/           # Project documentation, setups, & walkthroughs
└── db/             # Database schemas
```

## 📖 Documentation
Detailed documentation can be found in the [docs/](docs/) folder:
- [Ario Lib Workflow](docs/Ario%20Lib.md)
- [GAS Bot Sync Setting](docs/GASSetting.md)
- [Feature Checklist](docs/fitur.md)
- [Implementation Plans](docs/implementasi.md)

## 👤 Author
Developed by **useripx**

---
*Ario Library - Bridging knowledge and convenience.*
