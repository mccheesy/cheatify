# Cheatify

> A simple CRUD app using the Laravel PHP framework paired with Vue.js + VueRouter. WIP.

## About Cheatify

- Check out cheat codes from your favorite games.
- Register and login to add and edit codes.
- Coming soon:
  - Associate cheat codes with your favorite games
  - Associate games with your favorite systems
  - Vote for your favorite cheat codes

## Install

1. Clone this repo
```bash
git clone git@github.com:mccheesy/cheatify.git
```

2. Install composer packages
```bash
cd cheatify
composer install
```
Laravel Dusk requires manual installation ***only required to run browser tests*
```bash
composer require --dev laravel/dusk
```

3. Install npm packages
```bash 
npm install
```

4. Compile JavaScript & CSS assets
```bash
npm run prod
``` 

5. Copy the example environment file
```bash
cp .env.example .env
```

6. Generate the Laravel APP_KEY
```bash
php artisan key:generate
```

7. Customize the .env file with connection details for an available database and user *or create a database named cheatify and a user named cheatify with the password secret*
```
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={{DATABASE}}
DB_USERNAME={{USERNAME}}
DB_PASSWORD={{PASSWORD}}
```

8. Run the migrations & generate Passport keys
```bash
php artisan migrate
php artisan passport:keys
```

9. Navigate to the site
10. Enjoy!

## Feedback?

[Email me!](mailto:jmccleese@gmail.com)
