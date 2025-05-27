# Use an official Node.js runtime as a parent image
# Using a specific LTS version is good practice (e.g., 18-alpine, 20-alpine)
# Alpine versions are smaller
FROM node:18-alpine

# Set the working directory in the container
WORKDIR /usr/src/app

# Copy package.json and package-lock.json (if available)
# This step takes advantage of Docker's layer caching.
# If these files haven't changed, Docker will use the cached layer for npm install.
COPY package*.json ./

# Install app dependencies
RUN npm install
# If you are building your code for production
# RUN npm ci --omit=dev

# Bundle app source
COPY . .

# Expose the port the app runs on
EXPOSE 8080

# Define the command to run the application
CMD [ "node", "server.js" ]
