# Python (Flask) Docker Example

This example demonstrates how to containerize a simple Python web application built with Flask.

## Files

*   `app.py`: The main Flask application file.
*   `requirements.txt`: Defines Python package dependencies.
*   `Dockerfile`: Instructions to build the Docker Image.

*   `.dockerignore`: Specifies files to exclude from the Docker build context.

## How to Run

1.  **Navigate to this directory:**
    ```bash
    cd webapp-examples/python-app
    ```

2.  **Build the Docker Image:**
    Give your Image a name, for example, `my-python-app`:

    ```bash
    docker build -t my-python-app .
    ```

3.  **Run the Docker Container:**
    This command runs the Container in detached mode and maps port 5000 on your host to port 5000 in the Container (as defined in `app.py` and `Dockerfile`).

    ```bash
    docker run -d -p 5000:5000 --name python-app-container my-python-app
    ```

4.  **Access the application:**
    Open your web browser and go to `http://localhost:5000`. You should see the "Hello from Python and Flask!" message.

## To Stop and Remove the Container

1.  **Stop the Container:**

    ```bash
    docker stop python-app-container
    ```

2.  **Remove the Container:**

    ```bash
    docker rm python-app-container
    ```
