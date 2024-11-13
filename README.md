First clone this repository, install the dependencies, and setup your .env file.

  git clone https://github.com/harshmore785/family-details.git
  composer install
  cp .env.example .env
  php artisan key:generate
Then create the necessary database and run the initial migrations and seeders.

  php artisan migrate
  php artisan db:seed

  or

  php artisan migrate --seed
Now after run the server by using command

  php artisan serve
