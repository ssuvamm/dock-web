# Docker Setup Guide

Setting up Docker on your system is the first practical step to start containerizing your applications. This guide provides step-by-step instructions for installing Docker Desktop on major operating systems.

## Installing Docker Desktop

Docker Desktop is an easy-to-install application for your Mac or Windows environment that enables you to build and share containerized applications and microservices. It includes Docker Engine, Docker CLI client, Docker Compose, Docker Content Trust, Kubernetes, and Credential Helper.

### On Windows

Docker Desktop for Windows requires:

*   **Windows 10 or 11 (64-bit):** Pro, Enterprise, or Education (Build 19042 or higher).
*   **WSL 2 (Windows Subsystem for Linux 2):** Docker Desktop uses WSL 2 for better performance. The installer will offer to install or enable it if needed.
*   **Hardware prerequisites:**
    *   64-bit processor with Second Level Address Translation (SLAT).
    *   4GB system RAM.
    *   BIOS-level hardware virtualization support must be enabled in the BIOS settings.

**Installation Steps:**

1.  **Download Docker Desktop:**
    *   Go to the official Docker Desktop website: [https://www.docker.com/products/docker-desktop/](https://www.docker.com/products/docker-desktop/)
    *   Click on "Download for Windows".
2.  **Run the Installer:**
    *   Once the `Docker Desktop Installer.exe` is downloaded, double-click it to run the installer.
    *   Follow the on-screen instructions. Ensure the "Install required Windows components for WSL 2" option is checked if prompted.
    *   The installation process might require a system restart.
3.  **Start Docker Desktop:**
    *   After installation, search for "Docker Desktop" in your Start menu and launch it.
    *   The Docker whale icon will appear in your system tray. It might take a few moments to start. When it's running, the whale icon will be steady.
4.  **Accept Terms and Conditions:**
    *   On the first launch, you might be asked to accept the Docker Subscription Service Agreement.

### On macOS

Docker Desktop for Mac requires:

*   **Mac with Intel chip or Apple silicon:**
    *   **Intel chip:** macOS version 11 (Big Sur) or newer.
    *   **Apple silicon (M1, M2, etc.):** macOS version 11 (Big Sur) or newer. Docker Desktop will automatically download the correct version for your chip.
*   **Hardware prerequisites:**
    *   At least 4 GB of RAM.

**Installation Steps:**

1.  **Download Docker Desktop:**
    *   Go to the official Docker Desktop website: [https://www.docker.com/products/docker-desktop/](https://www.docker.com/products/docker-desktop/)
    *   Click on "Download for Mac" (it will automatically detect if you need Intel or Apple Silicon version).
2.  **Install the Application:**
    *   Once `Docker.dmg` is downloaded, double-click it.
    *   Drag the Docker.app icon to your Applications folder.
3.  **Start Docker Desktop:**
    *   Open your Applications folder and double-click Docker.app.
    *   You'll be prompted to authorize Docker.app with your system password.
    *   The Docker whale icon will appear in your top status bar, indicating Docker Desktop is running.
4.  **Accept Terms and Conditions:**
    *   On the first launch, you might be asked to accept the Docker Subscription Service Agreement.

### On Linux

For Linux, Docker Desktop is available for some distributions, but the more common approach is to install Docker Engine and Docker CLI directly. If you prefer Docker Desktop, check the official documentation for supported distributions and installation steps: [https://docs.docker.com/desktop/install/linux-install/](https://docs.docker.com/desktop/install/linux-install/)

**General Steps for Installing Docker Engine on Linux (Example for Ubuntu):**

These steps are a summary. For detailed instructions for your specific Linux distribution, always refer to the official Docker documentation: [https://docs.docker.com/engine/install/](https://docs.docker.com/engine/install/)

1.  **Uninstall old versions (if any):**
    ```bash
    sudo apt-get remove docker docker-engine docker.io containerd runc
    ```
2.  **Set up the repository:**
    *   Update the `apt` package index and install packages to allow `apt` to use a repository over HTTPS:
        ```bash
        sudo apt-get update
        sudo apt-get install             ca-certificates             curl             gnupg             lsb-release
        ```
    *   Add Docker’s official GPG key:
        ```bash
        sudo mkdir -p /etc/apt/keyrings
        curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
        ```
    *   Set up the repository:
        ```bash
        echo           "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu           $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
        ```
3.  **Install Docker Engine:**
    *   Update the `apt` package index again:
        ```bash
        sudo apt-get update
        ```
    *   Install Docker Engine, containerd, and Docker Compose:
        ```bash
        sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
        ```
        *(Note: `docker-compose-plugin` is the new way to get Docker Compose, replacing the older `docker-compose` standalone binary for many users.)*
4.  **Manage Docker as a non-root user (Optional but recommended):**
    *   Create the `docker` group (it might already exist):
        ```bash
        sudo groupadd docker
        ```
    *   Add your user to the `docker` group:
        ```bash
        sudo usermod -aG docker $USER
        ```
    *   Log out and log back in so that your group membership is re-evaluated. Alternatively, activate the changes to groups:
        ```bash
        newgrp docker
        ```
    *   If you can't log out and back in (e.g., on a remote server), you might need to run Docker commands with `sudo` until your next session.

## Verifying the Installation

Once Docker is installed and running (Docker Desktop is started, or Docker service is active on Linux), you can verify it by running a simple command in your terminal or command prompt:

```bash
docker --version
```
This command should display the installed Docker version.

Next, try running the "hello-world" image:

```bash
docker run hello-world
```

If Docker is installed correctly, this command will:
1.  Download the `hello-world` image from Docker Hub (if it's not already on your system).
2.  Run a container based on that image.
3.  The container will print a message confirming your installation is working, and then exit.

Example output:
```
Hello from Docker!
This message shows that your installation appears to be working correctly.
... (more informative text)
```

If you see this message, congratulations! Docker is up and running on your system.

---

With Docker installed, you're ready to move on to learning about Docker's basic concepts and how to use it for your web development projects.
