TP7 - Controller et Middleware
==============================

Objectif
--------

Dans le TP précédent, nous avons mis en place la partie Vue du MVC avec Blade.

Dans ce TP7, nous allons mettre en place la partie Contrôleur du MVC, en créant un contrôleur d'utilisateur auquel on fera appel via le contrôleur de routage.


Exercice 1 : Un Middleware d'authentification
---------------------------------------------

> Si besoin, la documentation est ici : [https://laravel.com/docs/6.x/middleware](https://laravel.com/docs/6.x/middleware)

1. Créez le middleware `EnsureMyUserIsAuthenticated` grâce à **artisan** avec la commande suivante (il faut être à la racine de votre projet Laravel) :
    ```sh
    $ php artisan make:middleware EnsureMyUserIsAuthenticated
    ```

1. Déplacer les instructions de vérification de la variable de session `user` du fichier `routes/web.php` vers la fonction `handle(...)` de `EnsureMyUserIsAuthenticated.php`.

1. Dans `app/Http/Kernel.php`, ajouter le middleware comme **middleware de routes**, avec pour nom `myuser.auth`.

1. Dans `routes/web.php`, ajouter le middleware au groupe de routes préfixé `admin`.


Exercice 2 : Un Contrôleur pour les gouverner tous
--------------------------------------------------

1. Créer un contrôleur `UserController` avec la commande suivante (il faut être à la racine de votre projet Laravel) :
    ```sh
    $ php artisan make:controller UserController
    ```


Exercice 3 : Le contrôle dans ses plus simples éléments
-------------------------------------------------------

1. Dans `UserController.php`, créer la fonction suivante :
    ```php
    /**
     * Show the signin page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin( Request $request )
    ```
et copiez-y le code de la fonction associée à la route `signin` de `routes/web.php`.

1. Modifier les routes `/` et `signin` de `routes/web.php` pour qu'elles appellent la méthode `signin` du contrôleur `UserController`.

1. Appliquer les deux étapes précédentes aux routes `signup`, `formpassword`, `signout` et `welcome`.


Exercice 4 : Le contrôle de l'authentification
----------------------------------------------

1. Dans `UserController.php`, créer une fonction `authenticate` su le même modèle que celles de l'exercice précédent.

1. Copier le code du fichier `resources/view/authenticate.php` dans la méthode `authenticate` de `UserController.php` et effectuer tous les changements possibles pour utiliser :
    - l'objet `$request` pour manipuler les données transmises par l'utilisateur (voir [HTTP Requests](https://laravel.com/docs/6.x/requests))
    - la directive `redirect` de Laravel au lieu de `header` (voir [Routing](https://laravel.com/docs/6.x/routing))

1. Supprimer le fichier `resources/view/authenticate.php`

1. Appliquer les deux étapes précédentes aux routes `adduser`, `changepassword` et `deleteuser`.

> Note : si certaines erreurs ne sont plus "catchées" et affichées dans un message mais déclanchent une erreur Laravel, ajouter un `\` devant les types d'erreur. Ex : `catch (\PDOException $e)`.


Exercice 5 : Les sessions selon Laravel
---------------------------------------

Cet exercice va permettre de déléguer la gestion des sessions à Laravel de manière transparente et de rendre le code plus lisible.

Le choix vous est laissé d'utiliser les sessions à travers l'objet `$request->session()` ou à travers la fonction globale `session` (voir la documentation disponible sur la page [HTTP Session](https://laravel.com/docs/6.x/session)).

1. Remplacer tous les appels au tableau `$_SESSION` du fichier `UserController.php` par l'utilisation des sessions de Laravel. Penser notamment :
    - à utiliser la directive `with` en complément des directives `view` et `redirect` pour transmettre les messages d'information et le nom de l'utilisateur
    - à détruire les sessions avec `flush`
    - à utiliser `put` pour sauvegarder le nom de l'utilisateur

1. Faite de même pour le middleware `EnsureMyUserIsAuthenticated.php`.

1. Finalement, supprimer l'appel à `session_start()` du fichier `routes/web.php` et supprimer le groupe global.
