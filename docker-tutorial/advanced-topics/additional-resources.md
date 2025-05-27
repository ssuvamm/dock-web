# Additional Resources & Tips

This page provides a collection of useful resources, tips, and best practices to help you continue your Docker journey.

## Official Docker Documentation

The official Docker documentation is comprehensive and the best place to find detailed information.

*   **Get Started with Docker:** [https://docs.docker.com/get-started/](https://docs.docker.com/get-started/)
*   **Dockerfile Reference:** [https://docs.docker.com/engine/reference/builder/](https://docs.docker.com/engine/reference/builder/) (Detailed info on every Dockerfile instruction)
*   **Docker CLI Reference:** [https://docs.docker.com/engine/reference/commandline/cli/](https://docs.docker.com/engine/reference/commandline/cli/) (All CLI commands)
*   **Docker Compose CLI Reference:** [https://docs.docker.com/compose/reference/](https://docs.docker.com/compose/reference/)
*   **Networking Overview:** [https://docs.docker.com/network/](https://docs.docker.com/network/)
*   **Storage Overview (Volumes & Bind Mounts):** [https://docs.docker.com/storage/](https://docs.docker.com/storage/)
*   **Best practices for writing Dockerfiles:** [https://docs.docker.com/develop/develop-images/dockerfile_best-practices/](https://docs.docker.com/develop/develop-images/dockerfile_best-practices/)

## Docker CLI Commands Cheat Sheet

Here are some of the most commonly used Docker commands.

**Image Management:**
*   `docker build -t <image_name>[:tag] .`: Build an Image from a Dockerfile in the current directory.
*   `docker images` or `docker image ls`: List local Images.
*   `docker rmi <image_name_or_id>` or `docker image rm <image_name_or_id>`: Remove a local Image.
*   `docker pull <image_name>[:tag]`: Pull an Image from a registry (default Docker Hub).
*   `docker push <username>/<image_name>[:tag]`: Push an Image to a registry.
*   `docker tag <source_image>[:tag] <target_image>[:tag]`: Tag an Image.
*   `docker history <image_name>`: Show the history of an Image (its layers).
*   `docker inspect <image_name_or_id>`: Low-level information on Docker objects (like Images or Containers).

**Container Management:**
*   `docker run [options] <image_name> [command]`: Run a command in a new Container.
    *   `-d`: Detached mode (run in background).
    *   `-p <host_port>:<container_port>`: Publish a Container's port(s) to the host.
    *   `-v <host_path>:<container_path>` or `<volume_name>:<container_path>`: Mount a Volume or bind mount a host directory.
    *   `--name <container_name>`: Assign a name to the Container.
    *   `-it`: Interactive mode with a pseudo-TTY.
    *   `--rm`: Automatically remove the Container when it exits.
    *   `-e <VAR_NAME>=<value>`: Set environment variables.
*   `docker ps`: List running Containers.
*   `docker ps -a`: List all Containers (running and stopped).
*   `docker stop <container_name_or_id>`: Stop one or more running Containers.
*   `docker start <container_name_or_id>`: Start one or more stopped Containers.
*   `docker restart <container_name_or_id>`: Restart one or more Containers.
*   `docker rm <container_name_or_id>`: Remove one or more Containers (must be stopped).
*   `docker rm -f <container_name_or_id>`: Force-remove a running Container.
*   `docker logs <container_name_or_id>`: Fetch the logs of a Container.
    *   `-f`: Follow log output.
*   `docker exec -it <container_name_or_id> <command>`: Run a command in a running Container (e.g., `bash`).
*   `docker inspect <container_name_or_id>`: Low-level information on Docker objects (like Images or Containers).

**Docker Compose (often used from directory with `docker-compose.yml`):**
*   `docker-compose up`: Create and start Containers.
    *   `--build`: Build Images before starting Containers.
    *   `-d`: Detached mode.
*   `docker-compose down`: Stop and remove Containers, Networks, and default Volumes created by `up`.
    *   `-v`: Remove named Volumes.
*   `docker-compose ps`: List Containers managed by Compose.
*   `docker-compose logs <service_name>`: View logs for a service.
*   `docker-compose exec <service_name> <command>`: Execute a command in a service's Container.
*   `docker-compose build <service_name>`: Build (or rebuild) a service's Image.
*   `docker-compose pull <service_name>`: Pull service Images.
*   `docker-compose stop <service_name>`: Stop services.
*   `docker-compose start <service_name>`: Start stopped services.
*   `docker-compose restart <service_name>`: Restart services.

**System & Cleanup:**
*   `docker version`: Show Docker version information.
*   `docker info`: Display system-wide information.
*   `docker system df`: Show Docker disk usage.
*   `docker system prune`: Remove unused data (stopped Containers, unused Networks, dangling Images).
    *   `-a`: Remove all unused Images, not just dangling ones.
    *   `--volumes`: Prune Volumes too (use with caution, as it deletes data).
*   `docker volume ls`: List Volumes.
*   `docker volume rm <volume_name>`: Remove a Volume.
*   `docker network ls`: List Networks.

## Tips for Debugging Common Docker Issues

*   **Container Exits Immediately:**
    *   Check logs: `docker logs <container_name_or_id>`. The application inside might be crashing.
    *   Ensure your `CMD` or `ENTRYPOINT` in the Dockerfile is correct and the application starts as expected.
    *   If it's a service that needs to stay running (like a web server), make sure it's not a command that finishes quickly.
*   **Port Conflicts (`Error starting userland proxy: listen tcp ... bind: address already in use`):**
    *   The host port you're trying to map (`-p <host_port>:<container_port>`) is already being used by another application on your host.
    *   Solution: Stop the other application or choose a different host port.
*   **"Cannot connect to the Docker daemon":**
    *   Ensure Docker Desktop (or Docker service on Linux) is running.
    *   On Linux, you might need to add your user to the `docker` group or use `sudo`.
*   **Permission Issues with Volumes/Bind Mounts:**
    *   The user inside the Container (often root by default) might not have permission to write to the mounted directory from the host, or files created by the Container might be owned by root on the host.
    *   Solutions:
        *   Run the Container with a specific user (`docker run -u <uid>:<gid> ...`).
        *   Ensure directory permissions on the host are appropriate.
        *   For development, this is often manageable, but for production, carefully manage user permissions.
*   **Image Not Found:**
    *   Double-check the Image name and tag for typos.
    *   If it's a local Image, ensure it was built successfully.
    *   If pulling from a registry, ensure you're authenticated if it's a private Image (`docker login`).
*   **Build Failures:**
    *   Read the error messages carefully during `docker build`. Often it's a typo in Dockerfile, a missing file for `COPY`, or a command in `RUN` failing.

## Docker Hub: Finding and Sharing Images

*   **Finding Images:** [https://hub.docker.com/](https://hub.docker.com/)
    *   Look for "Official Images" as they are vetted and maintained.
    *   Check Image descriptions for usage, tags (versions), and Dockerfile links.
*   **Sharing Your Images:**
    1.  Create a Docker Hub account.
    2.  Log in via CLI: `docker login`
    3.  Tag your Image: `docker tag my-local-image yourusername/my-repo-name:tag`
    4.  Push your Image: `docker push yourusername/my-repo-name:tag`

## The `.dockerignore` File

This file is crucial for faster and smaller Image builds. It works like a `.gitignore` file, specifying files and directories to exclude from the build context sent to the Docker daemon.

*   **Why use it?**
    *   **Speed:** Prevents sending large, unnecessary files (like `node_modules`, `target` directories, `.git` folder) to the daemon, speeding up `docker build`.
    *   **Cache Invalidation:** Avoids copying files that change often but aren't needed in the Image, which could break build cache unnecessarily.
    *   **Security:** Prevents accidentally copying sensitive files (like `.env` files with secrets, `aws_credentials`) into the Image.

*   **Example `.dockerignore`:**
    ```
    .git
    .vscode
    node_modules/
    npm-debug.log
    Dockerfile
    .dockerignore
    README.md
    # For Python projects:
    __pycache__
    *.pyc
    .venv/
    # For Java projects:
    target/
    build/
    # For Ruby projects:
    log/
    tmp/
    ```
    Place it in the root of your build context (usually where your Dockerfile is).

## Next Steps: Orchestration (Brief Mention)

Once you have multiple services running in Containers (e.g., a web app, database, caching service), managing them individually can become complex. This is where Container orchestration tools come in.

*   **Kubernetes (K8s):** The most popular orchestration platform. It automates deployment, scaling, and management of containerized applications. It's powerful but has a steeper learning curve.
*   **Docker Swarm:** Docker's native orchestration tool. Simpler to get started with if you're already familiar with Docker.
*   **Others:** Nomad, Amazon ECS, Google Kubernetes Engine (GKE), Azure Kubernetes Service (AKS).

For now, focus on mastering Docker and Docker Compose. Orchestration is a more advanced topic for when you need to manage applications at scale or in production environments.

## Security Best Practices (Basics)

*   **Use Official Images:** Start with official Images from Docker Hub whenever possible, as they are generally more secure and well-maintained.
*   **Use Specific Image Tags:** Avoid `latest` tag in production Dockerfiles. Pin to specific versions (e.g., `node:18-alpine` instead of `node:latest`) for predictable builds.
*   **Minimize Layers & Image Size:** Smaller Images have a smaller attack surface. Remove unnecessary tools and files. Use multi-stage builds.
*   **Run as Non-Root User:** Avoid running processes as `root` inside Containers. Use the `USER` instruction in your Dockerfile to switch to a non-root user.
*   **Don't Leak Secrets:** Never copy sensitive data like passwords, API keys, or credentials directly into your Docker Image. Use Docker secrets, environment variables injected at runtime (carefully!), or Volume mounts for configuration files.
*   **Scan Your Images:** Use tools (like Docker Scout, Snyk, Trivy) to scan your Images for known vulnerabilities.

---

Keep exploring, keep building, and don't be afraid to experiment! The Docker ecosystem is vast, but these resources and tips should help you navigate it more effectively.
