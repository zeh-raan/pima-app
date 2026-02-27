# Pima - Task Management RESTful API

## 1. Project Overview
This project is a RESTful Task Management API developed using **Laravel**.  
It allows users to create **projects** and manage **tasks** within each project.  

The API demonstrates:

- REST principles with JSON responses  
- Laravel MVC architecture  
- Database integration using MySQL  
- Input validation and error handling  
- Route grouping and API Resource formatting  

---

## 2. Technologies Used

- PHP 8+  
- Laravel Framework  
- MySQL  
- REST Architecture  
- JSON  
- Composer  

---

## 3. System Architecture

The application follows **Laravel MVC** structure:

- **Models** → Database interaction  
- **Controllers** → Handle request logic  
- **API Resources** → Format JSON responses  
- **Routes (api.php)** → Define RESTful endpoints  
- **Database (MySQL)** → Stores system data  

All API routes are grouped within `routes/api.php`.

---

## 4. Database Structure

### Users Table
- `id`  
- `name`  
- `email`  
- `password`  
- `timestamps`  

**Relationship:** A User has many Projects.

### Projects Table
- `id`  
- `user_id` (foreign key → users.id)  
- `title`  
- `description`  
- `timestamps`  

**Relationships:**  
- A Project belongs to a User  
- A Project has many Tasks

### Tasks Table
- `id`  
- `project_id` (foreign key → projects.id)  
- `title`  
- `description`  
- `status` (enum: todo, doing, done)  
- `due_date` (nullable)  
- `timestamps`  

**Relationship:** A Task belongs to a Project.  

> Foreign key constraints use cascade delete to maintain data integrity.

---

## 5. Installation Guide

### Step 1: Clone Repository
```bash
git clone https://github.com/zeh-raan/pima-app
```
### Step 2: Navigate to Project Directory
```bash
cd task-management-api
```
### Step 3: Install Dependencies
```bash
composer install
```
### Step 4: Configure Environment
```bash
cp .env.example .env
```
> Update .env with your database credentials:
```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
### Step 5: Generate Application Key
```bash
php artisan key:generate
```
### Step 6: Run Database Migrations
```bash
php artisan migrate
```
### Step 7: Start Development Server
```bash
php artisan serve
```
> API is accessible at: http://127.0.0.1:8000/api
## 6. API Endpoints

All responses are returned in JSON format.
### 6.1 Projects
| Method | Endpoint             | Description                 |
| ------ | -------------------- | --------------------------- |
| GET    | `/api/projects`      | Retrieve all projects       |
| GET    | `/api/projects/{id}` | Retrieve a specific project |
| POST   | `/api/projects`      | Create a new project        |
| PUT    | `/api/projects/{id}` | Update an existing project  |
| DELETE | `/api/projects/{id}` | Delete a project            |

POST /api/projects Example Request:
```json
{
  "title": "New Project",
  "description": "Project description"
}
```
### 6.2 Tasks
| Method | Endpoint                   | Description                     |
| ------ | -------------------------- | ------------------------------- |
| GET    | `/api/projects/{id}/tasks` | Retrieve all tasks in a project |
| POST   | `/api/tasks`               | Create a new task               |
| PUT    | `/api/tasks/{id}`          | Update an existing task         |
| DELETE | `/api/tasks/{id}`          | Delete a task                   |

POST /api/tasks Example Request:
```json
{
  "project_id": 1,
  "title": "Build Controller",
  "description": "Develop project controller logic",
  "status": "todo",
  "due_date": "2026-03-10"
}
```
## 7. Validation Rules
### Project
| Field       | Rules                      |
| ----------- | -------------------------- |
| title       | required, string, max: 255 |
| description | optional, string           |

### Tasks
| Field      | Rules                                  |
| ---------- | -------------------------------------- |
| project_id | required, must exist in projects table |
| title      | required, string                       |
| status     | required, one of: todo, doing, done    |
| due_date   | optional, valid date                   |

### Error handling
| HTTP Status | Meaning               |
| ----------- | --------------------- |
| 200         | Success               |
| 201         | Resource created      |
| 404         | Resource not found    |
| 422         | Validation error      |
| 500         | Internal server error |

```json
{
  "success": false,
  "message": "Resource not found"
}
```
### 9. API Testing
> Postman
