# Laravel Application

## Overview

This Dockerized Laravel application is designed to manage users and daily records. It includes features for capturing user data from an external API, storing it in a PostgreSQL database, and performing various operations such as viewing, searching, and deleting user records. Additionally, the application calculates and stores daily records, including total counts and average ages for male and female users.

## Prerequisite

- Docker

## Features

- **User Management**: Allows administrators to view, search, and delete user records. User records include attributes such as name, age, gender, and creation date.

- **API Integration**: Retrieves user data from an external API (https://randomuser.me/api/?results=20) and stores it in the database. Prevents duplicate entries by checking each user's UUID property before storing.

- **Daily Record Calculation**: Calculates and stores daily records, including total counts and average ages for male and female users. Updates these records automatically at the end of each day.

- **Redis Integration**: Utilizes Redis to store and update total counts of male and female records for each day.

## Setup

To set up and run the application using Docker, follow these steps:

1. Clone the repository to your local machine:

```
git clone https://github.com/tri-suli/lara-daily-record.git
```

2. Navigate to the project directory:

```
cd project-directory
```

3. Build the Docker image:

```
docker-compose build
```

4. Run the Docker container:

```
docker-compose up -d
```

5. Prepare the application after running the container

```
docker-compose run --rm composer install
docker-compose run --rm artisan migrate
```

6. Access the application in your web browser at `http://localhost:8080`.

## Usage

Once the application is set up and running, you can perform the following actions:

- View all users: Navigate to the Users page to see a table displaying all user records.

- Search users: Use the search functionality to filter users by name, age, gender, or creation date.

- Delete users: Click on the delete button next to a user record to remove it from the database. This action will update the total counts of male and female records for the corresponding day.

- View daily records: Access the Daily Records page to see a list of daily records, including total counts and average ages for male and female users.

## Dependencies

- Laravel Framework: Provides the core functionality and structure for the application.

- PostgreSQL: Used as the database management system for storing user records and daily records.

- Redis: Utilized for storing and updating total counts of male and female records.

- Tailwind CSS: Used for styling the user interface and creating a visually appealing design.

- Supervisor: Used to manage Laravel queue worker processes for handling background jobs.

## Contributing

Contributions are welcome! If you encounter any issues or have suggestions for improvements, please submit a GitHub issue or pull request.

## License

This project is licensed under the [MIT License](LICENSE).

---
