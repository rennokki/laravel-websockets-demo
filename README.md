# Laravel WebSockets Demo

## Requirements

- Laravel 8.x requirements with latest PHP (7.4)
- PCNTL extension (for the `websockets:serve` command; can only run on UNIX-based systems)

## Installation

```bash
$ cp .env.example .env
```

```bash
$ php artisan key:generate
```

```bash
$ composer install
```

```bash
$ npm install && npm run dev
```

If you plan to open a Homestead instance, you can do so:

```bash
$ vendor/bin/homestead make
```

Configure your `Homestead.yaml` file then install the instance:

```bash
$ vagrant up --provision
```

Run WebSockets server:

```bash
$ php artisan websockets:serve
```

## Troubleshooting

### It threw `WebSocket is closed before the connection is established.`

If you are on HTTPS, you need to specify the paths to the certificates using the variables described in `config/websockets.php`, and make sure 
that the private key got permissions to be read. In some cases, like Homestead, you might need to set the private key's permissions to `777`.
