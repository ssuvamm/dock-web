# Your First Docker Experience: A Step-by-Step Guide

Welcome! This guide is designed for beginners who have just installed Docker and want to walk through their very first experience of containerizing a simple application. We'll take a basic static website (just HTML and CSS) and run it inside a Docker Container using the Nginx web server.

If you haven't already, please make sure you've gone through the [Docker Setup Guide](../setup/docker-setup-guide.md) and have a working Docker installation. You should also have a basic understanding of the terms from the [Introduction to Docker](./introduction-to-docker.md) and [Docker Basic Concepts](../basic-concepts/docker-basic-concepts.md).

## What We'll Do

1.  **Create a very simple webpage.**
2.  **Write a `Dockerfile`** that tells Docker how to package this webpage with a web server.
3.  **Build a Docker Image** from the Dockerfile.
4.  **Run a Docker Container** from the Image.
5.  **Access our webpage** being served from the Container.

Let's begin!

## Step 1: Prepare Your Webpage Files

First, we need something to containerize. Let's create a small project folder and add a simple HTML and CSS file.

1.  **Create a project directory:**
    Open your terminal or command prompt. Create a new directory anywhere on your computer for this project. Let's call it `my-first-docker-app`.
    ```bash
    mkdir my-first-docker-app
    cd my-first-docker-app
    ```
    *(You are now inside the `my-first-docker-app` directory).*

2.  **Create an HTML file (`index.html`):**
    Inside `my-first-docker-app`, create a file named `index.html` with the following content:
    ```html
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My First Docker App</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Hello, Docker World!</h1>
        <p>This little webpage is running inside a Docker Container!</p>
        <p>Isn't that neat?</p>
    </body>
    </html>
    ```
    *(You can use any text editor like VS Code, Notepad, Sublime Text, Nano, or Vim to create these files).*

3.  **Create a CSS file (`style.css`):**
    In the same `my-first-docker-app` directory, create a file named `style.css` with the following content:
    ```css
    body {
        font-family: 'Arial', sans-serif;
        background-color: #e0f7fa;
        color: #00796b;
        text-align: center;
        margin-top: 50px;
    }
    h1 {
        color: #004d40;
    }
    p {
        font-size: 1.2em;
    }
    ```

At this point, your `my-first-docker-app` directory should have two files: `index.html` and `style.css`. You can open `index.html` in your browser locally to see what it looks like.

## Step 2: Write Your Dockerfile

The `Dockerfile` is the recipe Docker uses to build your application into a Docker **Image**. It's a plain text file named `Dockerfile` (no extension).

Create a file named `Dockerfile` (case-sensitive) in your `my-first-docker-app` directory with the following content:

```dockerfile
# Step 1: Specify the base Image
# We'll use an official Nginx Image. Nginx is a popular lightweight web server.
# 'alpine' refers to a small version of the Image.
FROM nginx:alpine

# Step 2: Copy our website files into the Image
# The first '.' means "copy from the current directory (where the Dockerfile is)".
# The second path '/usr/share/nginx/html' is the default directory where Nginx serves files from.
COPY . /usr/share/nginx/html

# Step 3: (Optional) Expose a port
# This line tells Docker that the Container will listen on port 80 at runtime.
# Nginx listens on port 80 by default.
EXPOSE 80

# No CMD needed here, as the base nginx:alpine Image already has a command to start Nginx.
```

Let's break down what these instructions mean:
*   `FROM nginx:alpine`: This says, "Start with the `nginx:alpine` Image from Docker Hub." This base Image already has Nginx installed and configured to serve static files.
*   `COPY . /usr/share/nginx/html`: This says, "Copy everything from the current directory (our `index.html` and `style.css`) into the `/usr/share/nginx/html` directory inside the Image."
*   `EXPOSE 80`: This is documentation. It tells Docker that the application inside the Container will be listening on port 80.

## Step 3: Build the Docker Image

Now that we have our webpage and our `Dockerfile`, let's build the Docker Image.

1.  **Open your terminal or command prompt.**
2.  **Navigate to your project directory** (`my-first-docker-app`) if you're not already there.
    ```bash
    cd path/to/my-first-docker-app
    ```
3.  **Run the `docker build` command:**
    ```bash
    docker build -t my-first-webpage .
    ```
    Let's understand this command:
    *   `docker build`: This is the command to build an Image from a Dockerfile.
    *   `-t my-first-webpage`: The `-t` flag is for "tagging" the Image. We're naming our Image `my-first-webpage`. You can choose any name. The part after a colon (e.g., `my-first-webpage:v1`) is the tag, if omitted it defaults to `latest`.
    *   `.` (the dot at the end): This tells Docker to look for the `Dockerfile` in the current directory. This also sets the "build context" – the set of files that Docker can access during the build (our `index.html` and `style.css`).

You'll see Docker execute the steps in your `Dockerfile`. If successful, you'll see a message like `Successfully tagged my-first-webpage:latest`.

4.  **Verify the Image is built (optional):**
    You can list the Images Docker knows about:
    ```bash
    docker images
    ```
    You should see `my-first-webpage` in the list.

## Step 4: Run the Docker Container

We have an Image! Now, let's run a **Container** based on this Image.

1.  **Run the `docker run` command:**
    ```bash
    docker run -d -p 8080:80 --name my-website-container my-first-webpage
    ```
    Let's break this down:
    *   `docker run`: The command to run a Container.
    *   `-d` (detached mode): This runs the Container in the background and prints the Container ID. If you don't use `-d`, your terminal will be attached to the Container's logs.
    *   `-p 8080:80` (port mapping): This is important!
        *   The Nginx server inside our Container is listening on port `80` (as defined by the Nginx Image and our `EXPOSE 80` line).
        *   This `-p` flag maps port `8080` on your host machine (your computer) to port `80` inside the Container.
        *   You can choose a different host port if 8080 is busy (e.g., `-p 8000:80`).
    *   `--name my-website-container`: This gives your running Container a memorable name. If you omit this, Docker will assign a random one.
    *   `my-first-webpage`: This is the name of the Image we want to run.

2.  **Verify the Container is running (optional):**
    ```bash
    docker ps
    ```
    This command lists currently running Containers. You should see `my-website-container` in the list.

## Step 5: Access Your Webpage!

Now for the exciting part! Open your web browser (Chrome, Firefox, Edge, etc.) and go to:

`http://localhost:8080`

If you used a different host port in the `docker run` command (e.g., `-p 8000:80`), then use that port in the URL (e.g., `http://localhost:8000`).

You should see your `index.html` page ("Hello, Docker World!") with the CSS styling applied, being served by Nginx from inside your Docker Container!

## Troubleshooting Common First-Timer Issues

*   **Port already in use:** If you get an error message like "port is already allocated" when running `docker run`, it means another application on your host machine is already using port 8080 (or whichever host port you chose).
    *   **Solution:** Stop the other application, or choose a different host port in the `docker run` command (e.g., `-p 8081:80`).
*   **Dockerfile not found:** If `docker build` says it can't find the Dockerfile, make sure:
    *   You are in the correct directory (`my-first-docker-app`).
    *   The file is named exactly `Dockerfile` (capital 'D', no extension).
*   **Cannot connect to `localhost:8080`:**
    *   Ensure your Container is running (`docker ps`). If not, check logs: `docker logs my-website-container`.
    *   Double-check the port mapping you used in `docker run`. The host port is the one you use in the browser.
    *   Check your system's firewall, although for `localhost` this is less common.

## Cleaning Up

Once you're done experimenting:

1.  **Stop the Container:**
    ```bash
    docker stop my-website-container
    ```
2.  **Remove the Container:**
    (You can only remove stopped Containers unless you use the `-f` force flag)
    ```bash
    docker rm my-website-container
    ```
3.  **Remove the Image (optional):**
    If you want to remove the Image you built:
    ```bash
    docker rmi my-first-webpage
    ```

## Congratulations!

You've successfully:
*   Created a simple web application.
*   Written a Dockerfile to define its Container environment.
*   Built a Docker Image.
*   Run a Docker Container from that Image.
*   Accessed your application running inside the Container.

This is the fundamental workflow of Docker. From here, you can explore containerizing more complex applications, using Docker Compose for multi-Container setups, and much more! Check out the other sections of this tutorial to continue your learning journey.
