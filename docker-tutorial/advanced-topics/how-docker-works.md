# How Docker Works (More In-depth)

While the basic commands are enough to get you started, understanding a bit more about Docker's internals can be helpful, especially when troubleshooting or designing more complex applications.

## Core Technologies: Namespaces and Cgroups

Docker leverages several features of the Linux kernel to achieve containerization. The two most fundamental ones are:

*   **Namespaces:** Namespaces provide isolation for global system resources. When you run a Container, Docker creates a set of namespaces for that Container. This means the Container gets its own isolated view of:
    *   **PID (Process ID):** Processes inside a Container only see other processes in the same Container. The first process in a Container gets PID 1.
    *   **NET (Network):** Each Container gets its own network stack (IP address, routing tables, port numbers).
    *   **MNT (Mount):** Containers have their own isolated filesystem view. Filesystem mounts in one Container don't affect others or the host.
    *   **UTS (Hostname):** Each Container can have its own hostname.
    *   **IPC (Inter-Process Communication):** Containers have their own isolated IPC resources.
    *   **User:** User and group IDs can be mapped between the Container and the host, allowing a process to have root privileges inside the Container but not on the host.

*   **Cgroups (Control Groups):** While namespaces provide isolation, cgroups manage and limit the resources that a Container can use. This includes:
    *   **CPU:** Limiting CPU usage or assigning CPU shares.
    *   **Memory:** Limiting the amount of memory a Container can consume.
    *   **Block I/O:** Limiting I/O bandwidth to block devices.
    *   **Device access:** Restricting access to specific devices.

Essentially, namespaces make a Container *think* it's its own isolated OS, and cgroups ensure it doesn't consume more than its allocated share of system resources.

## The Docker Daemon and Client

Docker uses a client-server architecture:

*   **Docker Daemon (`dockerd`):**
    *   This is a persistent background process that manages Docker objects such as Images, Containers, Networks, and Volumes.
    *   It listens for Docker API requests and processes them.
    *   The daemon is responsible for building Images, running Containers, and handling the Container lifecycle.
    *   On Linux, it typically runs as a system service. On Windows and macOS, Docker Desktop manages the daemon, often within a lightweight Linux VM (especially for running Linux Containers).

*   **Docker Client (`docker` CLI):**
    *   This is the command-line tool you interact with (e.g., `docker run`, `docker build`).
    *   When you type a command, the client sends it to the Docker daemon via the Docker API (which can be over a local socket or a network interface).
    *   The client then receives responses from the daemon and displays them in your terminal.

You can have your Docker client talk to a Docker daemon running on a remote machine, which is useful for managing remote Docker environments.

## Image Layers and Union File Systems

Docker Images are not monolithic blobs. They are composed of multiple read-only layers, stacked on top of each other.

*   **Layered Structure:** Each instruction in a Dockerfile (like `FROM`, `RUN`, `COPY`) creates a new layer in the Image.
*   **Read-Only Layers:** These layers are immutable. Once a layer is created, it cannot be changed.
*   **Shared Layers:** If multiple Images are based on the same parent Image (e.g., `ubuntu:20.04`), they will share the common layers. This saves disk space and speeds up Image pulls.
*   **Union File Systems (UFS):** Docker uses UFS (like Aufs, OverlayFS, or Btrfs depending on the storage driver) to combine these layers into a single, unified view that appears as a coherent filesystem to the Container.
    *   When you run a Container, Docker adds a thin **writable layer** (the "Container layer") on top of the read-only Image layers.
    *   Any changes made inside the running Container (e.g., writing new files, modifying existing files, deleting files) are written to this writable layer.
    *   The underlying Image layers remain unchanged. This is why changes made inside a Container are lost when the Container is removed, unless you use Volumes to persist data.
    *   This "copy-on-write" mechanism is efficient. If a Container needs to read a file, it reads from the underlying Image layers. If it needs to modify a file, the file is copied from an Image layer to the writable layer first, and then modified.

Understanding layers helps in optimizing Dockerfile builds. Commands that change frequently should be placed later in the Dockerfile to maximize layer caching.

## Basic Container Networking

When Docker is installed, it typically creates a few default Networks. The most common one for standalone Containers is the `bridge` Network.

*   **Bridge Network (`docker0`):**
    *   This is a private, internal Network created by Docker on the host.
    *   By default, when you run a Container without specifying a Network, it gets attached to this bridge Network.
    *   Docker acts as a DHCP server for this Network, assigning an internal IP address to each Container (e.g., `172.17.0.2`, `172.17.0.3`).
    *   Containers on the same bridge Network can communicate with each other using these internal IP addresses.
    *   To expose a Container's port to the outside world (i.e., the host machine or other machines on the host's network), you use port mapping (`-p` or `--publish` flag with `docker run`). This creates a firewall rule that forwards traffic from a port on the host to the Container's internal IP and port.

Docker also supports other Network drivers (e.g., `host`, `overlay` for Swarm, `none`), allowing for different networking configurations. Docker Compose often creates its own bridge Network for the services defined in a `docker-compose.yml` file, allowing easy communication between those services using their service names as hostnames.

## Registry and Docker Hub

*   **Registry:** A Registry is a storage system for Docker Images. It can be public (like Docker Hub) or private (hosted by yourself or a cloud provider).
*   **Docker Hub:** This is the default public Registry for Docker.
    *   When you run `docker pull ubuntu`, Docker contacts Docker Hub to download the `ubuntu` Image.
    *   When you run `docker push my-image`, Docker (by default) uploads `my-image` to your account on Docker Hub.
    *   It contains a vast collection of official Images (maintained by Docker or upstream projects) and community Images.

Understanding these concepts provides a better grasp of how Docker efficiently builds, runs, and manages Containers, and how it isolates them from each other and the host system.
