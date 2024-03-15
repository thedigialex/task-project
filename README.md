# Project Task Management System

## Overview

This Laravel project aims to facilitate the management of project tasks while providing outside clients access to their respective projects. The system allows staff members to approve clients and assign them to a company where projects are managed. Each project consists of phases, which in turn contain tasks. Additionally, there is a dedicated section for tracking bugs associated with projects.

## Features

- **User Authentication**:
    - Staff members and clients have their own authentication systems.
    - Staff members have access to all company boards, while clients can only view the boards they are assigned to.

- **Project Management**:
    - Staff members can create and manage companies, projects, phases, and tasks.
    - Clients have access to view the projects they are assigned to.

- **Bug Tracking**:
    - Users can log and track bugs associated with projects for better issue management.

## MVP Phase

This version represents Phase One of the Minimum Viable Product (MVP), focusing on the core functionalities described above. Future updates and modifications will be implemented in subsequent phases.

## Usage

1. **Clone the repository:**
   ```bash
   git clone https://github.com/thedigialex/task-project.git
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Set up environment variables:**
    - Copy the `.env.example` file to `.env`.
    - Update the necessary variables such as database credentials.

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Migrate the database:**
   ```bash
   php artisan migrate
   ```
6. **Serve the application:**
   ```bash
   php artisan serve
   ```

## License

This project is licensed under the [MIT License](LICENSE).
