# Welcome to the Comprehensive Docker Tutorial!

This tutorial is designed to guide you from the very basics of Docker to containerizing various types of web applications. Whether you're a student new to containerization or a developer looking to solidify your understanding, these guides aim to provide clear, step-by-step instructions and practical examples.

## Suggested Learning Path for Beginners

If you're new to Docker, we recommend going through the sections in the following order:

1.  **Introduction to Docker:** Understand the fundamentals.
2.  **Docker Setup Guide:** Get Docker running on your system.
3.  **Your First Docker Experience:** A hands-on walkthrough of containerizing a simple static webpage.
4.  **Docker Basic Concepts:** Dive deeper into essential Docker commands and concepts.
5.  **Web App Containerization Examples:** Explore how to Dockerize different types of web applications. Pick the ones relevant to your interests or tech stack.
6.  **How Docker Works (More In-depth):** Learn about the underlying technologies.
7.  **Additional Resources & Tips:** Discover more resources, best practices, and troubleshooting advice.

## Table of Contents

### Part 1: Getting Started with Docker

*   **[Introduction to Docker](./introduction/introduction-to-docker.md)**
    *   What is Docker?
    *   Why use Docker? (Benefits for Web Development)
    *   Docker vs. Virtual Machines (VMs)
    *   Basic Docker Terminology (Image, Container, Dockerfile, Docker Hub)
*   **[Docker Setup Guide](./setup/docker-setup-guide.md)**
    *   Installing Docker Desktop on Windows
    *   Installing Docker Desktop on macOS
    *   Installing Docker Engine on Linux
    *   Verifying the Installation
*   **[Your First Docker Experience: A Step-by-Step Guide](./introduction/first-docker-experience.md)**
    *   Creating a simple webpage
    *   Writing a Dockerfile for Nginx
    *   Building the Image
    *   Running the Container
    *   Accessing your webpage

### Part 2: Core Docker Concepts

*   **[Docker Basic Concepts](./basic-concepts/docker-basic-concepts.md)**
    *   Working with Docker Images (pull, list, remove)
    *   Running Docker Containers (`docker run`, interactive mode, detached mode, port mapping, naming, volumes)
    *   Understanding Dockerfiles (common instructions: FROM, RUN, COPY, ADD, CMD, ENTRYPOINT, WORKDIR, EXPOSE, ENV)
    *   Building Docker Images (`docker build`)
    *   Managing Containers (list, stop, start, remove, logs)
    *   Introduction to Docker Compose

### Part 3: Practical Web App Containerization Examples

Explore how to containerize different kinds of web applications. Each example includes the application code, a Dockerfile, and a README with build/run instructions.

*   **[Static HTML/CSS/JS Website (with Nginx)](./webapp-examples/static-html/README.md)**
*   **[Node.js (Express.js) Application](./webapp-examples/nodejs-app/README.md)**
*   **[Python (Flask) Application](./webapp-examples/python-app/README.md)**
*   **[Ruby on Rails Application (with PostgreSQL)](./webapp-examples/ruby-app/README.md)**
*   **[PHP Application (Simple Vanilla PHP with Apache)](./webapp-examples/php-app/README.md)**
*   **[Java (Spring Boot) Application](./webapp-examples/java-app/README.md)**

### Part 4: Advanced Topics & Further Learning

*   **[How Docker Works (More In-depth)](./advanced-topics/how-docker-works.md)**
    *   Namespaces and Cgroups
    *   The Docker Daemon and Client
    *   Image Layers and Union File Systems
    *   Basic Container Networking
    *   Registry and Docker Hub
*   **[Additional Resources & Tips](./advanced-topics/additional-resources.md)**
    *   Official Docker Documentation Links
    *   Docker CLI Commands Cheat Sheet
    *   Tips for Debugging Common Docker Issues
    *   Docker Hub: Finding and Sharing Images
    *   The `.dockerignore` File
    *   Next Steps: Orchestration (Brief Mention)
    *   Security Best Practices (Basics)

---

We hope this tutorial helps you on your Docker learning journey. Happy containerizing!
