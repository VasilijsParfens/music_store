# Laravel Project Setup Guide

This guide will walk you through setting up a Laravel project, including installing Composer, configuring the environment file, migrating and seeding the database, generating an application key, managing storage, and running the development server.

# Tools used for development

- HTML
- CSS (with Tailwind Css)
- JavaScript
- Laravel
- VsCode
- Laragon

## Prerequisites

- PHP (>= 7.3)
- Composer
- MySQL or another database supported by Laravel

## Step 1: Install Composer

Composer is a dependency manager for PHP. If you haven't installed Composer yet, download and install it from [getcomposer.org](https://getcomposer.org).

To install Composer dependencies in your project, run the following command in your project directory:
```
composer install
```
## Step 2: Create .env File

The .env file contains environment-specific configuration, such as database connection details. Copy the .env.example file to create a new .env file:
```
cp .env.example .env
```
Next, edit the .env file to configure your database connection:

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=your_database_name
- DB_USERNAME=your_database_user
- DB_PASSWORD=your_database_password

## Step 3: Migrate and Seed the Database

To run the database migrations and seed the database with test data, use the following Artisan command:
```
php artisan migrate:refresh --seed
```
This command will reset the database and run all migrations, then seed it with test data.

## Step 4: Generate Application Key

Laravel requires an application key, which is used for encryption. Generate the application key by running:
```
php artisan key:generate
```
This command will update the APP_KEY value in your .env file.

## Step 5: Move album_covers Folder

Move the album_covers folder to the storage/app/public directory. You can use the following command:
```
mv path/to/album_covers storage/app/public/
```
Make sure to replace path/to/album_covers with the actual path to your album_covers folder.

## Step 6: Link Storage to Public Folder

To create a symbolic link from storage/app/public to public/storage, run the following Artisan command:
```
php artisan storage:link
```
This command allows you to access the files in storage/app/public from the public directory.

## Step 7: Run the Development Server

To start the Laravel development server, run the following command:
```
php artisan serve
```
This command will start a local development server at http://127.0.0.1:8000.

## 5 Test cases
| **Test Case ID** | **Controller**   | **Method**            | **Test Description**                                             | **Expected Outcome**                                             | **Result** |
|------------------|------------------|-----------------------|------------------------------------------------------------------|------------------------------------------------------------------|------------|
| TC01             | AlbumController  | index                 | Verify that the index method retrieves the newest and best-selling albums | The method should return the correct view with newest and best-selling albums | Passed     |
| TC02             | AlbumController  | sort                  | Verify that the sort method sorts albums by title in ascending order  | The method should return the albums sorted by title in ascending order | Passed     |
| TC03             | CommentController| storeComment          | Verify that a comment can be successfully added to an album      | The comment should be added to the database, and the view should show the comment | Passed     |
| TC04             | OrderController  | showLibrary           | Verify that the showLibrary method retrieves the authenticated user's orders | The method should return the correct view with the user's orders | Passed     |
| TC05             | UserController   | store                 | Verify that a new user can be successfully registered            | The user should be added to the database, logged in, and redirected to the homepage | Passed     |
