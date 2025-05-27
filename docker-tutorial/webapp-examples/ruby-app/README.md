# Ruby on Rails with PostgreSQL Docker Example

This example demonstrates how to containerize a Ruby on Rails application with a PostgreSQL database using Docker and Docker Compose. This setup is primarily for development.

## Directory Structure

The main files for this example are:

```
ruby-app/
├── docker-compose.yml  # Defines and configures the 'web' and 'db' services.
├── README.md           # This file.
└── rails_docker_app/       # Contains the Rails application code.
    ├── Dockerfile          # Instructions to build the Rails app image.
    ├── entrypoint.sh       # Script to prepare DB and run the server.
    ├── Gemfile             # Rails app dependencies.
    ├── config/database.yml # Configured to use environment variables.
    └── ... (other Rails application files and directories)
```

## Prerequisites

*   Docker Desktop or Docker Engine/CLI installed.
*   Docker Compose installed (usually included with Docker Desktop).

## How to Run

1.  **Navigate to this directory:**
    Ensure you are in the `docker-tutorial/webapp-examples/ruby-app/` directory, where the `docker-compose.yml` file is located.
    ```bash
    cd docker-tutorial/webapp-examples/ruby-app
    ```

2.  **Build and Run with Docker Compose:**
    This command will:
    *   Build the Docker Image for your Rails application based on `rails_docker_app/Dockerfile`.
    *   Pull the `postgres:14-alpine` Image for the database.
    *   Create and start Containers for both the `web` (Rails) and `db` (PostgreSQL) services.
    *   The `entrypoint.sh` script in the `web` Container will attempt to create the database and run migrations.

    ```bash
    docker-compose up --build
    ```
    To run in detached (background) mode, add the `-d` flag:
    ```bash
    docker-compose up --build -d
    ```
    The first time you run this, it might take a few minutes to download Images, install gems, and set up the database.

3.  **Access the Application:**
    Once the services are running (you should see logs indicating the Rails server has started on port 3000), open your web browser and go to:
    `http://localhost:3000`
    You should see the "Hello from Ruby on Rails!" message.

## Common Docker Compose Commands

*   **Stop and Remove Containers, Networks, and Volumes:**
    ```bash
    docker-compose down
    ```
    *(Note: This will remove the `postgres_data` named Volume by default if not declared as `external: true` in the `docker-compose.yml`. Anonymous volumes are always removed with `down`. For this example, using `down` gives a fresh start. If you want to keep data in named volumes, use `docker-compose stop` to just stop services.)*
*   **Stop Services (keeps Containers and Volumes):**
    ```bash
    docker-compose stop
    ```
*   **Start Existing Stopped Services:**
    ```bash
    docker-compose start
    ```
*   **View Logs:**
    ```bash
    docker-compose logs web
    docker-compose logs db
    ```
    (Add `-f` to follow logs: `docker-compose logs -f web`)

*   **Run a Command in a Running Service Container:**
    *   Open a Rails console:
        ```bash
        docker-compose exec web bundle exec rails c
        ```
    *   Open a bash session in the web Container:
        ```bash
        docker-compose exec web bash
        ```
    *   Run database migrations (if you made new migration files):
        ```bash
        docker-compose exec web bundle exec rails db:migrate
        ```

## Important Notes

*   **Database Persistence:** The `postgres_data` named Volume in `docker-compose.yml` ensures that your PostgreSQL database data persists across Container restarts (e.g., after `docker-compose stop` and `docker-compose start`). If you run `docker-compose down` without `-v`, named Volumes like `postgres_data` are kept. Using `docker-compose down -v` will remove named Volumes as well.
*   **Gem Cache:** The `gem_cache` Volume helps persist downloaded gems, which can speed up subsequent `bundle install` runs if your `Gemfile.lock` hasn't changed significantly or if you rebuild the Image.
*   **Development Focus:** This configuration is optimized for development (e.g., mounting application code as a volume for live changes). Production setups would require different configurations for performance, security, and asset handling.
*   **`entrypoint.sh`:** This script ensures the database is ready before the Rails server starts. For more complex applications, you might use a tool like `wait-for-it.sh` to explicitly wait for the database service to be healthy.
