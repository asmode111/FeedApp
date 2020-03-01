## Requirements

* Terminal
* Docker
* Git
* Node
* npm

## How to install the project?

1 - Clone the project from Github.

```git clone https://github.com/onurdegerli/FeedApp.git```

```cd FeedApp```

2 - Create a `.env` file

```./app.sh env```

3 - Install dependencies

```./app.sh composer```

```./app.sh npm```

4 - Run containers

```./app.sh start```

5 - Run migrations

```./app.sh php```

```php artisan migrate```

## How to stop the project?

```./app.sh stop```

## URLs

[Application](http://localhost)

[PHPMyAdmin](http://localhost:8184)

## Email Sending/Receiving

If you want to receive email while reseting the password, you should create an account at [mailtrap.io](https://mailtrap.io/) and provide the settings below in the `.env` file:

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={MAILTRAP_USERNAME}
MAIL_PASSWORD={MAILTRAP_PASSWORD}
MAIL_FROM_ADDRESS={MAILTRAP_EMAIL}
```

## Troubleshooting

- If you encounter with any PHP dependency problem, please run the command below in `feedapp_php` container.

```./app.sh php```

```rm -rf vendor```

```composer update```


- If you encounter with any JS dependency problem, please run the command below outside of your containers.

```cd FeedApp/feed-reader```

```rm -rf node_modules```

```npm install && npm run dev```

- If you encounter with any database table/data related problem or just want to refresh tables, please run the command below in `feedapp_php` container.

```./app.sh php```

```php artisan migrate:refresh```

- If you still encounter with any problem, feel free to contact with me.

```onurdegerli@gmail.com```