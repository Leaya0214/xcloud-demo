# xCloud Server Management API

## Track
**Backend API** – CRUD + Bulk Operations for Servers

---

## 1️⃣ Project Setup

### Requirements
- PHP >= 8.2
- Laravel - 12  
- MySQL / MariaDB  
- Composer  
- (Optional) Postman for testing  

### Steps
1. Clone repository:
```bash
git clone <repo_url>
cd xcloud-demo
```
2. Install dependencies:
```composer install```

3. Create .env file
```cp .env.example .env```

4. Set DB credentials in .env

5. Run migrations & seeders:
```php artisan migrate --seed```

6. Generate app key:
```php artisan key:generate```

7. Run development server:
```php artisan ser```
8. Access API at: http://localhost:8000/api/

## 2️⃣ Authentication

Token-based authentication using Laravel Sanctum.

All server routes are protected, include Bearer token in headers:

Authorization: Bearer <your_token_here>
Accept: application/json

## 3️⃣ API Endpoints

| Action        | Method | Endpoint          | Body / Params                                                         |
| ------------- | ------ | ----------------- | --------------------------------------------------------------------- |
| List Servers  | GET    | /api/servers      | -                                                                     |
| Show Server   | GET    | /api/servers/{id} | id (URL param)                                                        |
| Create Server | POST   | /api/servers      | name, ip\_address, provider, status, cpu\_cores, ram\_mb, storage\_gb |
| Update Server | PUT    | /api/servers/{id} | Any of name, status, cpu\_cores, ram\_mb, storage\_gb                 |
| Delete Server | DELETE | /api/servers/{id} | id (URL param)                                                        |


| Action             | Method | Endpoint                        | Body (JSON)                                  |
| ------------------ | ------ | ------------------------------- | -------------------------------------------- |
| Bulk Delete        | POST   | /api/servers/bulk-delete        | { "ids": \[1,2,3] }                          |
| Bulk Update Status | POST   | /api/servers/bulk-update-status | { "ids": \[1,2,3], "status": "maintenance" } |


## 4️⃣ Validation Rules

--name → required, unique per provider

--ip_address → required, valid IPv4, unique

--provider → required, one of [aws, digitalocean, vultr, other]

--status → required, one of [active, inactive, maintenance]

--cpu_cores → integer, 1–128

--ram_mb → integer, 512–1048576

storage_gb → integer, 10–1048576

## 5️⃣ Postman Collection

--Postman collection exported at: /postman/xcloud-api-collection.json

--Includes all CRUD + bulk operations


## 6️⃣ AI Collaboration

<b>Used ChatGPT to generate:</b>

--Controller methods

--Validation rules

--Route design

--Bulk operations API

--Reviewed and debugged AI code for:

--Validation edge cases

--Fillable fields

--Proper RESTful endpoints

## 7️⃣ Debugging Journey

--Issue: POST /api/servers/index returned Laravel welcome page → fixed by correcting route to /api/servers

--Issue: Duplicate IPs → enforced unique validation

--Mass assignment errors → added $fillable fields in Server model

## 8️⃣ Tech Decisions & Trade-offs

--Backend-focused due to 30-min time constraint

--Sanctum authentication for simplicity

--Bulk operations added for bonus points

--Frontend skipped – optional if time allowed

## 9️⃣ Time Spent

~2–3 hours for CRUD + bulk operations

~30 min for Postman collection + README

## 10️⃣ Author & Optional: Live Demo

**Author:** Leaya  
**Email:** leaya@example.com  
**Location:** Dhaka, Bangladesh  
**Role:** Software Engineer / Backend Developer  

**Live Demo:** Not included (local testing via Postman)
