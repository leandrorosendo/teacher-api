# Teacher App - API/REST

## About

This is a simple API/Rest test to Teacher. It's a backend API to be consumed 
by [teacher-web]() 
frontend.

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
ex: DB_DATABASE=professor_api
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


This app is using Lumen Framework. It's a very simple app. There is no auth or CSRF 
protection.

There are only two rotes. One for the winner's list ```/winners``` and other to play the 
game ```/play```.

The app will check if the player alerady exists, if not it'll create a new player and 
store the scores to him. Otherwise updates the player's scores. The player checker will 
only check by name (case insensitive). After each play the app will check if the request 
is valid checking the form fields and cards type and size allowed. Any problem on that 
the app will reponse with 500 code and an array of erros. Otherwise will return the game 
results and a new list of winners.




4 - executar o comando de criacao das tabelas. "php artisan migrate:fresh --seed "
5 -  Testando aplicação se estiver usando windows executar o comando  para testar aplicação: "vendor\bin\phpunit.bat"
