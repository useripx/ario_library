# Project Setup Guide - Ario Library

This document outlines the steps to set up the Ario Library project locally.

## Prerequisites
- **PHP**: 8.4.15
- **Web Server**: Apache (with `mod_rewrite` enabled) or Nginx
- **Database**: MySQL 8.0+
- **Environment**: Laragon, XAMPP, or manual stack

## Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/useripx/ario_library.git
   cd ario_library
   ```

2. **Database Configuration**
   - Create a database named `ario_library`.
   - Import the schema from `db/db_plan.md` or a generated SQL file (to be provided).
   - Configure credentials in `config/config.php` (once created).

3. **Virtual Host (Recommended)**
   Set up a virtual host pointing to the `/public` directory:
   - Example: `ario-library.test` -> `c:\laragon\www\Ario Library\public`

4. **Google Drive Integration**
   - Use the Google Drive API or direct share links for PDF storage.
   - Links should be stored in the `books` table under the relevant field.

## Verification
- Access the project in your browser.
- The `index.php` in `public/` should handle routing.
