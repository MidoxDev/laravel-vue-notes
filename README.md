# Note Management System with Authentication
![Notes Home](images/1-notes.png)

## Project Description
This project is a Single Page Application (SPA) built using **Laravel** for the backend and **Vue.js 3** for the frontend, incorporating a modern tech stack for a seamless user experience. It features a robust user authentication system using **JWT (JSON Web Tokens)** for secure login and registration, ensuring that only authorized users can access the system.

## Key Features:
- **User Authentication**:  
  The login and registration pages allow users to create accounts and securely log in. JWT is used to authenticate users and manage sessions without the need for traditional cookie-based authentication.
  
- **CRUD Operations for Notes**:  
  Users can create, read, update, and delete their personal notes. Notes can include text, reminder dates, priorities, and permissions, enabling full control over the content. Notes are stored and retrieved from a Laravel backend using RESTful API endpoints.

- **Folder Management**:  
  The application allows users to organize their notes into folders. Users can add, modify, or delete folders, and group their notes based on the folder structure for better organization.

- **Vue.js Features**:  
  - **Vue Router**: Seamlessly navigates between pages without reloading the page, providing a fast and smooth user experience.
  - **Vuex**: Manages global state for user data, notes, and folders, ensuring that the application state is consistently handled across components.

- **SweetAlert Integration**:  
  Beautiful and responsive alert notifications for actions like successfully saving a note, errors during CRUD operations, or user authentication issues.

- **Responsive Design**:  
  The application is fully responsive, adapting to different screen sizes, ensuring a smooth experience on mobile and desktop devices.

## Installation

### Prerequisites:
- PHP >= 7.3
- Composer
- Node.js and npm

### Steps:
1. Clone the repository:
   ```bash
   git clone https://github.com/MidoxDev/laravel-vue-notes.git

2. Navigate into the project directory
   ```bash
    cd laravel-vue-notes
3. Install the backend dependencies
   ```bash
   composer install
4. Set up your environment variables by copying the .env.example to .env
   ```bash
   cp .env.example .env
5. Generate the application key
   ```bash
   php artisan key:generate
   php artisan jwt:secret
6. Run the database migrations to set up the database
   ```bash
   php artisan migrate
7. Seed the database with default data:
   ```bash
   php artisan db:seed
8. Install frontend dependencies
   ```bash
   npm install
9. Start the Laravel development server
   ```bash
   php artisan serve
10. In a separate terminal window, run the Vue.js development server
    ```bash
    npm run dev
11. Your app is ready!
    - The application is now running locally. You can access the app at http://localhost:8000 (for Laravel) and interact with the Vue.js frontend at the configured port.

### Login Information:
- Email : test@example.com
- Password : password
