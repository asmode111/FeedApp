## Requirements

* Computer :)
* Terminal
* Git
* Docker

## How to install the project?

1 - Clone the project from Github.

```git clone https://github.com/onurdegerli/BeadGame.git```

2 - Change directory to your project home.

```cd ~/BeadGame```

3 - In your project folder, run the command below:

```./docker.sh start```

## How to stop the project?

```./docker.sh stop```

## How to open the project in browser?

Web: `http://localhost`

## Troubleshooting

- If you encounter with any dependency problem, please run the command below in `beadgame_php` container.

```rm -rf vendor```

```composer update```

- If you still encounter with any problem, feel free to contact with me.

```onurdegerli@gmail.com```