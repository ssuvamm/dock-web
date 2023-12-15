# StWeApDo

Hosting a basic static website using Apache2 in Docker

# Dockerized Apache2 Static Website Hosting

This repository demonstrates how to host a basic static website using Apache2 within a Docker container. The setup involves creating a Docker image based on the Apache2 web server and serving a simple HTML webpage.

## Prerequisites

- Docker installed on your local machine. Please follow the official Docker installation guide.

## Instructions

### 1. Clone this Repository

Create a directory to store your website files. For example:

```bash
mkdir my_website
```

Inside the my_website directory, create an index.html file with your webpage content.

### 2. Create a Dockerfile

Create a Dockerfile in the my_website directory to define the Docker image.

```dockerfile
FROM httpd:latest
COPY ./ /usr/local/apache2/htdocs/
EXPOSE 80

```

### 3. Build the Docker image

Build the Docker image using the Dockerfile.    

```bash
docker build -t my_website .
```

### 4. Run the Docker image

Run the Docker image using the following command:

```bash
docker run -d -p 80:80 my_website
```

### 5. Access the website

Visit http://localhost:80 in your web browser. You should see your webpage. You can also access this from any device in your local network using the IP address of your host machine, that is running the Docker container.

## Stopping the Docker container

To stop the Docker container, use the following command:

```bash
docker stop my_website
```

## Cleaning up

To remove the Docker container, use the following command:

```bash
docker rm my_website
```
## Directory Structure

The `my_website` directory contains the Dockerfile, and your website files.

The `Dockerfile` file defines the configuration for the Docker image.

The `index.html` file contains the content of your website.

## Notes
- Replace index.html with your website content.
- Customize ports or paths as needed.
- This repository is for educational purposes only.
  

This `README.md` provides a step-by-step guide for setting up the Dockerized Apache2 static website hosting and includes explanations, instructions, and additional notes for customization. Adjustments can be made based on specific requirements or additional information you want to provide.
