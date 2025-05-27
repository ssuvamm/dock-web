# Static HTML Website with Nginx Docker Example

This example demonstrates how to containerize a simple static website (HTML, CSS) using Docker and Nginx.

## Files

*   `index.html`: The main HTML file.
*   `style.css`: Basic styling for the page.
*   `Dockerfile`: Instructions to build the Docker image.

## How to Run

1.  **Navigate to this directory:**
    ```bash
    cd webapp-examples/static-html
    ```

2.  **Build the Docker image:**
    Give your image a name, for example, `my-static-site`:
    ```bash
    docker build -t my-static-site .
    ```

3.  **Run the Docker container:**
    This command runs the container in detached mode and maps port 8080 on your host to port 80 in the container.
    ```bash
    docker run -d -p 8080:80 --name static-site-container my-static-site
    ```

4.  **Access the website:**
    Open your web browser and go to `http://localhost:8080`. You should see the `index.html` page.

## To Stop and Remove the Container

1.  **Stop the container:**
    ```bash
    docker stop static-site-container
    ```

2.  **Remove the container:**
    ```bash
    docker rm static-site-container
    ```
