# Récap

## Utilisation des données : CRUD

- Create
- Read
- Update
- Delete

Ce sont les actions habituelles à faire avec des données => Nos models vont forcément refléter cette utilisation. 

## Contraintes pour l'utilisation des classes

On peut utiliser des classes "abstraites" pour forcer les développeurs qui veulent étendre ces classes à implémenter certaines méthodes. On va garantir qu'un Model (par exemple) respecte le rôle qui lui a été attribué.

## Connexion utilisateur

**penser à faire un tour dans le code de la S03**

- On va travailler avec les sessions => session_start()
- Formulaire de connexion (POST)
- 2 routes
    - afficher le form (GET)
    - traiter la connexion (POST)
- comparer les info saisies avec les infos en BDD
    - récupérer l'utilisateur qui correspond à l'email saisi 
    - vérifier que le mot de passe saisi est le même que celui de l'user récupéré
- si les infos correspondent => utilisateur connu
    - Persister l'état "connecté" en stockant ses infos en session
- si les infos ne correspondent pas
    - message d'erreur pour afficher sur le formulaire (redirection donc)
