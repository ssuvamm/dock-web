# Use an official OpenJDK runtime as a parent image.
# Make sure the JDK version matches the one specified in pom.xml (e.g., 17)
FROM openjdk:17-slim

# Arguments for user and group (optional, good practice for security)
ARG APP_USER=springuser
ARG APP_GROUP=springgroup

# Create a non-root user and group
RUN groupadd -r ${APP_GROUP} && useradd -r -g ${APP_GROUP} -s /sbin/nologin ${APP_USER}

# Set the working directory in the container
WORKDIR /app

# Copy the pre-built JAR file into the container
# The user will need to build the Spring Boot application and ensure
# the resulting JAR (e.g., from target/docker-demo-0.0.1-SNAPSHOT.jar)
# is copied to the build context root and named 'app.jar' before building the Docker image.
COPY app.jar app.jar

# Change ownership to the non-root user
RUN chown ${APP_USER}:${APP_GROUP} app.jar

# Switch to the non-root user
USER ${APP_USER}

# Expose the port the app runs on (Spring Boot default is 8080)
EXPOSE 8080

# Define the command to run the application
ENTRYPOINT ["java", "-jar", "/app/app.jar"]
