# Java (Spring Boot) Docker Example

This example demonstrates how to containerize a simple Java web application built with Spring Boot.

## Files

*   `pom.xml`: Maven project configuration.
*   `src/main/java/com/example/dockerdemo/`: Contains the Spring Boot application and controller.
*   `Dockerfile`: Instructions to build the Docker Image.
*   `.dockerignore`: Specifies files to exclude from the Docker build context.
*   `app.jar`: **Placeholder for the compiled Spring Boot application.**

## Prerequisites

*   Java Development Kit (JDK) installed (version 17 or as specified in `pom.xml`).
*   Apache Maven installed (for building the project locally).
*   Docker Desktop or Docker Engine/CLI installed.

## How to Run

1.  **Navigate to this directory:**
    ```bash
    cd webapp-examples/java-app
    ```

2.  **Build the Spring Boot application (create the JAR):**
    Using Maven (you'll need `mvnw` or Maven installed):
    Since `mvnw` was not included in this manual setup, you'll need Maven installed globally.
    ```bash
    mvn clean package -DskipTests
    ```
    This will create a JAR file in the `target/` directory (e.g., `docker-demo-0.0.1-SNAPSHOT.jar`).

3.  **Prepare the JAR for Docker:**
    The `Dockerfile` expects the JAR to be named `app.jar` in the root of this directory.
    Copy the built JAR from `target/` and rename it:
    ```bash
    cp target/docker-demo-0.0.1-SNAPSHOT.jar ./app.jar
    ```
    (Replace `docker-demo-0.0.1-SNAPSHOT.jar` with the actual name of your JAR if it's different).
    **You MUST replace the placeholder `app.jar` with your actual compiled JAR.**

4.  **Build the Docker Image:**
    Give your Image a name, for example, `my-java-app`:
    ```bash
    docker build -t my-java-app .
    ```

5.  **Run the Docker Container:**
    This command runs the Container in detached mode and maps port 8080 on your host to port 8080 in the Container (Spring Boot's default).
    ```bash
    docker run -d -p 8080:8080 --name java-app-container my-java-app
    ```

6.  **Access the application:**
    Open your web browser and go to `http://localhost:8080`. You should see the "Hello from Spring Boot!" message.

## To Stop and Remove the Container

1.  **Stop the Container:**
    ```bash
    docker stop java-app-container
    ```

2.  **Remove the Container:**
    ```bash
    docker rm java-app-container
    ```
