TP3 - Gestion d'utilisateurs et BDD
===================================

Créez un répertoire `TP3` dans `public_html` et copiez-y les 4 fichiers suivant du `TP2` :
- `authenticate.php`
- `signin.php`
- `signout.php`
- `welcome.php`

Objectifs
---------

Cet exercice vous propose de mettre en place une gestion des utilisateurs dans une base de données MySQL.

> **Note** : il est utile d'avoir réalisé l'exercice 6 du TP2 afin de transmettre les message d'erreur de PHP au client.


Exercice 1 : Mise en place de la BDD
------------------------------------

1. Créer une nouvelle base de données `W31` à partir de [webetu](https://webetu.iutrs.unistra.fr/)
2. Créer une table `Users` permettant de stocker les logins et mot de passe des utilisateurs. Réfléchissez bien aux champs et attributs des champs : auto-increment, unique, null, etc.
3. Ajouter manuellement plusieurs utilisateurs


Exercice 2 : Authentification
-----------------------------

1. Créez un nouveau fichier `bdd.php` contenant 3 constantes correspondant aux
3 paramètres de la construction d'un objet PDO (voir [cours](http://adrien.krahenbuhl.fr/courses/IUTRS/W31/CM2) et [documentation](https://www.php.net/manual/fr/book.pdo.php))
2. Modifiez le fichier `authenticate.php` pour remplacer l'utilisation du tableau `$users` par la BDD en utilisant **PDO**. Pour cela :
    1. Créez un objet PDO en utilisant les informations contenues dans `bdd.php`
    2. Construisez et exécute une **requête préparée** permettant de récupérer le mot de passe de l'utilisateur
    3. Vérifiez que l'utilisateur existe avec [`rowCount()`](https://www.php.net/manual/fr/pdostatement.rowcount.php)
    4. Vérifiez que le mot de passe transmis en POST correspond au mot de passe trouvé dans la BDD

> **Note** : N'oubliez pas de gérer les exceptions PHP déclenchées par la construction d'un objet PDO. Si vous avez fait l'exercice 6 du TP2, vous pouvez ajouter les messages d'erreurs à la variable de session `message`.


Exercice 3 : Inscription
------------------------

1. Écrivez un nouveau fichier `signup.php` qui propose un formulaire d'inscription pour un nouvel utilisateur (avec mot de passe et confirmation de mot de passe) et le soumet à la page `adduser.php`.
2. Écrivez un nouveau fichier `adduser.php` qui :
    - vérifie que la méthode HTTP utilisée est `POST`
    - vérifie et sécurise les champs du formulaire de `signup.php`
    - vérifie que le mot de passe et sa confirmation sont identiques
    - tente d'insérer le nouvel utilisateur avec une **requête préparée** :
        - si la requête s'est bien passée, il demande une redirection vers `signin.php`
        - sinon il demande une redirection vers `signup.php`
3. Pour plus de navigabilité, ajoutez un lien vers `signup.php` sur `signin.php`, et réciproquement.

> **Note** : Si vous avez fait l'exercice 5 du TP2, vous pouvez ajouter les messages d'erreur et de réussite à la variable de session `message`.


Exercice 4 : Mots de passe cryptés
----------------------------------

Actuellement les mots de passe sont codés en clair dans votre base de données. Vous allez mettre en place le chiffrement (et le décryptage) des mots de passe.

> **Note 1** : Ce serait le bon moment pour faire un commit Git de votre 1ère version fonctionnelle de ce TP.

> **Note 2** : Si tout a bien été fait jusque là, les questions 2. et 3. de cet exercice nécessitent de ne changer **qu'une seule ligne** dans chacun des fichiers.

1. Supprimez de votre BDD tous les utilisateurs inscrits, via PhpMyAdmin.
2. Modifiez le fichier `adduser.php` afin qu'il enregistre le mot de passe chiffrés avec la fonction PHP [`password_hash`](http://php.net/manual/fr/function.password-hash.php). **Attention**, lisez bien sa documentation et, si besoin, procédez aux modifications des attributs de la colonne du mot de passe dans PhpMyAdmin.
3. Modifiez le fichier `authenticate.php` pour qu'il compare le mot de passe
du formulaire avec celui récupéré dans la BDD à l'aide de la fonction
[`password_verify`](http://php.net/manual/fr/function.password-verify.php).


Exercice 5 (bonus) : Vérification des mots de passe côté client
---------------------------------------------------------------

En théorie, la vérification de la similarité des deux mots de passe s'effectue auussi côté client, en Javascript, afin de réduire les requêtes inutiles.

1. Dans `signup.php`, écrivez une fonction javascript `checkPassword` qui récupère le contenu des `input` du mot de passe et de sa confirmation et les compare. Utilisez la fonction [`setCustomValidity`](https://developer.mozilla.org/fr/docs/Web/API/HTMLSelectElement/setCustomValidity) pour mettre à jour la validité du champ de confirmation.
2. Faite exécuter la fonction `checkPassword` à chaque saisie d'un nouveau caractère dans le champ de confirmation. Regardez du côté de l'attribut HTML `oninput`.


Pour les plus rapides
---------------------

- Niveau 1 : Mise en place de fonctions utilitaires pour la redirections et la vérification de la méthode HTTP utilisée dans un fichier `helpers.php`. Pensez au typage !
- Niveau 2 : Ajoutez un fichier de style CSS pour mettre en forme votre formulaire.
- Niveau 3 : Utilisez [Bootstrap](https://getbootstrap.com) pour mettre en forme vos différentes pages.
