# Contact Manager

This project is a contact manager built with PHP and Laravel. It allows users to store and manage their contacts efficiently. 

## Running

To run this project, follow the steps below:

1. Clone the repository to your local machine.
2. Install the required dependencies by running the following command:
  ```
  composer install
  ```
3. Update the necessary configuration values such as database credentials at `.env`.
4. Run the database migrations to create the necessary tables:
  ```
  php artisan migrate
  ```
5. Start the development server:
  ```
  php artisan serve
  ```

## Docker Compose

This project also includes a `docker-compose.yaml` file, allowing you to run the application using Docker. To do so, follow these steps:

1. Make sure you have Docker installed on your machine.
2. Navigate to the project directory.
3. Run the following command to start the containers:
  ```
  docker-compose up --build -d
  ```
4. Access the application by visiting `http://localhost:8000` in your web browser.

That's it! You now have the Contact Manager up and running. Feel free to explore its features and manage your contacts effortlessly.
