# Use an official Nginx image as the base image
FROM nginx:alpine

# Copy the static site content (HTML, CSS, JS files) into the Nginx default web root directory
COPY . /usr/share/nginx/html

# Expose port 80 (Nginx default HTTP port)
EXPOSE 80

# The default Nginx command will start the server.
# No explicit CMD is needed here as the base Nginx image already has one.
