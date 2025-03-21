

```markdown
# Laravel Project with Docker Compose and Livewire

This is a Laravel project configured to run in a Dockerized environment using Laravel Sail. It includes Livewire components for dynamic functionality and a Redis cache for improved performance.

## Features

- **Dockerized Environment**: Easily set up and run the application using Docker Compose.
- **Livewire Integration**: Dynamic and reactive components for a seamless user experience.
- **Redis Cache**: Used for caching and session storage.
- **MariaDB Database**: A robust database for storing application data.
- **Authentication**: Includes login and registration functionality with rate limiting.

---

## Prerequisites

Before starting, ensure you have the following installed:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)

---

## Setup Instructions

Follow these steps to set up and run the project:

### 1. Clone the Repository

```bash
git clone <repository-url>
cd <repository-folder>
```

### 2. Install Dependencies

Install Laravel dependencies using Composer:

```bash
composer install
```

### 3. Copy the `.env` File

Create a `.env` file by copying the example file:

```bash
cp .env.example .env
```

Update the `.env` file with your environment-specific values (e.g., database credentials, app URL).

### 4. Start Docker Containers

Use Docker Compose to build and start the containers:

```bash
./vendor/bin/sail up -d
```

### 5. Run Database Migrations

Run the Laravel migrations to set up the database schema:

```bash
./vendor/bin/sail artisan migrate
```

### 6. Access the Application

- Open your browser and navigate to `http://localhost` (or the port specified in `APP_PORT` in your `.env` file).

---

## Services Overview

The `docker-compose.yml` file defines the following services:

1. **laravel.test**:
   - The main application container running the Laravel application.
   - Includes support for Xdebug and Vite for development.
   - Mounts the project directory into the container for live development.

2. **redis**:
   - A lightweight Redis container for caching and session storage.
   - Exposes port `6379` for communication.

3. **mariadb**:
   - A MariaDB database container for storing application data.
   - Exposes port `3306` for database connections.

---

## Common Commands

Here are some common commands for working with the Docker environment:

- **Start the Containers**:
  ```bash
  ./vendor/bin/sail up -d
  ```

- **Stop the Containers**:
  ```bash
  ./vendor/bin/sail down
  ```

- **Run Artisan Commands**:
  ```bash
  ./vendor/bin/sail artisan <command>
  ```

- **Run Composer Commands**:
  ```bash
  ./vendor/bin/sail composer <command>
  ```

- **Run NPM Commands**:
  ```bash
  ./vendor/bin/sail npm <command>
  ```

- **Access the Application Container**:
  ```bash
  ./vendor/bin/sail shell
  ```

---

## Livewire Components

### Authentication Component

The `login.blade.php` file handles user authentication with the following features:

- **Email and Password Validation**: Ensures valid credentials are provided.
- **Rate Limiting**: Prevents brute force attacks by limiting login attempts.
- **Session Regeneration**: Secures the session after successful login.

### Cart Component

The `Cart.php` Livewire component manages the shopping cart functionality:

- **Add Items**: Dynamically adds items to the cart.
- **Remove Items**: Updates the cart and recalculates the total when items are removed.
- **Clear Cart**: Empties the cart and emits events to update other components.

---

## Environment Variables

The project uses environment variables defined in the `.env` file. Below are the key variables:

- **APP_PORT**: The port on which the Laravel application will run (default: `80`).
- **VITE_PORT**: The port for Vite's development server (default: `5173`).
- **DB_DATABASE**: The name of the database.
- **DB_USERNAME**: The database username.
- **DB_PASSWORD**: The database password.
- **FORWARD_REDIS_PORT**: The port for Redis (default: `6379`).
- **FORWARD_DB_PORT**: The port for MariaDB (default: `3306`).

---

## Troubleshooting

If you encounter issues, try the following:

1. **Check Container Logs**:
   ```bash
   ./vendor/bin/sail logs <service-name>
   ```

2. **Rebuild Containers**:
   ```bash
   ./vendor/bin/sail build --no-cache
   ```

3. **Clear Laravel Cache**:
   ```bash
   ./vendor/bin/sail artisan cache:clear
   ./vendor/bin/sail artisan config:clear
   ./vendor/bin/sail artisan route:clear
   ./vendor/bin/sail artisan view:clear
   ```

4. **Verify Environment Variables**:
   Ensure the `.env` file is correctly configured.

---

## License

This project is open-source and available under the MIT License.

[LICENSE](LICENSE.MD)
---
