#!/bin/sh

# Install composer
php composer.phar install

# Define the .env file path
file_path=".env"

if [ -f "$file_path" ]; then
    echo "$file_path already exists."
else
    # Copy the .env.example file to .env
    sudo cp .env.example .env

    # Prompt user for environment variables
    read -p "Enter Project Name: " PROJECT_NAME
    read -p "Enter APP URL: " INPUT_APP_URL
    read -p "Enter DB Name: " DB_DATABASE
    read -p "Enter DB Username: " DB_USERNAME
    read -p "Enter DB Password: " DB_PASSWORD
    read -p "Enter MAIL Password: " MAIL_PASSWORD

    # Replace placeholders in .env file
    sudo sed -i "s|YOUR_PROJECT_NAME|$PROJECT_NAME|g" "$file_path"
    sudo sed -i "s|YOUR_APP_URL|$INPUT_APP_URL|g" "$file_path"
    sudo sed -i "s|YOUR_DATABASE_NAME|$DB_DATABASE|g" "$file_path"
    sudo sed -i "s|YOUR_DATABASE_USERNAME|$DB_USERNAME|g" "$file_path"
    sudo sed -i "s|YOUR_DATABASE_PASSWORD|$DB_PASSWORD|g" "$file_path"
    sudo sed -i "s|YOUR_MAIL_PASSWORD|$MAIL_PASSWORD|g" "$file_path"

    # Generate app key
    php artisan key:generate
fi

# Set permissions for storage directory
sudo chmod -R 777 storage/

# Create an upload directory in public and set permissions
sudo mkdir -p public/upload
sudo chmod -R 777 public/upload

# Run migration and seed database
php artisan migrate --seed

# Prompt for queue setup with pm2
read -p "Do you want to start the queue using pm2? (yes/no): " QUEUE_START

if [ "$QUEUE_START" = "yes" ] || [ "$QUEUE_START" = "Yes" ]; then
    # Check if Node.js is installed
    if command -v node >/dev/null 2>&1; then
        echo "Node.js is already installed. Version: $(node -v)"
    else
        # Install Node.js, npm, and pm2
        echo "Installing Node.js, npm, and pm2..."
        sudo apt update
        sudo apt install -y nodejs npm
        sudo npm install -g pm2
        echo "Node.js version: $(node -v)"
        echo "npm version: $(npm -v)"
    fi

    # Start pm2 with the queue worker
    sudo pm2 start queue-worker.yml
fi

# Prompt for image optimizer installation
read -p "Do you want to install image optimizers? (yes/no): " IMG_OPTIMIZER

if [ "$IMG_OPTIMIZER" = "yes" ] || [ "$IMG_OPTIMIZER" = "Yes" ]; then
    # Function to check if a tool is installed and install it if not
    check_and_install() {
        tool=$1
        install_command=$2
        if command -v "$tool" >/dev/null 2>&1; then
            echo "$tool is already installed. Version: $($tool --version | head -n 1)"
        else
            echo "$tool is not installed. Installing now..."
            sudo apt-get install -y "$install_command"
            echo "$tool installed successfully."
        fi
    }

    # Install image optimization tools
    check_and_install "jpegoptim" "jpegoptim"
    check_and_install "optipng" "optipng"
    check_and_install "pngquant" "pngquant"
    check_and_install "cwebp" "webp"

    echo "All image optimizers checked and installed."
fi
