L'arborescence de Laravel
=========================

Voici les principaux fichiers et répertoires de Laravel à connaître pour W31.
Pour plus de détails, voir [la page de Laravel dédiée](https://laravel.com/docs/6.x/structure) :

- `app/Http/Controllers`
    - contient l'ensemble des contrôleurs que l'on crée
    - est accessible depuis le routage

- `app/Http/Middleware`
    - contient l'ensemble des middlewares que l'on crée
    - est accessible depuis le routage et les contrôleurs

- `app/Http/kernel.php`
    - fichier où l'on spécifie les middlewares utilisables dans notre application

- `public/index.php`
    - fichier d'entrée de l'application
    - récupère l'instance de l'application Laravel définie dans `bootstrap/app.php` et l'exécute

- `resources/views`
    - contient l'ensemble des vues Blade de votre application
    - est accessible depuis le routage et les contrôleurs

- `routes/web.php`
    - défini l'ensemble des routes pouvant être atteintes par les utilisateurs
    - fait appel aux middleware et contrôleurs lorsque cela est nécessaire

- `.env`
    - fichier de configuration de l'application
    - contient les variables pour l'accès à la BDD
