# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# # Remove specific entries from the source list
RUN sed -i '/bullseye-security\/InRelease/d' /etc/apt/sources.list && \
    sed -i '/bullseye-updates\/InRelease/d' /etc/apt/sources.list
# # Copy the shell script into the container
COPY install_dependencies.sh /usr/local/bin/

# Make the shell script executable
RUN chmod +x /usr/local/bin/install_dependencies.sh

# Run the shell script
RUN /usr/local/bin/install_dependencies.sh

WORKDIR /var/www/html

# Copy the application files into the container
COPY ./ /var/www/html/
