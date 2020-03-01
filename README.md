## Requirements

* Terminal
* Docker
* Git
* Node
* npm

## How to install the project?

1 - Clone the project from Github.

```git clone https://github.com/onurdegerli/FeedApp.git```

2 - Create `.env` file and paste the lines below:

```cd ~/FeedApp/feed-reader```

```nano .env```

```
APP_NAME=FeedAPP
APP_ENV=local
APP_KEY=base64:yow196wMJsJAnqb8XBmSZxjEe/g2JbcS6as5MyW0Q3k=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=feedapp_db
DB_PORT=3306
DB_DATABASE=feedapp
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={MAILTRAP_USERNAME}
MAIL_PASSWORD={MAILTRAP_PASSWORD}
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS={MAILTRAP_EMAIL}
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

3 - Install dependencies

```cd ~/FeedApp/feed-reader```

```./composer update```

```npm install && npm run dev```

4 - Run the containers

```cd ~/FeedApp```

```./docker.sh start```

5 - Run migrations

```cd ~/FeedApp```

```./docker.sh php```

```php artisan migrate```

## How to stop the project?

```./docker.sh stop```

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

```./docker.sh php```

```rm -rf vendor```

```composer update```


- If you encounter with any JS dependency problem, please run the command below outside of your containers.

```cd ~/FeedApp/feed-reader```

```rm -rf node_modules```

```npm install && npm run dev```

- If you encounter with any database table/data related problem or just want to refresh tables, please run the command below in `feedapp_php` container.

```./docker.sh php```

```php artisan migrate:refresh```

- If you still encounter with any problem, feel free to contact with me.

```onurdegerli@gmail.com```