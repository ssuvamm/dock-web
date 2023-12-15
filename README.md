# Hosting Your Website Using Docker
**Description:**
This project comprises of two separate tutorial for hosting a website locally using Docker. The first method is for a simple static website, and the 2nd method is for a Dynamic website comprising of a separate backend (Node.js) and frontend (React). It is containerized using Docker for easy deployment.

## Prerequisites

- Docker installed on your local machine. Please follow the official Docker installation guide.
  https://docs.docker.com/engine/install/

## Hosting a static website using Apache2 in Docker

### Instructions

#### 1. Create your directory

Create a directory to store your website files. For example:

```bash
mkdir my_website
```

Inside the my_website directory, create an index.html file with your webpage content.

#### 2. Create a Dockerfile

Create a Dockerfile in the my_website directory to define the Docker image.

```bash
touch Dockerfile
```

- This creates the dockerfile in linux, which you can edit using your favorite text editor.

```bash
FROM httpd:latest
```

- This specifies the base image for the Docker image.

```
WORKDIR /usr/local/apache2/htdocs/
```

- This specifies the working directory for the Docker image.

```bash
COPY ./ /usr/local/apache2/htdocs/
```

- This copies the website files in the current directory to the Docker image.

```
EXPOSE 80
```

- This specifies the port for the Docker image.

The completed Dockerfile looks like this:

```dockerfile
FROM httpd:latest

WORKDIR /usr/local/apache2/htdocs/

COPY ./ /usr/local/apache2/htdocs/

EXPOSE 80
```

#### 3. Build the Docker image

Build the Docker image using the Dockerfile.

```bash
docker build -t my_website .
```

- This builds the docker image.
- Replace my_website with your own image name
- The -t flag specifies the image name
- The period(.) specifies the current directory

#### 4. Run the Docker image

Run the Docker image using the following command:

```bash
docker run -d -p 80:80 my_website
```

- This runs the docker image
- The -d flag specifies that the container should run in the background
- The -p flag specifies that the container should listen on port 80
- Replace my_website with your own image name

#### 5. Access the website

Visit http://localhost:80 in your web browser. You should see your webpage. You can also access this from any device in your local network using the IP address of your host machine, that is running the Docker container.

- You can replace localhost with the IP address of your host machine

### Stopping the Docker container

To stop the Docker container, use the following command:

```bash
docker stop my_website
```

### Cleaning up

To remove the Docker container, use the following command:

```bash
docker rm my_website
```

### Directory Structure

The `my_website` directory contains the Dockerfile, and your website files.

The `Dockerfile` file defines the configuration for the Docker image.

## Hosting a Dynamic Website Using Docker

## Description

This project comprises a separate backend (Node.js) and frontend (React) for a website. It is containerized using Docker for easy deployment.

## Hosting a Dynamic website using Node.js in Docker

### Backend Setup

1. Navigate to the `backend` directory.

2. **Backend Dockerfile:**
   Create a Dockerfile for the Node.js backend with the following content:

   ```Dockerfile
   FROM node:latest

   WORKDIR /usr/src/backend

   COPY package.json ./
   COPY package-lock.json* ./

   RUN npm install

   COPY . .

   EXPOSE 3000

   CMD ["npm", "start"]
   ```

   **Explanation:**

   - FROM node:latest: Sets the base Node.js image.
   - WORKDIR: Defines the working directory inside the container.
   - COPY: Copies package files and installs dependencies.
   - EXPOSE: Exposes port 3000 for the backend.
   - CMD: Sets the command to start the backend server.

3. Build the Docker image using the following command:

   ```bash
   docker build -t backend-image-name -f path/to/backend/Dockerfile .
   ```

   - Replace backend-image-name with your preferred image name and provide the correct path to the Dockerfile.

4. Run the Docker image using the following command:

   ```bash
   docker run -p 3000:3000 backend-image-name
   ```

   - Replace backend-image-name with your preferred image name.
   - Replace 3000 with the port on which you want to expose the backend.
   - The backend will be accessible at http://localhost:3000.
   - This command will start the backend server and expose the port 3000.

### Frontend Setup

1. Navigate to the `frontend` directory.
2. **Frontend Dockerfile:**
   Create a Dockerfile for the React frontend with the following content:

   ```Dockerfile
    FROM node:latest

    WORKDIR /usr/src/frontend

    COPY package.json ./
    COPY package-lock.json* ./

    RUN npm install

    COPY . .

    RUN npm run build

    EXPOSE 4000

    CMD ["npm", "start"]
   ```

   **Explanation:**

   - FROM node:latest: Sets the base Node.js image.
   - WORKDIR: Defines the working directory inside the container.
   - COPY: Copies package files and installs dependencies.
   - RUN npm run build: Builds the React frontend.
   - EXPOSE: Exposes port 4000 for the frontend.
   - CMD: Sets the command to start the frontend server.

3. Build the Docker image using the following command:

   ```bash
   docker build -t frontend-image-name -f path/to/frontend/Dockerfile .
   ```

   - Replace frontend-image-name with your preferred image name and provide the correct path to the Dockerfile.

4. Run the Docker image using the following command:

   ```bash
   docker run -p 4000:4000 frontend-image-name
   ```

   - Replace frontend-image-name with your preferred image name.
   - Replace 4000 with the port on which you want to expose the frontend.
   - The frontend will be accessible at http://localhost:4000.
   - This command will start the frontend server and expose the port 4000.

Access the frontend at http://localhost:4000 and the backend at http://localhost:3000.

## Stopping the Containers

Use the following command to stop the containers:

```bash
docker stop backend-image-name
docker stop frontend-image-name
```

## Cleaning up

To remove the containers, use the following command:

```bash
docker rm backend-image-name frontend-image-name
```

## Directory Structure

- '/backend': Contains the Node.js backend.
- '/frontend': Contains the React frontend.

### Notes

- Customize ports or paths as needed.
- This repository is for educational purposes only.

This `README.md` provides a step-by-step guide for setting up a Dockerized Apache2 static website hosting, a Dockerized Node.js backend, and a Dockerized React frontend. It provides instructions for creating a Dockerfile and includes explanations, instructions, and additional notes for customization. Adjustments can be made based on specific requirements or additional information you want to provide.
