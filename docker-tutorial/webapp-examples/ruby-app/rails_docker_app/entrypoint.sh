#!/bin/bash
set -e # Exit immediately if a command exits with a non-zero status.

# Remove a potentially pre-existing server.pid for Rails.
if [ -f tmp/pids/server.pid ]; then
  rm tmp/pids/server.pid
fi

echo "Running database setup (db:prepare)..."
# This command will create the database if it doesn't exist,
# load the schema (usually from db/schema.rb), and run any pending migrations.
# It's generally idempotent and safe to run.
bundle exec rails db:prepare

# Then exec the container's main process (what's set as CMD in the Dockerfile).
# This will replace the shell process with the Rails server.
exec "$@"
