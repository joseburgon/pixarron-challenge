# Pixarron Challenge

Technical Assesment for Pixarron.

App running live on Heroku: http://pixarron-challenge.herokuapp.com/  
(It may take a while for the first time to load since it is running on a free dynos).

### Credentials

Admin User:  
*Email: admin@test.com
Password: pixarron2021*

Client User:  
*Email: client1@test.com
Password: pixarron2021*

### API documentation
https://documenter.getpostman.com/view/12059338/TVzViG2R

## Local Installation Process

### Step 1: Clone repository

If it's Windows we highly recommend using [Laragon](https://laragon.org/) as a local development environment.

```
git clone https://github.com/joseburgon/pixarron-challenge.git
```

### Step 2: Switch to the repo folder

```
cd pixarron-challenge
```

### Step 3: Install project packages and dependencies

```
composer install
```

### Step 4: Create .env file

The .env file is generally not loaded, due to security issues. The easiest way to do this is to copy the .env.example file to .env, and modify the latter:

```
copy .env.example .env
```

### Step 5: Generate project key

Laravel requires an encryption key for each project.

```
php artisan key:generate
```

### Step 6: Create database

Laravel is configured to use mySQL by default, not only the driver, server, database, user and password must be changed, but also the port, mySQL uses 3306 and postgres 5432.

### Step 7: Migrate and seed the database

```
php artisan migrate --seed
```

### Step 8: Start the local development server

```
php artisan serve
```

## Ready to go!

You can now access the server at http://localhost:8000.

Or http://pixarron-challenge.test/login if you use [Valet](https://laravel.com/docs/7.x/valet) on Mac or [Laragon](https://laragon.org/) on Windows.
