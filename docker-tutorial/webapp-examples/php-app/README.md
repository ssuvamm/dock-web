# Simple PHP with Apache Docker Example

This example demonstrates how to containerize a simple vanilla PHP application using Docker and an official PHP image with Apache.

## Files

*   `index.php`: A simple PHP script that displays a message, current date/time, an environment variable, and PHP version.
*   `Dockerfile`: Instructions to build the Docker image.

## How to Run

1.  **Navigate to this directory:**
    ```bash
    cd webapp-examples/php-app
    ```

2.  **Build the Docker image:**
    Give your image a name, for example, `my-php-app`:
    ```bash
    docker build -t my-php-app .
    ```

3.  **Run the Docker container:**
    This command runs the container in detached mode and maps port 8000 on your host to port 80 in the container (Apache's default port).
    ```bash
    docker run -d -p 8000:80 --name php-app-container my-php-app
    ```
    You can also pass environment variables:
    ```bash
    docker run -d -p 8000:80 --name php-app-container -e APP_NAME="My Awesome PHP App" my-php-app
    ```

4.  **Access the application:**
    Open your web browser and go to `http://localhost:8000`. You should see the PHP page.

## To Stop and Remove the Container

1.  **Stop the container:**
    ```bash
    docker stop php-app-container
    ```

2.  **Remove the container:**
    ```bash
    docker rm php-app-container
    ```

## Customizing

*   **PHP Extensions:** If your application needs specific PHP extensions (like `mysqli`, `pdo_mysql`, `gd`, etc.), you can uncomment and modify the `RUN docker-php-ext-install` lines in the `Dockerfile`.
*   **Apache Configuration:** For more complex Apache configurations (like custom VirtualHosts or enabling modules like `mod_rewrite`), you would need to `COPY` your custom `.conf` files into `/etc/apache2/sites-available/` or `/etc/apache2/conf-available/` and then enable them using `a2ensite` or `a2enconf` commands within your Dockerfile.
