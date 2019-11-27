JAC - Just Another CMS
======================

Vous devez développer une application de publication d'articles, c'est-à-dire un mini-[CMS](https://fr.wikipedia.org/wiki/Syst%C3%A8me_de_gestion_de_contenu). Celui-ci pourra porter sur le thème de votre choix : jeux vidéos, musique, actualité, technos web, etc... ou aucun, du moment que les fonctionnalités sont implémentées.

Article
-------

Un article doit avoir au minimum :

- un titre
- un auteur
- une date de publication initiale
- une date de modification
- **une ou plusieurs rubriques auxquelles il est associé**
- une phrase d'accroche
- un contenu textuel
- un statut indiquant s'il est publié ou non

Partie publique
---------------

Un visiteur non authentifié ne doit pas pouvoir accéder à un article non publié.

La partie publique doit proposer :

- le résumé des 3 derniers articles publiés
- une page avec le résumé de tous les articles publiés, le plus récent en premier.
- une liste des rubriques
- un formulaire de création de compte "rédacteur"

Un résumé d'article est constitué de son titre, sa date de publication et sa phrase d'accroche.

Navigation
----------

Quelle que soit la page, un clic sur le titre :

- d'un résumé d'article doit mener à la page de l'intégralité de l'article
- d'une rubrique doit amener à la page contenant le résumé de tous les articles publiés de cette rubrique

Compte "Rédacteur"
------------------

Un utilisateur authentifié doit pouvoir :

- se déconnecter
- supprimer son compte : seul ses articles non publiés sont supprimés
- changer son mot de passe

mais aussi :

- créer un nouvel article
- modifier un article qu'il a lui-même créé
- publier/dé-publier un article

Conseils
--------

- Nous vous recommandons de réaliser ce projet en partant de la base de code obtenue à l'issue du TP n°8.
- Ne passez pas trop de temps sur le CSS : il doit uniquement permettre de rendre le site lisible (identification claire des différents éléments sur chaque page) et de faciliter la navigation (menu(s) et/ou liens). Gardez à l'esprit que l'aspect esthétique ne sera pas évalué lors du TP noté.
