# MyLocations
 an Application that lets Users create markers on a map for their favorite locations with Laravel and VUE. Here Are the steps to start the project :
 
 # install npm dependencies
npm install

# generate a key for the application
php artisan key:generate

# generate Server secret for JWT (authentication)
php artisan jwt:secret

# create a local MySQL database 
mysql -u root

> create database mylocations;
> exit;

# add the database connection config to the .env file
DB_CONNECTION=mysql
DB_DATABASE=mylocations
DB_USERNAME=root
DB_PASSWORD=

# run the migration files to generate the schema
php artisan migrate

# run webpack and watch for changes
npm run watch

# serve php application
php artisan serve

#user to log with : 
email : test@test.com 
password : test

#use instructions
to add a place click on the map at the desired place 
