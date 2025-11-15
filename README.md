# php-series-manager-symfony

> A web application for managing TV series, built with the Symfony framework as part of an Alura course.

## About the Project

This project is a comprehensive web application for tracking TV series, developed to master the Symfony framework. It covers a wide range of features and concepts essential for modern web development.

The project includes:
*   Full MVC (Model-View-Controller) architecture with CRUD functionality.
*   Form implementation with session validation.
*   Integration of caching and security measures.
*   Advanced features like email handling, asynchronous processing, and file uploads.
*   A complete test suite to ensure application reliability.

## Tech Stack

*   [Symfony](https://symfony.com/)
*   [PHP](https://www.php.net/)
*   [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html)
*   [Composer](https://getcomposer.org/)
*   [Node.js](https://nodejs.org/) (for asset management)

## Usage

Below are the instructions for you to set up and run the project locally.

### Prerequisites

You need to have the following software installed:

*   [PHP](https://www.php.net/) (version 7.4 or higher)
*   [Composer](https://getcomposer.org/download/)
*   [Symfony CLI](https://symfony.com/download)
*   [Node.js](https://nodejs.org/) and npm

### Installation and Setup

Follow the steps below:

1.  **Clone the repository**
    ```bash
    git clone https://github.com/luizvilasboas/php-series-manager-symfony.git
    ```

2.  **Navigate to the project directory**
    ```bash
    cd php-series-manager-symfony
    ```

3.  **Install PHP dependencies**
    ```bash
    composer install
    ```

4.  **Install frontend assets**
    ```bash
    npm install
    npm run dev
    ```

5.  **Configure the environment**
    Create a local environment file by copying the example:
    ```bash
    cp .env .env.local
    ```
    Update the `DATABASE_URL` and other necessary settings in your new `.env.local` file.

6.  **Set up the database**
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

### Workflow

To run the application, start the built-in PHP server from the project root:
```bash
php -S localhost:8000 -t public
```
The application will be available in your browser at `http://localhost:8000`.

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request.

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.
