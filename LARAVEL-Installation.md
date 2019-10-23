Laravel
=======

Installation sur webetu
------------------------

**Attention : cette installation n'est possible que sur webetu.**

1. Initialisation d'une un projet `[NAME]` :

```
$ composer create-project --prefer-dist laravel/laravel [NAME]
```

2. Lancement d'un serveur local :

```
$ cd [NAME]
$ php artisan serve
Laravel development server started: http://127.0.0.1:8000
```

Si tout s'est bien passé, votre navigateur affiche une page blanche avec le contenu suivant avec l'URL `http://127.0.0.1:8000` :

```
                Laravel
Docs Laracasts News Blog Nova Forge Vapor GitHub
```


Installation sur votre ordi personnel
--------------------------------------

### Dépendances

- php-fpm
- php-zip
- php-xml
- php-mbstring

### Procédure

1. Installation manuelle de Composer

```
$ sudo apt install composer
```

2. Initialisation d'une application `[NAME]` basée sur laravel

```
$ composer create-project --prefer-dist laravel/laravel [NAME]
```

3. Exposition du site sur le serveur web

```
$ php artisan serve
```

Si tout s'est bien passé, votre navigateur affiche une page blanche avec le contenu suivant avec l'URL `http://127.0.0.1:8000` :

```
                Laravel
Docs Laracasts News Blog Nova Forge Vapor GitHub
```
