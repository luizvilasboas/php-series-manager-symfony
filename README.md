# php-series-manager-symfony

This undertaking was created within the framework of an Alura course aimed at mastering Symfony. It offers a comprehensive exploration of the Symfony framework, encompassing:

- Complete MVC CRUD functionality
- Form implementation and session validation
- Integration of caching and security measures
- Handling of mailing, asynchronous processing, uploads, and testing

## Usage

Follow these steps to set up and run the Symfony project on your local machine.

### Prerequisites

Ensure that the following prerequisites are installed on your system:

- PHP (>= 7.4)
- Composer
- Symfony CLI
- Node.js and npm (for asset management)

### Steps

1. **Clone the Repository:**

   ```
   git clone https://gitlab.com/alura-courses-code/php/php-series-manager-symfony.git
   ```

2. **Navigate to Project Directory:**

   ```
   cd php-series-manager-symfony
   ```

3. **Install Dependencies:**

   ```
   composer install
   ```

4. **Configure Environment Variables:**

   Copy the provided `.env` file to create a new `.env.local` file.

   ```
   cp .env .env.local
   ```

   Update the necessary configuration settings in the `.env` file, such as database credentials.

5. **Create Database:**

   ```
   php bin/console doctrine:database:create
   ```

6. **Run Migrations:**

   ```
   php bin/console doctrine:migrations:migrate
   ```

7. **Install Frontend Assets:**

   ```
   npm install
   npm run dev
   ```

8. **Start the Symfony Server:**

   ```
   php -S localhost:8000 -t public
   ```

   Access the application at [http://localhost:8000](http://localhost:8000) in your web browser.

## Contributing

If you wish to contribute to this project, feel free to open a merge request. We welcome all forms of contribution!

## License

This project is licensed under the [MIT](https://gitlab.com/alura-courses-code/php/php-series-manager-symfony/-/blob/main/LICENSE). Refer to the LICENSE file for more details.
