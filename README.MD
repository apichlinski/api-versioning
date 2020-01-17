# How run project from scratch?
```bash
cp .env.dist .env
docker-compose up -d
docker-compose exec php composer install
docker-compose exec php bin/console cache:clear
docker-compose exec php bin/console asset:install
docker-compose exec php vendor/bin/phing install
docker-compose run node yarn up
docker-compose run node yarn dev
```
Remember that pass phrase is in .env
```bahs
docker-compose exec php openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
docker-compose exec php openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```
## Aditional necessary steps
### Cron
#### Hush Space utilization
Every instance should have a cron entry (or other type of cyclic task) that will execute below script (at least once a day).
```bash
bin/console app:hush-space-usage
```  
This script will calculate daily usage of every hush space. You can specyfic the day you want to calculate utilization for ```bin/console app:hush-space-usage 2020-01-13```. 
By default script will calculate usage for yesterday.

# Database migration
```bash
docker-compose exec php bin/console make:migration
docker-compose exec php bin/console doctrine:migrations:migrate
```

# Coding Standards Tools
## Checking
```bash
docker-compose up -d
docker-compose exec php composer install --dev
docker-compose exec php vendor/bin/phing check
docker-compose exec php vendor/bin/phpmd src --exclude src/Entity,src/Migrations,src/Enum --suffixes php text cleancode,codesize,controversial,design,unusedcode
docker-compose exec php vendor/bin/php-cs-fixer fix --dry-run
```
or by phing command
```bash
docker-compose exec php vendor/bin/phing check
```

## Fixing
```bash
docker-compose up -d
docker-compose exec php composer install --dev
docker-compose exec php vendor/bin/php-cs-fixer fix
```
or by phing command
```bash
docker-compose exec php vendor/bin/phing fix
```


# Phing
You can list all available commands by
```bash
docker-compose up -d
docker-compose exec php composer install --dev
docker-compose exec php vendor/bin/phing -l
```

# Functional tests
```bash
docker-compose exec php bin/phpunit
```
or by phing command
```bash
docker-compose exec php vendor/bin/phing test
```