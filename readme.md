## Install the dockerfile
```docker-compose up -d --build --remove-orphans```

## Install composer dependencies
```docker-compose exec basket composer install```

## Run the tests
```docker-compose exec basket php ./vendor/bin/phpunit ./tests/OfferTests.php```
