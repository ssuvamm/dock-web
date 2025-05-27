# Node.js (Express.js) Docker Example

This example demonstrates how to containerize a simple Node.js web application built with Express.

## Files

*   `server.js`: The main application file.
*   `package.json`: Defines project dependencies and scripts.
*   `Dockerfile`: Instructions to build the Docker image.
*   `.dockerignore`: Specifies files to exclude from the Docker build context.

## How to Run

1.  **Navigate to this directory:**
    ```bash
    cd webapp-examples/nodejs-app
    ```

2.  **Build the Docker image:**
    Give your image a name, for example, `my-node-app`:
    ```bash
    docker build -t my-node-app .
    ```

3.  **Run the Docker container:**
    This command runs the container in detached mode and maps port 3000 on your host to port 8080 in the container (as defined in `server.js` and `Dockerfile`).
    ```bash
    docker run -d -p 3000:8080 --name node-app-container my-node-app
    ```

4.  **Access the application:**
    Open your web browser and go to `http://localhost:3000`. You should see the "Hello from Node.js and Express!" message.

## To Stop and Remove the Container

1.  **Stop the container:**
    ```bash
    docker stop node-app-container
    ```

2.  **Remove the container:**
    ```bash
    docker rm node-app-container
    ```
