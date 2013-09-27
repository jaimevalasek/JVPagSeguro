JVPagSeguro
===========

Create By: Jaime Marcelo Valasek

Modulo para implementação do sistema de pagamento pagseguro em seu site ZF2.

Installation
-----
Download this module into the vendor folder of your project.

Enable the module in the file application.config.php. Add the module JVPagSeguro.

### With composer

1. Add this project and JVKart in your composer.json:

```php
"require": {
    "jaimevalasek/jv-pag-seguro": "dev-master"
}
```

2. Now tell composer to download JVPagSeguro by running the command:

```php $ php composer.phar update```

### Enabling it in your `application.config.php`.
```php
<?php
return array(
    'modules' => array(
        // ...
        'JVKart',
        'JVPagSeguro',
    ),
    // ...
);
```

Você encontrará tutoriais de como implementar nos seguintes sites abaixo:
-----
http://www.zf2.com.br/tutoriais

http://www.youtube.com/zf2tutoriais
