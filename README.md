# 📋 Task Management RESTful API
This project is a RESTful Task Management API developed using **Laravel**. It allows **users** to create **projects** and manage **tasks**. The API demonstrates:
- REST principles with JSON responses.
- Laravel MVC architecture.
- Database integration using MySQL.
- Input validation and error handling.
- Route grouping and API Resource formatting.
  - All API routes are grouped within `routes/api.php`.

## 🗂️ Database Structure
This is a brief overview of our database for the sake of comprehension.

### Users Table
Below is an example of the **Users** table in our application.
* We modified the default model that Laravel provides (as well as user sessions).
* The `password` and `api_key` fields are hashed for security reasons.  
&nbsp;

| id | email | password | api_key |
|----|-------|----------|---------|
| 1 | test@example.com | hizxd... | asjipd... |

### Projects Table
Below is an example of the **Projects** table in our application.
* *Many* projects belong to *only one* user.  
&nbsp;

| id | user_id | title | description |
|----|-------|----------|---------|
| 1 | 1 | "Title" | "Fancy description" |

### Tasks Table
Below is an example of the **Tasks** table in our application.
* *Many* tasks belong to *only one* project.
* *Many* tasks belong to *only one* user, because of the relationship between **** and **Projects**.
* Tasks have **3 status** values; "pending", "done" and "missed".  
&nbsp;

| id | project_id | title | status | due_date |
|----|------------|-------|--------|----------|
| 1 | 1 | "Task 1" | "pending" | ... |
| 2 | 1 | "Task 2" | "done" | ... |
| 3 | 2 | "Task 3" | "missed" | ... |

## 💻 Setup & Usage
Follow these steps to be able to properly run the application.

1. **Clone the repository.**
    ```bash
    git clone https://github.com/zeh-raan/pima-app.git
    ```

2. **Navigate to project directory.**
    ```bash
    cd pima-app/
    ```

3. **Setup environment variables.**
    ```bash
    cp .env.example .env
    ```

    * Update database properties.
      ```python
      DB_DATABASE=ez_tasking
      DB_USERNAME=root
      DB_PASSWORD=
      ```

4. **Run database migrations and seeders.**
    ```bash
    php artisan migrate:fresh --seed
    ```

5. **Start the application.**
    ```bash
    php artisan serve
    ```
## 🌐 API Endpoints
All api endpoints are found at http://localhost:8000/api. 

**Some** of the endpoints have been listed below. To see the full list:
1. Start the application.
2. Go to http://localhost:8000/docs.

### Project API Endpoints
| Method | Endpoint             | Description                 |
| ------ | -------------------- | --------------------------- |
| GET    | `/api/projects`      | Retrieve all projects       |
| GET    | `/api/projects/{id}` | Retrieve a specific project |
| POST   | `/api/projects`      | Create a new project        |
| PUT    | `/api/projects/{id}` | Update an existing project  |
| DELETE | `/api/projects/{id}` | Delete a project            |

### Tasks API Endpoints
| Method | Endpoint                   | Description                     |
| ------ | -------------------------- | ------------------------------- |
| GET    | `/api/tasks?project_id={project_id}` | Retrieve all tasks in a project |
| POST   | `/api/tasks`               | Create a new task               |
| PUT    | `/api/tasks/{id}`          | Update an existing task         |
| DELETE | `/api/tasks/{id}`          | Delete a task                   |

## 🛠️ API Testing
The API can be tested using various tools such as:
* Postman
* CURL
  ```bash
  curl -X GET http://127.0.0.1:8000/projects -H "X-API-KEY: your-key-here" -H "Accept: application/json"
  ```

### Example Use Case
We have provided a simple python script under `/example` to demonstrate how the API may be used.  
Follow the `README.md` there!