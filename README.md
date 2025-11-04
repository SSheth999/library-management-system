# Library Book Management System

A complete CRUD (Create, Read, Update, Delete) web application for managing library books, built with **CodeIgniter 4**, **PHP 8.1**, **MySQL**, and **Docker**.

## Features

✅ **Full CRUD Operations** - Create, read, update, and delete book records  
✅ **Form Validation** - Required field validation for title, author, and publication year  
✅ **Image Upload** - Optional book cover image upload with placeholder support  
✅ **User-Friendly Interface** - Clean, responsive design with flash messages  
✅ **Delete Confirmation** - JavaScript confirmation dialog before deletion  
✅ **Docker Support** - Complete Docker setup for easy deployment  

## Technology Stack

- **Backend**: PHP 8.1 with CodeIgniter 4 framework
- **Frontend**: HTML5, CSS3, JavaScript (vanilla)
- **Database**: MySQL 8.0
- **Containerization**: Docker & Docker Compose
- **Version Control**: Git & GitHub

## Prerequisites

Before you view the application, ensure you have the following installed on your machine:

- [Docker](https://www.docker.com/get-started) (version 20.10 or later)
- [Docker Compose](https://docs.docker.com/compose/install/) (version 2.0 or later)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/) (optional, for local development)


## Project Structure

```
SSheth999/
├── app/
│   ├── Config/          # Configuration files
│   │   ├── App.php
│   │   ├── Database.php
│   │   ├── Routes.php
│   │   └── ...
│   ├── Controllers/     # Application controllers
│   │   ├── BaseController.php
│   │   └── Books.php    # Main CRUD controller
│   ├── Models/          # Database models
│   │   └── BookModel.php
│   ├── Views/           # View templates
│   │   └── books/
│   │       ├── index.php
│   │       ├── create.php
│   │       └── edit.php
│   └── Database/
│       └── Migrations/  # Database migrations
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css
│   │   └── images/
│   │       └── placeholder.png
│   ├── uploads/
│   │   └── books/       # Uploaded book covers
│   └── index.php        # Entry point
├── docker-compose.yml   # Docker Compose configuration
├── Dockerfile           # Web container definition
├── composer.json        # PHP dependencies
├── .env.example         # Environment variables template
└── README.md           # This file
```

## Usage Guide

### Creating a Book

1. Navigate to the "List of Books" page
2. Click the "Add New Book" button
3. Fill in the required fields:
   - **Title** (required)
   - **Author** (required)
   - **Genre** (optional)
   - **Publication Year** (required)
   - **Book Cover Image** (optional)
4. Click "Save"
5. You'll be redirected to the list page with a success message

### Editing a Book

1. From the "List of Books" page, click "Edit" on any book
2. Modify the fields as needed
3. Optionally upload a new cover image (replaces the old one)
4. Click "Update"
5. You'll be redirected with a success message

### Deleting a Book

1. From the "List of Books" page, click "Delete" on any book
2. Confirm the deletion in the dialog box
3. The book and its associated image will be removed
4. You'll see a success message

## Development & Design Decisions

### Why CodeIgniter 4?

- **Lightweight Framework**: CodeIgniter is known for its simplicity and ease of learning
- **Built-in Features**: Comes with form validation, database abstraction, and security features out of the box
- **MVC Architecture**: Clear separation of concerns (Model-View-Controller)
- **Active Community**: Well-documented and actively maintained
- **Performance**: Fast execution suitable for small to medium applications

### Why Docker?

- **Consistency**: Ensures the application runs the same way across all environments
- **Easy Setup**: New developers can get started with just `docker-compose up`
- **Isolation**: Containers isolate dependencies, preventing conflicts
- **Production-Ready**: Same containers can be used in development and production
- **MySQL Included**: Database container removes the need for local MySQL installation

### Database Design

- **Simple Schema**: The `books` table includes all necessary fields:
  - `id`: Primary key (auto-increment)
  - `title`, `author`, `genre`, `publication_year`: Book information
  - `cover_image`: Filename of uploaded image
  - `created_at`, `updated_at`: Timestamps for record tracking
- **Flexible**: Genre is optional, allowing for future expansion
- **Image Handling**: Images stored as filenames, actual files in `public/uploads/books/`

### Security Considerations

- **CSRF Protection**: CodeIgniter's built-in CSRF token protection
- **Input Validation**: Server-side validation on all forms
- **File Upload Security**: File type and size validation for image uploads
- **SQL Injection Prevention**: Using CodeIgniter's Query Builder (parameterized queries)
- **XSS Prevention**: Using `esc()` function to escape output in views

### Image Upload Strategy

- **Optional Upload**: Books can be created without cover images
- **Placeholder**: Default placeholder image displayed when no cover is available
- **File Management**: Old images are deleted when books are updated or deleted
- **File Naming**: Random filenames prevent conflicts and overwrites
- **Size Limit**: 2MB maximum file size to prevent abuse

### Frontend Design

- **Responsive**: Works on desktop, tablet, and mobile devices
- **Clean UI**: Modern, minimalist design focused on usability
- **Feedback**: Flash messages provide clear feedback for user actions
- **Accessibility**: Semantic HTML and proper labels for form inputs
- **No Dependencies**: Vanilla JavaScript (no jQuery or other libraries needed)

## Troubleshooting

### Application not loading

- Check if containers are running: `docker-compose ps`
- Check container logs: `docker-compose logs web`
- Verify port 8080 is not in use by another application

### Database connection errors

- Ensure the database container is running: `docker-compose ps db`
- Check database credentials in `.env` file
- Verify the database was created: `docker-compose exec db mysql -u library_user -p -e "SHOW DATABASES;"`

### Image upload not working

- Check directory permissions: `chmod -R 777 public/uploads`
- Verify the `public/uploads/books` directory exists
- Check file size (must be < 2MB)
- Verify file type (JPEG, PNG, or GIF only)

### Migration errors

- Ensure the database container is running
- Check database connection settings
- Try dropping and recreating the database:
  ```bash
  docker-compose exec db mysql -u library_user -p -e "DROP DATABASE library_db; CREATE DATABASE library_db;"
  docker-compose exec web php spark migrate
  ```

## Contributing

This is a prep work assignment. If you'd like to contribute improvements:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is open source and available under the MIT License.

## Author

**Siddharth Sheth**  
First year at Northeastern University studying Computer Science and Business Administration.

---

## Resources Used

This project was built following best practices from:
- [Learn to Code HTML & CSS](https://learn.shayhowe.com/html-css/)
- [The PHP Handbook](https://www.freecodecamp.org/news/the-php-handbook/)
- [Docker 101 Tutorial](https://www.docker.com/101-tutorial)
- [An Intro to Git and GitHub for Beginners](https://www.freecodecamp.org/news/git-and-github-for-beginners/)
- [CodeIgniter: Build Your First Application](https://codeigniter.com/user_guide/tutorial/index.html)
