## Deployment

### Open terminal & execute next commands:

1. ```cp .env.example .env```

2.
```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v $(pwd):/var/www/html \
-w /var/www/html \
laravelsail/php83-composer:latest \
composer install
```

3. ```./vendor/bin/sail up -d```

4. ```./vendor/bin/sail artisan key:generate```

5. ```./vendor/bin/sail php artisan migrate```

7. Open http://localhost/. 
After click on API Documentation you will see next url http://localhost/api/documentation and swagger documentation 
   page.
