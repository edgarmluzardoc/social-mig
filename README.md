# Social Network

Run Docker composer on this directory:
```
docker-compose up -d
```
Run the DB migrations on this directory:
```
php artisan migrate:refresh --seed
```

The "Reset Password" feature is built with `Mailtrap.io` for testing purposes and this project needs your own credentials in the `.env` file, so just update these from your Mailtrap account:
```
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

Go to your local:
http://localhost:8082/

You are all set!
