<h1>W cmd w VSC jak otworzysz projekt</h1>
<article>
<span>composer install</span><br>
<span>npm install</span>
</article>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

```
APP_NAME=Pitcernia
APP_ENV=local
APP_KEY=base64:oaOJeVKq+2gB1Hnl2kOb9zF/NQ1f7Zl6Z8SyZWlykEM=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=pl
APP_FALLBACK_LOCALE=pl
APP_FAKER_LOCALE=pl_PL

APP_MAINTENANCE_DRIVER=file

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# ✅ Zdalna baza danych (serwer 3.125.38.149)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=pitcernia
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=pitcernia.notify@gmail.com
MAIL_PASSWORD="zxgp lsgi zxrb ndcu"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=pitcernia.notify@gmail.com
MAIL_FROM_NAME=Pitcernia

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
#123

```

```
INSERT INTO `menus` (`id`, `name`, `description`, `ingredients`, `price`, `size`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Hawajska', 'Egzotyczna mieszanka szynki i ananasa na klasycznym cieście.', 'Mozzarella, Cheddar, Szynka, Ananas, Sos pomidorowy', 31, 'Średnia', 'pizza', NULL, NULL),
(2, 'Formaggio Quattro', 'Cztery wyśmienite sery dla prawdziwych seromaniaków.', 'Mozzarella, Gorgonzola, Parmezan, Ricotta, Sos śmietanowy', 40, 'Duża', 'pizza', NULL, NULL),
(3, 'Vegano Verde', 'Zielona wegańska rozkosz z warzywami i pesto.', 'Cukinia, Bakłażan, Papryka, Wegański ser, Rukola, Pesto', 36, 'Średnia', 'pizza', NULL, NULL),
(4, 'Spicy Diablo', 'Dla odważnych – pikantna uczta z kiełbasą i chili.', 'Kiełbasa, Ostro papryczki, Mozzarella, Sos pomidorowy', 32, 'Średnia', 'pizza', NULL, NULL),
(5, 'Di Mare', 'Pizza inspirowana smakami morza i świeżością owoców morza.', 'Krewetki, Kalmary, Czarne oliwki, Czosnek, Mozzarella, Sos pomidorowy', 44, 'Średnia', 'pizza', NULL, NULL),
(6, 'Cztery Sery', 'Bogactwo serów z nutą klasyki.', 'Mozzarella, Cheddar, Parmezan, Ricotta, Sos pomidorowy', 38, 'Mała', 'pizza', NULL, NULL),
(7, 'Kurczak Buffalo', 'Pikantna pizza z kurczakiem buffalo i łagodnym sosem ranch.', 'Kurczak, Sos buffalo, Mozzarella, Sos ranch', 35, 'Duża', 'pizza', NULL, NULL),
(8, 'Margarita Classico', 'Prosta klasyka z sosem pomidorowym i świeżą bazylią.', 'Sos pomidorowy, Mozzarella, Świeża bazylia', 28, 'Mała', 'pizza', NULL, NULL),
(9, 'Pizza Warzywna', 'Kolorowa, lekka i pełna warzyw dla wegetarian.', 'Papryka, Cebula, Pieczarki, Mozzarella, Sos pomidorowy', 30, 'Średnia', 'pizza', NULL, NULL),
(10, 'Spinaci Freschi', 'Lekka pizza z młodym szpinakiem i fetą.', 'Szpinak, Feta, Czosnek, Mozzarella, Oliwa, Sos śmietanowy', 33, 'Mała', 'pizza', NULL, NULL),
(11, 'Pomodoro Fresco', 'Soczyste pomidory i świeże zioła na cienkim cieście.', 'Pomidory cherry, Mozzarella, Bazylia, Oliwa, Sos pomidorowy', 30, 'Mała', 'pizza', NULL, NULL),
(12, 'Inferno di Napoli', 'Piekielna mieszanka ostrego salami i jalapeño.', 'Salami pikantne, Mozzarella, Jalapeño, Sos pomidorowy, Bazylia, Sos chili', 36, 'Średnia', 'pizza', NULL, NULL),
(13, 'Wegańska Rozkosz', 'Roślinna propozycja z kurczakiem roślinnym i kremowym sosem.', 'Roślinny kurczak, Sos alfredo, Mozzarella roślinna', 42, 'Mała', 'pizza', NULL, NULL),
(14, 'Ziołowy Raj', 'Zielona pizza z pesto i świeżymi ziołami.', 'Pesto, Oliwki, Pomidory, Mozzarella', 32, 'Mała', 'pizza', NULL, NULL),
(15, 'Wolina', 'Legendarna pizza inspirowana smakiem wyspy Wolin.', 'Dojrzewająca szynka, Ser burrata, Rukola, Pomidory konfitowane, Czosnek niedźwiedzi, Sos śmietanowy', 52, 'Duża', 'pizza', NULL, NULL),

-- Zapiekanki
(16, 'Zapiexy Klasyk', 'Tradycyjna zapiekanka jak za dawnych lat.', 'Bagietka, Pieczarki, Ser żółty, Ketchup, Szczypiorek', 15, 'Mała', 'zapiekanka', NULL, NULL),
(17, 'Mięsny Jeż', 'Mięsna uczta w formie zapiekanki.', 'Bagietka, Mięso mielone, Cebula, Ser, Sos BBQ', 18, 'Duża', 'zapiekanka', NULL, NULL),
(18, 'Wegański Power', 'Zapiekanka dla roślinożerców – lekko i smacznie.', 'Bagietka, Tofu, Cukinia, Papryka, Wegański ser, Pesto', 19, 'Średnia', 'zapiekanka', NULL, NULL),

-- Makarony
(19, 'Carbonara Classica', 'Włoska klasyka z boczkiem i parmezanem.', 'Makaron spaghetti, Boczek, Jajko, Parmezan, Pieprz', 32, 'Średnia', 'makaron', NULL, NULL),
(20, 'Bolognese Rustico', 'Domowy makaron z mięsnym sosem pomidorowym.', 'Makaron tagliatelle, Mielona wołowina, Sos pomidorowy, Cebula, Czosnek', 34, 'Duża', 'makaron', NULL, NULL),
(21, 'Spinaci e Ricotta', 'Makaron z delikatną ricottą i świeżym szpinakiem.', 'Makaron ravioli, Ricotta, Szpinak, Masło, Parmezan', 36, 'Mała', 'makaron', NULL, NULL);
```
