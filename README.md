W31 - Programmation web côté serveur
====================================

Nous mettrons sur ce dépôt toutes les resources pour les TDs, TPS.
Il sera impératif de savoir l'utiliser pour le TP noté.
Suivez les instructions ci-dessous pour mettre en place votre environnement de travail.

Pour les questions sur l'**utilisation** de votre dépôt, regardez la page [HOWTO](HOWTO.md).

1 - Créer un **clône distant** sur Gitlab
-----------------------------------------

Il suffit de cliquer sur le bouton "Fork" en haut de la page, à côté du bouton bleu "Clone".

**À FAIRE** : Ajouter votre enseignant de TP en tant que "Reporter" de votre dépôt (menu "Settings" => "Members").

2 - Créer un **clône local** sur votre ordinateur
-------------------------------------------------

1. Installer git sur votre ordinateur personnel (rien à faire sur les postes de l'IUT) :
```sh
$ sudo apt install git
```

2. Configurer vos informations d'utilisateur :
```sh
$ git config --global user.name "[Prenom] [Nom]"
$ git config --global user.email "[login]@unistra.fr"
```

3. Cloner :
```sh
$ git clone git@git.unistra.fr:[username]/W31.git
```

3 - Ajouter le **remote "prof"**
--------------------------------

En trois commandes :
```sh
$ cd W31
$ git remote add prof git@git.unistra.fr:W31/W31.git
$ git fetch prof
```

Si tout s'est bien passé, la commande :
```sh
$ git remote
```
affiche :
```sh
origin
prof
```
