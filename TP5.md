TP5 - Prise en main de Laravel
==============================

Objectif
--------

Intégrer votre application d'authentification au framework Laravel.
Vous pouvez vous baser au choix :

- sur de vos propres sources résultant du TP4
- sur la proposition du répertoire [correction/TP4](correction/TP4)

Noter que le but de ce TP est d'obtenir une application fonctionnelle **mais qui ne respectera pas encore le découpage MVC**.

Les TPs suivants permettront de séparer progressivement les parties Modèle, Vue et Contrôleur en utilisant à bon escient les fonctionnalités offertes par Laravel.


Exercice 1 : Installation
-------------------------

Suivez les indications donnés dans [LARAVEL-installation.md](LARAVEL-installation.md).

**Attention : `composer` n'est installé que sur webetu, pas sur troglo.**


Exercice 2 : Préparation des vues
---------------------------------

1. Copiez les fichiers suivants du TP4 dans `resources/views/` :
    - `adduser.php`
    - `authenticate.php`
    - `changepassword.php`
    - `deleteuser.php`
    - `formpassword.php`
    - `signin.php`
    - `signout.php`
    - `signup.php`
    - `welcome.php`

1. Dans `routes/web.php` :
    - Écrivez les routes GET et POST pour les fichiers ci-dessus (ne pas utiliser `Route::view`)
    - Faites en sorte qu'une requête vers la racine du site propose la vue `signin.php`
    - Testez toutes les routes GET. Regardez ce qu'il se passe lorsqu'on demande une route qui n'a pas été prévue dans `routes/web.php`

1. Dans chaque fichier remplacer toutes les références à des fichiers PHP par des références à des routes.

1. Dans le fichier `app/Http/Kernel.php`, commenter les lignes qui font référence au middleware `VerifyCsrfToken`.


Exercice 3 : Controleur et PDO
------------------------------

1. Dans le fichier `.env`,  modifiez les champs `DB_HOST`, `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD` avec les informations de l'ancien fichier `bdd.php`.

1. Copier le fichier `models/User.php` du TP4 dans le répertoire `app/` de votre application et le renommer `MyUser.php`. **Attention, ne pas écraser le fichier `User.php` existant déjà dans ce répertoire.**

1. Dans `MyUser.php` :
    - déclarer le namespace `App`
    - remplacer les `User::USER_TABLE` par `MyUser::USER_TABLE`
    - remplacer tous les `MyPDO::pdo()` par `DB::connection()->getPdo()`
    - ajouter en entête les deux `use` suivants :
        ```php
        use Illuminate\Support\Facades\DB;
        use PDO;
        ```

1. Dans chacun des fichiers `adduser.php`, `authenticate.php`, `changepassword.php`, `deleteuser.php` et `signout.php` :
    - remplacer les `require_once('models/User');` par des `use App\MyUser;`
    - remplacer les `new User` par des `new MyUser`

**À ce stade, l'application devrait être entièrement fonctionnelle. Solutionner les problèmes avant de passer à la suite.**


Exercice 4 : Le grand nettoyage
-------------------------------

1. Supprimer toutes les vérifications de `REQUEST_METHOD` : c'est maintenant le routage qui le gère.

1. Supprimer tous les `session_start()` de tous vos fichiers.

1. Dans `routes/web.php`, mettre toutes les routes dans un groupe. Dans la fonction qui contient maintenant toutes les routes, ajouter en première instruction un `session_start()`.

1. Dans `routes/web.php`, remplacer l'appel à la vue `signout` par le code du fichier `signout.php` et modifier l'appel à `header()` par un appel à la méthode `redirect()` de Laravel. Supprimer `signout.php`.

1. Dans le même esprit que la question précédente, déplacer le code de vérification de connexion situé au début des fichiers `changepassword.php`, `deleteuser.php`, `formpassword.php` et `welcome.php` dans les fonctions de routage correspondantes. Remplacer les appels à `header()` par des appels à la méthode `redirect()` de Laravel.

1. Dans `routes/web.php`, placer les routes de la question précédente (+ la route `signout`) dans un groupe préfixé par `admin`. Ajouter `admin/` à ces routes dans tous les `header()` de tous vos fichiers de vues.

**Vérifier que tout fonctionne.**
