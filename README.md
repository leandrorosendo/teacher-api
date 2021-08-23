# Teacher-App - API/REST

This is a simple API/Rest test to CRUD a teacher, discipline and link teacher to discipline. 
It's a backend API to be consumed by [teacher-web](https://github.com/leandrorosendo/teacher-web)  frontend.

### Install Dependencies 
```
composer install
```

### Create .env file
```
 (LINUX) cp .env.example .env
 (WINDOWS)copy .env.example .env
```

### Configura .env file with db settings
```
ex: 
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=professor_api
DB_USERNAME=postgres
DB_PASSWORD=
```

## Run Server Api
```
php -S localhost:8000 -t public
```

## Run Seeders
```
php artisan migrate:fresh --seed 
```

## Test
```
(WINDOWS):  vendor\bin\phpunit.bat
```


This app is using Lumen Framework. It's a very simple app. There is no auth or CSRF protection.

There are only three rotes. One for the teacher's ```/teachers``` , disciplines  ```/disciplines``` and other to link teacher disciplines  ```/teachers/disciplines```.

The app will check if the cpf and email the teacher already exists and if age < 18 years, if not it'll create a new teacher and store. Otherwise updates the player's scores. The discipline checker will only check by name (case insensitive). Each creation / changethe app linked teacher x discipline will check if the teacher is already linked to a subject. Any problem on that the app will reponse with 422 code and an array of erros. All routes the app check if informations compatibles of data types.


