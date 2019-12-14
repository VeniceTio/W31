Bonjour,

Ci-dessous quelques informations générales à propos du TP noté de lundi.

Organisation
------------

- Vous serez répartis sur les salles 5, 17 , 105 et 106.
- La répartition par salle sera affichée à l'entrée et sur chaque salle
- Vous aurez le droit de (et êtes même encouragés à) utiliser votre ordinateur personnel : il n'y aura pas de poste fixe pour tout le monde.
- Bien entendu, tous les autres appareils électroniques seront rangés dans vos sacs et vos téléphones en silencieux.

BDD
---

Nous vous fourniront un script MySQL à importer dans PhpMyAdmin qui contiendra le modèle de BDD avec des données déjà insérées. Vous pouvez tester cette procédure avec le fichier d'exemple fournit en pièce jointe et en suivant par exemple la procédure ici : https://help.fasthosts.co.uk/app/answers/detail/a_id/3186/~/importing-and-exporting-mysql-databases-using-phpmyadmin
(vous trouverez pleins d'autres exemples sur internet).

Gitlab
------

Le sujet du TP noté sera "pushé" sur le remote "prof" lundi à 8h30. Vous pourrez donc le récupérer de la même manière que vous avez récupéré les sujet des TPs tout au long du module.

À faire dès à présent :

- Donnez les droits "Reporter" sur votre clone à votre chargé de TD
- Mettre votre clone en privé limiter le plagiat

À faire pendant l'examen :

- Faites un `git pull prof master` pour récupérer le sujet
- Faites des `git commit` régulièrement : il pourront servir de base pour dissocier les éventuels plagiaires des plagiés.
- ne faites qu'un seul `git push origin master` à la fin
- vous aurez droit à toutes les aides possibles : code, internet, etc... à l'exception de l'aide directe d'autres personnes, qu'elles soient présentes physiquement ou en ligne.
- vous pourrez utiliser toutes les fonctionnalités de Lumen que vous voulez mais seules celles vues en cours, TDs et TPs seront nécessaires : en utiliser de plus avancées ne donnera pas plus de points.


Principaux aspects à maîtriser
------------------------------

- Syntaxe PHP
- Connexion à une basse de donnée avec PDO (et/ou Eloquent)
- Organisation MVC de votre code
- Répartition des tâches selon le modèle MVC :
    - routage dans web.php
    - requêtes vers la BDD exclusivement dans les classes Modèle
    - traitement des requêtes et utilisation des classes Modèles pour générer les vues dans les contrôleurs
    - middleware pour des tâches répétitives et/ou de contrôle
- Cohérence des requêtes avec leur traitement
- Routage :
    - utilisation de prefixes
    - utilisation de paramètres transmis aux contrôleurs
- Blade :
    - utilisation d'un ou plusieurs layouts avec héritage
    - traitement de paramètres transmis par les contrôleurs


Bon week-end.
