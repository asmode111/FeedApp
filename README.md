## Requirements

* Computer :)
* Terminal
* Git or Git Client
* Docker
* Node
* npm

## How to install the project?

1 - Clone the project from Github.

```git clone https://github.com/onurdegerli/BeadGame.git```

2 - Change directory to your project home.

```cd ~/BeadGame```

3 - In your project folder, run the command below:

```./docker.sh start```

4 - Install dependencies

```cd ~/BeadGame/feed-reader```

```./composer update```

```npm install && npm run dev```

5 - Run migrations

```cd ~/BeadGame```

```./docker.sh php```

```php artisan migrate```

## How to stop the project?

```./docker.sh stop```

## URLs

[Application](http://localhost)

[PHPMyAdmin](http://localhost:8184)

## Troubleshooting

- If you encounter with any PHP dependency problem, please run the command below in `beadgame_php` container.

```./docker.sh php```

```rm -rf vendor```

```composer update```

- If you encounter with any JS dependency problem, please run the command below outside of your containers.

```cd ~/BeadGame/feed-reader```

```rm -rf node_modules```

```npm install && npm run dev```

- If you still encounter with any problem, feel free to contact with me.

```onurdegerli@gmail.com```