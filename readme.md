# VoteService
Сервис для голосования сотрудников за предложения о улучшении условий работы в компании и её рабочих процессов.

# How to start
    cp env.example .env
    docker-compose build
    docke-compose up -d
    docker-compose exec php php /var/www/artisan key:generate
    docker-compose exec php php /var/www/artisan config:cache
    docker-compose exec php php /var/www/artisan make:auth
    docker-compose exec php php /var/www/artisan migrate
  Go to 127.0.0.1:8080
