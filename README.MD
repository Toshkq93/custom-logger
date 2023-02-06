# Class Logger

##  Installation

Install the package via composer

```bash
composer require toshkq93/custom-logger
```
## Setup and use

```php
$logger_file = Logger::factory(FileDriver::class, ['filePath' => 'data/default.log']);

$logger_db = Logger::factory(DatabaseDriver::class, [
    'dsn' => 'mysql:host=127.0.0.1;dbname=test;charset=utf8',
    'table' => 'qwerty',
    'username' => 'root',
    'password' => '',
]);

$logger_db->info('test');
$logger_file->info('text');
```

## Security

If you discover any security related issues, please email ***a.stanovoi170993@gmail.com*** instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
