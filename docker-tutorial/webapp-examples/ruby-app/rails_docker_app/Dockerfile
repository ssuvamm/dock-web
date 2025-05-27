# Start with a Ruby image
FROM ruby:3.1-slim

# Install dependencies:
# - build-essential: For compiling native extensions
# - libpq-dev: For pg gem (PostgreSQL adapter)
# - nodejs and yarn: For asset pipeline (though we try to minimize JS for this example)
# - curl: For health checks or other utilities
RUN apt-get update -qq && \
    apt-get install -y build-essential libpq-dev nodejs yarn curl

# Set the working directory
WORKDIR /rails_docker_app

# Create a directory for dummy assets if they are not generated
# RUN mkdir -p app/assets/builds
# RUN touch app/assets/builds/.keep

# Copy Gemfile and Gemfile.lock
COPY Gemfile Gemfile.lock ./

# Install gems
# Using --jobs 4 to speed up installation
# Ensure bundler is up to date and install gems
RUN gem update bundler && bundle install --jobs 4 --retry 3

# Copy the rest of the application code
COPY . .

# Expose port 3000 (default Rails port)
EXPOSE 3000

# Configure entrypoint to run migrations and start server
COPY entrypoint.sh /usr/bin/
RUN chmod +x /usr/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]

# Start the Rails server
CMD ["bundle", "exec", "rails", "server", "-b", "0.0.0.0"]
