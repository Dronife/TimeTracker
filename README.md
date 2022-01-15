## Task
  - Create application with selected framework(laravel) to record time spent for completed tasks. 
  - Export list of tasks with selected format(csv, pdf, xls) and time range.
## Setup
**Best to use with docker**
```
docker-compose up -d
docker ps
```
- *Next you need to find the column named "IMAGE" and search for "laravelapp" value*<br>
- *When you find the row is it located you copy the value of "CONTAINER ID NAMES"*<br>
- *E.G.: mine was "7e5f1c77864d"*
```
docker exec -it <container_id_name_you_copied> bash
```
- *This command moves you to virtual enviroment you created*
- *Then you do all the basic commands for laravel setup*
```
composer update
cp .env.example .env
php artisan key:generate
```
- *You will need to setup Database in enviroment(.env) file*
- *Personally I edit it IDE*
- *Mysql and phpmyadmin are already installed with database called "time_tracker"*
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=time_tracker
DB_USERNAME=root
DB_PASSWORD=
```
- *Continue to run commands*
```
 php artisan migrate:fresh --seed
```
#### Everyting has been setup
## Access
- **localhost:8080** - the application
    - Logins should be left in login route 
- **localhost:8888** - phpmyadmin
    - user: **root**
## Testing
```
./vendor/bin/phpunit tests
```



  
