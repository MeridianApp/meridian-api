# Meridian API

Symfony 8 REST API backend for the Meridian investment tracker.  
See [`../SPEC.md`](../SPEC.md) for the full project specification.

## Requirements

- PHP 8.5+
- [Symfony CLI](https://symfony.com/download)

## Bootstrap

```bash
# 1. Install dependencies
symfony composer install

# 2. Create your local environment file
cp .env.example .env.local
# Then edit .env.local and set:
#   DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
#   APP_ADMIN_EMAIL=admin
#   APP_ADMIN_PASSWORD_HASH='<hash>'   # generate with: php -r "echo password_hash('yourpassword', PASSWORD_BCRYPT);"

# 3. Generate JWT key pair
symfony console lexik:jwt:generate-keypair

# 4. Create the database schema
symfony console doctrine:schema:create

# 5. Start the dev server
symfony serve
```

API is available at `https://127.0.0.1:8000`.

## Auth

```bash
# Login
curl -X POST https://127.0.0.1:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"username": "admin", "password": "yourpassword"}'

# Refresh
curl -X POST https://127.0.0.1:8000/api/auth/refresh \
  -H "Content-Type: application/json" \
  -d '{"refresh_token": "<refresh_token>"}'
```
