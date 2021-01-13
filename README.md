# Demo
[https://aliftech.github.uz](https://aliftech.github.uz "https://aliftech.github.uz")

# Installation
```bash
git clone https://github.com/ismoil-nosr/laravel-project.git
cd laravel-project/
composer install
cp .env.example .env
php artisan migrate --seed
```

## Docker
First create an image:

    sudo docker build -f ./.deploy/Dockerfile -t contact_manager

Then run container:

    sudo docker run -d -t -i -e APP_ENV='development' \ 
    -e DB_CONNECTION='mysql' \
    -e DB_HOST='mysql_server' \
    -e DB_PORT='3306' \
    -e DB_DATABASE='contact_manager' \
    -e DB_USERNAME='contact_manager \
	-e DB_PASSWORD='password' \
    -p 80:80 \
	-p 443:443\
    --name contact_manager

## Docker-compose
```bash
git clone https://github.com/ismoil-nosr/laravel-project.git
cd laravel-project/
docker-compose up -d
```