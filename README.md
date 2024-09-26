# Docker-Compose-PHP-MySQL

This repository contains a full-stack PHP web application with MySQL and phpMyAdmin, using Docker for easy setup and deployment.

## Getting Started

### Prerequisites

Make sure you have Docker and Docker Compose installed on your system.

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/chalakahasanthaprasad/Docker-Compose-PHP-MySQL.git
    cd Docker-Compose-PHP-MySQL
    ```

2. **Run the application:**

    ```bash
    docker-compose up
    ```

    This command will build and start the Docker containers for the application.

3. **Stop the application:**

    ```bash
    docker-compose down
    ```

    This command will stop and remove the Docker containers.

## Troubleshooting

### Common Errors

- **Fatal error: Uncaught Error: Call to undefined function mysqli_connect():**

    ```plaintext
    Fatal error: Uncaught Error: Call to undefined function mysqli_connect() in /var/www/html/index.php:3 Stack trace: #0 {main} thrown in /var/www/html/index.php on line 3
    ```

### Solution

1. Open the interactive terminal with your Docker container that's running the `www` service:

    ```bash
    docker exec -it <container_id> /bin/bash
    ```

2. Run the following commands inside the container:

    ```bash
    docker-php-ext-install mysqli
    docker-php-ext-enable mysqli
    apachectl restart
    ```

    Replace `<container_id>` with the ID of your running container.

## Accessing the Application

- **phpMyAdmin:**

    Access phpMyAdmin at [http://localhost:8001](http://localhost:8001)

- **Test the Application:**

    Test the application at [http://localhost/public/index.php](http://localhost/public/index.php)

- **Index Page:**

    Access the index page at [http://localhost/src/views/index.php](http://localhost/src/views/index.php)

## Built With

- [PHP](https://www.php.net/) - Server-side scripting language
- [MySQL](https://www.mysql.com/) - Relational database management system
- [phpMyAdmin](https://www.phpmyadmin.net/) - Administration tool for MySQL
- [Docker](https://www.docker.com/) - Containerization platform
- [Docker Compose](https://docs.docker.com/compose/) - Tool for defining and running multi-container Docker applications

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any changes.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Inspiration and resources from the open-source community.

---