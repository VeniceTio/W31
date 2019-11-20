TP8 - Eloquent ORM
==================

Objectif
--------

Dans le TP précédent, nous avons mis en place la partie Contrôleur de notre application Laravel.

Dans ce TP6, l'objectif est d'utiliser les fonctionnalités de l'ORM Eloquent pour gérer les vues sans ses soucier de leur enregistrement en base de données.


Exercice 1 : Un utilisateur qui manie le verbe
----------------------------------------------

Pour cet exercice, référeez-vous aux documentation sur [la migration](https://laravel.com/docs/6.x/migrations) et sur [Eloquent ORM](https://laravel.com/docs/6.x/eloquent).

1. Créer un modèle d'utilisateur `UserEloquent` avec artisan, en demandant la génération du fichier de migration en même temps :
    ```sh
    $ php artisan make:model UserEloquent -m
    ```

1. Modifier le fichier de migration `database/migrations/2019_..._create_user_eloquents_table.php` pour qu'elle possède un champs `user` (clé primaire) et un champ `password`. La table doit s'appeller `UserEloquent`.

1. Procéder à la migration avec la commande :
    ```sh
    $ php artisan migrate
    ```
    et vérifier que la table `UserEloquent` créée est identique à la table `Users`.

1. Dans `app/UserEloquent.php`, indiquer :
    - que la table utilisée s'appelle `UserEloquent`
    - que la clé primaire s'appelle `user` et est une chaîne de caractères
    - qu'il n'y a pas de `timestamps` dans les attributs


Exercice 2 : De User à UserEloquent
-----------------------------------

Cet exercice a pour objectif de remplacer, dans `UserController.php`, l'utilisation de du modèle `User` par `UserController`.

Pendant les tests, il est possible d'indiquer dans `UserEloquent.php` d'utiliser temporairement la table `Users` afin d'avoir déjà des utilisateurs inscrits.

1. Commencer par effectuer le remplacement dans la méthode `authenticate`. Il est nécessaire de réintroduire la méthode `password_verify`.

1. Poursuivez avec `addUser` et `changePassword`.
    - Il est nécessaire de réintroduire la méthode `password_hash`.
    - Traiter l'exception déclenchée lorsqu'il y a violation de clé primaire.

1. Enfin terminer avec `deleteUser` : cette méthode ne doit plus contenir que 3 instructions.

1. Finalement, supprimer le fichier `MyUser.php` et toutes les instructions qui y font référence.
